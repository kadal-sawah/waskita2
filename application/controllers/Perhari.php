<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perhari extends CI_Controller
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
    }
    public function index($tgl = date('Y-m-d')){
        $this->db->select('pen');
    }
}