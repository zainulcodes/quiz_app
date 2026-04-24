
<?php
class Soal extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in_user') == false){
            redirect('user/index');
        }
    }

    public function index() {
        $user_session = $this->session->userdata('logged_in_user');
        $id = $user_session['id'];
        $user = $this->db->get_where('users', ['id' => $id])->row_array();
        if($user['quiz_taken'] == '0') {
            echo "
            <script>
                alert('Kamu tidak bisa mengakses soal saat ini!, silahkan kerjakan quiz sebelum mengakses soal');
                window.location.href = '" . base_url('quiz/start') . "';
            </script>";
        }
        // exit;
        $questions = $this->db->get('questions')->result_array();
        $data = [];
        $new_questions = [];

        foreach ($questions as $q) {

            $new_questions[] = [
                'id' => $q['id'],
                'question' => $q['question'],
                'option' => [
                    'A' => $q['option_a'],
                    'B' => $q['option_b'],
                    'C' => $q['option_c'],
                    'D' => $q['option_d'],
                ],
                'correct_answer' => $q['correct_answer']
            ];
        }
        $data['questions'] = $new_questions;
        // $this->load->view('includes/header');
        $this->load->view('soal/index', $data);
        // $this->load->view('includes/footer');
    }

    public function submit_ajax(){
        $answers = $this->input->post('answers');
        $questions = $this->db->get('questions')->result();
        // get user session
        $user_session = $this->session->userdata('logged_in_user');
        $id = $user_session['id'];
        $name = $user_session['name'];
        $email = $user_session['email'];
        
        $questions_attempts = $this->db->get_where('questions_attempts', ['email' => $email])->row();

        $correct = 0;
        $total = count($questions);

        foreach($questions as $q){
            if(isset($answers[$q->id]) && $answers[$q->id] == $q->correct_answer){
                $correct++;
            }
        }

        // ✅ HITUNG SCORE PERSEN
        $score = 0;
        if($total > 0){
            $score = ($correct / $total) * 100;
        }

        // optional: bulatkan
        $score = round($score);
        if($questions_attempts){
            $this->db->where('user_id', $id);
            $this->db->update('questions_attempts', [
                'score' => $score,
                'duration' => $this->input->post('duration')
            ]);
        } else {
            $this->db->insert('questions_attempts', [
                'user_id' => $id,
                'name' => $name,
                'email' => $email,
                'score' => $score,
                'duration' => $this->input->post('duration')
            ]);
        }
        

        $this->session->set_userdata('last_user_id', $id);
        $this->session->set_userdata('last_score_soal', $score);
        $this->session->set_userdata('total_soal', $total);
        
        echo json_encode([

            'correct' => $correct,
            'total' => $total,
            'score' => $score
        ]);
    }

    public function get_ranking_ajax(){
        $ranking = $this->db
            ->order_by('score','DESC')
            ->limit(10)
            ->get('questions_attempts')
            ->result();

        echo json_encode($ranking);
    }

    public function ranking() {
        $user_session = $this->session->userdata('logged_in_user');
        $id = $user_session['id'];
        $soal = $this->db->get_where('questions_attempts',['user_id'=>$id])->row_array();
        $data['soal'] = $soal;
        $data['total_soal'] = $this->db->get('questions')->num_rows();
        $this->load->view('includes/header');
        $this->load->view('soal/ranking', $data);
        $this->load->view('includes/footer');
    }

    public function get_server_time()
    {
        header('Content-Type: application/json');
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");

        echo json_encode([
            'server_time' => round(microtime(true) * 1000)
        ]);
    }
}
