<?php


class Lall extends CI_model
{
	function register($mahasiswa, $data)
	{
		$this->db->select('*');
		$this->db->from('topik');
		return $this->db->insert($mahasiswa, $data);
	}
	function upload_tugas($data)
	{
		$this->db->insert('jawaban_tugas', $data);
	}
    function gettopik($kode_topik){
		$this->db->select('*');
		$this->db->from('topik');
		$this->db->where('kode_topik',$kode_topik);
		return $this->db->get();
	}
	public function update_tugas($id,$data){
		$this->db->where('id_jawaban',$id);
		$this->db->update('jawaban_tugas',$data); 
	}
	function getkonten($id_topik){
		$this->db->select('*');
		$this->db->from('konten');
		$this->db->where('id_topik',$id_topik);
		return $this->db->get();
	}
	function get_all_jtugas($id){
		$this->db->select('*');
		$this->db->from('jawaban_tugas');
		$this->db->where('id_mhs',$id);
		return $this->db->get();
	}
}