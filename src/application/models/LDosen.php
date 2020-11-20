<?php


class LDosen extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function Ldosen($username, $pwd){
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
	  $this->db->where('aktif', 'reg');
	  return $this->db->get();
	 }

	public function insert_topik($data){
		$this->db->insert('topik', $data);
	}
	
	function hapus_topik($id){
		$this->db->where('id_topik',$id);
		$this->db->delete('topik');
	}

	function update_topik($data,$id){
		$this->db->where('id_topik',$id);
		$this->db->update('topik',$data);
	}

	public function uDosen($id,$data){
		$this->db->where('id_dosen',$id);
		$this->db->update('dosen',$data); 
	}

	public function uKon($id,$data){
		$this->db->where('nim',$id);
		$this->db->update('mahasiswa',$data); 
	}

	public function uNilai($id,$data){
		$this->db->where('id_jawaban',$id);
		$this->db->update('jawaban_tugas',$data); 
	}

	function getDosen($id){
		$this->db->select('*');
		$this->db->from('dosen');
		$this->db->where('id_dosen', $id);
		return $this->db->get();
	}
	
	function getjTugas($id){
		$this->db->select('*');
		$this->db->from('v_jtugas');
		$this->db->where('id_topik', $id);
		return $this->db->get();
	}
}

?>