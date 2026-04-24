<?php
class Auth extends CI_Controller {
    public function index(){
        $this->load->view('admin/login');
    }
    public function do_login(){
        $email = $this->input->post('email');
        $pass  = md5($this->input->post('password'));

        $user = $this->db->get_where('users', [
            'email'=>$email,
            'password'=>$pass,
            'role'=>'admin'
        ])->row();

        if($user){
            // $this->session->set_userdata([
            //     'admin_id'=>$user->id,
            //     'admin_name'=>$user->name
            // ]);
            do_login($user->id, $user->name, $user->email, true, 'admin', 'admin');
            redirect('admin/index');
        } else {
            $data['message'] = "Login gagal !, Pastikan email dan password benar";
            // dump($data['message']);
            // exit;
            redirect('auth/index', $data);
        }
    }
    public function logout(){
        $this->session->unset_userdata('logged_in_admin');
        redirect('auth/index');
    }
}
