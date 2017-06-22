<?php

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function create()
    {
        if (isset($_SESSION["user"])) {
            $this->session->set_flashdata('message', "請先登出再來註冊。");
            redirect('/', 'refresh');
            return false;
        }

        $this->load->view('templates/message');
        $this->load->view('templates/header');
        $this->load->view('users/create');
        $this->load->view('templates/footer');
    }

    public function creating()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', "註冊失敗");
            $this->load->view('users/create');
            $this->load->view('templates/footer');
            return true;
        } else {
            $data = array(
              "email" => $this->input->post('email'),
              "password" => $this->input->post('password'),
              "name" => $this->input->post('name')
            );
            $user_id = $this->user_model->create($data);
            $this->session->set_flashdata('message', "註冊成功，歡迎。");
            $_SESSION['user']['id'] = $user_id;
            redirect('/', 'refresh');
            return true;
        }
    }
}
