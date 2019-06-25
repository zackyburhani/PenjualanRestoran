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

	public function lapTerlaris($awal,$akhir,$limit)
	{
		$check = false;
		try{

			if($limit == ""){
				$query = $this->db->query("
					SELECT nm_menu,COUNT(*) as terlaris FROM nota
						JOIN detail_pesan ON nota.no_nota = detail_pesan.no_nota
						JOIN menu ON menu.kd_menu = detail_pesan.kd_menu 
					WHERE nota.tgl_nota BETWEEN '$awal' AND '$akhir'
					GROUP BY nm_menu
					ORDER BY terlaris DESC
				");
			} else {
				$query = $this->db->query("
				SELECT nm_menu,COUNT(*) as terlaris FROM nota
					JOIN detail_pesan ON nota.no_nota = detail_pesan.no_nota
					JOIN menu ON menu.kd_menu = detail_pesan.kd_menu 
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


	////



	//count
	public function jumlah($table)
  	{
    	$query = $this->db->get($table);
    	return $query->num_rows();
  	}

	

	//ambil data nota
	public function getNota()
	{
		$result = $this->db->from('nota')->order_by('no_nota','DESC')->get();
		return $result->result();
	}

	public function getPelanggan()
	{
		$result = $this->db->from('pelanggan')->order_by('id_plg','DESC')->get();
		return $result->result();
	}

	//ambil data nota
	public function getRetur()
	{
		$result = $this->db->from('retur')->order_by('id_retur','DESC')->get();
		return $result->result();
	}

	

	

	

	

	//join pesan
	public function getJoinPesan()
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('pesan');
			$this->db->join('pelanggan', 'pelanggan.id_plg = pesan.id_plg');
			$this->db->order_by('id_pesan','DESC');
			$query = $this->db->get();
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function getBarang_Copy($id)
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('barang');
			$this->db->join('copy_barang', 'copy_barang.id_brg = barang.id_brg');
			$this->db->where('barang.id_brg',$id);
			$this->db->order_by('copy_barang.id_copy','DESC');
			$query = $this->db->get();
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function getCopyBarangID($id)
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('barang');
			$this->db->join('copy_barang', 'copy_barang.id_brg = barang.id_brg');
			$this->db->where('copy_barang.id_copy',$id);
			$query = $this->db->get();
			return $query->row();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}


	public function getBarang_pesan()
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT barang.id_brg as id_barang,nm_brg, artikel, harga, id_copy, size, stok,
					(SELECT SUM(stok) FROM copy_barang WHERE copy_barang.id_brg = id_barang GROUP by copy_barang.id_brg) as total
				FROM barang
					JOIN copy_barang ON copy_barang.id_brg = barang.id_brg
				ORDER BY barang.id_brg DESC");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function getBarang()
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT barang.id_brg as id_barang,nm_brg, artikel, harga, id_copy, size, stok,
					(SELECT SUM(stok) FROM copy_barang WHERE copy_barang.id_brg = id_barang GROUP by copy_barang.id_brg) as total
				FROM barang
					LEFT JOIN copy_barang ON copy_barang.id_brg = barang.id_brg
				GROUP BY barang.id_brg
				ORDER BY barang.id_brg DESC");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function barangCopy()
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('barang');
			$this->db->join('copy_barang', 'copy_barang.id_brg = barang.id_brg');
			$this->db->order_by('copy_barang.id_copy','DESC');
			$query = $this->db->get();
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	//by id
	public function getJoinPesan_ID($no_nota)
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('pesan');
			$this->db->join('nota', 'nota.id_pesan = pesan.id_pesan','left');
			$this->db->join('pelanggan', 'pelanggan.id_plg = pesan.id_plg','left');
			$this->db->where('no_nota',$no_nota);
			$this->db->order_by('no_nota','DESC');
			$query = $this->db->get();
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function getJoinRetur_ID($no_nota)
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('pesan');
			$this->db->join('pelanggan', 'pelanggan.id_plg = pesan.id_plg');
			$this->db->join('nota', 'nota.id_pesan = pesan.id_pesan');
			$this->db->join('retur', 'retur.no_nota = nota.no_nota');
			$this->db->where('nota.no_nota',$no_nota);
			$this->db->order_by('nota.no_nota','DESC');
			$query = $this->db->get();
			return $query->row();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function getJoinReturDetail_ID($no_nota)
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('pesan');
			$this->db->join('pelanggan', 'pelanggan.id_plg = pesan.id_plg');
			$this->db->join('nota', 'nota.id_pesan = pesan.id_pesan');
			$this->db->join('retur', 'retur.no_nota = nota.no_nota');
			$this->db->join('detail_retur', 'detail_retur.id_retur = retur.id_retur');
			$this->db->join('copy_barang', 'detail_retur.id_copy = copy_barang.id_copy');
			$this->db->join('barang', 'barang.id_brg = copy_barang.id_brg');
			$this->db->where('nota.no_nota',$no_nota);
			$this->db->order_by('nota.no_nota','DESC');
			$query = $this->db->get();
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function getNotaRetur($no_nota)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT * FROM pesan 
					JOIN nota ON nota.id_pesan = pesan.id_pesan 
					JOIN detail_pesan ON detail_pesan.id_pesan = pesan.id_pesan
					JOIN copy_barang ON copy_barang.id_copy = detail_pesan.id_copy
					JOIN barang ON barang.id_brg = copy_barang.id_brg
				WHERE nota.no_nota = '$no_nota'
			");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function getKwitansi_fetch($no_nota)
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('pesan');
			$this->db->join('pelanggan', 'pelanggan.id_plg = pesan.id_plg','left');
			$this->db->join('nota', 'nota.id_pesan = pesan.id_pesan','left');
			$this->db->where('nota.no_nota',$no_nota);
			$query = $this->db->get();
			return $query->row();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function getKwitansi($no_nota)
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('pesan');
			$this->db->join('detail_pesan', 'pesan.id_pesan = detail_pesan.id_pesan');
			$this->db->join('nota', 'nota.id_pesan = pesan.id_pesan');
			$this->db->join('copy_barang', 'copy_barang.id_copy = detail_pesan.id_copy');
			$this->db->join('barang', 'barang.id_brg = copy_barang.id_brg');
			$this->db->where('nota.no_nota',$no_nota);
			$query = $this->db->get();
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function getKwitansiRetur($no_nota)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT barang.id_brg as id_barang, nm_brg, size,
				    qty,
                    harga,
				    detail_retur.jml_harga as jml_harga
				FROM pesan
					JOIN nota ON nota.id_pesan = pesan.id_pesan
					JOIN retur ON retur.no_nota = nota.no_nota
					JOIN detail_retur ON detail_retur.id_retur = retur.id_retur
                    JOIN copy_barang ON copy_barang.id_copy = detail_retur.id_copy
                    JOIN barang ON barang.id_brg = copy_barang.id_brg
				WHERE nota.no_nota = '$no_nota'
			");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}


	public function getKwitansiRetur_fetch($no_nota)
	{
		$check = false;
		try{
			$this->db->select('*');
			$this->db->from('pesan');
			$this->db->join('pelanggan', 'pelanggan.id_plg = pesan.id_plg','left');
			$this->db->join('nota', 'nota.id_pesan = pesan.id_pesan','left');
			$this->db->join('retur', 'retur.no_nota = nota.no_nota','left');
			$this->db->where('nota.no_nota',$no_nota);
			$query = $this->db->get();
			return $query->row();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function getNotaReturValidasi($no_nota)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT * FROM pesan 
					JOIN nota ON nota.id_pesan = pesan.id_pesan 
					JOIN detail_pesan ON detail_pesan.id_pesan = pesan.id_pesan
					JOIN copy_barang ON copy_barang.id_copy = detail_pesan.id_copy
					JOIN barang ON barang.id_brg = copy_barang.id_brg
					JOIN retur ON retur.no_nota = nota.no_nota
				WHERE nota.no_nota = '$no_nota'
			");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	//detail berdasarkan id
	public function getJoinDetail_ID($no_nota)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT *,
					(SELECT sum(jml_bayar) FROM pesan 
					 	JOIN detail_pesan ON detail_pesan.id_pesan = pesan.id_pesan
						JOIN nota ON pesan.id_pesan = nota.id_pesan
					 	WHERE nota.no_nota = '$no_nota'
					) as total
				FROM pesan
					LEFT JOIN pelanggan ON pelanggan.id_plg = pesan.id_plg
					LEFT JOIN nota ON nota.id_pesan = pesan.id_pesan
					LEFT JOIN detail_pesan ON pesan.id_pesan = detail_pesan.id_pesan
					LEFT JOIN copy_barang ON detail_pesan.id_copy = copy_barang.id_copy
					LEFT JOIN barang ON barang.id_brg = copy_barang.id_brg
				WHERE nota.no_nota = '$no_nota'");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

    

    public function getKodeRetur()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(id_retur,7)) as kd_max from retur");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "RTB".$kd;
    }

    public function getNomorNota()
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

    //kode barang
	public function getKodeBarang()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(id_brg,7)) as kd_max from barang");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "BRG".$kd;
    }

    //kode barang copy
	public function getKodeBarangCopy()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(id_copy,7)) as kd_max from copy_barang");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "CPY".$kd;
    }

    //kode Order
	public function getKodePesan()
    {
       	$q  = $this->db->query("SELECT MAX(RIGHT(id_pesan,7)) as kd_max from pesan");
       	$kd = "";
    	if($q->num_rows() > 0) {
        	foreach ($q->result() as $k) {
          		$tmp = ((int)$k->kd_max)+1;
           		$kd = sprintf("%07s",$tmp);
        	}
    	} else {
         $kd = "0000001";
    	}
       	return "PSN".$kd;
    }


    public function lapPenjualan($awal,$akhir)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT * FROM pesan 
					JOIN nota ON nota.id_pesan = pesan.id_pesan
					JOIN detail_pesan ON pesan.id_pesan = detail_pesan.id_pesan
    				JOIN copy_barang ON copy_barang.id_copy = detail_pesan.id_copy
    				JOIN barang ON barang.id_brg = copy_barang.id_brg
    			WHERE pesan.tgl_bayar BETWEEN '$awal' AND '$akhir'
			");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function lapPenjualan_diskon($awal,$akhir)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT diskon, (SUM(jml_bayar)-diskon) as total FROM pesan 
					JOIN detail_pesan ON pesan.id_pesan = detail_pesan.id_pesan
    				JOIN copy_barang ON copy_barang.id_copy = detail_pesan.id_copy
    				JOIN barang ON barang.id_brg = copy_barang.id_brg
    			WHERE pesan.tgl_bayar BETWEEN '$awal' AND '$akhir' GROUP by pesan.id_pesan
			");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function lapRetur($awal,$akhir)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT * FROM pelanggan
				 	JOIN pesan ON pesan.id_plg = pelanggan.id_plg
					JOIN nota ON nota.id_pesan = pesan.id_pesan
					JOIN retur ON retur.no_nota = nota.no_nota
					JOIN detail_retur ON retur.id_retur = detail_retur.id_retur
					JOIN copy_barang ON copy_barang.id_copy = detail_retur.id_copy
					JOIN barang ON barang.id_brg = copy_barang.id_brg
				 WHERE retur.tgl_retur BETWEEN '$awal' AND '$akhir'
			");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

	public function lapPesan($awal,$akhir)
	{
		$check = false;
		try{
			$query = $this->db->query("
				SELECT * FROM pesan
					LEFT JOIN pelanggan ON pelanggan.id_plg = pesan.id_plg
					LEFT JOIN nota ON nota.id_pesan = pesan.id_pesan
					LEFT JOIN detail_pesan ON detail_pesan.id_pesan = pesan.id_pesan
					JOIN copy_barang ON copy_barang.id_copy = detail_pesan.id_copy
    				JOIN barang ON barang.id_brg = copy_barang.id_brg
				WHERE pesan.tgl_bayar BETWEEN '$awal' AND '$akhir'
			");
			return $query->result();
		}catch (Exception $ex) {
			$check = false;
		}
		return $check;
	}

}