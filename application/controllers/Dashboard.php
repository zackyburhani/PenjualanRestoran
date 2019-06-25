<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
	} 
	
	public function index()
	{	
		$data = [
            'title' => 'Dashoard',
            'kategori' => $this->Model->jumlah('kategori'),
            'menu' => $this->Model->jumlah('menu'),
            'pelanggan' => $this->Model->jumlah('pelanggan'),
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_dashboard');
		$this->load->view('template/v_footer');
	}

	public function page_error()
	{
		$this->load->view('template/404.php');
	}
}