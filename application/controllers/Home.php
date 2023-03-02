<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
    public function index()
    {
        $lastdate = $this->m_cvm->GetdataLastCVM();
        $allgroup = $this->m_cvm->UpdateAllProductCVM($lastdate);
        $data = [
            'title' => 'CAS - Home',
            'fullname' => $this->session->userdata('fullname'),
            'email' => $this->session->userdata('email'),
            'content' => "pages/home",
            'cvm' => $allgroup,
            'lastdate' => $lastdate,
        ];
        $this->load->view('layout/content', $data);
    }

    public function cvm()
    {
        $data = [
            'title' => 'CAS - Perfomance CVM',
            'fullname' => $this->session->userdata('fullname'),
            'email' => $this->session->userdata('email'),
            'content' => "pages/camp_cvm",
        ];
        $this->load->view('layout/content', $data);;
    }
}
