<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Campaign_dev1 extends CI_Controller
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
    public function form_target_submittion()
    {
        $data = [
            'title' => 'CAS - Upload Target Whitelist',
            'fullname' => $this->session->userdata('fullname'),
            'email' => $this->session->userdata('email'),
            'content' => "pages/camp_upload_target",
        ];
        $this->load->view('layout/content', $data);
    }

    public function getdata()
    {
        $SQL = "SELECT * FROM cdpm_target_cluster_channel_wa";
        $query = $this->db->query($SQL)->result();
        if (count($query) > 0) {
            $no = 1;
            foreach ($query as $row) {
                $data = [
                    'no' => $no++,
                    'region' => $row->region,
                    'branch' => $row->branch,
                    'cluster' => $row->cluster,
                    'periode' => $row->periode,
                    'value' => str_replace(",", ".", number_format($row->value, 0)),
                ];
                $output[] = $data;
            }
            echo json_encode($output);
        } else {
            $data = [
                'no' => "",
                'region' => "",
                'branch' => "",
                'cluster' => "",
                'periode' => "",
                'value' => "",
            ];
            echo json_encode($data);
        }
    }
}