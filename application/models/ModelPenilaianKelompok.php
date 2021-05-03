<?php

class ModelPenilaianKelompok extends CI_Model
{
    public $table = 'penilaian_kelompok as penk';
    public $table1 = 'kelompok as k';
    public $table2 = 'anggota as a';
    public $table3 = 'ceklis as c ';
    public $table4 = 'soal_kelompok AS soalk ';
    public $table5 = 'detail_penilaian_kelompok AS dpk ';
    public $table6 = 'aktivitas as akt';
    public $column_order = ['k.nama_kelompok']; //field yang ada di table
    public $column_search = ['k.nama_kelompok']; //field yang diizin untuk pencarian
    public $order = ['id_kelompok' => 'desc']; // default order

    public function __construct()
    {
        parent::__construct();
    }

    public function NilaiTelepon($id)
    {
        $this->db->select('(akt.h + akt.h1 + akt.h2 + akt.h3) AS total_telepon');
        $this->db->from('aktivitas as akt');
        $this->db->where([
            'sha1(akt.id_kelompok)' => $id,
            'tipe' => '3',
        ]);
        $Req = $this->db->get()->result();
        $data = 0;
        foreach ($Req as $key) {
            $data += $key->total_telepon;
        }
        // $this->library->printr($Req);
        return $data;
    }

    public function ReadCeklisTipe($where = null)
    {
        $this->db->select('c.id_ceklis, c.nama_ceklis');
        $this->db->from($this->table3);
        if ($where != null) {
            $AddWhere['c.tipe'] = $where;
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

    public function CekModeEditPosko($data)
    {
        $this->db->select('pkelompok.id_penilaian_kelompok');
        $this->db->from('penilaian_kelompok as pkelompok');
        if (strtolower($data['penilaian']) == 'posko') {
            $this->db->where([
                'id_kelompok' => $data['kelompok'],
                'id_ceklis' => $data['id_ceklis'],
                'tgl' => date('Y-m-d'),
            ]);
        } else {
            $this->db->where([
                'id_kelompok' => $data['kelompok'],
                'id_ceklis' => $data['id_ceklis'],
            ]);
        }
        $ReadPosko = $this->db->get();

        return $ReadPosko->num_rows() > 0 ? true : false;
    }


    public function ReadKelompokMix(){
        $ReadKelompok = $this->db->select('kelompok.nama_kelompok,kelompok.id_kelompok')->from('kelompok')->get();
        foreach($ReadKelompok->result_array() as $kelompok):

            // nilai 'RENTINKON'
            $PenilaianKelompok = $this->db->select(
                '((penilaian_kelompok.total_nilai + penilaian_kelompok.total_nilai2) / 2) AS NILAI_RENTINKON'
            )->from('penilaian_kelompok')
             ->where([
                 'id_kelompok'          => $kelompok['id_kelompok'],
                //  'ceklis.tipe'          => '1',
                 'ceklis.tipe_produk'   => 'RENTINKON'
             ])
             ->join('ceklis','ceklis.id_ceklis = penilaian_kelompok.id_ceklis' ,'LEFT')
             ->get();
            $this->library->printr($PenilaianKelompok->result_array(),'noexit');
        endforeach;
        exit(1);
    }
    public function ReadKelompokMix2()
    {
        // tampil kelompok
        try {
            $this->db->select('kelompok.nama_kelompok, kelompok.id_kelompok');
            $this->db->from('kelompok');
            $ReadKelompok = $this->db->get();
            if ($ReadKelompok->num_rows() <= 0) {
                throw new Exception('Kelompok belum tersedia');
            }
            $no = 0;
            $data['count'] = $ReadKelompok->num_rows();
            $data['collections'] = [];
            $Pembagi = 4;
            if ($data['count'] > 0) {
                $SourceKelompok = $ReadKelompok->result_array();
                foreach ($SourceKelompok as $list) :
                    $CountJabatan = $this->CountCeklisAktivitas();
                $tampung[$no]['nama_kelompok'] = $list['nama_kelompok'];
                $this->db->select('pper.id_penilaian_perorangan, ceklis.is_asisten, pper.id_jabatan,pper.total_nilai');
                $this->db->from('penilaian_perorangan as pper');
                $this->db->where(['id_kelompok' => $list['id_kelompok']]);
                $this->db->join('ceklis', 'ceklis.id_ceklis = pper.id_ceklis', 'inner');
                $ReadPenilaian = $this->db->get();
                $tampung[$no]['total_aktivitas'] = 0;
                if ($ReadPenilaian->num_rows() > 0) {
                    $SourcePenilaian = $ReadPenilaian->result_array();
                    $TotalAktivitas = 0;
                    $TotalAktivitasPanglima = 0;
                    foreach ($SourcePenilaian as $ListPenilaian) :
                            // $DecodeJabatan = json_decode($ListPenilaian['id_jabatan'], true);

                           /// if ($ListPenilaian['is_asisten'] == 1 || $ListPenilaian['is_asisten'] == 3) {
                                $TotalAktivitas += $ListPenilaian['total_nilai'];
                    //} else
                    //    $TotalAktivitasPanglima += $ListPenilaian['total_nilai'];

                    endforeach;
                    // if($list['id_kelompok'] == 1 ){

                    //     $Pembagi = 4;
                    $PembagiJabatan = $CountJabatan;
                    // }
                    // else{
                    //     $Pembagi = 3;
                    //     $PembagiJabatan = $CountJabatan;
                    //     if($list['id_kelompok'] == 9)
                    //         $PembagiJabatan = 8;

                    // }

                    // $tampung[$no]['total_aktivitas'] = number_format(((($TotalAktivitas / $PembagiJabatan) / 1) + $TotalAktivitasPanglima) / 2, 2);
                    $tampung[$no]['total_aktivitas'] = ($TotalAktivitas / $PembagiJabatan);
                    // $tampung[$no]['total_aktivitas'] = $TotalAktivitas;

                        // $tampung[$no]['total_aktivitas'] = $CountJabatan;
                }

                // select penilaian kelompok
                $this->db->select('pkelompok.id_penilaian_kelompok,pkelompok.total_nilai, ceklis.id_ceklis, ceklis.tipe');
                $this->db->from('penilaian_kelompok as pkelompok');
                $this->db->where([
                        'id_kelompok' => $list['id_kelompok'],
                        'ceklis.tipe' => '4',
                    ]);
                $this->db->join('ceklis', 'ceklis.id_ceklis = pkelompok.id_ceklis', 'inner');
                $ReadPenilaianKelompok = $this->db->get();
                $tampung[$no]['nilai_posko'] = 0;
                if ($ReadPenilaianKelompok->num_rows() > 0) {
                    $SourcePenilaianKelompok = $ReadPenilaianKelompok->result_array();

                    foreach ($SourcePenilaianKelompok as $ListPKelompok) :
                                @$tampung[$no]['nilai_posko'] += $ListPKelompok['total_nilai'];
                    endforeach;
                }

                // telepon telegram
                $this->db->select('(telepon_telegram.h +
                telepon_telegram.h1 +
                telepon_telegram.h2 + 
                telepon_telegram.h3) AS TOTAL_TELEPON_TELEGRAM, 
                telepon_telegram.tipe');
                $this->db->from('telepon_telegram');
                $this->db->where([
                        'id_kelompok' => $list['id_kelompok'],
                        'tahun' => date('Y'),
                    ]);
                $this->db->order_by('tipe', 'ASC');
                $this->db->group_by('tipe');
                $ReadTel = $this->db->get();
                $tampung[$no]['nilai_telepon'] = 0;
                $tampung[$no]['nilai_telegram'] = 0;
                if ($ReadTel->num_rows() == 2) {
                    $SourceTel = $ReadTel->result_array();
                    $tampung[$no]['nilai_telepon'] = $SourceTel[0]['TOTAL_TELEPON_TELEGRAM'];
                    $tampung[$no]['nilai_telegram'] = $SourceTel[1]['TOTAL_TELEPON_TELEGRAM'];
                }

                // penilaian produk
                $tampung[$no]['nilai_produk'] = 0;
                $this->db->select('pkelompok.total_nilai');
                $this->db->from('penilaian_kelompok as pkelompok');
                $this->db->where([
                        'id_kelompok' => $list['id_kelompok'],
                        'ceklis.tipe' => '1',
                    ]);
                $this->db->join('ceklis', 'ceklis.id_ceklis = pkelompok.id_ceklis', 'inner');
                $ReadPKelompok = $this->db->get();
                if ($ReadPKelompok->num_rows() > 0) {
                    $SourcePKelompok = $ReadPKelompok->result_array();
                    $TampungPKelompok = 0;
                    foreach ($SourcePKelompok as $ListPKelompok) :
                            $TampungPKelompok += $ListPKelompok['total_nilai'];
                    endforeach;
                    if ($list['id_kelompok'] == 9) {
                        $PembagiCProduk = $this->CountCeklisProduk() - 2;
                    } else {
                        $PembagiCProduk = $this->CountCeklisProduk();
                    }

                    $tampung[$no]['nilai_produk'] = $TampungPKelompok / $PembagiCProduk;
                }

                ++$no;
                endforeach;

                // $this->library->printr($DecodeJabatan);
                // $this->library->printr($tampung);
            }
            // $this->library->printr($tampung);
            $data['collections'] = $tampung;
            $data['status'] = 200;
            // $this->library->printr($ta  mpung);
        } catch (Exception $Error) {
            $data = [
                'status' => 400,
                'message' => $Error->getMessage(),
                'count' => 0,
                'collections' => [],
            ];
        } catch (Throwable $Error) {
            $data = [
                'status' => 400,
                'message' => 'Throwable '.$Error->getMessage(),
                'count' => 0,
                'collections' => [],
            ];
        } finally {
            return $data;
        }
    }

    private function CountCeklisAktivitas()
    {
        $this->db->select('COUNT(ceklis.id_ceklis) as CEKLIS');
        $this->db->from('ceklis');
        $where['tipe'] = 5;

        $this->db->where($where);

        return $this->db->get()->row()->CEKLIS;
    }

    private function CountCeklisProduk()
    {
        $this->db->select('COUNT(ceklis.id_ceklis) as CEKLIS');
        $this->db->from('ceklis');
        $where['tipe'] = 1;

        $this->db->where($where);

        return $this->db->get()->row()->CEKLIS;
    }

    public function CekTeleponTelegram($kelompok)
    {
        $this->db->select('telepon_telegram.h,
                           telepon_telegram.h1,
                           telepon_telegram.h2,
                           telepon_telegram.h3,
                           telepon_telegram.tipe
        ');
        $this->db->from('telepon_telegram');
        $this->db->where([
            'id_kelompok' => $kelompok,
            'tahun' => date('Y'),
        ]);
        $ReadTeleponTelegram = $this->db->get();
        $data['return'] = false;
        $data['count'] = $ReadTeleponTelegram->num_rows();
        $data['collections'] = [];
        if ($data['count'] > 0) {
            $data['return'] = true;
            $data['collections'] = $ReadTeleponTelegram->result_array();
        }

        return $data;
    }

    private function CountJabatan()
    {
        $this->db->select('c.id_jabatan, c.is_asisten');
        $this->db->from('ceklis as c');
        $this->db->where(['c.tipe' => '5']);
        $Result = $this->db->get();
        if ($Result->num_rows() > 0) {
            $SourceResult = $Result->result_array();
            $CountJabatan = 0;
            foreach ($SourceResult as $List) :
                $DecodeJabatan = json_decode($List['id_jabatan'], true);
            if ($List['is_asisten'] == 1 || $List['is_asisten'] == 3) {
                if (count($DecodeJabatan) > 1) {
                    $CountJabatan += count($DecodeJabatan);
                } else {
                    ++$CountJabatan;
                }
            }

            endforeach;
        }

        return $CountJabatan;
    }

    public function CekModeEditKelompok($data)
    {
        $this->db->select('pkelompok.id_penilaian_kelompok, pkelompok.id_ceklis');
        $this->db->from('penilaian_kelompok as pkelompok');
        $this->db->join('ceklis', 'ceklis.id_ceklis = pkelompok.id_ceklis', 'inner');
        $this->db->where([
            'pkelompok.id_kelompok' => $data['id_kelompok'],
            'ceklis.tipe' => $data['tipe_ceklis'],
            'tahun' => date('Y'),
        ]);
        $Result = $this->db->get();
        // $this->library->printr($Result->result_array());
        $data['collections'] = [];
        $data['count'] = $Result->num_rows();
        if ($data['count'] > 0) {
            $SourceResult = $Result->result_array();
            // read detail penilaian_kelompok
            $tampung = [];
            foreach ($SourceResult as $List) :
                $IdPenilaianKelompok = $List['id_penilaian_kelompok'];

            $this->db->select('dpkelompok.nilai, dpkelompok.id_soal_kelompok, dpkelompok.id_detail_penilaian_kelompok');
            $this->db->from('detail_penilaian_kelompok as dpkelompok');
            $this->db->where(['id_penilaian_kelompok' => $IdPenilaianKelompok]);
            $ReadDetail = $this->db->get();
            if ($ReadDetail->num_rows() > 0) {
                $SourceDetail = $ReadDetail->result_array();
                $no = 0;
                $tampung[$List['id_ceklis']]['count'] = $ReadDetail->num_rows();

                foreach ($SourceDetail as $ListDetail) :
                        $tampung[$List['id_ceklis']][$no]['id_detail_penilaian_kelompok'] = $ListDetail['id_detail_penilaian_kelompok'];
                $tampung[$List['id_ceklis']][$no]['id_soal_kelompok'] = $ListDetail['id_soal_kelompok'];
                $tampung[$List['id_ceklis']][$no]['nilai'] = $ListDetail['nilai'];
                ++$no;
                endforeach;
            }
            endforeach;
            $data['collections'] = $tampung;
        }

        return $data;
    }

    public function CekModeEditKelompokPosko($data)
    {
        $this->db->select('pkelompok.id_penilaian_kelompok, pkelompok.id_ceklis');
        $this->db->from('penilaian_kelompok as pkelompok');
        $this->db->join('ceklis', 'ceklis.id_ceklis = pkelompok.id_ceklis', 'inner');
        $where = [
            'pkelompok.id_kelompok' => $data['id_kelompok'],
            'ceklis.tipe' => $data['tipe_ceklis'],
        ];
        if ($data['penilaian'] == 'Posko') {
            $where['tgl'] = date('Y-m-d');
        }

        $this->db->where($where);
        $Result = $this->db->get();
        // $this->library->printr($Result->result_array());
        $data['collections'] = [];
        $data['count'] = $Result->num_rows();
        if ($data['count'] > 0) {
            $SourceResult = $Result->result_array();
            // read detail penilaian_kelompok
            $tampung = [];
            foreach ($SourceResult as $List) :
                $IdPenilaianKelompok = $List['id_penilaian_kelompok'];

            $this->db->select('dpkelompok.nilai, dpkelompok.id_soal_kelompok, dpkelompok.id_detail_penilaian_kelompok');
            $this->db->from('detail_penilaian_kelompok as dpkelompok');
            $this->db->where(['id_penilaian_kelompok' => $IdPenilaianKelompok]);
            $ReadDetail = $this->db->get();
            if ($ReadDetail->num_rows() > 0) {
                $SourceDetail = $ReadDetail->result_array();
                $no = 0;
                $tampung[$List['id_ceklis']]['count'] = $ReadDetail->num_rows();

                foreach ($SourceDetail as $ListDetail) :
                        $tampung[$List['id_ceklis']][$no]['id_detail_penilaian_kelompok'] = $ListDetail['id_detail_penilaian_kelompok'];
                $tampung[$List['id_ceklis']][$no]['id_soal_kelompok'] = $ListDetail['id_soal_kelompok'];
                $tampung[$List['id_ceklis']][$no]['nilai'] = $ListDetail['nilai'];
                ++$no;
                endforeach;
            }
            endforeach;
            $data['collections'] = $tampung;
        }

        return $data;
    }

    public function ReadCeklisTipePosko($where = null)
    {
        $this->db->select('c.id_ceklis, c.nama_ceklis');
        $this->db->from($this->table3);
        if ($where != null) {
            $AddWhere['c.tipe'] = $where;
        }

        $this->db->where($AddWhere);
        $this->db->order_by('c.sort', 'ASC');
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;

        if ($GetData->num_rows() > 0) {
            $no = 0;
            $source = $GetData->result_array();
            foreach ($source as $list) :
                $tampung[$no]['id_ceklis'] = $list['id_ceklis'];
            $tampung[$no]['nama_ceklis'] = $list['nama_ceklis'];

            $this->db->select('maks, aspek, id_soal_kelompok');
            $this->db->from('soal_kelompok');
            $this->db->where([
                'tipe_nilai' => $where,
                'id_ceklis' => $list['id_ceklis'], ]);
            $GetSoal = $this->db->get();
            $tampung[$no]['soal'] = [];
            if ($GetSoal->num_rows() > 0) {
                $SourceSoal = $GetSoal->result_array();
                $y = 0;
                foreach ($SourceSoal as $list2) :
                        $tampung[$no]['soal'][$y]['id_soal_kelompok'] = $list2['id_soal_kelompok'];
                $tampung[$no]['soal'][$y]['aspek'] = $list2['aspek'];
                $tampung[$no]['soal'][$y]['maks'] = $list2['maks'];
                ++$y;
                endforeach;
            }
            ++$no;
            endforeach;
            $data['collections'] = $tampung;
            $data['count'] = count($tampung);
        }

        return $data;
    }

    public function ReadCeklisTipeProduk($where = null)
    {
        $this->db->select('c.id_ceklis, c.nama_ceklis');
        $this->db->from($this->table3);
        if ($where != null) {
            $AddWhere['c.tipe'] = $where;
        }

        $this->db->where($AddWhere);
        $this->db->order_by('c.sort', 'ASC');
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;

        if ($GetData->num_rows() > 0) {
            $no = 0;
            $source = $GetData->result_array();
            foreach ($source as $list) :
                $tampung[$no]['id_ceklis'] = $list['id_ceklis'];
            $tampung[$no]['nama_ceklis'] = $list['nama_ceklis'];

            $this->db->select('maks, aspek, id_soal_kelompok');
            $this->db->from('soal_kelompok');
            $this->db->where(['tipe_nilai' => $where, 'id_ceklis' => $list['id_ceklis']]);
            $GetSoal = $this->db->get();
            $tampung[$no]['soal'] = [];
            if ($GetSoal->num_rows() > 0) {
                $SourceSoal = $GetSoal->result_array();
                $y = 0;
                foreach ($SourceSoal as $list2) :
                        $tampung[$no]['soal'][$y]['id_soal_kelompok'] = $list2['id_soal_kelompok'];
                $tampung[$no]['soal'][$y]['aspek'] = $list2['aspek'];
                $tampung[$no]['soal'][$y]['maks'] = $list2['maks'];
                ++$y;
                endforeach;
            }
            ++$no;
            endforeach;
            $data['collections'] = $tampung;
            $data['count'] = count($tampung);
        }

        return $data;
    }

    public function ReadCeklisTipeProdukPosko($where = null)
    {
        $this->db->select('c.id_ceklis, c.nama_ceklis');
        $this->db->from($this->table3);
        if ($where != null) {
            $AddWhere['c.tipe'] = $where;
        }

        $this->db->where($AddWhere);
        $this->db->order_by('c.sort', 'ASC');
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;

        if ($GetData->num_rows() > 0) {
            $no = 0;
            $source = $GetData->result_array();
            foreach ($source as $list) :
                $tampung[$no]['id_ceklis'] = $list['id_ceklis'];
            $tampung[$no]['nama_ceklis'] = $list['nama_ceklis'];

            $this->db->select('maks, aspek, id_soal_kelompok');
            $this->db->from('soal_kelompok');
            $this->db->where(['tipe_nilai' => $where, 'id_ceklis' => $list['id_ceklis']]);
            $GetSoal = $this->db->get();
            $tampung[$no]['soal'] = [];
            if ($GetSoal->num_rows() > 0) {
                $SourceSoal = $GetSoal->result_array();
                $y = 0;
                foreach ($SourceSoal as $list2) :
                        $tampung[$no]['soal'][$y]['id_soal_kelompok'] = $list2['id_soal_kelompok'];
                $tampung[$no]['soal'][$y]['aspek'] = $list2['aspek'];
                $tampung[$no]['soal'][$y]['maks'] = $list2['maks'];
                ++$y;
                endforeach;
            }
            ++$no;
            endforeach;
            $data['collections'] = $tampung;
            $data['count'] = count($tampung);
        }

        return $data;
    }

    public function ReadCeklisTipeAktivitas($where = null)
    {
        $this->db->select('c.id_ceklis, c.is_asisten, c.id_jabatan, c.nama_ceklis, c.tanggal');
        $this->db->from($this->table3);
        if (is_array($where) && $where['tipe_ceklis'] != null) {
            $AddWhere['c.tipe'] = $where['tipe_ceklis'];
        }
        $this->db->where($AddWhere);
        $this->db->order_by('c.sort', 'ASC');
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;

        if ($GetData->num_rows() > 0) {
            $no = 0;
            $source = $GetData->result_array();
            foreach ($source as $list) :
                $this->db->select('custom_count_soal_perorangan.id_jabatan');
            $this->db->from('custom_count_soal_perorangan');
            $this->db->where([
                    'id_kelompok' => $where['kelompok'],
                    'id_ceklis' => $list['id_ceklis'],
                ]);
            $GetJabatan = $this->db->get();
            $tampung[$no]['id_ceklis'] = $list['id_ceklis'];
            $tampung[$no]['nama_ceklis'] = $list['nama_ceklis'];
            $tampung[$no]['is_asisten'] = $list['is_asisten'];
            $tampung[$no]['id_jabatan'] = $GetJabatan->num_rows() == 1 ? $GetJabatan->row()->id_jabatan : $list['id_jabatan'];

            $this->db->select('nilmax, tindakan_macam,id_soal_perorangan');
            $this->db->from('soal_perorangan');

            if ($list['tanggal'] == null) {
                $this->db->where(['id_ceklis' => $list['id_ceklis']]);
            } else {
                $this->db->where(['id_ceklis' => $list['id_ceklis'], 'tanggal' => date('Y-m-d')]);
            }
            // $this->db->where(['id_ceklis' => $list['id_ceklis']]);

            $GetSoal = $this->db->get();
            $tampung[$no]['soal'] = [];
            if ($GetSoal->num_rows() > 0) {
                $SourceSoal = $GetSoal->result_array();
                $y = 0;
                foreach ($SourceSoal as $list2) :
                        $tampung[$no]['soal'][$y]['id_soal_perorangan'] = $list2['id_soal_perorangan'];
                $tampung[$no]['soal'][$y]['aspek'] = $list2['tindakan_macam'];
                $tampung[$no]['soal'][$y]['maks'] = $list2['nilmax'];
                ++$y;
                endforeach;
            }
            ++$no;
            endforeach;
            $data['collections'] = $tampung;
            $data['collections']['CountAnggota'] = $this->CountAnggota($where['kelompok']);
            $data['count'] = count($tampung);
        }
        // $this->library->printr($data);
        return $data;
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

    public function ReadKelompokInfo($id)
    {
        $this->db->select('k.id_kelompok, 
                           k.nama_kelompok,
                           (SELECT COUNT(agt.id_anggota) FROM anggota agt WHERE k.id_kelompok = agt.id_kelompok) AS jumlah_anggota');
        $this->db->from($this->table1);
        $this->db->where('sha1(k.id_kelompok)', $id);
        $data = $this->db->get();

        $SetData['collections'] = [];
        $SetData['count'] = 0;
        if ($data->num_rows() > 0) {
            // $this->library->printr($s);
            $SetData['collections'] = $data;
            $SetData['count'] = $data->num_rows();
        }

        return $SetData;
    }

    public function ReadSoal($ceklis)
    {
        $this->db->select('soalk.id_soal_kelompok, soalk.aspek, soalk.tipe_nilai, soalk.maks,
        (SELECT ck.nama_ceklis FROM ceklis ck WHERE soalk.id_ceklis = ck.id_ceklis) AS nama_ceklis');
        $this->db->from($this->table4);
        $this->db->where('soalk.id_ceklis', $ceklis);
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;
        if ($GetData->num_rows() > 0) {
            $data['nama_ceklis'] = $GetData->row()->nama_ceklis;
            $data['collections'] = $GetData;
            $data['count'] = $GetData->num_rows();
        }

        return $data;
    }

    public function ReadKelompok()
    {
        $this->db->select('k.nama_kelompok, k.id_kelompok');
        $this->db->from($this->table1);
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;
        if ($GetData->num_rows() > 0) {
            $data['collections'] = $GetData;
            $data['count'] = $GetData->num_rows();
        }

        return $data;
    }

    private function _get_datatables_query($id = null)
    {
        $this->db->select('k.id_kelompok, 
                           k.nama_kelompok,
                           (SELECT COUNT(agt.id_anggota) FROM anggota agt WHERE k.id_kelompok = agt.id_kelompok) AS jumlah_anggota,
                           (SELECT SUM(dpk.nilai) FROM detail_penilaian_kelompok as dpk WHERE dpk.id_kelompok = k.id_kelompok) AS nilai_produk');

        $this->db->from($this->table1);
        $kelompokna = json_decode($_SESSION['akses_kelompok']);
        $hehe = 0;
        foreach ($kelompokna as $key) {
            if ($hehe === 0) {
                $this->db->where(['k.nama_kelompok' => $key->value]);
            } else {
                $this->db->or_where(['k.nama_kelompok' => $key->value]);
            }
            ++$hehe;
        }
        if ($id != null) {
            $this->db->where('sha1(k.id_kelompok)', $id);
        }

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

    private function _get_datatables_query2($ceklis = null)
    {
        $this->db->select("a.nrp, 
                           a.nama,
                           (SELECT p.nama_pangkat FROM pangkat p WHERE p.id_pangkat = a.id_pangkat) AS nama_pangkat,
                           k.nama_kelompok,
                           c.id_ceklis,
                           c.nama_ceklis,
                           (SELECT SUM(dpp.nilai) FROM {$this->table5} WHERE dpp.id_penilaian_perorangan = pen.id_penilaian_perorangan) AS total_nilai");

        $this->db->from($this->table);
        $this->db->join($this->table2, 'a.id_anggota = pen.id_anggota', 'inner');
        $this->db->join($this->table3, 'c.id_ceklis = pen.id_ceklis', 'inner');
        $this->db->join($this->table4, 'k.id_kelompok = pen.id_kelompok', 'inner');
        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
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

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);

        return $this->db->count_all_results();
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

    public function CekUdahInsertPenilaian($kelompok, $ceklis, $tanggal = true)
    {
        if ($tanggal == true) {
            $data['tanggal'] = date('Y-m-d');
        }
        $data['id_kelompok'] = $kelompok;
        $data['id_ceklis'] = $ceklis;

        $ReadPakas = $this->db->get_where('penilaian_perorangan', $data);
        if ($ReadPakas->num_rows() > 0) {
            return true;
        }

        return false;
    }

    public function ModeEditAktivitas($data)
    {
        if (!is_array($data)) {
            throw new Exception('param tidak tersedia');
        }
        $this->db->select('c.id_ceklis, c.is_asisten, c.id_jabatan, c.nama_ceklis, c.tanggal');
        $this->db->from('ceklis as c');
        if (is_array($data)) {
            $AddWhere['c.tipe'] = $data['tipe_ceklis'];
        }

        $this->db->where($AddWhere);
        $this->db->order_by('c.sort', 'ASC');
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = $GetData->num_rows();
        if ($data['count'] > 0) {
            // select penilaian perorangan
            $SourceCeklis = $GetData->result_array();
            $no = 0;
            foreach ($SourceCeklis as $list) :
                $IdCeklis = $list['id_ceklis'];
            $this->db->select('pper.id_penilaian_perorangan,
                                       pper.id_ceklis,
                                       pper.total_nilai,
                                       pper.id_jabatan');
            $this->db->from('penilaian_perorangan as pper');
            $this->db->where([
                    'id_ceklis' => $IdCeklis,
                    'id_kelompok' => $data['id_kelompok'],
                ]);
            $ReadPPer = $this->db->get();
            $tampung[$IdCeklis] = [];

            if ($ReadPPer->num_rows() > 0) {
                $SourcePPer = $ReadPPer->result_array();
                foreach ($SourcePPer as $ListPPer) :
                        $IdPenilaianPerorangan = $ListPPer['id_penilaian_perorangan'];
                $this->db->select('dpper.nilai,dpper.id_soal_perorangan, dpper.id_jabatan');
                $this->db->from('detail_penilaian_perorangan as dpper');
                $this->db->where([
                            'id_penilaian_perorangan' => $IdPenilaianPerorangan,
                            'tanggal' => date('Y-m-d'),
                        ]);
                $DecodeIdJabatanListPer = json_decode($ListPPer['id_jabatan'], true);
                $IdJabatanListPer = [];
                // $this->library->printr($DecodeIdJabatanListPer);
                // echo '<pre>' . print_r($ListPPer['id_jabatan'], true) . '</pre>';
                foreach ($DecodeIdJabatanListPer as $LJabatan) :
                            $IdJabatanListPer[] = $LJabatan['id_jabatan'];
                endforeach;
                $ReadDPper = $this->db->get();
                if ($ReadDPper->num_rows() > 0) {
                    $SourceDPper = $ReadDPper->result_array();
                    $y = 0;

                    foreach ($SourceDPper as $ListDPper) :

                                if (in_array($ListDPper['id_jabatan'], $IdJabatanListPer)) {
                                    $tampung[$IdCeklis][$ListDPper['id_jabatan']][$y]['id_soal_perorangan'] = $ListDPper['id_soal_perorangan'];
                                    $tampung[$IdCeklis][$ListDPper['id_jabatan']][$y]['nilai'] = $ListDPper['nilai'];
                                }
                    ++$y;
                    endforeach;
                }
                endforeach;

                $tampung[$IdCeklis]['total_nilai'] = $ListPPer['total_nilai'];
            }
            ++$no;
            endforeach;
            $data['collections'] = $tampung;
        }
        // $this->library->printr($data);
        return $data;
    }

    public function Store($data = null)
    {
        if (!is_array($data)) {
            return false;
        }

        // insert data ke penilaian kelompok
        $DataPenilaian = [
            'id_kelompok' => $data['id_kelompok'],
            'id_ceklis' => $data['id_ceklis'],
            'ket' => $data['ket'],
        ];
        $this->db->insert('penilaian_kelompok', $DataPenilaian);
        $id = $this->db->insert_id();

        $message = [
            'status' => 400,
            'message' => 'kolom ada yang kosong',
        ];

        if (count($data['id_soal_kelompok']) == count($data['nilai'])) {
            $x = 0;
            foreach ($data['id_soal_kelompok'] as $list) {
                // insert data detail penilaian perorangan
                $DataDetailPenilaian = [
                    'id_penilaian_kelompok' => $id,
                    'id_soal_kelompok' => $this->library->Decode($list, 3),
                    'id_kelompok' => $data['id_kelompok'],
                    'id_ceklis' => $DataPenilaian['id_ceklis'],
                    'nilai' => $data['nilai'][$x++],
                ];
                $this->db->insert('detail_penilaian_kelompok', $DataDetailPenilaian);
            }
            $message = [
                'status' => 200,
                'message' => 'ok',
            ];
        }

        return $message;
    }

    public function StoreTel($data = null)
    {
        if (!is_array($data)) {
            return false;
        }

        // insert data ke penilaian kelompok
        $DataPenilaian = [
            'id_kelompok' => $data['id_kelompok'],
            'id_ceklis' => $data['id_ceklis'],
            'ket' => $data['ket'],
        ];
        $this->db->insert('penilaian_kelompok', $DataPenilaian);
        $id = $this->db->insert_id();

        $message = [
            'status' => 400,
            'message' => 'kolom ada yang kosong',
        ];

        // insert data aktivitas
        $DataDetailPenilaian = [
            'id_kelompok' => $data['id_kelompok'],
            'id_ceklis' => $DataPenilaian['id_ceklis'],
            'h' => $data['H'],
            'h1' => $data['H_1'],
            'h2' => $data['H_2'],
            'h3' => $data['H_3'],
            'h3' => $data['H_3'],
            'tipe' => $data['tipe_nilai'],
        ];
        $this->db->insert('aktivitas', $DataDetailPenilaian);
        $message = [
            'status' => 200,
            'message' => 'ok',
        ];

        return $message;
    }

    public function StoreUpdateTel($data = null)
    {
        if (!is_array($data)) {
            return false;
        }
        $counter = 0;
        // $this->library->printr($data);
        $SetData = [
            'h' => $data['h'],
            'h1' => $data['h1'],
            'h2' => $data['h2'],
            'h3' => $data['h3'],
        ];
        $this->db->where(['id_aktivitas' => $data['id_aktivitas']]);
        $this->db->update('aktivitas', $SetData);
    }

    public function StoreUpdate($data = null)
    {
        if (!is_array($data)) {
            return false;
        }
        if (count($data['id_soal_kelompok']) == count($data['nilai'])) {
            $counter = 0;
            // $this->library->printr($data);
            foreach ($data['nilai'] as $list) :
                $SetData = [
                    'nilai' => $list,
                ];
            $this->db->where(['id_detail_penilaian_kelompok' => $this->library->Decode($data['id_detail_penilaian_kelompok'][$counter], 3)]);
            $this->db->update($this->table5, $SetData);

            ++$counter;
            endforeach;
            $this->db->where([
                'id_kelompok' => $data['id_kelompok'],
                'id_ceklis' => $data['id_ceklis'],
            ]);
            $this->db->update($this->table, ['ket' => $data['ket']]);

            return true;
        }

        return false;
    }

    public function ReadAnggotaPenilaian($param)
    {
        $this->db->select(' a.nama, a.id_anggota');
        $this->db->from($this->table2);
        $this->db->join($this->table, 'a.id_anggota = pen.id_anggota', 'inner');
        $this->db->group_by('id_anggota');
        $GetData = $this->db->get();
        $data['collections'] = [];
        $data['count'] = 0;
        if ($GetData->num_rows() > 0) {
            $data['collections'] = $GetData;
            $data['count'] = $GetData->num_rows();
        }

        return $data;
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

    public function NilaiProduk($IdKelompok)
    {
        // table => penilaian_kelompok
        // table1 => kelompok
        // table5 => detail_penilaian_kelompok
        $this->db->select('SUM(dpk.nilai) AS nilai_produk');
        $this->db->from($this->table5);
        $this->db->join($this->table3, 'dpk.id_ceklis = c.id_ceklis');
        $where = [
            'sha1(dpk.id_kelompok)' => $IdKelompok,
            'c.tipe' => 1,
        ];
        $this->db->where($where);
        $Req = $this->db->get()->result();
        $data = 0;
        foreach ($Req as $key) {
            $data += $key->nilai_produk;
        }

        return $data;
    }

    public function NilaiPosko($IdKelompok)
    {
        // table => penilaian_kelompok
        // table1 => kelompok
        // table5 => detail_penilaian_kelompok
        $this->db->select('SUM(dpk.nilai) AS nilai_posko');
        $this->db->from($this->table5);
        $this->db->join($this->table3, 'dpk.id_ceklis = c.id_ceklis');
        $where = [
            'sha1(dpk.id_kelompok)' => $IdKelompok,
            'c.tipe' => 4,
        ];
        $this->db->where($where);
        $Req = $this->db->get()->result();
        $data = 0;
        foreach ($Req as $key) {
            $data += $key->nilai_posko;
        }

        return $data;
    }

    public function EditPenilaian($data)
    {
        // panggil tabel penilaian aktivitas
        $data["DATE_FORMAT(penk.tgl,'%Y-%m-%d')"] = date('Y-m-d');
        $Req = $this->db->get_where($this->table, $data);

        // cek kalau data nya ada , maka jalankan mode edit
        $mode['edit'] = false;
        // $this->library->printr($Req->result_array());
        if ($Req->num_rows() == 1) {
            $source = $Req->row();
            $SetData = [
                'id_penilaian_kelompok' => $source->id_penilaian_kelompok,
            ];

            $DataEdit = $this->db->get_where($this->table5, $SetData);

            // panggil tabel detail penilaian anggota
            $mode['edit'] = true;
            $mode['EditData'] = $DataEdit->result_array();
            $mode['ket'] = $source->ket;
        } else {
            $mode['edit'] = false;
            $mode['EditData'] = [];
        }

        return $mode;
    }

    public function EditPenilaianAktivitas($data)
    {
        // panggil tabel penilaian aktivitas
        $data["DATE_FORMAT(aktivitas.tgl,'%Y-%m-%d')"] = date('Y-m-d');

        $Req = $this->db->get_where('aktivitas', $data);

        // cek kalau data nya ada , maka jalankan mode edit
        $mode['mode'] = false;
        $mode['EditData'] = [];
        $mode['count'] = 0;
        $mode['tipe'] = null;
        if ($Req->num_rows() == 1) {
            $source = $Req->row();
            $mode['tipe'] = $source->tipe == 1 ? 'TELEGRAM' : 'TELEPON';
            $mode['mode'] = true;
            $mode['EditData'] = $source;
            $mode['count'] = $Req->num_rows();
        }

        return $mode;
    }
}
