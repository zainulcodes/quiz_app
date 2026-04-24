
<?php
class Quiz extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in_user') == false){
            redirect('user/index');
        }
    }
    public function start(){
        $questions = $this->db->get('quiz_questions')->result_array();
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
        $this->load->view('quiz/index', $data);
    }

    public function index(){
        $this->load->view('includes/header');
        $this->load->view('quiz/start');
        $this->load->view('includes/footer');
    }

    public function submit_ajax(){
        $answers = $this->input->post('answers');
        $questions = $this->db->get('quiz_questions')->result();
        // get user session
        $user_session = $this->session->userdata('logged_in_user');
        $id = $user_session['id'];
        $name = $user_session['name'];
        $email = $user_session['email'];
        $user = $this->db->get_where('users', ['id' => $id])->row_array();
        $quiz_attempts = $this->db->get_where('quiz_attempts', ['email' => $email])->row();

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
        if($quiz_attempts){
            $this->db->where('user_id', $id);
            $this->db->update('quiz_attempts', [
                'score' => $score,
                'duration' => $this->input->post('duration')
            ]);
            $user_session['quiz_taken'] = '1';
            $this->db->where('id', $id);
            $this->db->update('users', ['quiz_taken' => '1' ]);
        } else {
            $user_session['quiz_taken'] = '1';
            $this->db->insert('quiz_attempts', [
                'user_id' => $id,
                'name' => $name,
                'email' => $email,
                'score' => $score,
                'duration' => $this->input->post('duration')
            ]);
            $this->db->where('id', $id);
            $this->db->update('users', ['quiz_taken' => '1' ]);
        }


        $this->session->set_userdata('last_user_id', $id);
        $this->session->set_userdata('last_score_quiz', $score);
        $this->session->set_userdata('total_quiz', $total);
        
        echo json_encode([

            'correct' => $correct,
            'total' => $total,
            'score' => $score
        ]);
    }

    public function quiz_ranking(){
        $user_session = $this->session->userdata('logged_in_user');
        $id = $user_session['id'];
        $quiz = $this->db->get_where('quiz_attempts',['user_id'=>$id])->row_array();
        $data['quiz'] = $quiz;
        $data['total_quiz'] = $this->db->get('quiz_questions')->num_rows();
        $this->load->view('includes/header');
        $this->load->view('quiz/ranking', $data);
        $this->load->view('includes/footer');
    }

    public function get_ranking_ajax(){
        $ranking = $this->db
            ->order_by('score','DESC')
            ->limit(10)
            ->get('quiz_attempts')
            ->result();

        echo json_encode($ranking);
    }

    public function materi() {
        $this->load->view('includes/header');
        $this->load->view('materi/materi');
        $this->load->view('includes/footer');
    }
}
