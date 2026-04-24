
<?php
class Ranking extends CI_Controller {

    public function index(){
        $data['ranking'] = $this->db->query("
            SELECT user_id, MAX(score) as score
            FROM quiz_attempts
            GROUP BY user_id
            ORDER BY score DESC
        ")->result();

        $this->load->view('ranking/index',$data);
    }

    public function questions_ranking(){
        $data['ranking'] = $this->db->query("
            SELECT user_id, MAX(score) as score
            FROM quiz_attempts
            GROUP BY user_id
            ORDER BY score DESC
        ")->result();

        $this->load->view('soal/ranking',$data);
    }
}
