<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {  
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

    }
    
    public function Index(){
        $this->load->view('auth/auth_header');
        $this->load->view('auth/login');
        $this->load->view('auth/auth_footer');
    }

    function login(){
        $this->form_validation->set_rules('nim','nim','required|trim');
         
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $cek_admin = $this->LModel->LDosen($username,$password);
        if($cek_admin->num_rows() > 0){
            $data = $cek_admin->row_array();
            $this->session->set_userdata('login',TRUE);
            $this->session->set_userdata('akses','dosen');
            $this->session->set_userdata('id',$data['id_dosen']);
            $this->session->set_userdata('nama',$data['nama']);
            $this->session->set_userdata('nip',$data['nip']);
            redirect(site_url('Dosen'));
		}else{
            $cek_siswa = $this->LModel->Lmhs($username,$password);
            if($cek_siswa->num_rows() > 0){
                $data = $cek_siswa->row_array();
                if ($data['aktif']==2) {
                    $this->session->set_userdata('login',TRUE);
                    $this->session->set_userdata('akses','mahasiswa');
                    $this->session->set_userdata('id',$data['id_mhs']);
                    $this->session->set_userdata('nama',$data['nama']);
                    $this->session->set_userdata('nim',$data['nim']);
                    redirect(site_url('Mahasiswa'));
                }else{
                    echo $this->session->set_flashdata('msg','Silahkan Hubungi Dosen Untuk Aktivasi!');
                    redirect(base_url());    
                }
			}else{
				echo $this->session->set_flashdata('msg','Username atau Pasword salah!');
                redirect(base_url());
			}
			
		}
	}
    
    
    public function registration()
	{
        $this->form_validation->set_rules('nim','nim','required|trim');
        $this->form_validation->set_rules('nama','nama','required|trim');
        $this->form_validation->set_rules('email','email','required|trim|valid_email|is_unique[mahasiswa.email]',array('is_unique' => 'This email has already registered!!'));
        $this->form_validation->set_rules('password1','Password','required|trim|min_length[8]|matches[password2]',array('matches' => 'Password dont match','min_length'=>'Password too short!!(min 8)'));
        $this->form_validation->set_rules('password2','Password','required|trim|matches[password1]');
       
        
        
        if( $this->form_validation->run() == false){
            $this->load->view('auth/auth_header');
            $this->load->view('auth/registration');
            $this->load->view('auth/auth_footer');
        } else {
            $email = $this->input->post('email',true);
            $data = array(
                'nim' => htmlspecialchars($this->input->post('nim',true)),
                'nama' => htmlspecialchars($this->input->post('nama',true)),
                'email' => htmlspecialchars($email),
                'foto' => 'default.jpg',
                'password' => md5($this->input->post('password1')),	
                'aktif' => '1',
			);

            $this->db->insert('mahasiswa',$data);

            //token
            // $token = base64_encode(random_bytes(32));
            // $user_token = [
            //     'email' => $email,
            //     'token' => $token,
            //     'date_created' => time()
            // ];

            // $this->db->insert('user',$data);
            // $this->db->insert('user_token',$user_token);
            
            // $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please activate your account!</div>');
            redirect('auth');
        }
    }  
    
    private function _sendEmail($token, $type){
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'webkelasku@gmail.com',
            'smtp_pass' => 'alvia2811',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->email->initialize($config);
        
        $this->email->from('kelaskuweb@gmail.com', 'Web KELASKU');
        $this->email->to($this->input->post('email'));
        
        if($type == 'verify'){
            $this->email->subject('Account Verification');
            $this->email->message('Click This Link to Verify Your Account : <a href="'. base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Active</a>');
        } else if($type == 'forgot'){
            $this->email->subject('Reset Password');
            $this->email->message('Click This Link to reset Your Password : <a href="'. base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset password</a>');

        }

        if($this->email->send()){
            return true;
        }else{
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify(){
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
       
        if($user){
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if(time() - $user_token['date_created'] < (60 * 60 * 24)){
                    $this->db->set('is_Active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">'. $email .' has been activated! Please login. </div>');
                    redirect('auth');    
                }else{

                    $this->db->delete('user',['email' => $email]);
                    $this->db->delete('user_token',['email' => $email]);

                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account activation failed! Expired token!</div>');
                    redirect('auth');    
                }
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account activation fail! Wrong token!</div>');
                redirect('auth');    
            }
        }else{
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account activation fail! Wrong email</div>');
            redirect('auth');
        }
    }

    public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">You have been logout!</div>');
        redirect('auth');
    }
    
    public function blocked(){
        $this->load->view('auth/blocked');
    }

    public function forgotPassword(){
        $this->form_validation->set_rules('email','Email','required|trim|valid_email');
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/auth_header');
            $this->load->view('auth/forgot-password');
            $this->load->view('auth/auth_footer');
        }else{
            $email = $this->input->post('email');

            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            
            if($user){
               
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time() 
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token,'forgot');

                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Please Check Your Email to reset your password!</div>');
                redirect('auth/forgotPassword');
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email is not registered!!</div>');
                redirect('auth/forgotPassword');
            }
        }
    }

    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if($user){
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changepassword();
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset password failed! wrong token.</div>');
                redirect('auth');    
            }
        }else{
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset password failed! wrong email.</div>');
                redirect('auth');
        }
    }

    public function changepassword()
    {
        if(!$this->session->userdata('reset_email')){
            redirect(auth);
        }

        $this->form_validation->set_rules('password1','Password','required|trim|min_length[8]|matches[password2]',array('matches' => 'Password dont match','min_length'=>'Password too short!!'));
        $this->form_validation->set_rules('password2','Repeat Password','required|trim|min_length[8]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header');
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');    
        }else{
            $password = md5($this->input->post('password1'));
            $email = $this->session->userdata('reset_email');
            
            $this->db->set('password',$password);
            $this->db->where('email',$email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password has been change.</div>');
                redirect('auth');          
        }
        
    }

}
?>