<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nota extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
	} 
	
	public function index()
	{	
		$data = [
            'title' => 'Nota',
            'nota'=> $this->Model->getAll('Nota','no_nota','desc'),
            'kategori' => $this->Model->getAll('Menu','nm_menu','asc'),
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_nota');
		$this->load->view('template/v_footer');
	}

	public function simpan()
	{	
		$data = [
			'no_nota' => $this->input->post('no_nota'),
            'tgl_nota' => $this->input->post('tgl_nota'),
            'kd_menu' => $this->input->post('kd_menu'),
            'kd_pelanggan' => $this->input->post('kd_pelanggan'),
		];

		$result = $this->Model->simpan('nota',$data);

        if($result){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
	}

	public function ubah()
	{
        $no_nota = $this->input->post('no_nota');

		$data = [
			'tgl_nota' => $this->input->post('tgl_nota'),
            'kd_menu' => $this->input->post('kd_menu'),
            'kd_pelanggan' => $this->input->post('kd_pelanggan'),
		];

		$result = $this->Model->update('no_nota',$no_nota,$data,'nota');

		if($result){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
    }
    
    public function hapus()
	{
		$no_nota = $this->input->post('no_nota');
		$data = $this->Model->hapus('no_nota',$no_nota,'nota');
		if($data){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
    }

    public function tambah_pesan()
	{	
		$data = [
            'title' => 'Nota',
            'kategori'=> $this->Model->get_kategori(),
            'menu' => $this->Model->get_menu(),
            'no_nota' => $this->Model->getKodeNota(),
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_tambah_nota');
		$this->load->view('template/v_footer');
    }
    
    public function add_to_cart(){ //fungsi Add To Cart

		$kd_menu = $this->input->post('kd_menu');

        $pesan = $this->Model->getByID('menu','kd_menu',$kd_menu);
        $kategori = $this->Model->getByID('kategori','kd_kategori',$pesan->kd_kategori);

		$data = [
	        'id' => $pesan->kd_menu, 
	        'name' => $pesan->nm_menu, 
	        'price' => $pesan->harga,
            'size' => $kategori->nm_kategori,
            'qty' => $this->input->post('jumlah'),
            'coupon' => $this->input->post('keterangan'),
	    ];

        $tes = $this->cart->insert($data);
        echo $this->show_cart(); //tampilkan cart setelah added
    }

    public function load_cart(){ //load data cart
        echo $this->show_cart();
    }

    public function show_cart(){ //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {

            if($items['coupon'] == ""){
                $keterangan = "-";
            } else {
                $keterangan = $items['coupon'];
            }

            $no++;
            $output .='
                <tr>
                    <td align="center">'.$no.'</td>
                    <td align="center">'.$items['size'].'</td>
                    <td align="center">'.$items['name'].'</td>
                    <td align="center">'.$keterangan.'</td> 
                    <td align="center">'.number_format($items['price'],0,',','.').'</td>
                    <td align="center">'.$items['qty'].'</td>  
                    <td align="right">'.number_format($items['subtotal'],0,',','.').'</td>
                    <td align="center"><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-md"><i class="glyphicon glyphicon-trash"></i></button></td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="6"><center>TOTAL</center></th>
                <th colspan="1"> <div class="text-right">'.'Rp '.number_format($this->cart->total(),0,',','.').'</div></th>
                <th></th>
            </tr>
        ';
        return $output;
    }

    public function hapus_cart(){ //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'), 
            'qty' => 0, 
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }
    
    public function getMenu()
    {
        $kd_menu = $this->input->post('kd_menu');
        $data = $this->Model->getByID('menu','kd_menu',$kd_menu);
        if($data){
            echo json_encode($data);
        } else {
            echo json_encode("gagal");
        }
    }
}