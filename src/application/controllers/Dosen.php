<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller 
{

    public function Index(){
        $data['topik'] = $this->LModel->getTopik()->result();
        $data['judul'] = 'Dashboard';
		$sdata=$data;
		$this->load->view('dosen/header_utama',$data);
		$this->load->view('dosen/sidebar',$data);
		$this->load->view('dosen/topbar',$sdata);
        $this->load->view('dosen/halaman_utama',$sdata);
		$this->load->view('dosen/footer_utama');
		$this->load->view('dosen/modal');
	}
	
    public function profile(){
        $data['topik'] = $this->LModel->getTopik()->result();
        $data['judul'] = 'Profile';
        $sdata['dosen'] = $this->LDosen->getdosen($this->session->userdata('id'))->row_array();
        $this->load->view('dosen/header_utama',$data);
		$this->load->view('dosen/sidebar',$data);
		$this->load->view('dosen/topbar',$data);
        $this->load->view('dosen/profile',$sdata);
		$this->load->view('dosen/footer_utama');


    }

    public function konfirmasi($nim){
        $query = array(
            'aktif' => 2
            ); 
        $this->LDosen->uKon($nim,$query);
        redirect($_SERVER['HTTP_REFERER']);
    }
    
	public function listMhs(){
        $data['topik'] = $this->LModel->getTopik()->result();
		$data['mahasiswa'] = $this->LModel->getMahasiswa()->result();
        $data['judul'] = 'Daftar Mahasiswa';
		$sdata=$data;
        $this->load->view('dosen/header_utama',$data);
		$this->load->view('dosen/sidebar',$data);
		$this->load->view('dosen/topbar',$sdata);
		$this->load->view('dosen/daftar_mhs',$sdata);
		$this->load->view('dosen/footer_utama');
	}
	
	function addtopik(){
		$query = array(
            'nama_topik' => $this->input->post('namaTopik'),
				'kode_topik' => $this->input->post('kodeTopik'),
				'icon' => $this->input->post('namaIkon')
            ); 
		$this->LDosen->insert_topik($query);
		redirect($_SERVER['HTTP_REFERER']);
	}
    
	function hapustopik($id){
        $this->LDosen->hapus_topik($id);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function updateTopik(){
        $id = $this->input->post('id_topik');
		$nama = $this->input->post('namaTopik');
		$kode = $this->input->post('kodeTopik');
		$icon = $this->input->post('icon');
        
		$query = array(
            'nama_topik' => $nama,
			'kode_topik' => $kode,
			'icon' => $icon
		);
        
		$this->LDosen->update_topik($query,$id);
		redirect($_SERVER['HTTP_REFERER']);
	}
    public function materi($kode_topik)
    {
        $data['topik'] = $this->LModel->getTopik()->result();
        $data['judul'] = 'Materi';
        $sdata=$data;
        $this->load->view('dosen/header_utama',$data);
        $this->load->view('dosen/sidebar',$data);
        $this->load->view('dosen/topbar',$sdata);
        $this->load->view('dosen/header_utama',$data);
        $data['topik'] = $this->Lall->gettopik($kode_topik)->row();
        $data['konten'] = $this->Lall->getkonten($data['topik']->id_topik)->row();
        $data['jawaban_tugas'] = $this->LDosen->getjTugas($data['topik']->id_topik)->result();
        $this->load->view('dosen/materi',$data);
        $this->load->view('dosen/footer_utama');
    }
    
    public function beri_nilai(){
        $query = array(
            'nilai' => $this->input->post('nilai'),
            'st' => 'nilai',
        );
        // print_r($query);
        $id_jawaban = $this->input->post('id_jawaban');
        // echo $id_jawaban;
        $this->LDosen->uNilai($id_jawaban,$query);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function simpanMateri()
    {
    
        $data['id_topik'] = $this->input->post('id_topik');
        $data['isi_konten'] = $this->input->post('konten');
        $cek = $this->db->where('id_topik', $data['id_topik'])->get('konten')->num_rows();    
        
        if ($cek == 0 ) {
            $this->db->insert('konten', $data);    
        }else {
            if ($data['isi_konten'] != "") {
                $this->db->where('id_topik',$data['id_topik'])->update('konten',$data);
            } 
        }
        
        redirect('dosen/materi/'.$this->input->post('kode_topik'));
    
    }

    public function uploadImage()
    {
        $this->load->library('upload');
        $config['upload_path'] = "./assets/img/upload/";
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('file')) {
            $data = $this->upload->data();
            echo json_encode([
                'path' => base_url('./assets/img/upload/' . $data['file_name'])
            ]);
        } else {
          echo json_encode(['status' => 'KO', 'error' => $this->upload->display_errors()]);
        }
    }
}