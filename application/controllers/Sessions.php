<?php

class Sessions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    public function create()
    {
        if (isset($_SESSION["user"])) {
            $this->session->set_flashdata('message', "你已經登入過了。");
            redirect('/', 'refresh');
            return true;
        }
        $this->load->helper('form');
        $this->load->view('templates/header');
        $this->load->view('sessions/create');
        $this->load->view('templates/footer');
    }

    public function creating()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $data['user'] = $this->user_model->getUser($email, $password);

        if ($data['user']) {
            $this->session->set_flashdata('message', "登入成功。");
            $_SESSION['user']['id'] =  $data['user']->id;
            // if user is admin
            if ($data['user']->is_admin=='Y') {
                $_SESSION['user']['is_admin'] = true;
            }
            redirect('/', 'refresh');
            return true;
        } else {
            $this->session->set_flashdata('message', "登入失敗，請重新輸入帳密。");

            redirect('/login', 'refresh');
            return true;
        }
    }

    public function destroy()
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION['user']);
            $this->session->set_flashdata('message', "成功登出");
            redirect('/', 'refresh');
            return true;
        } else {
            $this->session->set_flashdata('message', "尚未登入");
            redirect('/sign_in', 'refresh');
            return true;
        }
    }
}
