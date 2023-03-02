<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Postpaid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->session->sess_expiration = '60';
        $this->session->sess_expire_on_close = 'true';
        if ($this->session->userdata('log_in') != "login") {
            redirect(base_url("auth"));
        }
        $this->load->model('m_cvm');
    }

    public function performance()
    {
        $data = [
            'title' => 'CAS - Postpaid Performance ',
            'fullname' => $this->session->userdata('fullname'),
            'email' => $this->session->userdata('email'),
            'content' => "pages/camp_postpaid",
        ];
        $this->load->view('layout/content', $data);
    }
}
