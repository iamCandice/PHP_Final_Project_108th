<?php
class Admin_articles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
        $this->load->model('user_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->checkSession();
        $this->check_admin();
        $data['articles'] = $this->article_model->getALL();
        $user_ids = array();
         foreach ($data['articles'] as $article) {
             if (!empty($article['user_id'])) {
                 array_push($user_ids, $article['user_id']);
            }
            }
         if (!empty($user_ids)) {
            $data['users'] = $this->user_model->find_by_ids($user_ids);
        }
        $this->load->view('templates/header');
        $this->load->view('admin_articles/index', $data);
        $this->load->view('templates/footer');
    }

    public function destroy($id=null)
    {
        $this->checkSession();
        $this->check_admin();
        $data['article'] = $this->article_model->get($id);
        $query = $this->article_model->destroy($id);
        if ($query) {
            $this->session->set_flashdata('message', "刪除文章成功");
        } else {
            $this->session->set_flashdata('message', "刪除文章失敗");
        }
        redirect(site_url('admin/articles/'), 'refresh');
    }

    public function active($article_id)
    {
        $data = array(
        "status" => "active"
      );
        $query = $this->article_model->update($data, $article_id);
        $this->session->set_flashdata('message', "審核文章通過成功");
        redirect(site_url('admin/articles/'), 'refresh');
    }

    public function refuse($article_id)
    {
        $data = array(
        "status" => "refuse"
      );
        $query = $this->article_model->update($data, $article_id);
        $this->session->set_flashdata('message', "審核文章拒絕成功");
        redirect(site_url('admin/articles/'), 'refresh');
    }

    private function checkSession()
    {
        if (!isset($_SESSION["user"])) {
            $this->session->set_flashdata('message', "尚未登入，請先登入。");
            redirect('/sign_in', 'refresh');
            return false;
        }
    }
    private function check_admin()
    {
        if (!(isset($_SESSION["user"]['is_admin']) && ($_SESSION["user"]['is_admin']==true))) {
            $this->session->set_flashdata('message', "你不是管理員，無權操作。");
            redirect(site_url(), 'refresh');
            return false;
        }
    }
}
