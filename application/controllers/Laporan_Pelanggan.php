<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Laporan_Pelanggan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
	}
	
	public function index()
	{	
        $data =[
            'title' => 'Laporan Pelanggan',
        ];
        $this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_lapPelanggan');
		$this->load->view('template/v_footer');
	}

	public function cetak()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');

        if($akhir < $awal){
            $this->session->set_flashdata('pesanGagal','Tanggal Tidak Valid');
            redirect('Laporan_Pelanggan');
        }

        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        //cetak gambar
        $image1 = "assets/img/LOGO.png";
        $pdf->Cell(1, 0, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30), 0, 0, 'L', false );
        // mencetak string
        $pdf->Cell(186,10,'RESTAURANT BAKMI RIZKI',0,1,'C');
        $pdf->Cell(9,1,'',0,1);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(186,7,'Jl. Raya Inpres No.55',0,1,'C');
        $pdf->Cell(186,3,' Kec. Larangan, Kota Tangerang, Banten 15154 ',0,1,'C');
        $pdf->Cell(186,5,'',0,1,'C');
        $pdf->Cell(186,5,'',0,1,'C');

        $pdf->Line(10, 42, 210-11, 42); 
        $pdf->SetLineWidth(0.5); 
        $pdf->Line(10, 42, 210-11, 42);
        $pdf->SetLineWidth(0);     
            
        $pdf->ln(6);        
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,1,'',0,1);
        $pdf->Cell(190,10,'LAPORAN PELANGGAN TANGGAL '.shortdate_indo($awal). ' SAMPAI '.shortdate_indo($akhir),0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $pelanggan = $this->Model->lapPelanggan($awal,$akhir);

        if($pelanggan == null) {
            $this->session->set_flashdata('pesanGagal','Data Tidak Ditemukan');
            redirect('Laporan_Pelanggan');
        }

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(25,6,'Nomor Nota',1,0,'C');
        $pdf->Cell(25,6,'ID Pelanggan',1,0,'C');
        $pdf->Cell(50,6,'Nama Pelanggan',1,0,'C');
        $pdf->Cell(30,6,'No. Telp',1,0,'C');
        $pdf->Cell(50,6,'Alamat',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $tampung = array();
        $no = 1;
        foreach ($pelanggan as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(25,6,$row->no_nota,1,0,'C');
            $pdf->Cell(25,6,$row->kd_pelanggan,1,0,'C');
            $pdf->Cell(50,6,$row->nm_pelanggan,1,0,'C');
            $pdf->Cell(30,6,$row->no_telp,1,0,'C');
            $pdf->Cell(50,6,$row->alamat,1,1,'C');
        }

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
        $pdf->Cell(64,6,'( '.ucwords("admin").' )',0,0,'C');

        $fileName = 'LAPORAN_PELANGGAN_'.shortdate_indo($awal).'_SAMPAI_'.shortdate_indo($akhir).'.pdf';
        $pdf->Output('D',$fileName); 
    }
}
