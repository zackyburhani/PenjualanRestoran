<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
    }

    //ambil semua data
	public function getAll($table,$col,$order)
	{
		$this->db->order_by($col, $order);
        $query = $this->db->get($table);
        return $query->result();
	}

    //simpan
	public function simpan($table,$data)
	{
		$checkinsert = false;
		try{
			$this->db->insert($table,$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
    }
    
    //update
	public function update($pk,$id,$data,$table)
	{
		$checkupdate = false;
		try{
			$this->db->where($pk,$id);
			$this->db->update($table,$data);
			$checkupdate = true;
		}catch (Exception $ex) {
			$checkupdate = false;
		}
		return $checkupdate;
    }
    
    //hapus
	public function hapus($pk,$id,$table)
	{
		$checkdelete = false;
		try{
			$this->db->where($pk,$id);
			$this->db->delete($table);
			$checkdelete = true;
		}catch (Exception $ex) {
			$checkdelete = false;
		}
		return $checkdelete;
    }
    
    //ambil semua data perID
	public function getByID($table,$kolom,$id)
	{
		$this->db->from($table);
		$this->db->where($kolom, $id);
		$query = $this->db->get();
		return $query->row();
	}
    
    //kode pelanggan
	public function getKodeKategori()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(kd_kategori,7)) as kd_max from kategori");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "KAT".$kd;
    }

    public function getKodeMenu()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(kd_menu,7)) as kd_max from menu");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "MNU".$kd;
	}
	
	public function getKodeNota()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(no_nota,7)) as kd_max from nota");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "NTA".$kd;
	}
	
	public function getKodePelanggan()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(kd_pelanggan,7)) as kd_max from pelanggan");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "PLG".$kd;
	}
	
	public function getKodeWO()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(kd_wo,8)) as kd_max from wo");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%08s",$tmp);
        	}
    	} else {
         $kd = "00000001";
    	}
       	return "WO".$kd;
    }

	public function get_kategori()
    {
        $this->db->order_by('nm_kategori', 'asc');
        return $this->db->get('kategori')->result();
    }
		
	public function get_menu()
   	{
        $this->db->order_by('nm_menu', 'asc');
        $this->db->join('menu', 'menu.kd_kategori = kategori.kd_kategori');
        return $this->db->get('kategori')->result();
	}
	
	public function getNotaWO()
	{
		$this->db->order_by('nota.no_nota', 'desc');
        $this->db->join('nota', 'nota.no_nota = wo.no_nota');
        return $this->db->get('wo')->result();
	}

	public function getDetailNota($no_nota)
	{
		$this->db->order_by('nota.no_nota', 'desc');
		$this->db->join('nota', 'nota.no_nota = wo.no_nota');
		$this->db->join('pelanggan', 'nota.kd_pelanggan = pelanggan.kd_pelanggan');
		$this->db->join('detail_pesan', 'detail_pesan.no_nota = nota.no_nota');
		$this->db->join('menu', 'menu.kd_menu = detail_pesan.kd_menu');
		$this->db->join('kategori', 'kategori.kd_kategori = menu.kd_kategori');
		$this->db->where('nota.no_nota',$no_nota);
        return $this->db->get('wo')->result();
	}

	public function getDetailNota_fetch($no_nota)
	{
		$this->db->order_by('nota.no_nota', 'desc');
		$this->db->join('nota', 'nota.no_nota = wo.no_nota');
		$this->db->join('pelanggan', 'nota.kd_pelanggan = pelanggan.kd_pelanggan');
		$this->db->join('detail_pesan', 'detail_pesan.no_nota = nota.no_nota');
		$this->db->join('menu', 'menu.kd_menu = detail_pesan.kd_menu');
		$this->db->join('kategori', 'kategori.kd_kategori = menu.kd_kategori');
		$this->db->where('nota.no_nota',$no_nota);
        return $this->db->get('wo')->row();
	}

	public function getDetailWO($kd_wo)
	{
		$this->db->order_by('nota.no_nota', 'desc');
		$this->db->join('nota', 'nota.no_nota = wo.no_nota');
		$this->db->join('pelanggan', 'nota.kd_pelanggan = pelanggan.kd_pelanggan');
		$this->db->join('detail_pesan', 'detail_pesan.no_nota = nota.no_nota');
		$this->db->join('menu', 'menu.kd_menu = detail_pesan.kd_menu');
		$this->db->join('kategori', 'kategori.kd_kategori = menu.kd_kategori');
		$this->db->where('wo.kd_wo',$kd_wo);
        return $this->db->get('wo')->result();
	}

	public function lapPendapatan($awal,$akhir)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT * FROM pelanggan
					JOIN nota ON nota.kd_pelanggan = pelanggan.kd_pelanggan
					JOIN detail_pesan ON detail_pesan.no_nota = nota.no_nota
					JOIN menu ON menu.kd_menu = detail_pesan.kd_menu
					JOIN kategori ON kategori.kd_kategori = menu.kd_kategori
					JOIN wo ON wo.no_nota = nota.no_nota
				WHERE nota.tgl_nota BETWEEN '$awal' AND '$akhir'
			");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function lapPelanggan($awal,$akhir)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT * FROM pelanggan
					JOIN nota ON nota.kd_pelanggan = pelanggan.kd_pelanggan
					JOIN detail_pesan ON detail_pesan.no_nota = nota.no_nota
					JOIN menu ON menu.kd_menu = detail_pesan.kd_menu
					JOIN kategori ON kategori.kd_kategori = menu.kd_kategori
					JOIN wo ON wo.no_nota = nota.no_nota
				WHERE nota.tgl_nota BETWEEN '$awal' AND '$akhir'
			");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function lapTerlaris($awal,$akhir,$limit)
	{
		$check = false;
		try{

			if($limit == ""){
				$query = $this->db->query("
					SELECT *,COUNT(*) as terlaris FROM nota
						JOIN detail_pesan ON nota.no_nota = detail_pesan.no_nota
						JOIN menu ON menu.kd_menu = detail_pesan.kd_menu 
						JOIN kategori ON menu.kd_kategori = kategori.kd_kategori 
					WHERE nota.tgl_nota BETWEEN '$awal' AND '$akhir'
					GROUP BY nm_menu
					ORDER BY terlaris DESC
				");
			} else {
				$query = $this->db->query("
				SELECT *,COUNT(*) as terlaris FROM nota
					JOIN detail_pesan ON nota.no_nota = detail_pesan.no_nota
					JOIN menu ON menu.kd_menu = detail_pesan.kd_menu 
					JOIN kategori ON menu.kd_kategori = kategori.kd_kategori
				WHERE nota.tgl_nota BETWEEN '$awal' AND '$akhir'
				GROUP BY nm_menu
				ORDER BY terlaris DESC
				limit $limit
			");
			}
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	//count
	public function jumlah($table)
  	{
    	$query = $this->db->get($table);
    	return $query->num_rows();
  	}
}