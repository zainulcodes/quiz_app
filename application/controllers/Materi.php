
<?php
class Materi extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in_user') == false){
            redirect('user/index');
        }
    }

    public function index() {
        $this->load->view('includes/header');
        $this->load->view('materi/materi');
        $this->load->view('includes/footer');
    }
}
