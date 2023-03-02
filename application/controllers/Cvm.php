<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cvm extends CI_Controller
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
        if (substr($lastdate, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($lastdate));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($lastdate)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($lastdate)));
        }
        $combo = $this->m_cvm->ShowPerformanceCVMClusterComboSakti($lastdate);
        $insak = $this->m_cvm->ShowPerformanceCVMClusterInternetSakti($lastdate);
        $others = $this->m_cvm->ShowPerformanceCVMClusterOthers($lastdate);
        $multisim = $this->m_cvm->ShowPerformanceCVMClusterMultisim($lastdate);
        $hotpromo = $this->m_cvm->ShowPerformanceCVMClusterHotPromo($lastdate);
        $inlife = $this->m_cvm->ShowPerformanceCVMClusterInlife($lastdate);
        $churn = $this->m_cvm->ShowPerformanceCVMClusterChurn($lastdate);
        $fourG = $this->m_cvm->ShowPerformanceCVMCluster4G($lastdate);
        $data = [
            'title' => 'CAS - Perfomance CVM',
            'fullname' => $this->session->userdata('fullname'),
            'email' => $this->session->userdata('email'),
            'content' => "pages/camp_cvm",
            'last_date' => $lastdate,
            'date1' => $date1,
            'date2' => $date2,
            'combo' => $combo,
            'insak' => $insak,
            'others' => $others,
            'multisim' => $multisim,
            'hotpromo' => $hotpromo,
            'inlife' => $inlife,
            'churn' => $churn,
            'fourG' => $fourG,
        ];
        $this->load->view('layout/content', $data);
    }

    public function performance_region()
    {
        // $input = file_get_contents('php://input');
        // $decode = json_decode($input, true);
        $datenow = $_POST['tanggal'];
        // echo $datenow;
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $this->m_cvm->ShowSVMPerformance($datenow);
    }

    public function performance_cluster()
    {
        $datenow = $_POST['tanggal'];
        // echo $datenow;
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $this->m_cvm->ShowSVMPerformanceCluster($datenow);
    }

    public function performance_detail()
    {
        $cat_package = $_POST['cat_package'];
        $region = $_POST['region'];
        $datenow = $_POST['datenow'];
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        if ($region == "AREA 1") {
            $this->m_cvm->ShowCVMPerformanceDetailAREA1($date2, $date1, $datenow, $cat_package);
        } else {
            $this->m_cvm->ShowCVMPerformanceDetailRegion($date2, $date1, $datenow, $region, $cat_package);
        }
    }

    public function export_last()
    {
        $datenow = $this->m_cvm->GetdataLastCVM();
        // $datenow = $_POST['tanggal'];
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $data = [
            'datenow' => $datenow,
            'date2' => $date2,
            'date1' => $date1,
            'cvm' => $this->m_cvm->ShowSVMPerformanceLadTable($datenow),
            'content' => "pages/export/export_cvm",
        ];
        $this->load->view('layout/export', $data);
    }

    public function export_cvm_filter($datenow)
    {
        // $datenow = $_POST['tanggal'];
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $data = [
            'datenow' => $datenow,
            'date2' => $date2,
            'date1' => $date1,
            'cvm' => $this->m_cvm->ShowSVMPerformanceLadTable($datenow),
            'content' => "pages/export/export_cvm",
        ];
        $this->load->view('layout/export', $data);
    }

    public function filter_cvm_combo_sakti()
    {
        $datenow = $_POST['tanggal'];
        // echo $datenow;
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $query = $this->m_cvm->ShowPerformanceCVMClusterComboSakti($datenow);
        $output = [];
        if (count($query) > 0) {
            foreach ($query as $row) {
                $output[] = $row;
            }
        } else {
            $output['empty'] = ['empty'];
        }
        echo json_encode($output);
    }

    public function filter_cvm_internet_sakti()
    {
        $datenow = $_POST['tanggal'];
        // echo $datenow;
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $query = $this->m_cvm->ShowPerformanceCVMClusterInternetSakti($datenow);
        $output = [];
        if (count($query) > 0) {
            foreach ($query as $row) {
                $output[] = $row;
            }
        } else {
            $output['empty'] = ['empty'];
        }
        echo json_encode($output);
    }

    public function filter_cvm_others()
    {
        $datenow = $_POST['tanggal'];
        // echo $datenow;
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $query = $this->m_cvm->ShowPerformanceCVMClusterOthers($datenow);
        $output = [];
        if (count($query) > 0) {
            foreach ($query as $row) {
                $output[] = $row;
            }
        } else {
            $output['empty'] = ['empty'];
        }
        echo json_encode($output);
    }

    public function filter_cvm_multisim()
    {
        $datenow = $_POST['tanggal'];
        // echo $datenow;
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $query = $this->m_cvm->ShowPerformanceCVMClusterMultisim($datenow);
        $output = [];
        if (count($query) > 0) {
            foreach ($query as $row) {
                $output[] = $row;
            }
        } else {
            $output['empty'] = ['empty'];
        }
        echo json_encode($output);
    }

    public function filter_cvm_hotpromo()
    {
        $datenow = $_POST['tanggal'];
        // echo $datenow;
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $query = $this->m_cvm->ShowPerformanceCVMClusterHotPromo($datenow);
        $output = [];
        if (count($query) > 0) {
            foreach ($query as $row) {
                $output[] = $row;
            }
        } else {
            $output['empty'] = ['empty'];
        }
        echo json_encode($output);
    }

    public function filter_cvm_inlife()
    {
        $datenow = $_POST['tanggal'];
        // echo $datenow;
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $query = $this->m_cvm->ShowPerformanceCVMClusterInlife($datenow);
        $output = [];
        if (count($query) > 0) {
            foreach ($query as $row) {
                $output[] = $row;
            }
        } else {
            $output['empty'] = ['empty'];
        }
        echo json_encode($output);
    }

    public function filter_cvm_churn()
    {
        $datenow = $_POST['tanggal'];
        // echo $datenow;
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $query = $this->m_cvm->ShowPerformanceCVMClusterChurn($datenow);
        $output = [];
        if (count($query) > 0) {
            foreach ($query as $row) {
                $output[] = $row;
            }
        } else {
            $output['empty'] = ['empty'];
        }
        echo json_encode($output);
    }

    public function filter_cvm_fourg()
    {
        $datenow = $_POST['tanggal'];
        // echo $datenow;
        if (substr($datenow, -2) == 31) {
            $nowbaru = date('Y-m-' . "01", strtotime($datenow));
            $datem1 = date('Y-m-d', strtotime('-1 month', strtotime($nowbaru)));
            $datem2 = date('Y-m-d', strtotime('-2 month', strtotime($nowbaru)));
            $date1 = date("Y-m-t", strtotime($datem1));
            $date2 = date("Y-m-t", strtotime($datem2));
        } else {
            $date1 = date('Y-m-d', strtotime('-1 month', strtotime($datenow)));
            $date2 = date('Y-m-d', strtotime('-2 month', strtotime($datenow)));
        }
        $query = $this->m_cvm->ShowPerformanceCVMCluster4G($datenow);
        $output = [];
        if (count($query) > 0) {
            foreach ($query as $row) {
                $output[] = $row;
            }
        } else {
            $output['empty'] = ['empty'];
        }
        echo json_encode($output);
    }
}