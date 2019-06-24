<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
	} 
	
	public function index()
	{	
		$data = [
            'title' => 'Kategori',
            'kategori' => $this->Model->getAll('kategori','kd_kategori','desc'),
            'id_kategori' => $this->Model->getKodeKategori(),
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_kategori');
		$this->load->view('template/v_footer');
	}

	public function simpan()
	{	
		$data = [
			'kd_kategori' => $this->input->post('kd_kategori'),
			'nm_kategori' => $this->input->post('nm_kategori'),
		];

		$result = $this->Model->simpan('kategori',$data);

        if($result){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
	}

	public function ubah()
	{
        $kd_kategori = $this->input->post('kd_kategori');

		$data = [
			'nm_kategori' => $this->input->post('nm_kategori'),
		];

		$result = $this->Model->update('kd_kategori',$kd_kategori,$data,'kategori');

		if($result){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
    }
    
    public function hapus()
	{
		$kd_kategori = $this->input->post('kd_kategori');
		$data = $this->Model->hapus('kd_kategori',$kd_kategori,'kategori');
		if($data){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
	}
}