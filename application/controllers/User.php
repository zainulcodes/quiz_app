<?php
class User extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        if (is_login('user')) {
            redirect('quiz');
        } else {
            $this->load->view('login');
        }
    }

    public function login()
    {
        $nama  = $this->input->post('nama');
        $email = $this->input->post('email');
        // VALIDASI
        if(empty($nama) || empty($email)){
            echo json_encode([
                'status' => 'error',
                'message' => 'Nama & Email wajib diisi'
            ]);
            return;
        }

        // VALIDASI EMAIL
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo json_encode([
                'status' => 'error',
                'message' => 'Format email tidak valid'
            ]);
            return;
        }

        // CEK EMAIL
        $user = $this->db->get_where('users', ['email' => $email])->row();
        if($user){
            // ✅ LOGIN
            // $this->session->set_userdata([
            //     'id' => $user->id,
            //     'name'    => $user->name,
            //     'email'   => $user->email,
            //     'logged_in' => true,
            //     'role' => $user->role
            // ]);
            do_login($user->id, $user->name, $user->email, true, 'user', 'user');

            echo json_encode([
                'status' => 'success',
                'message' => 'Login berhasil (user lama)'
            ]);
        }else{
            // ✅ REGISTER
            $this->db->insert('users', [
                'name'  => $nama,
                'email' => $email,
                'role'  => 'user'
            ]);

            $id = $this->db->insert_id();
            do_login($id, $nama, $email, true, 'user', 'user');
            

            echo json_encode([
                'status' => 'success',
                'message' => 'Registrasi berhasil'
            ]);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in_user');
        redirect('user/index');
    }
}