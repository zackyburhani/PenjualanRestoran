<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
	} 
	
	public function index()
	{	
		$data = [
            'title' => 'Menu',
            'menu'=> $this->Model->getAll('Menu','kd_menu','desc'),
            'kategori' => $this->Model->getAll('Kategori','nm_kategori','asc'),
            'kd_menu' => $this->Model->getKodeMenu(),
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_menu');
		$this->load->view('template/v_footer');
	}

	public function simpan()
	{	
		$data = [
			'kd_menu' => $this->input->post('kd_menu'),
            'nm_menu' => $this->input->post('nm_menu'),
            'harga' => $this->input->post('harga'),
            'kd_kategori' => $this->input->post('kd_kategori'),
		];

		$result = $this->Model->simpan('menu',$data);

        if($result){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
	}

	public function ubah()
	{
        $kd_menu = $this->input->post('kd_menu');

		$data = [
		    'nm_menu' => $this->input->post('nm_menu'),
            'harga' => $this->input->post('harga'),
            'kd_kategori' => $this->input->post('kd_kategori'),
		];

		$result = $this->Model->update('kd_menu',$kd_menu,$data,'menu');

		if($result){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
    }
    
    public function hapus()
	{
		$kd_menu = $this->input->post('kd_menu');
		$data = $this->Model->hapus('kd_menu',$kd_menu,'menu');
		if($data){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
    }
    
    public function getKategori()
    {
        $kd_kategori = $this->input->post('kd_kategori');
        $data = $this->Model->getByID('kategori','kd_kategori',$kd_kategori);
        if($data){
            echo json_encode($data);
        } else {
            echo json_encode("gagal");
        }
    }
}