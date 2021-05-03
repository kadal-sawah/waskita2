<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penilaiankelompok extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Import();
    }

    private function Import()
    {
        $this->load->model('ModelPenilaianKelompok', 'pkelompok');
        $this->load->library('Library');
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('Login'));
        }
    }

    public function StoreAkivitasAsisten()
    {
        try {
            $input = $this->input->post();
            // $this->library->printr($input);
            if (!is_array($input['nilai_1'])) {
                throw new Exception('ceklis tidak tersedia');
            }
            $IdJabatan = $input['id_jabatan'];
            if (!is_array($IdJabatan)) {
                throw new Exception('Jabatan tidak tersedia');
            }
            $x = 0;
            foreach ($IdJabatan as $list) :
                $TampungJabatan[$x++]['id_jabatan'] = $list;
            endforeach;
            $ceklis = key($input['nilai_1']);

            $CekAsisten = $this->pkelompok->CekUdahInsertPenilaian($input['kelompok'], $ceklis, true);
            $Jabatan = json_encode($TampungJabatan);
            $DecodeJabatan = json_decode($Jabatan, true);

            // $this->library->printr(($input));
            if ($CekAsisten == false) {
    
                // echo array_sum($input['nilai_1'][$ceklis]) . ' + ' . array_sum($input['nilai_2'][$ceklis]);
                // $this->library->printr($total_nilai);
                $DataPenilaianPerorangan = [
                    'id_jabatan' => $Jabatan,
                    'id_ceklis' => $ceklis,
                    'tanggal' => date('Y-m-d'),
                    'tahun' => date('Y'),
                    'id_kelompok' => $input['kelompok'],
                    'total_nilai' => $input['rata-rata'],
                ];
                $this->db->insert('penilaian_perorangan', $DataPenilaianPerorangan);
                $IdPenilaianPerorangan = $this->db->insert_id();
                // insert detail penilaian perorangan => asisten
                $nil = 1;
                foreach ($DecodeJabatan as $listJabatan) :
                    // $this->library->printr($DecodeJabatan[0]);
                    foreach ($input['nilai_'.$nil][$ceklis] as $key => $list) :
                        // key = id_soal_perorangan
                        $DataPenilaianPer = [
                            'id_penilaian_perorangan' => $IdPenilaianPerorangan,
                            'id_soal_perorangan' => $key,
                            'nilai' => $list,
                            'id_jabatan' => $listJabatan['id_jabatan'],
                            'tanggal' => date('Y-m-d'),
                        ];
                $this->db->insert('detail_penilaian_perorangan', $DataPenilaianPer);
                endforeach;

                ++$nil;
                endforeach;

                $message = [
                    'status' => 200,
                    'message' => 'Penilaian Ceklis telah di tambahkan',
                ];
            } else {
                $nil = 1;
                $x = 0;
                $IdPenilaianPerorangan = null;
                $TampungNilai = [];

                foreach ($DecodeJabatan as $listJabatan) :
                    $this->db->select('pper.id_penilaian_perorangan');
                $this->db->from('penilaian_perorangan as pper');
                $this->db->where([
                        'id_kelompok' => $input['kelompok'],
                        'id_ceklis' => $ceklis,
                        'tanggal' => date('Y-m-d'),
                    ]);
                $ReadAsisten = $this->db->get();
                if ($ReadAsisten->num_rows() > 0) {
                    $SourceAsisten = $ReadAsisten->result_array();
                    // $this->library->printr($SourceAsisten);

                    foreach ($SourceAsisten as $ListAsisten) :
                            $IdPenilaianPerorangan = $ListAsisten['id_penilaian_perorangan'];
                    // echo '<pre>' . print_r($input['nilai_' . $nil][$ceklis], true) . '</pre>';
                    foreach ($input['nilai_'.$nil][$ceklis] as $key => $list) :
                                $TampungNilai[$x][] = $list;
                    // key = id_soal_perorangan
                    // echo $list . ',';
                    $DataPenilaianPer = [
                                    'nilai' => empty($list) ? 0 : $list,
                                ];
                    $this->db->where([
                                    'id_penilaian_perorangan' => $ListAsisten['id_penilaian_perorangan'],
                                    'id_jabatan' => $listJabatan['id_jabatan'],
                                    'id_soal_perorangan' => $key,
                                ]);
                    $this->db->update('detail_penilaian_perorangan', $DataPenilaianPer);
                    endforeach;
                    endforeach;
                    ++$x;
                    ++$nil;
                }

                endforeach;
                // $this->library->printr($TampungNilai);


                // update penilaian
                $this->db->where(['id_penilaian_perorangan' => $IdPenilaianPerorangan]);
                $this->db->update('penilaian_perorangan', ['total_nilai' => $input['rata-rata']]);
                $message = [
                    'status' => 200,
                    'message' => 'Penilaian Ceklis telah di update',
                ];
            }
        } catch (Exception $Error) {
            $message = [
                'status' => 400,
                'message' => $Error->getMessage(),
            ];
        } catch (Throwable $Error) {
            $message = [
                'status' => 400,
                'message' => 'Throwable : '.$Error->getLine().$Error->getMessage(),
            ];
        } finally {
            echo json_encode($message);
        }
    }

    public function StoreAktivitasPanglimaKas()
    {
        try {
            $input = $this->input->post();
            if (!is_array($input['nilai1'])) {
                throw new Exception('ceklis tidak tersedia');
            }
            if (!is_array($input['id_jabatan'])) {
                throw new Exception('jabatan tidak tersedia');
            }
            if (count($input['id_jabatan']) > 1) {
                throw new Exception('jabatan panglima/kepala staff hanya boleh di isi 1 orang dalam 1 kelompok');
            }
            $IdJabatan = $input['id_jabatan'][0];
            $ceklis = key($input['nilai1']);
            $CekPakas = $this->pkelompok->CekUdahInsertPenilaian($input['kelompok'], $ceklis, false);
            if ($CekPakas == true) {
                // mode edit
                $this->db->select('penilaian_perorangan.id_penilaian_perorangan, 
                                   penilaian_perorangan.id_jabatan');
                $this->db->from('penilaian_perorangan');
                $this->db->where([
                    'id_kelompok' => $input['kelompok'],
                    'id_ceklis' => $ceklis,
                ]);
                $EditPakas = $this->db->get();

                $SourcePakas = $EditPakas->result_array();
                foreach ($SourcePakas as $list) :
                    $this->db->select('dpper.nilai, dpper.id_jabatan');
                $this->db->from('detail_penilaian_perorangan as dpper');
                $this->db->where([
                        'id_penilaian_perorangan' => $list['id_penilaian_perorangan'],
                        'tanggal' => date('Y-m-d'),
                    ]);
                $ReadCekDetail = $this->db->get();
                if ($ReadCekDetail->num_rows() > 0) {
                    foreach ($input['nilai1'][$ceklis] as $key => $ListNilai) :

                            // key = id_soal_perorangan
                            $DataPenilaianPer = [
                                'nilai' => $ListNilai,
                            ];
                    $this->db->where([
                                'id_penilaian_perorangan' => $list['id_penilaian_perorangan'],
                                'id_soal_perorangan' => $key,
                            ]);
                    $this->db->update('detail_penilaian_perorangan', $DataPenilaianPer);
                    endforeach;
                } else {
                    // insert detail penilaian perorangan => panglima/kas
                    foreach ($input['nilai1'][$ceklis] as $key => $ListNilai) :
                            // key = id_soal_perorangan
                            $DataPenilaianPer = [
                                'id_penilaian_perorangan' => $list['id_penilaian_perorangan'],
                                'id_soal_perorangan' => $key,
                                'nilai' => $ListNilai,
                                'id_jabatan' => $IdJabatan,
                                'tanggal' => date('Y-m-d'),
                            ];
                    $this->db->insert('detail_penilaian_perorangan', $DataPenilaianPer);
                    endforeach;
                }

                // update penilaian perorangan

                $this->db->select('dpper.nilai');
                $this->db->from('detail_penilaian_perorangan as dpper');
                $this->db->where([
                        'id_penilaian_perorangan' => $list['id_penilaian_perorangan'],
                    ]);
                $ReadUpdate = $this->db->get();
                if ($ReadUpdate->num_rows() > 0) {
                    $SourceUpdate = $ReadUpdate->result_array();
                    $TotalUpdate = 0;
                    foreach ($SourceUpdate as $ListUpdate) :
                            $TotalUpdate += $ListUpdate['nilai'];
                    endforeach;

                    // proses update penilaian_perorangan
                    $this->db->where(['id_penilaian_perorangan' => $list['id_penilaian_perorangan']]);
                    $this->db->update('penilaian_perorangan', ['total_nilai' => number_format($TotalUpdate, 2)]);
                }
                endforeach;
                $message = [
                    'status' => 200,
                    'message' => 'Penilaian Ceklis telah di update',
                ];
            }
            // throw new Exception('Anda telah mengisi nilai panglima/Kepala staff untuk hari ini, silahkan coba dilain hari');
            // kalau penilain belum input
            if ($CekPakas == false) {
                // $this->library->printr($_POST);
                $DataPenilaianPerorangan = [
                    'id_jabatan' => json_encode([['id_jabatan' => $IdJabatan]]),
                    'id_ceklis' => $ceklis,
                    'tanggal' => date('Y-m-d'),
                    'tahun' => date('Y'),
                    'id_kelompok' => $input['kelompok'],
                    'total_nilai' => array_sum($input['nilai1'][$ceklis]),
                ];
                // insert table penilaian_perorangan;
                $this->db->insert('penilaian_perorangan', $DataPenilaianPerorangan);
                $IdPenilaianPerorangan = $this->db->insert_id();
                // insert detail penilaian perorangan => panglima/kas
                foreach ($input['nilai1'][$ceklis] as $key => $list) :
                    // key = id_soal_perorangan
                    $DataPenilaianPer = [
                        'id_penilaian_perorangan' => $IdPenilaianPerorangan,
                        'id_soal_perorangan' => $key,
                        'nilai' => $list,
                        'id_jabatan' => $IdJabatan,
                        'tanggal' => date('Y-m-d'),
                    ];
                $this->db->insert('detail_penilaian_perorangan', $DataPenilaianPer);
                endforeach;
                $message = [
                    'status' => 200,
                    'message' => 'Penilaian Ceklis telah di tambahkan',
                ];
            }
            // update penulaian pakas
            else {
            }
        } catch (Exception $Error) {
            $message = [
                'status' => 400,
                'message' => $Error->getMessage(),
            ];
        } catch (Throwable $Error) {
            $message = [
                'status' => 400,
                'message' => 'Throwable'.$Error->getMessage(),
            ];
        } finally {
            echo json_encode($message);
        }
    }

    public function getTeleponTelegram()
    {
        try {
            $kelompok = $this->input->get('kelompok');
            $this->db->select('telepon_telegram.h, 
                               telepon_telegram.h1,
                               telepon_telegram.h2,
                               telepon_telegram.h3,
                               telepon_telegram.tipe,
                            ');
            $this->db->from('telepon_telegram');
            $this->db->where([
                'id_kelompok' => $kelompok,
                'tahun' => date('Y'),
            ]);
            $ReadTeleponTelegram = $this->db->get();
            $message['count'] = $ReadTeleponTelegram->num_rows();
            $message['collections'] = [];
            if ($message['count'] > 0) {
                $message['collections'] = $ReadTeleponTelegram->result_array();
            }
        } catch (Exception $Error) {
            $message = [
                'count' => $Error->getMessage(),
                'collections' => [],
            ];
        } catch (Throwable $Error) {
            $message = [
                'count' => $Error->getMessage(),
                'collections' => [],
            ];
        } finally {
            echo json_encode($message);
        }
    }

    public function StoreTelTelpon()
    {
        try {
            $input = $this->input->post();
            if (count($input['telepon']) < 4) {
                throw new Exception('Nilai Telepon tidak diketahui');
            }
            if (count($input['telegram']) < 4) {
                throw new Exception('Nilai Telegram tidak diketahui');
            }
            $CekTeleponTelegram = $this->pkelompok->CekTeleponTelegram($input['kelompok']);
            if ($CekTeleponTelegram['return'] == false) {
                $DataTelepon = [
                    'id_kelompok' => $input['kelompok'],
                    'h' => $input['telepon'][0],
                    'h1' => $input['telepon'][1],
                    'h2' => $input['telepon'][2],
                    'h3' => $input['telepon'][3],
                    'tanggal' => date('Y-m-d'),
                    'tahun' => date('Y'),
                    'tipe' => 1,
                ];
                $DataTelegram = [
                    'id_kelompok' => $input['kelompok'],
                    'h' => $input['telegram'][0],
                    'h1' => $input['telegram'][1],
                    'h2' => $input['telegram'][2],
                    'h3' => $input['telegram'][3],
                    'tanggal' => date('Y-m-d'),
                    'tahun' => date('Y'),
                    'tipe' => 2,
                ];
                $this->db->insert('telepon_telegram', $DataTelepon);
                $this->db->insert('telepon_telegram', $DataTelegram);

                $message = [
                    'status' => 200,
                    'message' => 'Penilaian Telegram & Telepon telah ditambahkan',
                ];
            } elseif ($CekTeleponTelegram['return'] == true) {
                $DataTelepon = [
                    'h' => $input['telepon'][0],
                    'h1' => $input['telepon'][1],
                    'h2' => $input['telepon'][2],
                    'h3' => $input['telepon'][3],
                ];
                $DataTelegram = [
                    'h' => $input['telegram'][0],
                    'h1' => $input['telegram'][1],
                    'h2' => $input['telegram'][2],
                    'h3' => $input['telegram'][3],
                ];
                //updat telepon
                $this->db->where([
                    'id_kelompok' => $input['kelompok'],
                    'tipe' => '1',
                    'tahun' => date('Y'),
                ]);
                $this->db->update('telepon_telegram', $DataTelepon);
                $this->db->where([
                    'id_kelompok' => $input['kelompok'],
                    'tipe' => '2',
                    'tahun' => date('Y'),
                ]);

                $this->db->update('telepon_telegram', $DataTelegram);
                $message = [
                    'status' => 200,
                    'message' => 'Penilaian Telegram & Telepon telah diupdate',
                ];
            }
        } catch (Exception $Error) {
            $message = [
                'status' => 400,
                'message' => $Error->getMessage(),
            ];
        } catch (Throwable $Error) {
            $message = [
                'status' => 400,
                'message' => 'Throwable'.$Error->getMessage(),
            ];
        } finally {
            echo json_encode($message);
        }
    }

    public function StorePosko()
    {
        try {
            $input = $this->input->post();

            // $this->library->printr($input);
            // insert penilaian_kelompok
            if (!is_array($input)) {
                throw new Exception('nilai tidak diketahui');
            }
            $ceklis = key($input['nilai']);
            $DataInput = [
                'kelompok' => $input['kelompok'],
                'id_ceklis' => $ceklis,
                'penilaian' => $input['penilaian'],
            ];
            $CekModeEdit = $this->pkelompok->CekModeEditPosko($DataInput);
            if ($CekModeEdit == false) {
                // $this->library->printr($input);
                $DataKelompok = [
                    'id_kelompok' => $input['kelompok'],
                    'id_ceklis' => $ceklis,
                    'tahun' => date('Y'),
                    'tgl' => date('Y-m-d'),
                    'ket' => '-',
                    'total_nilai' => array_sum($input['nilai'][$ceklis]),
                    'total_nilai2' => array_sum($input['nilai_2'][$ceklis]),
                ];

                // $this->library->printr($input);

                $this->db->insert('penilaian_kelompok', $DataKelompok);
                $id = $this->db->insert_id();
                // insert detail_penilaian_kelompok
                foreach ($input['nilai'][$ceklis] as $key => $list) :
                    $DataDetail = [
                        'id_penilaian_kelompok' => $id,
                        'id_soal_kelompok' => $key,
                        'id_kelompok' => $input['kelompok'],
                        'id_ceklis' => $ceklis,
                        'penilai1' => $list,
                        'penilai2' => $input['nilai_2'][$ceklis][$key],
                    ];
                $this->db->insert('detail_penilaian_kelompok', $DataDetail);
                endforeach;
                $message = [
                    'status' => 200,
                    'message' => 'Penilaian telah ditambahkan',
                ];
            } else {
                $this->db->select('pkelompok.id_penilaian_kelompok');
                $this->db->from('penilaian_kelompok as pkelompok');
                $this->db->where([
                    'id_kelompok' => $DataInput['kelompok'],
                    'id_ceklis' => $DataInput['id_ceklis'],
                    'tahun' => date('Y'),
                ]);
                $ReadPosko = $this->db->get();
                if ($ReadPosko->num_rows() > 0) {
                    $SourcePosko = $ReadPosko->result_array();
                    $TotalNilai1 = 0;
                    $TotalNilai2 = 0;

                    foreach ($SourcePosko as $list) :
                        $TotalNilai1 = 0;
                    $TotalNilai2 = 0;
                    foreach ($input['nilai'][$ceklis] as $key => $val) :
                            $this->db->where([
                                'id_penilaian_kelompok' => $list['id_penilaian_kelompok'],
                                'id_soal_kelompok' => $key,
                            ]);

                    $this->db->update('detail_penilaian_kelompok', [
                                'penilai1' => $val,
                                'penilai2' => $input['nilai_2'][$ceklis][$key],
                                ]);

                    $TotalNilai1 += $val;
                    $TotalNilai2 += $input['nilai_2'][$ceklis][$key];
                    endforeach;
                    $this->db->where(['id_penilaian_kelompok' => $list['id_penilaian_kelompok']]);
                    $this->db->update('penilaian_kelompok', [
                            'tgl' => date('Y-m-d H:i:s'),
                            'total_nilai' => $TotalNilai1,
                            'total_nilai2' => $TotalNilai2,
                            ]);
                    endforeach;
                    $message = [
                        'status' => 200,
                        'message' => 'Penilaian telah diupdate',
                    ];
                } else {
                    throw new Exception('Penilaian gagal diupdate, silahkan hubungi admin');
                }
            }
        } catch (Exception $Error) {
            $message = [
                'status' => 400,
                'message' => $Error->getMessage(),
            ];
        } catch (Throwable $Error) {
            $message = [
                'status' => 400,
                'message' => 'Throwable'.$Error->getMessage(),
            ];
        } finally {
            echo json_encode($message);
        }
    }

    public function index()
    {
        try {
            // Read anggota
            $ReadKelompok = $this->pkelompok->ReadKelompok();
            $data['CountKelompok'] = $ReadKelompok['count'];
            $data['CollectionsKelompok'] = [];

            if ($data['CountKelompok'] > 0) {
                $data['CollectionsKelompok'] = $ReadKelompok['collections']->result_array();
            }
            // $this->library->printr($GetDataPenilaian['collections']->result_array());
            $this->load->view('PenilaianKelompok/Tambah', $data);
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','".($Error->getMessage())."')</script>");
            redirect();
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','Throwable ".($Error->getMessage())."')</script>");
            redirect();
        }
    }

    public function Get($IdKelompok = null)
    {
        error_reporting(0);

        $list = $this->pkelompok->get_datatables($IdKelompok);
        // if ($list['count'] <= 0)
        //     throw new Exception('Data kosong');

        $no = $_POST['start'];

        $data = [];
        $sub = null;
        foreach ($list['collections'] as $field) {
            $id = sha1($field['id_kelompok']);
            $Nposko = $this->pkelompok->NilaiPosko($id);
            $Nproduk = $this->pkelompok->NilaiProduk($id);
            $NTelegram = $this->pkelompok->NilaiTelegram($id);
            $NTelepon = $this->pkelompok->NilaiTelepon($id);
            $row = [];
            $row[] = $field['nama_kelompok'];
            $row[] = $field['jumlah_anggota'].' Anggota';
            $row[] = number_format($Nproduk, 2);
            $row[] = number_format($Nposko, 2);
            $row[] = number_format($NTelepon, 2);
            $row[] = number_format($NTelegram, 2);
            // $row[] = number_format($NTelepon, 2);
            // $row[] = number_format($NTelegram, 2);

            // $data['NilaiPosko'] = $NilaiPosko ;

            // $row[] = $field['nilai_posko'] * 20 / 100;

            $row[] = "<a href='".base_url('penilaiankelompok/tambah/'.$id)."'
                        class='btn btn-dark px-2 montserrat-600 letter-spacing py-1'>
                        <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24'
                        stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                        <path stroke='none' d='M0 0h24v24H0z' />
                        <polyline points='9 11 12 14 20 6' />
                        <path d='M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9' /></svg>
                        Beri nilai
                    </a>";
            $data[] = $row;
            ++$no;
        }
        $output = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->pkelompok->count_all(),
            'recordsFiltered' => $this->pkelompok->count_filtered(),
            'data' => $data,
        ];

        echo json_encode($output);
    }

    public function storetel()
    {
        try {
            $input = $this->input->post();
            // $this->library->printr($input);
            if (!$input) {
                throw new Exception('POST Method');
            }
            $data = [
                'id_kelompok' => $this->library->XssClean('id_kelompok'),
                'id_ceklis' => $this->library->XssClean('ceklis'),
                'H' => $input['H'],
                'H_1' => $input['H_1'],
                'H_2' => $input['H_2'],
                'H_3' => $input['H_3'],
                'tipe_nilai' => $input['tipe_nilai'],
                'ket' => '',
            ];
            // $this->library->printr($data);
            // cek
            // $UpdateOrAdd = $this->pkelompok->UpdateOrAdd($data);

            $Insert = $this->pkelompok->StoreTel($data);
            if ($Insert['status'] != 200) {
                throw new Exception($Insert['message']);
            }
            $this->session->set_flashdata('pesan', "<script>pesan_sukses('Pesan','Data telah ditambahkan')</script>");
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','".($Error->getMessage())."')</script>");
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','".($Error->getMessage())."')</script>");
        } finally {
            redirect('penilaiankelompok/tambah/'.sha1($data['id_kelompok']));
        }
    }

    public function store()
    {
        try {
            $input = $this->input->post();
            $this->library->printr($input);
            if (!$input) {
                throw new Exception('POST Method');
            }
            $this->session->set_flashdata('pesan', "<script>pesan_sukses('Pesan','Data telah ditambahkan')</script>");
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','".($Error->getMessage())."')</script>");
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','".($Error->getMessage())."')</script>");
        } finally {
            redirect('penilaiankelompok/tambah/'.sha1($data['id_kelompok']));
        }
    }

    public function update()
    {
        try {
            $input = $this->input->post();
            if (!$input) {
                throw new Exception('POST Method');
            }
            $IdSoalKelompok = $input['id_soal_kelompok'];

            $data = [
                'id_detail_penilaian_kelompok' => $this->input->post('id_detail_penilaian_kelompok'),
                'id_soal_kelompok' => $IdSoalKelompok,
                'id_kelompok' => $this->library->XssClean('id_kelompok'),
                'id_ceklis' => $this->library->XssClean('ceklis'),
                'nilai' => $input['nilai'],
                'ket' => $input['ket'],
            ];

            $Update = $this->pkelompok->StoreUpdate($data);
            if ($Update != true) {
                throw new Exception('Sedang terjadi masalah, silahkan coba beberapa saat lagi');
            }
            $this->session->set_flashdata('pesan', "<script>pesan_sukses('Pesan','Data telah update')</script>");
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','".($Error->getMessage())."')</script>");
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','".($Error->getMessage())."')</script>");
        } finally {
            redirect('penilaiankelompok/tambah/'.sha1($data['id_kelompok']));
        }
    }

    public function updatetel()
    {
        try {
            $input = $this->input->post();
            if (!$input) {
                throw new Exception('POST Method');
            }
            $data = [
                'id_kelompok' => $this->library->XssClean('id_kelompok'),
                'id_ceklis' => $this->library->XssClean('ceklis'),
                'id_aktivitas' => $this->library->Decode($this->input->post('id_aktivitas'), 3),
                'h' => $input['H'],
                'h1' => $input['H_1'],
                'h2' => $input['H_2'],
                'h3' => $input['H_3'],
            ];
            // $this->library->printr($data);
            $Update = $this->pkelompok->StoreUpdateTel($data);

            $this->session->set_flashdata('pesan', "<script>pesan_sukses('Pesan','Data telah update')</script>");
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','".($Error->getMessage())."')</script>");
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','".($Error->getMessage())."')</script>");
        } finally {
            redirect('penilaiankelompok/tambah/'.sha1($data['id_kelompok']));
        }
    }

    public function Ajaxanggota()
    {
        $id = $this->input->get('data');
        $GetAnggota = $this->pkelompok->AjaxAnggota($id);
        $data['count'] = 0;
        if ($GetAnggota->num_rows() > 0) {
            $source = $GetAnggota->row();
            $data['nrp'] = $source->nrp;
            $data['id_anggota'] = $source->id_anggota;
            $data['nama_pangkat'] = $source->nama_pangkat;
            $data['count'] = $GetAnggota->num_rows();
        }
        echo json_encode($data);
    }

    public function Ajaxkelompok($id = null)
    {
        error_reporting(0);

        try {
            $GetAnggota = $this->pkelompok->get_datatables($id);

            if ($GetAnggota['count'] <= 0) {
                throw new Exception('Data kosong');
            }
            foreach ($GetAnggota['collections'] as $field) {
                $id = sha1($field['id_anggota']);
                $row = [];

                $row[] = $field['nama'];
                $row[] = $field['nama_pangkat'];
                $row[] = $field['nrp'];
                $row[] = $field['nama_kelompok'];

                $row[] = "<a href='".base_url('penilaianperorangan/tambah/'.$id)."'
                                class='btn btn-primary px-2 montserrat-600 letter-spacing py-1'>
                                <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24'
                                stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                                <path stroke='none' d='M0 0h24v24H0z' />
                                <polyline points='9 11 12 14 20 6' />
                                <path d='M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9' /></svg>
                                Beri nilai
                            </a>";
                $data[] = $row;
            }
            $message = [
                'draw' => $_POST['draw'],
                'recordsTotal' => $this->pkelompok->count_all(),
                'recordsFiltered' => $this->pkelompok->count_filtered(),
                'data' => $data,
            ];
            echo json_encode($message);
        } catch (Exception $Error) {
            $message = [
                'draw' => '1',
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
            ];
            echo json_encode($message);
        } catch (Throwable $Error) {
            $message = [
                'draw' => '1',
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
            ];
            echo json_encode($message);
        }
    }

    public function AjaxAktivitas()
    {
        $input = $this->input->get();
        // $this->library->printr($input);
        $GetData = [
            'tipe_ceklis' => $input['tipe_ceklis'],
            'kelompok' => $input['id_kelompok'],
        ];
        $GetDataSoal = $this->pkelompok->ReadCeklisTipeAktivitas($GetData);
        $data['CountSoal'] = $GetDataSoal['count'];
        $data['CollectionsCeklis'] = [];
        if ($GetDataSoal['count'] > 0) {
            $data['CollectionsCeklis'] = $GetDataSoal['collections'];
        }
        $data['edit'] = [];

        $GetModeEdit = $this->pkelompok->ModeEditAktivitas([
            'tipe_ceklis' => $input['tipe_ceklis'],
            'id_kelompok' => $input['id_kelompok'],
        ]);
        if ($GetModeEdit['count'] > 0) {
            $data['edit'] = $GetModeEdit['collections'];
        }
        // $this->library->printr($data);
        // $this->db->select('c.id_ceklis, c.is_asisten, c.id_jabatan, c.nama_ceklis, c.tanggal');
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        echo json_encode($data);
    }

    public function ajaxproduk()
    {
        $input = $this->input->get();
        $tipe = $input['tipe_ceklis'];
        $GetDataSoal = $this->pkelompok->ReadCeklisTipeProduk($tipe);
        $data['CountSoal'] = $GetDataSoal['count'];
        $data['CollectionsCeklis'] = [];
        if ($GetDataSoal['count'] > 0) {
            $data['CollectionsCeklis'] = $GetDataSoal['collections'];
        }

        $Edit = [
            'id_kelompok' => $input['id_kelompok'],
            'tipe_ceklis' => $tipe,
        ];

        $ReadEdit = $this->db->select('
            penilaian_kelompok.id_penilaian_kelompok,
            penilaian_kelompok.id_kelompok,
            penilaian_kelompok.total_nilai')
            ->from('penilaian_kelompok')
            ->where(['id_kelompok' => $Edit['id_kelompok']])
            ->get();

        $data['mode'] = false;

        $data['edit'] = [];
        if ($ReadEdit->num_rows() > 0) {
            $data['mode'] = true;
            $source = $ReadEdit->result_array();
            $tampung = [];
            foreach ($source as $list):
                $readDetailPenilaian = $this->db->get_where('detail_penilaian_kelompok', ['id_penilaian_kelompok' => $list['id_penilaian_kelompok']]);

            $sourceDetail = $readDetailPenilaian->result_array();

            foreach ($sourceDetail as $list2):
                    $tampung[($list2['id_ceklis'])][($list2['id_soal_kelompok'])]['nilai'] = $list2['penilai1'];
            $tampung[($list2['id_ceklis'])][($list2['id_soal_kelompok'])]['nilai2'] = $list2['penilai2'];
            endforeach;
            $data['edit'] = $tampung;
            endforeach;
        }

        // kalo edit n
        echo json_encode($data);
    }

    public function ajaxposko()
    {
        $input = $this->input->get();
        $DataInput = [
            'tipe_ceklis' => $input['tipe_ceklis'],
            'id_kelompok' => $input['kelompok'],
            'penilaian' => $input['penilaian'],
        ];
        $GetDataSoal = $this->pkelompok->ReadCeklisTipeProduk($DataInput['tipe_ceklis']);

        $data['CountSoal'] = $GetDataSoal['count'];
        $data['CollectionsCeklis'] = [];
        if ($GetDataSoal['count'] > 0) {
            $data['CollectionsCeklis'] = $GetDataSoal['collections'];
        }

        $EditMode = $this->pkelompok->CekModeEditKelompokPosko($DataInput);
        $data['edit'] = [];
        $data['CountEdit'] = count($EditMode['collections']);
        if (count($EditMode['collections'])) {
            $data['edit'] = $EditMode['collections'];
        }
        echo json_encode($data);
    }

    public function dokumen($IdKelompok)
    {
        $input = $this->input->get();
        $ceklis = $input['ceklis'];
        $GetDataSoal = $this->pkelompok->ReadSoal($ceklis);
        $data['CountSoal'] = $GetDataSoal['count'];
        $data['CollectionsSoal'] = 0;
        $data['mode'] = false;
        $data['edit'] = [];
        if ($data['CountSoal'] > 0) {
            $data['CollectionsSoal'] = $GetDataSoal['collections']->result_array();
            $data['nama_ceklis'] = $GetDataSoal['nama_ceklis'];

            // mode edit
            $SetData = [
                'id_ceklis' => $ceklis,
                'id_kelompok' => $IdKelompok,
            ];
            $CekMode = $this->pkelompok->EditPenilaian($SetData);
            $data['mode'] = $CekMode['edit'];
            $data['edit'] = false;
            $data['ket'] = [];
            if ($data['mode'] == true) {
                $data['edit'] = $CekMode['EditData'];
                $data['ket'] = $CekMode['ket'];
            }
        }
        echo json_encode($data);
    }

    public function ajaxtipe()
    {
        $data = $this->input->get('data');

        $Ceklis = $this->db->get_where('ceklis', ['tipe' => $data]);

        $SetData['collections'] = [];
        $SetData['count'] = 0;
        if ($Ceklis->num_rows() > 0) {
            $source = $Ceklis->result_array();
            $SetData['collections'] = $source;
            $SetData['count'] = $Ceklis->num_rows();
        }
        echo json_encode($SetData);
    }

    public function ajaxtel($IdKelompok)
    {
        $GetData = $this->input->get('ceklis');
        // $this->library->printr($_GET);
        $SetData = [
            'id_ceklis' => $GetData,
            'id_kelompok' => $IdKelompok,
        ];
        $Aktivitas = $this->pkelompok->EditPenilaianAktivitas($SetData);
        // $this->library->printr($Aktivitas);
        $data['mode'] = false;
        $data['EditData'] = [];
        $data['tipe'] = null;
        $data['count'] = $Aktivitas['count'];
        if ($Aktivitas['mode'] == true && $Aktivitas['count'] > 0) {
            $data['mode'] = true;
            $data['EditData'] = $Aktivitas['EditData'];
            $data['tipe'] = $Aktivitas['tipe'];
        }

        // $this->library->printr($data);
        echo json_encode($data);
    }
}
