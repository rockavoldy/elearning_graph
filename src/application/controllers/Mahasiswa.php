<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function Index()
    {
        $data['topik'] = $this->LModel->getTopik()->result();
        $data['judul'] = 'Dashboard';
        $sdata = $data;
        $this->load->view('mahasiswa/header_utama', $data);
        $this->load->view('mahasiswa/sidebar', $data);
        $this->load->view('mahasiswa/topbar', $sdata);
        $this->load->view('mahasiswa/halaman_utama', $sdata);
        $this->load->view('mahasiswa/footer_utama');
    }

    public function profile()
    {
        $data['topik'] = $this->LModel->getTopik()->result();
        $data['judul'] = 'Profile';
        $sdata['mhs'] = $this->LModel->getMhs($this->session->userdata('id'))->row_array();
        $this->load->view('mahasiswa/header_utama', $data);
        $this->load->view('mahasiswa/sidebar', $data);
        $this->load->view('mahasiswa/topbar', $data);
        $this->load->view('mahasiswa/profile', $sdata);
        $this->load->view('mahasiswa/footer_utama');
    }

    function eMhs()
    {

        $query = array(
            "nim" => $this->input->post('nim'),
            "nama" => $this->input->post('nama'),
            "email" => $this->input->post('email')
        );
        if ($this->input->post('email') != null) {
            $query['password'] = md5($this->input->post('password'));
        }
        $this->LModel->uMhs($this->session->userdata('id'), $query);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated.</div>');
        redirect('mahasiswa/profile');
    }

    public function materi($kode_topik)
    {
        $data['topik'] = $this->LModel->getTopik()->result();
        $data['judul'] = 'Materi';
        $sdata = $data;
        $this->load->view('mahasiswa/header_utama', $data);
        $this->load->view('mahasiswa/sidebar', $data);
        $this->load->view('mahasiswa/topbar', $sdata);
        $this->load->view('mahasiswa/header_utama', $data);
        $data['topik'] = $this->Lall->gettopik($kode_topik)->row();
        $data['konten'] = $this->Lall->getkonten($data['topik']->id_topik)->row();
        $tugas = $this->LModel->getJtugas($id = $this->session->userdata('id'), $data['topik']->id_topik)->row();
        if ($tugas) {
            $data['tugas'] = $tugas;
        } else {
            $tugas = new stdClass;
            $tugas->st = -1;
            $data['tugas'] = $tugas;
        }
        $data['soal'] = json_encode($this->LSoal->getListSoal($kode_topik));
        $this->load->view('mahasiswa/materi', $data);
        $this->load->view('mahasiswa/footer_utama');
    }
    public function jawab_tugas()
    {
        $jawaban = $_FILES['file']['name'];
        $id = $this->session->userdata('id');
        $nim = $this->session->userdata('nim');
        $id_topik = $this->input->post('id_topik');
        $tfile = substr($jawaban, -4);
        $tfile = substr($tfile, 1);
        if ($tfile != '.') {
            $tfile = substr($jawaban, -5);
        } else {
            $tfile = substr($jawaban, -4);
        }
        // echo '<pre>';
        // print_r($tfile);
        // echo '</pre>';
        //$name=$data['sesi']['0']->nama_sesi.$tfile;
        $namafile = "$id$id_topik$nim$tfile";

        // echo "$namafile";
        $config['file_name']         = $namafile;
        $config['upload_path']        = './JawabanTugas/';
        $config['allowed_types']    = 'doc|docx|pdf|ppt|pptx|xlsx|xls';
        $config['overwrite']        = true;

        $this->load->library('upload', 'url');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            echo $this->upload->display_errors();
        } else {
            $data = $this->upload->data();
            $query = array(
                'file_jawaban' => $namafile,
                'id_topik' => $id_topik,
                'id_mhs' => $this->session->userdata('id'),
                'total_submit' => 1,
                'st' => 'sudah',

            );
            $this->Lall->upload_tugas($query);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function doneMhs()
    {
        $query = array(
            "id_mhs" => $this->session->userdata('id'),
            "akses" => $this->input->post('akses'),
        );
        $this->LModel->addAkses($query);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_tugas()
    {
        $jawaban = $_FILES['file']['name'];
        $id = $this->session->userdata('id');
        $nim = $this->session->userdata('nim');
        $id_jawaban = $this->input->post('id_jawaban');
        $tfile = substr($jawaban, -4);
        $tfile = substr($tfile, 1);
        if ($tfile != '.') {
            $tfile = substr($jawaban, -5);
        } else {
            $tfile = substr($jawaban, -4);
        }
        // echo '<pre>';
        // print_r($tfile);
        // echo '</pre>';
        //$name=$data['sesi']['0']->nama_sesi.$tfile;
        $namafile = "$id$id_topik$nim$tfile";

        // echo "$namafile";
        $config['file_name']         = $namafile;
        $config['upload_path']        = './JawabanTugas/';
        $config['allowed_types']    = 'doc|docx|pdf|ppt|pptx|xlsx|xls';
        $config['overwrite']        = true;

        $this->load->library('upload', 'url');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            echo $this->upload->display_errors();
        } else {
            $data = $this->upload->data();
            $query = array(
                'file_jawaban' => $namafile,
                'total_submit' => $this->input->post('total_submit') + 1,
                'st' => 'sudah',
            );
            $this->Lall->update_tugas($id_jawaban, $query);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function indikator()
    {
        $data['topik'] = $this->LModel->getTopik()->result();
        $data['judul'] = 'Dashboard';
        $sdata = $data;
        $this->load->view('mahasiswa/header_utama', $data);
        $this->load->view('mahasiswa/sidebar', $data);
        $this->load->view('mahasiswa/topbar', $sdata);
        $this->load->view('mahasiswa/indikator', $sdata);
        $this->load->view('mahasiswa/footer_utama');
    }


    public function evaluasi()
    {
        $data['topik'] = $this->LModel->getTopik()->result();
        $data['judul'] = 'Dashboard';
        $sdata = $data;
        $this->load->view('mahasiswa/header_utama', $data);
        $this->load->view('mahasiswa/sidebar', $data);
        $this->load->view('mahasiswa/topbar', $sdata);
        $akses = $this->LModel->getAkses($this->session->userdata('id'))->row();
        if ($akses) {
            $sdata['akses'] = true;
            $this->load->view('mahasiswa/evaluasi', $sdata);
        } else {
            $sdata['akses'] = false;
            if ($this->LModel->getJSoal($this->session->userdata("id"))) {
                $sdata['akses'] = true;
                $this->load->view('mahasiswa/evaluasi', $sdata);
            } else {
                $this->load->view('mahasiswa/error', $sdata);
            }
        }
        $this->load->view('mahasiswa/footer_utama');
    }

    public function tentang()
    {
        $data['topik'] = $this->LModel->getTopik()->result();
        $data['judul'] = 'Dashboard';
        $sdata = $data;
        $this->load->view('mahasiswa/header_utama', $data);
        $this->load->view('mahasiswa/sidebar', $data);
        $this->load->view('mahasiswa/topbar', $sdata);
        $this->load->view('mahasiswa/tentang', $sdata);
        $this->load->view('mahasiswa/footer_utama');
    }

    public function graph($kode_topik)
    {
        $data['kode_topik'] = $kode_topik;
        $this->load->view("mahasiswa/graph", $data);
    }
}
