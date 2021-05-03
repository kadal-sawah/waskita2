<?php

class ModelPenilaianPerorangan extends CI_Model
{
    public $table = 'penilaian_perorangan as pen';
    public $table1 = 'soal_perorangan as soalp';
    public $table2 = 'anggota as a';
    public $table3 = 'ceklis as c';
    public $table4 = 'kelompok as k';
    public $table5 = 'detail_penilaian_perorangan as dpp';
    public $column_order = [null, 'a.nama', null, 'a.nrp', 'k.nama_kelompok']; //field yang ada di table
    public $column_search = ['a.nama', 'a.nrp', 'k.nama_kelompok']; //field yang diizin untuk pencarian
    public $order = ['id_anggota' => 'desc']; // default order

    public function __construct()
    {
        parent::__construct();
    }

    public function ReadJabatan()
    {
        $this->db->select('jabatan.id_jabatan, jabatan.nama_jabatan');
        $this->db->from('jabatan');
        $this->db->order_by('urutan', 'asc');
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;
        if ($GetData->num_rows() > 0) {
            $data['collections'] = $GetData;
            $data['count'] = $GetData->num_rows();
        }

        return $data;
    }

    private function CekNilai($IdPenilaianPerorangan, $fieldnilai, $count)
    {
        $this->db->select('dpper.id_penilaian_perorangan');
        $this->db->from('detail_penilaian_perorangan as dpper');
        $this->db->where(['id_penilaian_perorangan' => $IdPenilaianPerorangan, $fieldnilai => 0]);
        $Read = $this->db->get();
        $cek = $Read->num_rows();

        if ($cek == $count) {
            return true;
        } else {
            return false;
        }
    }

    public function ReadAnggotaMix($where)
    {
        // if ($tanggal == null) $tanggal = date('Y-m-d');
        $this->db->select('anggota.id_anggota,
                           anggota.id_jabatan,
                           anggota.nama,
                           pangkat.nama_pangkat,
                           jabatan.nama_jabatan,
                           jabatan.is_plus');
        $this->db->from('anggota');
        $this->db->where(['id_kelompok' => $where['kelompok']]);
        $this->db->join('pangkat', 'anggota.id_pangkat = pangkat.id_pangkat', 'left');
        $this->db->join('jabatan', 'anggota.id_jabatan = jabatan.id_jabatan', 'inner');
        $this->db->order_by('urutan', 'asc');
        $Read = $this->db->get();
        $data['count'] = $Read->num_rows();
        $data['collections'] = [];
        if ($Read->num_rows() > 0) {
            $SourceData = $Read->result_array();
            $no = 0;
            $TampungNilai = 0;
            $TampungPerHari = [];
            foreach ($SourceData as $list) :
                // $tampung[$no]['id_kelompok'] = $list['id_kelompok'];
                $tampung[$no]['id_anggota'] = $list['id_anggota'];
            $tampung[$no]['id_jabatan'] = $list['id_jabatan'];
            $tampung[$no]['nama'] = $list['nama'];
            $tampung[$no]['nama_pangkat'] = $list['nama_pangkat'];
            $tampung[$no]['nama_jabatan'] = $list['nama_jabatan'];
            $tampung[$no]['is_plus'] = $list['is_plus'];

            $this->db->select('pper.total_nilai, pper.id_kelompok, pper.id_jabatan, pper.id_penilaian_perorangan,pper.id_ceklis, ceklis.is_asisten');
            // $DecodeJabatanAgt = json_decode($list['id_jabatan'], true);
            $this->db->from('penilaian_perorangan as pper');
            $this->db->join('ceklis', 'ceklis.id_ceklis = pper.id_ceklis', 'inner');
            $this->db->join('kelompok', 'kelompok.id_kelompok = pper.id_kelompok', 'inner');

            if ($where['tanggal'] != null) {
                $wherep['pper.tanggal'] = $where['tanggal'];
            }
            $wherep['pper.id_kelompok'] = $where['kelompok'];
            $this->db->where($wherep);
            $ReadPerorangan = $this->db->get();
            if ($ReadPerorangan->num_rows() > 0) {
                $source = $ReadPerorangan->result_array();
                // $this->library->printr($source);
                $TampungPerHari = [];
                foreach ($source as $ListPerorangan) :
                        $tampung[$no]['id_kelompok'] = $ListPerorangan['id_kelompok'];
                // jabatan
                $DecodeJabatan = json_decode($ListPerorangan['id_jabatan'], true);
                $nil = 1;
                // $tampung[$no]['nilai_aktivitas'][] = 0;
                foreach ($DecodeJabatan as $ListJabatan) :
                            if ($list['id_jabatan'] == $ListJabatan['id_jabatan']) {
                                $this->db->select('dpper.nilai, dpper.id_jabatan');
                                $this->db->from('detail_penilaian_perorangan as dpper');
                                if ($where['tanggal'] != null) {
                                    $wherePenilaian['dpper.tanggal'] = $where['tanggal'];
                                }

                                $wherePenilaian['id_penilaian_perorangan'] = $ListPerorangan['id_penilaian_perorangan'];
                                $wherePenilaian['id_jabatan'] = $ListJabatan['id_jabatan'];
                                $this->db->where($wherePenilaian);

                                $ReadDpp = $this->db->get();
                                //$TampungNilai = 0;
                                // $this->library->printr($ReadDpp->result_array());

                                //if ($ReadDpp->num_rows() > 0) {
                                //    $SourceDpp = $ReadDpp->result_array();
                                //    foreach ($SourceDpp as $ListDpp) :
                                //        $TampungNilai += $ListDpp['nilai'];
                                //    endforeach;
                                //}
                                // $this->library->printr($TampungNilai);
                                $tampung[$no]['nilai_aktivitas'][] = $ListPerorangan['total_nilai'];

                                ++$nil;
                            }

                endforeach;
                endforeach;
            }

            // penilaian produk
            $TampungNilaiProduk = 0;
            // kalau panglima

            if ($list['id_jabatan'] == 209 || $list['id_jabatan'] == 272) {
                $this->db->select('SUM(pkelompok.total_nilai) as total_nilai');
                $this->db->from('penilaian_kelompok as pkelompok');
                $this->db->where([
                        'id_kelompok' => $where['kelompok'],
                        'tahun' => date('Y'),
                        'ceklis.tipe' => 1, // produk
                    ]);
                $this->db->join('ceklis', 'pkelompok.id_ceklis = ceklis.id_ceklis', 'inner ');

                $ReadPenilaianKelompok = $this->db->get();
                $tampung[$no]['nilai_produk'] = [];
                if ($ReadPenilaianKelompok->num_rows() > 0) {
                    $PanglimaProduk = $ReadPenilaianKelompok->row();
                    if ($where['kelompok'] == 9 and ($list['id_jabatan'] == 9 || $list['id_jabatan'] == 27)) {
                        $tampung[$no]['nilai_produk'] = number_format($PanglimaProduk->total_nilai / ($this->CountCeklisProduk() - 2), 2);
                    } else {
                        $tampung[$no]['nilai_produk'] = number_format($PanglimaProduk->total_nilai / $this->CountCeklisProduk(), 2);
                    }

                    // $this->library->printr($SourcePenilaianKel);
                }
            } else {
                // selain panglima
                $this->db->select('pkelompok.total_nilai,pkelompok.id_ceklis,    ceklis.id_jabatan');
                $this->db->from('penilaian_kelompok as pkelompok');
                $this->db->where([
                        'id_kelompok' => $where['kelompok'],
                        'tahun' => date('Y'),
                        'ceklis.tipe' => 1, // produk,
                        'ceklis.id_jabatan !=' => '',
                    ]);
                $this->db->like('ceklis.id_jabatan', $list['id_jabatan']);
                $this->db->join('ceklis', 'pkelompok.id_ceklis = ceklis.id_ceklis', 'inner ');
                $ReadProduk = $this->db->get();
                if ($ReadProduk->num_rows() > 0) {
                    $SourceProduk = $ReadProduk->result_array();
                    // $this->library->printr($SourceProduk);
                    // echo '<pre>' . print_r($SourceProduk, true) . '</pre>';
                    $TampungNilProd = [];
                    foreach ($SourceProduk as $listProduk) :
                            // $DecodeJabatanPrd = json_decode($listProduk['id_jabatan'], true);
                            // foreach ($DecodeJabatanPrd as $listJbt) :
                            //     $TampungListJabatan[] = $listJbt['id_jabatan'];
                            // endforeach;
                            // $this->library->printr($TampungListJabatan);
                            if ($ReadProduk->num_rows() > 1) {
                                $TampungNilProd[] = $listProduk['total_nilai'];
                            } else {
                                $TampungNilProd[] = $listProduk['total_nilai'];
                            }

                    endforeach;
                    // $this->library->printr($TampungNilProd);
                    // echo '<pre>' . print_r($TampungNilProd, true) . '</pre>';
                    $tampung[$no]['nilai_produk'] = number_format(array_sum($TampungNilProd) / count($TampungNilProd), 2);
                    // $tampung[$no]['nilai_produk'] = $TampungNilProd;
                }
            }

            // $tampung[$no]['nilai_produk'] = $TampungNilaiProduk;
            ++$no;
            endforeach;
            // foreach ($tampung as $key) {
            //     // echo substr($key['nama_jabatan'], 0, 3);
            //     if (substr($key['nama_jabatan'], 0, 2) == "As") {
            //         echo $key['nama_jabatan'] . " : " . $key['nilai_produk'] . "<br>";
            //     }
            // }
            $data['collections'] = $tampung;
            // $this->library->printr($tampung);
        }

        return $data;
    }

    private function CountCeklisProduk()
    {
        $this->db->select('COUNT(ceklis.id_ceklis) as CEKLIS');
        $this->db->from('ceklis');
        $where['tipe'] = 1;

        $this->db->where($where);

        return $this->db->get()->row()->CEKLIS;
    }

    private function CountAnggota($kelompok, $is_plus = true)
    {
        $this->db->select('anggota.id_anggota, jabatan.is_plus');
        $this->db->from('anggota');
        $this->db->join('jabatan', 'anggota.id_jabatan = jabatan.id_jabatan', 'inner');
        if ($is_plus == true) {
            $where['is_plus !='] = 1;
        }
        $where['id_kelompok'] = $kelompok;

        $this->db->where($where);

        return $this->db->get()->num_rows();
    }

    public function AjaxAnggota($param = null)
    {
        $this->db->select('a.id_anggota, a.nrp, pangkat.nama_pangkat');
        $this->db->from($this->table2);
        $this->db->where('id_anggota', $param);
        $this->db->join('pangkat', 'a.id_pangkat = pangkat.id_pangkat', 'inner');

        return $this->db->get();
    }

    public function ReadSoal($ceklis)
    {
        $this->db->select('soalp.id_soal_perorangan, soalp.is_asisten, soalp.tindakan_macam, soalp.nilmax');
        $this->db->from($this->table1);
        $this->db->where('soalp.id_ceklis', $ceklis);
        $this->db->where('is_aktif', 1);
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;
        if ($GetData->num_rows() > 0) {
            $data['collections'] = $GetData;
            $data['count'] = $GetData->num_rows();
        }

        return $data;
    }

    public function ReadCeklis($where = null)
    {
        $this->db->select('c.id_ceklis, c.nama_ceklis');
        $this->db->from($this->table3);
        $AddWhere['tipe'] = 5;
        if ($where != null) {
            $AddWhere['c.id_ceklis'] = $where;
        }

        $this->db->where($AddWhere);
        $this->db->order_by('c.id_ceklis', 'ASC');
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;
        if ($GetData->num_rows() > 0) {
            $data['collections'] = $GetData;
            $data['count'] = $GetData->num_rows();
        }

        return $data;
    }

    public function CekAnggota($id = null)
    {
        try {
            if ($id == null) {
                throw new Exception('daftar anggota kosong');
            }
            $this->db->select('k.nama_kelompok');

            $this->db->from($this->table2);
            $this->db->join($this->table4, 'a.id_kelompok = k.id_kelompok', 'inner');
            $this->db->where(['sha1(k.id_kelompok)' => $id]);

            $GetData = $this->db->get();
            $data['collections'] = [];
            $data['count'] = 0;
            if ($GetData->num_rows() > 0) {
                $data['collections'] = $GetData;
                $data['count'] = $GetData->num_rows();
            }
        } catch (Exception $Error) {
            $data = [
                'count' => 0,
                'collections' => [],
            ];
        } catch (Throwable $Error) {
            $data = [
                'count' => 0,
                'collections' => [],
            ];
        } finally {
            return $data;
        }
    }

    public function ReadAnggota($id)
    {
        $this->db->select('a.nama, 
                           a.nrp,
                           a.id_anggota,
                           k.id_kelompok,
                           k.nama_kelompok,
                           (SELECT jab.nama_jabatan FROM jabatan as jab WHERE jab.id_jabatan = a.id_jabatan) AS nama_jabatan,
                           (SELECT pang.nama_pangkat FROM pangkat as pang WHERE pang.id_pangkat = a.id_pangkat) AS nama_pangkat');
        $this->db->from($this->table2);
        $this->db->join($this->table4, 'a.id_kelompok = k.id_kelompok', 'inner');
        if ($id != null) {
            $this->db->where(['sha1(a.id_anggota)' => $id]);
        }

        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;
        if ($GetData->num_rows() > 0) {
            $data['collections'] = $GetData;
            $data['count'] = $GetData->num_rows();
        }

        return $data;
    }

    public function ReadNilaiAnggota($IdAnggota)
    {
        // akumulasi data
        $this->db->select('SUM(dpp.nilai) AS nilai_perorangan');
        $this->db->from($this->table5);
        $this->db->where(['sha1(dpp.id_anggota)' => $IdAnggota]);
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;
        if ($GetData->num_rows() > 0) {
            $data['collection'] = $GetData->row()->nilai_perorangan;
            $data['count'] = $GetData->num_rows();
        }

        return $data;
    }

    public function ReadKelompok($id = null)
    {
        $this->db->select('k.nama_kelompok, k.id_kelompok');
        $this->db->from($this->table4);
        if ($id != null) {
            $this->db->where(['sha1(k.id_kelompok)' => $id]);
        }

        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;
        if ($GetData->num_rows() > 0) {
            $data['collections'] = $GetData;
            $data['count'] = $GetData->num_rows();
        }

        return $data;
    }

    public function TotalNilai($id)
    {
        $this->db->select('(SELECT SUM(dpper.nilai) FROM detail_penilaian_perorangan dpper WHERE dpper.id_anggota = a.id_anggota) AS total_nilai');
        $this->db->from($this->table2);
        $this->db->join($this->table4, 'a.id_kelompok = k.id_kelompok', 'inner');
        $this->db->where('sha1(k.id_kelompok)', $id);
        // $this->db->where('k.id_kelompok', sha1($id));
        $Req = $this->db->get()->result();
        $data = 0;
        foreach ($Req as $key) {
            $data += $key->total_nilai;
        }

        return $data;
    }

    private function _get_datatables_query($id = null)
    {
        error_reporting(0);
        $this->db->select('a.nrp, 
                           a.nama,
                           a.id_anggota,
                           k.id_kelompok,
                           (SELECT j.nama_jabatan FROM jabatan j WHERE j.id_jabatan = a.id_jabatan) AS nama_jabatan,
                           (SELECT SUM(dpper.nilai) FROM detail_penilaian_perorangan dpper WHERE dpper.id_anggota = a.id_anggota) AS total_nilai,
                           k.nama_kelompok');

        $this->db->from($this->table2);
        $this->db->join($this->table4, 'a.id_kelompok = k.id_kelompok', 'inner');
        $this->db->where('sha1(k.id_kelompok)', $id);

        $i = 0;

        foreach ($this->column_search as $item) {
            if (!empty($_POST['search']['value'])) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            ++$i;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables($id = null)
    {
        $this->_get_datatables_query($id);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        $data['count'] = 0;
        $data['collections'] = [];
        if ($query->num_rows() > 0) {
            $data['count'] = $query->num_rows();
            $data['collections'] = $query->result_array();
        }

        return $data;
    }

    public function count_filtered($id = null)
    {
        $this->_get_datatables_query($id);
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_all($IdKelompok)
    {
        $this->db->from($this->table2);
        $this->db->where('sha1(a.id_kelompok)', $IdKelompok);

        return $this->db->get()->num_rows();
    }

    public function cekPerubahan()
    {
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);

        return $this->cekPerubahan();
    }

    public function update($data, $where)
    {
        $this->db->where($where);
        $this->db->update($this->table, $data);

        return $this->cekPerubahan();
    }

    public function delete($where)
    {
        $this->db->where($where);
        $this->db->delete($this->table);

        return $this->cekPerubahan();
    }

    public function Store($data = null)
    {
        if (!is_array($data)) {
            return false;
        }

        // insert data ke penilaian perorangan
        $DataPenilaian = [
            'id_anggota' => $data['id_anggota'],
            'id_ceklis' => $data['id_ceklis'],
            'tanggal' => date('Y-m-d'),
        ];

        $this->db->insert('penilaian_perorangan', $DataPenilaian);
        $id = $this->db->insert_id();

        $message = [
            'status' => 400,
            'message' => 'kolom ada yang kosong',
        ];
        if (count($data['id_soal_perorangan']) == count($data['nilai'])) {
            $x = 0;
            foreach ($data['nilai'] as $key => $list) {
                // insert data detail penilaian perorangan
                $DataDetailPenilaian = [
                    'id_penilaian_perorangan' => $id,
                    'id_soal_perorangan' => $key,
                    'id_anggota' => $DataPenilaian['id_anggota'],
                    'nilai' => $list,
                ];
                $this->db->insert('detail_penilaian_perorangan', $DataDetailPenilaian);
            }
            // echo count($data['id_soal_perorangan']) . '==' . count($data['nilai']);
            // $this->library->printr($data);

            $message = [
                'status' => 200,
                'message' => 'ok',
            ];
        }

        return $message;
    }

    public function StoreUpdate($data = null)
    {
        if (!is_array($data)) {
            return false;
        }
        // $this->library->printr($data);
        if (count($data['id_soal_perorangan']) == count($data['nilai'])) {
            $counter = 0;
            // $this->library->printr($data);
            foreach ($data['nilai'] as $list) :
                // if (empty($data['nilai'][$counter])) {
                //     // insert penilaian perorangan

                // }
                $SetData = [
                    'nilai' => $list,
                ];
            $this->db->where(['id_detail_penilaian_perorangan' => $this->library->Decode($data['id_detail_penilaian_perorangan'][$counter], 3)]);
            $this->db->update($this->table5, $SetData);

            ++$counter;
            endforeach;

            return true;
        }

        return false;
    }

    public function CekUpdateAdd($data)
    {
        try {
            // read data penilaian perorangan
            $param = [
                'id_anggota' => $data['id_anggota'],
                'id_ceklis' => $data['id_ceklis'],
            ];

            $query = $this->db->get_where($this->table, $param);

            // cek ketersediaan data
            if ($query->num_rows() > 0) {
                // mode edit
                $source = $query->row();
                $IdPenilaianPerorangan = $source->id_penilaian_perorangan;
                $IdSoalPerorangan = $data['id_soal_perorangan'];
                $ReadDetailPenilaian = $this->db->get_where($this->table5, [
                    'dpp.id_soal_perorangan' => $IdSoalPerorangan,
                    'dpp.id_penilaian_perorangan' => $IdPenilaianPerorangan,
                ]);
                if ($ReadDetailPenilaian->num_rows() <= 0) {
                    throw new Exception('Data penilaian Kosong');
                }
                foreach ($ReadDetailPenilaian as $list) :
                    $DataUpdate = [
                        'nilai',
                    ];

                endforeach;

                $this->db->update($this->table5, []);
            }

            $message = [
                'status' => 200,
                'message' => 'ok',
                'data' => '',
            ];
        } catch (Exception $Error) {
            $message = [
                'status' => 400,
                'message' => $Error->getMessage(),
            ];
        } catch (Throwable $Error) {
            $message = [
                'status' => 400,
                'message' => 'Throwable '.$Error->getMessage(),
            ];
        } finally {
            return $message;
        }
    }

    public function EditPenilaian($data)
    {
        error_reporting(0);

        // panggil tabel penilaian perorangan
        $Req = $this->db->get_where($this->table, $data);

        // $this->library->printr($Req->result_array());
        // cek kalau data nya ada , maka jalankan mode edit
        $mode['edit'] = false;

        // panggil tabel detail penilaian anggota
        if ($Req->num_rows() == 1) {
            $source = $Req->row();
            $SetData = [
                'id_penilaian_perorangan' => $source->id_penilaian_perorangan,
                'id_anggota' => $source->id_anggota,
            ];
            $DataDetailPenilaian = $this->db->get_where($this->table5, $SetData)->result_array();
            $mode['edit'] = true;
            $mode['EditData'] = $DataDetailPenilaian;
        } else {
            $mode['edit'] = false;
            $mode['EditData'] = [];
        }

        return $mode;
    }
}
