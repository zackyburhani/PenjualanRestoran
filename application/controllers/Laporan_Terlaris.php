<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Laporan_Terlaris extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
	}
	
	public function index()
	{	
        $data =[
            'title' => 'Laporan Terlaris',
            'terlaris' => null
        ];
        $this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_lapTerlaris');
		$this->load->view('template/v_footer');
    }
    
    public function proses()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $jumlah = $this->input->post('jumlah');

        $terlaris = $this->Model->lapTerlaris($awal,$akhir,$jumlah);

        foreach($terlaris as $ter){
            $parsing[] = [
                'name' => $ter->nm_menu,
                'y' => (int)$ter->terlaris,
            ];
        }

        if($parsing){
            echo json_encode($parsing);
        } else {
            echo json_encode('gagal');
        }

    }

	public function cetak()
    {
        $awal = $this->input->post('awal_chart');
        $akhir = $this->input->post('akhir_chart');
        $jumlah = $this->input->post('jumlah_chart');

        if($akhir < $awal){
            $this->session->set_flashdata('pesanGagal','Tanggal Tidak Valid');
            redirect('Laporan_Terlaris');
        }

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
        $pdf->Cell(10,1,'',0,1);
        $pdf->Cell(190,10,'LAPORAN MENU TERLARIS TANGGAL '.shortdate_indo($awal). ' SAMPAI '.shortdate_indo($akhir),0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $terlaris = $this->Model->lapTerlaris($awal,$akhir,$jumlah);

        if($terlaris == null) {
            $this->session->set_flashdata('pesanGagal','Data Tidak Ditemukan');
            redirect('Laporan_Terlaris');
        }

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(20,6,'kategori',1,0,'C');
        $pdf->Cell(40,6,'Menu',1,0,'C');
        $pdf->Cell(40,6,'Harga',1,0,'C');
        $pdf->Cell(20,6,'Total',1,0,'C');
        $pdf->Cell(15,6,'Jumlah',1,0,'C');
        $pdf->Cell(45,6,'Jumlah Bayar',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $tampung = array();
        $no = 1;
        foreach ($terlaris as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(20,6,$row->nm_kategori,1,0,'C');
            $pdf->Cell(40,6,$row->nm_menu,1,0,'C');
            $pdf->Cell(40,6,number_format($row->harga,0,',','.'),1,0,'C');
            $pdf->Cell(20,6,$row->terlaris,1,0,'C');
            $pdf->Cell(15,6,$row->jumlah,1,0,'C');
            $pdf->Cell(45,6,number_format($row->harga_menu,0,',','.'),1,1,'C');
            $total[] = $row->harga_menu;
        }

        $grand = array_sum($total);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(145,6,'Grand Total',1,0,'C');
        $pdf->Cell(45,6,'Rp. '.number_format($grand,0,',','.'),1,1,'C');

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

        $fileName = 'LAPORAN_PENJUALAN_'.shortdate_indo($awal).'_SAMPAI_'.shortdate_indo($akhir).'.pdf';
        $pdf->Output('D',$fileName); 
    }
}
