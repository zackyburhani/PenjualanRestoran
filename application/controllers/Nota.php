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
            'nota'=> $this->Model->getNotaWO(),
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_nota');
		$this->load->view('template/v_footer');
    }
    
    public function getDetailNota()
    {   
        $no_nota = $this->input->post('no_nota');
        $data = $this->Model->getDetailNota($no_nota);
        
        foreach($data as $key){
            $detail[] = [
                'kd_pelanggan' => $key->kd_pelanggan, 
                'nm_pelanggan' => $key->nm_pelanggan,
                'no_telp' => $key->no_telp,
                'alamat' => $key->alamat,
                'no_nota' => $key->no_nota,
                'tgl_nota' => shortdate_indo($key->tgl_nota),
                'kd_wo' => $key->kd_wo,
                'harga' => number_format($key->harga,0,',','.'),
                'jumlah' => $key->jumlah,
                'kd_menu' => $key->kd_menu,
                'nm_menu' => $key->nm_menu,
                'keterangan' => $key->keterangan,
                'harga_menu' => number_format($key->harga_menu,0,',','.'),
                'sum' => $key->harga_menu,
            ];
        }

        if(count($detail) > 0){
            echo json_encode($detail);
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
            'kd_pelanggan' => $this->Model->getKodePelanggan(),
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_tambah_nota');
		$this->load->view('template/v_footer');
    }

    public function simpan()
	{	
        $data_pelanggan = [
            'kd_pelanggan' => $this->input->post('kd_pelanggan'),
			'nm_pelanggan' => $this->input->post('nm_pelanggan'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat'),
		];

		$data_nota = [
			'no_nota' => $this->input->post('no_nota'),
            'tgl_nota' => date('Y-m-d'),
            'kd_pelanggan' => $this->input->post('kd_pelanggan'),
        ];

        $data_wo = [
            'kd_wo' => $this->Model->getKodeWO(),
			'no_nota' => $this->input->post('no_nota'),
        ];

        $result_pelanggan = $this->Model->simpan('pelanggan',$data_pelanggan);
        $result_nota = $this->Model->simpan('nota',$data_nota);
        $result_wo = $this->Model->simpan('wo',$data_wo);

        if($result_pelanggan && $result_nota && $result_wo){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
    }
    
    function simpan_detail()
	{
		$kd_menu = $this->input->post('kd_menu');
		$no_nota = $this->input->post('no_nota');
		$jumlah = $this->input->post('jumlah');
        $harga_menu = $this->input->post('harga_menu');
        $keterangan = $this->input->post('keterangan');

		$data = [
			'kd_menu' => $kd_menu,
			'no_nota' => $no_nota,
            'jumlah' => $jumlah,
            'harga_menu' => $harga_menu,
			'keterangan' => $keterangan,
		];

        $result = $this->Model->simpan('detail_pesan',$data);

        if($result){
            echo json_encode("sukses");
        } else {
            echo json_encode("gagal");
        }
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

    public function cekCart()
    {   
        if($this->cart->contents() == null){
            $data_cart = false;
        } else {
            $data_cart = true;
        }
        echo json_encode($data_cart);
    }

    public function load_detail(){ 
        foreach ($this->cart->contents() as $items) {
            $data[] = [
            	'kd_menu'=> $items['id'],
            	'nm_menu' =>$items['name'],
            	'harga_menu' =>$items['subtotal'],
                'jumlah' =>$items['qty'],
                'keterangan' =>$items['coupon']
            ];  
        }
        echo json_encode($data);
    }

    public function destroy()
	{	
		$data = $this->cart->destroy();
    }

    public function cetak_nota($no_nota)
    {
        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        //cetak gambar
        $image1 = "assets/img/LOGO.png";
        $pdf->Cell(1, 0, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 35), 0, 0, 'L', false );
        // mencetak string
        $pdf->Cell(186,10,'SNAZZY ESSENTIALS',0,1,'C');
        $pdf->Cell(9,1,'',0,1);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(186,7,'PERUMAHAN PURI PERMAI BLOK A2/03',0,1,'C');
        $pdf->Cell(186,3,' Kec. Tigakarsa - Kab. Tangerang - Banten ',0,1,'C');
        $pdf->Cell(186,5,'',0,1,'C');
        $pdf->Cell(186,5,'',0,1,'C');

        $pdf->Line(10, 42, 210-11, 42); 
        $pdf->SetLineWidth(0.5); 
        $pdf->Line(10, 42, 210-11, 42);
        $pdf->SetLineWidth(0);     
            
        $pdf->ln(6);        
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,10,'NOTA',0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $nota = $this->Model->getDetailNota($no_nota);

        $nota_fetch = $this->Model->getDetailNota_fetch($no_nota);

        $pdf->SetFont('Arial','',9);

        $pdf->Cell(25,6,'Nomor Nota',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$nota_fetch->no_nota,0,0,'L');
        
        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'Tanggal Nota',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.shortdate_indo($nota_fetch->tgl_nota),0,1,'L');

        $pdf->Cell(25,6,'Pelanggan',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        if($nota_fetch->nm_pelanggan == null){
            $pdf->Cell(40,6,'-',0,0,'L');
        } else {
            $pdf->Cell(40,6,''.$nota_fetch->nm_pelanggan,0,0,'L');
        }
        
        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'',0,0,'L');
        $pdf->Cell(5,6,'',0,0,'C');
        $pdf->Cell(20,6,'',0,1,'L');

		$pdf->Cell(25,6,'Telepon',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        if($nota_fetch->no_telp == null){
            $pdf->Cell(40,6,'-',0,1,'L');
        } else {
            $pdf->Cell(40,6,''.$nota_fetch->no_telp,0,1,'L');
        }


        $pdf->Cell(25,6,'Alamat',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        if($nota_fetch->alamat == null){
            $pdf->Cell(40,6,'-',0,1,'L');
        } else {
            $pdf->Cell(40,6,''.$nota_fetch->alamat,0,1,'L');
        }

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(30,6,'Kategori',1,0,'C');
        $pdf->Cell(35,6,'Nama Menu',1,0,'C');
        $pdf->Cell(40,6,'Keterangan',1,0,'C');
        $pdf->Cell(20,6,'Harga',1,0,'C');
        $pdf->Cell(15,6,'Jumlah',1,0,'C');
        $pdf->Cell(40,6,'Jumlah Harga',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $tampung = array();
        $no = 1;
        foreach ($nota as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(30,6,$row->nm_kategori,1,0,'C');
            $pdf->Cell(35,6,ucwords($row->nm_menu),1,0,'C');
            
            if($row->keterangan == ""){
                $pdf->Cell(40,6,'-',1,0,'C');
            } else {
                $pdf->Cell(40,6,$row->keterangan,1,0,'C');
            }

            $pdf->Cell(20,6,number_format($row->harga,0,',','.'),1,0,'C');
            $pdf->Cell(15,6,$row->jumlah,1,0,'C');
            $pdf->Cell(40,6,number_format($row->harga_menu,0,',','.'),1,1,'C');   
        	$tampung[] = $row->harga_menu;
        }

        $grand_total = array_sum($tampung);

        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(150,6,'Total Harga',1,0,'C');
        $pdf->Cell(40,6,'Rp. '.number_format($grand_total,0,',','.'),1,1,'C');
        $pdf->SetFont('Arial','',8);
        
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,5,'Tangerang, '.date_indo(date("Y-m-d")),0,1,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(64,6,'Hormat Kami',0,1,'C');

        $pdf->Cell(10,20,'',0,1);

        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(64,6,'( '.ucwords('admin').' )',0,0,'C');
        
        if($nota_fetch->nm_pelanggan == null){
            $fileName = $no_nota.'.pdf';
        } else {
            $fileName = $no_nota.'_'.$nota_fetch->nm_pelanggan.'.pdf';
        }

        $pdf->Output('D',$fileName); 
    }

    public function cetak_wo($kd_wo)
    {
        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        //cetak gambar
        $image1 = "assets/img/LOGO.png";
        $pdf->Cell(1, 0, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 35), 0, 0, 'L', false );
        // mencetak string
        $pdf->Cell(186,10,'SNAZZY ESSENTIALS',0,1,'C');
        $pdf->Cell(9,1,'',0,1);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(186,7,'PERUMAHAN PURI PERMAI BLOK A2/03',0,1,'C');
        $pdf->Cell(186,3,' Kec. Tigakarsa - Kab. Tangerang - Banten ',0,1,'C');
        $pdf->Cell(186,5,'',0,1,'C');
        $pdf->Cell(186,5,'',0,1,'C');

        $pdf->Line(10, 42, 210-11, 42); 
        $pdf->SetLineWidth(0.5); 
        $pdf->Line(10, 42, 210-11, 42);
        $pdf->SetLineWidth(0);     
            
        $pdf->ln(6);        
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,10,'WORK ORDER',0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $nota = $this->Model->getDetailWO($kd_wo);

        $pdf->SetFont('Arial','',9);

        $pdf->Cell(25,6,'Nomor WO',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$kd_wo,0,0,'L');
        
        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'',0,0,'L');
        $pdf->Cell(5,6,'',0,0,'C');
        $pdf->Cell(20,6,'',0,1,'L');

        $pdf->Cell(25,6,'Nomor Nota',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,$nota[0]->no_nota,0,0,'L');

        $pdf->Cell(25,6,'',0,0,'L');
        $pdf->Cell(5,6,'',0,0,'C');
        $pdf->Cell(40,6,'',0,1,'L');

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(40,6,'Kategori',1,0,'C');
        $pdf->Cell(45,6,'Nama Menu',1,0,'C');
        $pdf->Cell(50,6,'Keterangan',1,0,'C');
        $pdf->Cell(30,6,'Harga',1,0,'C');
        $pdf->Cell(15,6,'Jumlah',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $tampung = array();
        $no = 1;
        foreach ($nota as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(40,6,$row->nm_kategori,1,0,'C');
            $pdf->Cell(45,6,ucwords($row->nm_menu),1,0,'C');
            
            if($row->keterangan == ""){
                $pdf->Cell(50,6,'-',1,0,'C');
            } else {
                $pdf->Cell(50,6,$row->keterangan,1,0,'C');
            }

            $pdf->Cell(30,6,number_format($row->harga,0,',','.'),1,0,'C');
            $pdf->Cell(15,6,$row->jumlah,1,1,'C'); 
        	$tampung[] = $row->harga_menu;
        }
 
        $fileName = $kd_wo.'.pdf';

        $pdf->Output('D',$fileName); 
    }
    
}