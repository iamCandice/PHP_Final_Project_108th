<?php
class Articles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
        $this->load->model('comment_model');
        $this->load->model('user_model');
        $this->load->model('like_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['articles'] = $this->article_model->find_active();
        $this->load->view('templates/header');
        $this->load->view('articles/index', $data);
        $this->load->view('templates/footer');
    }
    public function show($id = null)
    {
        $data['article'] = $this->article_model->get($id);
        if (!$data['article']) {
            $this->session->set_flashdata('message', "沒有此文章");
            redirect(site_url('articles/'), 'refresh');
            return true;
        }
        $data['comments'] = $this->comment_model->find_by_article($id);
        $data['author'] = $this->user_model->find($data['article']['user_id']);
        $data['likes'] = $this->like_model->article_likes($id);
        $user_id = null;
        if (isset($_SESSION["user"]['id'])) {
            $user_id = $_SESSION["user"]['id'];
        }
        $data['liked'] = $this->like_model->is_exists($user_id, $id);
        if (!empty($data['comments'])) {
            $user_ids = array();
            foreach ($data['comments'] as $comment) {
                if (!empty($comment['user_id'])) {
                    array_push($user_ids, $comment['user_id']);
                }
            }
            $data['users'] = $this->user_model->find_by_ids($user_ids);
        }
        $this->load->view('templates/header');
        $this->load->view('articles/show', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->checkSession();

        $this->load->view('articles/create');
        $this->load->view('templates/footer');
    }

    public function creating()
    {
        $this->checkSession();
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', "建立文章失敗");
            $this->load->view('articles/create');
            $this->load->view('templates/footer');
            return true;
        } else {
            $data = array(
              "title" => $this->input->post('title'),
              "content" => $this->input->post('content'),
              "pic_url" => $this->input->post('pic_url'),
              "url" => $this->input->post('url')
            );
            $article_id = $this->article_model->insert($data, $_SESSION['user']['id']);
            $this->session->set_flashdata('message', "建立文章成功");
            redirect(site_url('articles/'.$article_id), 'refresh');
            return true;
        }
    }

    public function edit($id=null)
    {
        $this->checkSession();
        $data['article'] = $this->article_model->get($id);
        $this->checkArticleAuthor($data['article'], $_SESSION["user"]);
        $this->load->view('articles/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id=null)
    {
        $this->checkSession();
        $data['article'] = $this->article_model->get($id);
        $this->checkArticleAuthor($data['article'], $_SESSION["user"]);
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', "更新文章失敗");
            redirect(site_url('articles/'.$id.'/edit'), 'refresh');
            return true;
        } else {
            $data = array(
              "title" => $this->input->post('title'),
              "content" => $this->input->post('content'),
              "pic_url" => $this->input->post('pic_url'),
              "url" => $this->input->post('url')
            );
            $query = $this->article_model->update($data, $id);
            $this->session->set_flashdata('message', "更新文章成功");
            redirect(site_url('articles/'.$id), 'refresh');
            return true;
        }
    }
    public function destroy($id=null)
    {
        $this->checkSession();
        $data['article'] = $this->article_model->get($id);
        $this->checkArticleAuthor($data['article'], $_SESSION["user"]);
        $query = $this->article_model->destroy($id);
        if ($query) {
            $this->session->set_flashdata('message', "刪除文章成功");
            redirect(site_url('articles/'), 'refresh');
            return true;
        } else {
            $this->session->set_flashdata('message', "刪除文章失敗");
            redirect(site_url('articles/'.$id), 'refresh');
            return true;
        }
    }
    public function my()
    {
        $this->checkSession();
        $data['articles'] = $this->article_model->find_by_author($_SESSION["user"]["id"]);
        $this->load->view('templates/header', $data);
        $this->load->view('articles/my', $data);
        $this->load->view('templates/footer');
    }

    public function comment($article_id=null)
    {
        $this->checkSession();
        $this->form_validation->set_rules('message', 'Message', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', "留言失敗。");
            redirect(site_url('articles/'.$article_id), 'refresh');
            return true;
        } else {
            $data = array(
              "message" => $this->input->post('message'),
              "article_id" => $article_id,
              "user_id" => $_SESSION["user"]["id"]
            );
            $query = $this->comment_model->create($data);
            $this->session->set_flashdata('message', "留言成功");
            redirect(site_url('articles/'.$article_id), 'refresh');
            return true;
        }
    }

    public function like($article_id)
    {
        $this->checkSession();
        $this->checkLike($_SESSION["user"]['id'], $article_id);
        $this->like_model->insert($_SESSION["user"]['id'], $article_id);
        $this->session->set_flashdata('message', "你點讚了此文章");
        redirect(site_url('articles/'.$article_id), 'refresh');
    }

    public function dislike($article_id)
    {
        $this->checkSession();
        $this->checkLiked($_SESSION["user"]['id'], $article_id);
        $this->like_model->destroy($_SESSION["user"]['id'], $article_id);
        $this->session->set_flashdata('message', "你收回了此文章的讚。");
        redirect(site_url('articles/'.$article_id), 'refresh');
    }

    private function checkLike($user_id, $article_id)
    {
        $like = $this->like_model->is_exists($user_id, $article_id);
        if ($like) {
            $this->session->set_flashdata('message', "你已經讚過了。");
            redirect(site_url('articles/'.$article_id), 'refresh');
            return false;
        }
    }

    private function checkLiked($user_id, $article_id)
    {
        $like = $this->like_model->is_exists($user_id, $article_id);
        if (!$like) {
            $this->session->set_flashdata('message', "你還沒讚過，不能收回讚。");
            redirect(site_url('articles/'.$article_id), 'refresh');
            return false;
        }
    }
    private function checkSession()
    {
        if (!isset($_SESSION["user"])) {
            $this->session->set_flashdata('message', "尚未登入，請先登入。");
            redirect('/sign_in', 'refresh');
            return false;
        }
    }
    private function checkArticleAuthor($article, $author)
    {
        if ($article['user_id'] != $author['id']) {
            $this->session->set_flashdata('message', "你不是作者，無權操作。");
            redirect(site_url('articles/'.$article['id']), 'refresh');
            return false;
        }
    }

    // public function pagination(){
    //     $this->load->library('pagination');

    //     $config['base_url'] =  base_url().'/Articles/page/';;
    //     $config['total_rows'] = 200;
    //     $config['per_page'] = 1; 
    //     $config['num_links'] = 5;
    //     $config['use_page_numbers'] = TRUE;
    //     $config['first_link'] = false;
    //     $config['last_link'] = false;

    //     $offset_limit = intval($this->uri->segment(3));
    //     $this->pagination->initialize($config); 

    //     //沒有分頁資料可以顯示的時候，create_links() 函數就會回傳空字串
    //     echo $this->pagination->create_links();
    //     // $this->load->view('Articles/index.php',$data);
    // }
}
