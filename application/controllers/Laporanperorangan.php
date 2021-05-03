<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporanperorangan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->Import();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('Login'));
        }
    }

    private function Import()
    {
        $this->load->model('ModelPenilaianPerorangan', 'pperorangan');
        $this->load->library('Library');
    }

    public function Tambah($id = null, $IdAnggota = null)
    {

        try {
            if ($id == null)
                throw new Exception('param kosong');

            // Soal perorangan
            $GetDataCeklis = $this->pperorangan->ReadCeklis();

            $data['Count'] = $GetDataCeklis['count'];
            $data['CollectionsCeklis'] = [];
            if ($GetDataCeklis['count'] > 0)
                $data['CollectionsCeklis'] = $GetDataCeklis['collections']->result_array();

            $GetDataAnggota = $this->pperorangan->ReadAnggota($IdAnggota);
            $data['CountAnggota'] = $GetDataAnggota['count'];
            $data['profil'] = [];
            if ($GetDataAnggota['count'] > 0)
                $data['profil'] = $GetDataAnggota['collections']->result_array()[0];
            // Penilaian Anggota
            $ReadPenilaian = $this->pperorangan->ReadNilaiAnggota($IdAnggota);
            $data['CountPenilaianAnggota'] = $ReadPenilaian['count'];
            $data['NilaiAnggota'] = [];
            if ($data['CountPenilaianAnggota'] > 0)
                $data['NilaiAnggota'] = $ReadPenilaian['collection'];

            // $this->library->printr($data);
            $this->load->view('LaporanPerorangan/Tambah', $data);
        } catch (Exception $Error) {
        }
    }
    public function index($IdAnggota = null)
    {
        try {
            if ($IdAnggota == null)
                throw new Exception('Anggota tidak ditemukan');
            $data['id'] = $IdAnggota;

            $ReadAnggota = $this->pperorangan->CekAnggota($IdAnggota);

            $ReadKelompok = $this->pperorangan->ReadKelompok($IdAnggota);
            if ($ReadKelompok['count'] <= 0)
                throw new Exception('Kelompok tidak ditemukan');

            // info ReadKelompokInfo
            $this->load->model('ModelPenilaianKelompok', 'pkelompok');
            $GetInfoKelompok = $this->pkelompok->ReadKelompokInfo($IdAnggota);
            $data['CountInfoKelompok'] = $GetInfoKelompok['count'];
            if ($data['CountInfoKelompok'] <= 0)
                throw new Exception("Info kelompok tidak ditemukan");

            $data['profil'] = [];
            if ($GetInfoKelompok['count'] > 0)
                $data['profil'] = $GetInfoKelompok['collections']->result_array()[0];


            $SourceKelompok = $ReadKelompok['collections']->row();
            $data['count'] = $ReadAnggota['count'];
            $data['nama_kelompok'] = $SourceKelompok->nama_kelompok;
            $data['TotalNilai'] = $this->pperorangan->TotalNilai($IdAnggota);
            $this->load->view('LaporanPerorangan/Data', $data);
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','" . ($Error->getMessage()) . "')</script>");
            redirect();
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','Throwable " . ($Error->getMessage()) . "')</script>");
            redirect();
        }
    }

    public function detail($IdAnggota = null)
    {
        try {
            if ($IdAnggota == null)
                throw new Exception('Kelompok tidak ditemukan');
            $this->db->select('a.nama, a.nrp, p.nama_pangkat as pangkat, j.nama_jabatan as jabatan');
            $this->db->from('anggota as a');
            $this->db->join('pangkat as p', 'a.id_pangkat = p.id_pangkat', 'left');
            $this->db->join('jabatan as j', 'a.id_jabatan = j.id_jabatan', 'left');
            $this->db->where(['sha1(a.id_anggota)' => $IdAnggota]);
            $dataAnggota = $this->db->get();
            // $this->req->print($dataAnggota);
            // $this->library->printr($dataAnggota);
            $data['id'] = '-';
            $data['nrp'] = '-';
            $data['nama'] = '-';
            $data['pangkat'] = '-';
            if ($dataAnggota->num_rows() > 0) {
                $source = $dataAnggota->row();
                $data['id'] = $IdAnggota;
                $data['nrp'] = $source->nrp;
                $data['nama'] = $source->nama;
                $data['pangkat'] = empty($source->pangkat) ? '-' : $source->pangkat;
                $data['jabatan'] = empty($source->jabatan) ? '-' : $source->jabatan;
            }

            $this->load->view('LaporanPerorangan/Detail', $data);
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','" . ($Error->getMessage()) . "')</script>");
            redirect();
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','Throwable " . ($Error->getMessage()) . "')</script>");
            redirect();
        }
    }

    public function GetDetail($id = null, $idkel = null)
    {
        error_reporting(0);

        try {
            if ($id == null)
                throw new Exception('Kelompok tidak ditemukan');

            // $list = $this->pperorangan->get_datatables($id);
            $id = $this->req->xss($id);
            $query = "
                SELECT 
	                (SELECT ck.id_ceklis FROM ceklis AS ck WHERE ck.id_ceklis = sp.id_ceklis) AS id_ceklis,
	                (SELECT ck.nama_ceklis FROM ceklis AS ck WHERE ck.id_ceklis = sp.id_ceklis) AS nama_ceklis,
	                SUM(dpp.nilai) AS nilai
                FROM 
	                detail_penilaian_perorangan AS dpp 
	            INNER JOIN soal_perorangan AS sp ON dpp.id_soal_perorangan = sp.id_soal_perorangan
                WHERE dpp.id_anggota = (
                    SELECT a.id_anggota FROM anggota AS a WHERE sha1(a.id_anggota) = '$id'
                )
                GROUP BY sp.id_ceklis ORDER BY nilai DESC";
            $list = $this->db->query($query);
            //  = $this->pperorangan->get_datatables($id);
            // $this->library->printr($list);
            $data = [];
            $nilai_ = 0;
            foreach ($list->result_array() as $field) {
                $nilai_ += $field['nilai'];
                $row = array();
                $row[] = $field['id_ceklis'] . " - " . $field['nama_ceklis'];
                $row[] = $field['nilai'];
                $data[] = $row;
            }
            $r_ = array();
            $r_[] = '<h3>TOTAL</h3>';
            $r_[] = "<h3>$nilai_</h3>";
            $data[] = $r_;

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $list->num_rows(),
                "recordsFiltered" => $list->num_rows(),
                "data" => $data,
            );
        } catch (Exception $Error) {
            $output = array(
                "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            );
        } catch (Throwable $Error) {
            $output = array(
                "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            );
        } finally {
            echo json_encode($output);
        }
    }

    public function Get($id = null)
    {

        $idKelompok = $id;
        error_reporting(0);

        try {
            if ($id == null)
                throw new Exception('Kelompok tidak ditemukan');

            $list = $this->pperorangan->get_datatables($id);
            // $this->library->printr($list);
            if ($list['count'] <= 0)
                throw new Exception('Data kosong');

            $data = [];
            foreach ($list['collections'] as $field) {

                $id = sha1($field['id_anggota']);
                $namaGan = $field['nama'];
                $row = array();
                $row[] = "<a href='" . base_url('laporanperorangan/detail/') . "$id/" . $idKelompok . "'>$namaGan</a>";
                $row[] = $field['nama_pangkat'];
                $row[] = $field['nrp'];
                $row[] = $field['nama_jabatan'];
                $row[] = empty($field['total_nilai']) ? 0 : $field['total_nilai'];

                $data[] = $row;
            }
            $totalNa = number_format($this->pperorangan->TotalNilai($idKelompok), 0, 2, '.');
            $r_ = array();
            $r_[] = '';
            $r_[] = '';
            $r_[] = '';
            $r_[] = '<h3>TOTAL</h3>';
            $r_[] = "<h3>$totalNa</h3>";
            $data[] = $r_;

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->pperorangan->count_all($idKelompok),
                "recordsFiltered" => $this->pperorangan->count_filtered($idKelompok),
                "data" => $data,
            );
        } catch (Exception $Error) {
            $output = array(
                "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            );
        } catch (Throwable $Error) {
            $output = array(
                "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            );
        } finally {
            echo json_encode($output);
        }
    }

    public function store()
    {

        try {
            $input = $this->input->post();
            // $this->library->printr($input);
            if (!$input)
                throw new Exception("POST Method");
            $IdSoalPerorangan = array_keys($input['nilai']);
            $data = [
                'id_soal_perorangan' => $IdSoalPerorangan,
                'id_anggota'  => $this->library->XssClean('id_anggota'),
                'id_ceklis'   => $this->library->XssClean('ceklis'),
                'nilai'       => $input['nilai'],
                'id_kelompok'      => $input['id_kelompok'],
            ];

            $Insert = $this->pperorangan->Store($data);
            if ($Insert['status'] != 200)
                throw new Exception($Insert['message']);

            $this->session->set_flashdata('pesan', "<script>pesan_sukses('Pesan','Data telah ditambahkan')</script>");
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } finally {
            redirect('penilaianperorangan/tambah/' .  $data['id_kelompok'] . '/' . sha1($data['id_anggota']));
        }
    }

    public function update()
    {
        try {
            $input = $this->input->post();
            // $this->library->printr($input);
            if (!$input)
                throw new Exception("POST Method");
            $IdSoalPerorangan = array_keys($input['nilai']);

            $data = [
                'id_detail_penilaian_perorangan' => $this->input->post('id_detail_penilaian_perorangan'),
                'id_soal_perorangan' => $IdSoalPerorangan,
                'id_anggota'  => $this->library->XssClean('id_anggota'),
                'id_ceklis'   => $this->library->XssClean('ceklis'),
                'nilai'       => $input['nilai'],
                'id_kelompok'      => $input['id_kelompok'],
            ];

            // echo 'penilaianperorangan/tambah/' . sha1($data['id_anggota']) . '/' . $data['id_kelompok'];
            // exit(1);
            // cek 
            // $UpdateOrAdd = $this->pperorangan->UpdateOrAdd($data);

            $Update = $this->pperorangan->StoreUpdate($data);

            if ($Update != true)
                throw new Exception('Sedang terjadi masalah, silahkan coba beberapa saat lagi');

            $this->session->set_flashdata('pesan', "<script>pesan_sukses('Pesan','Data telah update')</script>");
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } finally {
            redirect('penilaianperorangan/tambah/' . $data['id_kelompok'] . '/' . sha1($data['id_anggota']));
        }
    }

    public function Ajaxanggota()
    {
        $id = $this->input->get('data');
        $GetAnggota = $this->pperorangan->AjaxAnggota($id);
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

            $GetAnggota = $this->pperorangan->get_datatables($id);

            if ($GetAnggota['count'] <= 0)
                throw new Exception('Data kosong');

            foreach ($GetAnggota['collections'] as $field) {

                $id = sha1($field['id_anggota']);
                $row = array();

                $row[] = $field['nama'];
                $row[] = $field['nama_pangkat'];
                $row[] = $field['nrp'];
                $row[] = $field['nama_kelompok'];

                $row[] = "<a href='" . base_url('penilaianperorangan/tambah/' . $id) . "'
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
            $message = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->pperorangan->count_all(),
                "recordsFiltered" => $this->pperorangan->count_filtered(),
                "data" => $data,
            );
            echo json_encode($message);
        } catch (Exception $Error) {
            $message = array(
                "draw" => '1',
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array(),
            );
            echo json_encode($message);
        } catch (Throwable $Error) {
            $message = array(
                "draw" => '1',
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array(),
            );
            echo json_encode($message);
        }
    }


    public function dokumen($IdAnggota)
    {
        $input = $this->input->get();
        $ceklis = $input['ceklis'];
        $GetDataSoal = $this->pperorangan->ReadSoal($ceklis);

        $data['count'] = $GetDataSoal['count'];
        $data['collections'] = [];
        if ($GetDataSoal['count'] > 0)
            $data['collections'] = $GetDataSoal['collections']->result_array();

        $GetDataCeklis = $this->pperorangan->ReadCeklis($ceklis);

        if ($GetDataCeklis['count'] > 0) {
            $source = $GetDataCeklis['collections']->row();
            $data['nama_ceklis'] = $source->nama_ceklis;
        }

        $SetData = [
            'id_anggota' => $IdAnggota,
            'id_ceklis'  => $ceklis
        ];

        $CekMode = $this->pperorangan->EditPenilaian($SetData);
        $data['edit'] = [];
        $data['mode'] = $CekMode['edit'];
        if ($CekMode['edit'] == true)
            $data['edit'] = $CekMode['EditData'];
        echo json_encode($data);
    }
}