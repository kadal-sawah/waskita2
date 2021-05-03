<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hardcopy extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->Import();
    }

    private function Import()
    {
        $this->load->library('Library');
    }
    public function print($tipe, $kelompoks)
    {
        $this->load->library('Pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $tipe . "-" . $data['KELOMPOK']->nama_kelompok . '.pdf';
        $data['tipe'] = $tipe;
        $data['kelompok'] = $kelompok;
        $this->pdf->load_view('Hardcopy-Print', $data);
        $this->load->view('Hardcopy-Print', $data);
    }
    public function index()
    {

        
       $this->db->select('kelompok.id_kelompok, kelompok.nama_kelompok');
       $this->db->from('kelompok');
       $ReadKelompok = $this->db->get()->result_array();
        $no = 0;
       foreach($ReadKelompok as $lst):
        $this->db->select('soal_kelompok.maks, ceklis.nama_ceklis, soal_kelompok.aspek');
        $this->db->from('soal_kelompok');
        $this->db->where(['tipe' => '1' , 'ceklis.id_ceklis' => 'C39']);
        $this->db->join('ceklis','ceklis.id_ceklis = soal_kelompok.id_ceklis','inner');
        $ReadSoal = $this->db->get();
        $tampung[$no]['nama_kelompok'] = $lst['nama_kelompok'];
        if($ReadSoal->num_rows() > 0){
            $SourceSoal = $ReadSoal->result_array();
            $data['nama_ceklis'] = $ReadSoal->row()->nama_ceklis;
            $y = 0;
            foreach($SourceSoal as $ListSoal):
                $tampung[$no]['soal'][$y]['maks'] = $ListSoal['maks'];
                $tampung[$no]['soal'][$y]['aspek'] = $ListSoal['aspek'];
                $y++;
            endforeach;
        }
        $no++;
        endforeach;
        $data['collections'] = $tampung;
        // $this->load->view('Hardcopy', $data);

        // $this->load->library('Pdf');

        // $this->pdf->setPaper('A4', 'landscape');
        // $this->pdf->filename = 'PRODUK.pdf';
        // $this->pdf->load_view('Hardcopy', $data);
        // $this->library->printr($data);
    $this->load->view('Hardcopy', $data);

    }
}