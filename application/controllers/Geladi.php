<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Geladi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->Import();
    }

    private function Import()
    {
        $this->load->library('Library');

        $this->load->model('ModelPenilaianKelompok', 'pkelompok');
    }

    public function geladiakhir()
    {
        try {
            // Read anggota
            $ReadKelompokMix = $this->pkelompok->ReadKelompokMix();
            $data['CountKelompok'] = $ReadKelompokMix['count'];
            $data['CollectionsKelompok'] = [];

            if ($data['CountKelompok'] > 0) {
                $data['CollectionsKelompok'] = $ReadKelompokMix['collections'];
            }
            // $this->library->printr($data);

            $this->load->view('Geladi2', $data);
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','".($Error->getMessage())."')</script>");
            redirect();
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','Throwable ".($Error->getMessage())."')</script>");
            redirect();
        }
    }

    public function index()
    {
        try {
            // Read anggota
            $ReadKelompokMix = $this->pkelompok->ReadKelompokMix();
            $data['CountKelompok'] = $ReadKelompokMix['count'];
            $data['CollectionsKelompok'] = [];
            $data['CustomProduk'] = [
                                '0' => '86.06',
                                '1' => '86.03',
                                '2' => '86.69',
                                '3' => '85.74',
                                '4' => '86.37',
                                '5' => '86.13',
                                '6' => '86.70',
                                '7' => '86.80',
                                '8' => '87.26',
            ];

            if ($data['CountKelompok'] > 0) {
                $data['CollectionsKelompok'] = $ReadKelompokMix['collections'];
            }
            // $this->library->printr($data);

            $this->load->view('Geladi', $data);
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','".($Error->getMessage())."')</script>");
            redirect();
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','Throwable ".($Error->getMessage())."')</script>");
            redirect();
        }
    }
}
