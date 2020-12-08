<?php


class LModel extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function LDosen($username, $pwd){
	  $pwd = md5($pwd);
	  $this->db->select('*');
	  $this->db->from('dosen');
	  $this->db->where('nip', $username);
	  $this->db->where('password', $pwd);
	  return $this->db->get();
	 }

	public function Lmhs($username, $pwd){
	  $pwd = md5($pwd);
	  $this->db->select('*');
	  $this->db->from('mahasiswa');
	  $this->db->where('nim', $username);
	  $this->db->where('password', $pwd);
	  return $this->db->get();
	}

	public function insertMhs($data){
	  	$this->db->insert('mahasiswa',$data);
	}
	
	public function addAkses($data){
		$this->db->insert('akses',$data);
  	}

	public function getTopik(){
		$this->db->select('*');
		$this->db->from('topik');
	 	return $this->db->get();
	}
	public function getAkses($id){
		$this->db->select('*');
		$this->db->from('akses');
		$this->db->where('id_mhs', $id);
	 	return $this->db->get();
	}

	function getJtugas($id,$id_topik){
		$this->db->select('*');
		$this->db->from('jawaban_tugas');
		$this->db->where('id_mhs',$id);
		$this->db->where('id_topik',$id_topik);
		return $this->db->get();
	}

	public function uMhs($id,$data){
		$this->db->where('id_mhs',$id);
		$this->db->update('mahasiswa',$data); 
	}
	
	function getMhs($id){
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->where('id_mhs', $id);
		return $this->db->get();
	}
	
	function getMahasiswa(){
		$this->db->select('*');
		$this->db->from('mahasiswa');
		return $this->db->get();
	}

	function getJSoal($id_mhs) 
	{
		$soal = $this->db->get("soal")->num_rows();

		$this->db->where("id_mhs", $id_mhs);
		$nilai = $this->db->get("nilai_mhs")->num_rows();
		if ($soal == $nilai) {
			$this->db->insert("akses", ["id_mhs" => $id_mhs, "akses" => "evaluasi"]);
			return true;
		}

		return false;
	}
}
?>