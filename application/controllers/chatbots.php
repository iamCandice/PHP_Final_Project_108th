<?php
class Chatbots extends CI_Controller{
 public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
        $this->load->model('like_model');
        $this->load->model('tag_model');
        // $this->load->model('articletag_model');
    }
  public function index()
  {
        $this->load->view('templates/header');
        $this->load->view('chatbots/index');
        $this->load->view('templates/footer');	
  
  }
   public function hot()
    {
        $hots = [];

        $likes = $this->like_model->hot_likes();
        foreach ($likes as &$like) {
          $article = $this->article_model->get($like['article_id']);
          
          $like['title'] = $article['title'];
        }

        $data = [
            'likes' => $likes
        ];
        $this->load->view('templates/header');
        $this->load->view('chatbots/hot',$data);
        $this->load->view('templates/footer');
    }
 public function tag()
  {
        $tags = [];
        $likes = $this->like_model->hot_tags();
        foreach ($likes as &$like) {
          $article_tag = $this->tag_model->gettag($like['tag_id']);
          $like['name'] = $article_tag['name'];
        }
        $data = [
          'likes' => $likes
        ];
        $this->load->view('templates/header');
        $this->load->view('chatbots/tag',$data);
        $this->load->view('templates/footer');  
  }
}

?>