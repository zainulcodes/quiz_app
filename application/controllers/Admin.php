<?php
class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logged_in_admin')) redirect('auth/index');
    }

    public function index(){
        $data['total_users'] = $this->db->get_where('users', array('role' => 'user'))->num_rows();
        $data['total_soal'] = $this->db->get('questions')->num_rows();
        $data['page'] = 'admin/dashboard';
        $this->load->view('admin/layout', $data);
    }

    public function get_questions(){
        echo json_encode(['data'=>$this->db->get('questions')->result()]);
    }

    public function save_question(){
        $this->db->insert('questions',$_POST);
        echo json_encode(['status'=>'ok']);
    }

    public function get_question($id){
        echo json_encode($this->db->get_where('questions',['id'=>$id])->row());
    }

    public function update_question(){
        $this->db->update('questions',$_POST,['id'=>$_POST['id']]);
        echo json_encode(['status'=>'ok']);
    }

    public function delete_question($id){
        $this->db->delete('questions',['id'=>$id]);
        echo json_encode(['status'=>'ok']);
    }

    public function logout(){
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_name');
        redirect('auth/index');
    }

    public function users(){
        $data['page'] = 'admin/users';
        $this->load->view('admin/layout', $data);
    }

    public function questions(){
        $data['page'] = 'admin/questions';
        $this->load->view('admin/layout', $data);
    }

    public function quiz(){
        $data['page'] = 'admin/quiz';
        $this->load->view('admin/layout', $data);
    }

    public function ranking_quiz(){
        $data['page'] = 'admin/ranking_quiz';
        $this->load->view('admin/layout', $data);
    }

    public function ranking_questions(){
        $data['page'] = 'admin/ranking_questions';
        $this->load->view('admin/layout', $data);
    }

    /* ================= QUIZ QUESTIONS ================= */

    /* VIEW */
    public function quiz_questions()
    {
        $data['page'] = 'admin/quiz_questions';
        $this->load->view('admin/layout', $data);
    }

    /* GET DATA */
    public function get_quiz_questions()
    {
        echo json_encode([
            'data' => $this->db->get('quiz_questions')->result()
        ]);
    }

    /* INSERT */
    public function save_quiz_question()
    {
        $data = [
            'question' => $this->input->post('question'),
            'option_a' => $this->input->post('a'),
            'option_b' => $this->input->post('b'),
            'option_c' => $this->input->post('c'),
            'option_d' => $this->input->post('d'),
            'correct_answer' => $this->input->post('correct')
        ];

        $this->db->insert('quiz_questions', $data);

        echo json_encode(['status'=>'ok']);
    }

    /* GET DETAIL */
    public function get_quiz_question($id)
    {
        echo json_encode(
            $this->db->get_where('quiz_questions',['id'=>$id])->row()
        );
    }

    /* UPDATE */
    public function update_quiz_question()
    {
        $id = $this->input->post('id');

        $data = [
            'question' => $this->input->post('question'),
            'option_a' => $this->input->post('a'),
            'option_b' => $this->input->post('b'),
            'option_c' => $this->input->post('c'),
            'option_d' => $this->input->post('d'),
            'correct_answer' => $this->input->post('correct')
        ];

        $this->db->update('quiz_questions', $data, ['id'=>$id]);

        echo json_encode(['status'=>'ok']);
    }

    /* DELETE */
    public function delete_quiz_question($id)
    {
        $this->db->delete('quiz_questions',['id'=>$id]);
        echo json_encode(['status'=>'ok']);
    }
}
