<?php
class Admin_users extends CI_Controller
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
        $data['users'] = $this->user_model->all();
        $this->load->view('templates/header');
        $this->load->view('admin_users/index', $data);
        $this->load->view('templates/footer');
    }
    public function show($user_id)
    {
        $this->checkSession();
        $this->check_admin();
        $data['user'] = $this->user_model->find($user_id);
        $this->load->view('templates/header');
        $this->load->view('admin_users/show', $data);
        $this->load->view('templates/footer');
    }
    public function edit($user_id)
    {
        $this->checkSession();
        $this->check_admin();
        $data['user'] = $this->user_model->find($user_id);
        $this->load->view('templates/header');
        $this->load->view('admin_users/edit', $data);
        $this->load->view('templates/footer');
    }
    public function update($user_id)
    {
        $this->checkSession();
        $this->check_admin();
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', "更新會員失敗");
            $this->load->view('templates/header');
            $this->load->view('admin_users/edit');
            $this->load->view('templates/footer');
            return true;
        } else {
            $data = array();
            if (!empty($this->input->post('email'))) {
                $data["email"] = $this->input->post('email');
            }
            if (!empty($this->input->post('password'))) {
                $data["password"] = $this->input->post('password');
            }
            $data["name"] = $this->input->post('name');
            $this->user_model->update($data, $user_id);
            $this->session->set_flashdata('message', "更新會員成功");
            redirect('admin_users', 'refresh');
            return true;
        }
    }
    public function destroy($user_id)
    {
        $this->checkSession();
        $this->check_admin();
        $data['user'] = $this->user_model->find($user_id);
        $query = $this->user_model->destroy($user_id);
        if ($query) {
            $this->session->set_flashdata('message', "刪除會員成功");
        } else {
            $this->session->set_flashdata('message', "刪除會員失敗");
        }
        redirect(site_url('admin/users/'), 'refresh');
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