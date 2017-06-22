<?php
class Chatbots extends CI_Controller{
 public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
        $this->load->model('like_model');
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

        $likes = $this->like_model->hot_likes();/*key*/
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

        $likes = $this->like_model->tag_likes();
        foreach ($likes as $like) {
            $tags[] = $this->article_model->gettag($like['tag_id']);
        }

        $data = [
            'tags' => $tags,
        ];
        $this->load->view('templates/header');
        $this->load->view('chatbots/tag',$data);
        $this->load->view('templates/footer');  

  }
  public function article_tag()
  {
       
        $this->load->view('templates/header');
        $this->load->view('chatbots/article_tag');
        $this->load->view('templates/footer');  

  }
}

?>