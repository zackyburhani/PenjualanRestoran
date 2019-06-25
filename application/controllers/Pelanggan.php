<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
	} 
	
	public function index()
	{	
		$data = [
            'title' => 'Pelanggan',
            'pelanggan' => $this->Model->getAll('pelanggan','kd_pelanggan','desc'),
            'kd_pelanggan' => $this->Model->getKodePelanggan(),
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_pelanggan');
		$this->load->view('template/v_footer');
	}

	public function ubah()
	{
        $kd_pelanggan = $this->input->post('kd_pelanggan');

		$data = [
			'nm_pelanggan' => $this->input->post('nm_pelanggan'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat'),
		];

		$result = $this->Model->update('kd_pelanggan',$kd_pelanggan,$data,'pelanggan');

		if($result){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
    }
    
    public function hapus()
	{
		$kd_pelanggan = $this->input->post('kd_pelanggan');
		$data = $this->Model->hapus('kd_pelanggan',$kd_pelanggan,'pelanggan');
		if($data){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
	}
}