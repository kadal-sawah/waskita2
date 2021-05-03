<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
		$this->load->library('Library');
	}
	public function index()
	{

		$this->load->view('index');
	}
}
