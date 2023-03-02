<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Campaign_dev2 extends CI_Controller
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
        date_default_timezone_set('Asia/Jakarta');
        // $this->load->model('m_cvm');
        $this->load->model('m_agile');
    }
    public function agile()
    {
        $folder_bba = "/mnt/data2/campaign_area/cdpm";
        $data = [
            'title' => 'CAS - Agile Check Taker',
            'fullname' => $this->session->userdata('fullname'),
            'email' => $this->session->userdata('email'),
            'content' => "pages/camp_agile",
            'rowUpload' => $this->m_agile->GetDataRowUpload(),
            'date_bba' => date('Y-m-d', strtotime('-3 days', strtotime(date('Y-m-d')))),
            'file_bba' => $this->m_agile->GetFuntionInfoBBA(),
            'folder' => $folder_bba,
        ];
        $this->load->view('layout/content', $data);
    }

    public function check_taker()
    {
        require_once APPPATH . '/third_party/Net/SFTP/Stream.php';
        require_once APPPATH . '/third_party/Net/SFTP.php';
        require_once APPPATH . '/third_party/Net/SSH2.php';
        require_once APPPATH . '/third_party/Math/BigInteger.php';
        require_once APPPATH . '/third_party/Crypt/RC4.php';
        require_once APPPATH . '/third_party/Crypt/Rijndael.php';
        require_once APPPATH . '/third_party/Crypt/Random.php';
        require_once APPPATH . '/third_party/Crypt/Hash.php';
        require_once APPPATH . '/third_party/Crypt/Twofish.php';
        require_once APPPATH . '/third_party/Crypt/Blowfish.php';
        require_once APPPATH . '/third_party/Crypt/TripleDES.php';
        $host = '10.32.18.206';
        $port = '22';
        $username = 'mcdserver';
        $password = 'mcdserver';
        $ssh = new Net_SSH2($host);
        $sftp = new Net_SFTP($host, $port);

        $now = date('Y-m-d-H-i-s');
        $filedokumen = $_FILES['file-3'];
        $namadokumen =  preg_replace("/\.[^.]+$/", "", $filedokumen["name"]);
        $temp = explode(".", $filedokumen["name"]);
        $extension = end($temp);
        $campaign_date = $_POST['campaign_date'];
        $campaign_date_h1 = date('Y-m-d', strtotime('+1 days', strtotime($campaign_date)));
        $program = $_POST['program'];
        $arrstr = array(" ", "-");
        $newFileName = $namadokumen . "_" . $now . "." . $extension;
        $newFileName_taker = $namadokumen . "_" . $now . "_taker" . "." . $extension;
        $newFileName_taker_txt = $namadokumen . "_" . $now . "_taker" . ".txt";
        $tmpFile = $filedokumen["tmp_name"];

        // Mulai chektaker
        $bba_date = "/mnt/data2/campaign_area/cdpm/raw_bba_daily_region_new_" . $campaign_date . ".txt";
        $bba_date_d1 = "/mnt/data2/campaign_area/cdpm/raw_bba_daily_region_new_" . $campaign_date_h1 . ".txt";
        $bba_gabungan = "/home/mcdserver/datacdpm/data/agile/upload/sumber.txt";
        $bba_filter_program = "/home/mcdserver/datacdpm/data/agile/upload/bba_program.txt";

        // WhitelistUpload = 
        $WhitelistUpload = "/home/mcdserver/datacdpm/data/agile/upload/" . $newFileName;
        $WhitelistTaker = "/home/mcdserver/datacdpm/data/agile/taker/" . $newFileName_taker;
        $WhitelistTaker_txt = "/home/mcdserver/datacdpm/data/agile/taker/" . $newFileName_taker_txt;
        $WLCopy = "/home/mcdserver/datacdpm/data/agile/upload/wl.txt";

        $bba_proses_gabungan = "cat " . $bba_date . "  "  . $bba_date_d1 . " > " . $bba_gabungan;

        $SedDulu = "sed -i 's/.$//' " . $WhitelistUpload;
        $script = $this->m_agile->FilterBBA_ByProgram($program, $bba_gabungan, $bba_filter_program);
        $CopyWL = $this->m_agile->CopyWL($WhitelistUpload, $WLCopy);
        $CopyWLTaker = $this->m_agile->CopyWLTaker($WhitelistTaker);
        $CopyWLTaker2 = $this->m_agile->CopyWLTaker2($WhitelistTaker_txt);
        // echo $CopyWL;
        $join = $this->m_agile->JoinWhitelistProgram();
        $scriptFilterJoin = $this->m_agile->FilterFileJoin($WhitelistTaker, $program);
        $inject = $this->m_agile->InjectToTableMysql();
        $rm1 = $this->m_agile->RemoveFileSql();
        $rm2 = $this->m_agile->RemoveFiletxt();
        $rm3 = $this->m_agile->RemoveFileProgramBBA();
        $rm4 = $this->m_agile->RemoveFileGabunganBBA();
        $rm5 = $this->m_agile->RemoveFileCopyTaker();
        $rm6 = $this->m_agile->RemoveFileCopyWL();
        $ssh->login($username, $password);
        if ($sftp->login($username, $password)) {
            // 
            $sftp->put($WhitelistUpload, $tmpFile, NET_SFTP_LOCAL_FILE);
            $ssh->exec($SedDulu);
            $ssh->exec($CopyWL);
            $ssh->exec($bba_proses_gabungan);
            $ssh->exec($script);
            $sftp->exec($join);
            $sftp->exec($CopyWLTaker);
            $sftp->exec($scriptFilterJoin);
            $sftp->exec($CopyWLTaker2);
            // $sftp->exec($inject);
            $sftp->exec($rm1);
            $sftp->exec($rm2);
            $sftp->exec($rm3);
            $sftp->exec($rm4);
            $sftp->exec($rm5);
            $sftp->exec($rm6);

            $value = [
                'file_upload' => $filedokumen['name'],
                'file_taker1' => $newFileName_taker,
                'file_taker2' => $newFileName_taker_txt,
                'campaign_date' => $campaign_date,
                'program' => $program,
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => $now,
            ];
            $query = $this->m_agile->InsertData($value, "cdpm_agile_row_upload");
            $data = [
                'status' => "success",
                'message' => "successfully"
            ];
        } else {
            $data = [
                'status' => "Failed",
                'message' => "Alert"
            ];
        }
        echo json_encode($data);
    }

    public function list_data_taker($fileName)
    {
        require_once APPPATH . '/third_party/Net/SFTP/Stream.php';
        require_once APPPATH . '/third_party/Net/SFTP.php';
        require_once APPPATH . '/third_party/Net/SSH2.php';
        require_once APPPATH . '/third_party/Math/BigInteger.php';
        require_once APPPATH . '/third_party/Crypt/RC4.php';
        require_once APPPATH . '/third_party/Crypt/Rijndael.php';
        require_once APPPATH . '/third_party/Crypt/Random.php';
        require_once APPPATH . '/third_party/Crypt/Hash.php';
        require_once APPPATH . '/third_party/Crypt/Twofish.php';
        require_once APPPATH . '/third_party/Crypt/Blowfish.php';
        require_once APPPATH . '/third_party/Crypt/TripleDES.php';
        $host = '10.32.18.206';
        $port = '22';
        $username = 'mcdserver';
        $password = 'mcdserver';
        $ssh = new Net_SSH2($host);
        $sftp = new Net_SFTP($host, $port);
        // $file = $_POST['file'];
        // echo $fileName;
        $file = file("/home/mcdserver/datacdpm/data/agile/taker/" . $fileName);
        // $file = file("public/resource/" . $fileName);

        foreach ($file as $line) {
            $columns = explode("|", $line);
            $data = array(
                'msisdn' => $columns[0],
                'region' => $columns[1],
                'city' => $columns[2],
                'channel' => $columns[3],
                'revenue' => $columns[4],
                'trx_date' => $columns[5],
                'program' => $columns[6],
            );
            $response[] = $data;
        }
        echo json_encode($response);
    }

    public function summary($fileName)
    {
        require_once APPPATH . '/third_party/Net/SFTP/Stream.php';
        require_once APPPATH . '/third_party/Net/SFTP.php';
        require_once APPPATH . '/third_party/Net/SSH2.php';
        require_once APPPATH . '/third_party/Math/BigInteger.php';
        require_once APPPATH . '/third_party/Crypt/RC4.php';
        require_once APPPATH . '/third_party/Crypt/Rijndael.php';
        require_once APPPATH . '/third_party/Crypt/Random.php';
        require_once APPPATH . '/third_party/Crypt/Hash.php';
        require_once APPPATH . '/third_party/Crypt/Twofish.php';
        require_once APPPATH . '/third_party/Crypt/Blowfish.php';
        require_once APPPATH . '/third_party/Crypt/TripleDES.php';
        $host = '10.32.18.206';
        $port = '22';
        $username = 'mcdserver';
        $password = 'mcdserver';
        $ssh = new Net_SSH2($host);
        $sftp = new Net_SFTP($host, $port);
        // $file = file("public/resource/" . $fileName);
        $file = file("/home/mcdserver/datacdpm/data/agile/taker/" . $fileName);
        $grouped = array();
        $rev = array();
        foreach ($file as $line) {
            $columns = explode("|", $line);
            $key = str_replace("&", "", $columns[3]);
            if (!isset($grouped_data[$key])) {
                $grouped_data[str_replace(" ", "", $key)] =  intval($columns[4]);
            } else {
                $grouped_data[str_replace(" ", "", $key)] +=  intval($columns[4]);
            }
        }
        // print_r($grouped_data);
        // var_dump($grouped_data);
        echo json_encode($grouped_data);
    }

    public function download_file_all($FileName)
    {
        $this->load->helper('download');
        $file = '/home/mcdserver/datacdpm/data/agile/taker/' . $FileName;
        force_download($file, NULL);
    }

    public function download_file_all_filter()
    {
        $program = $_POST['program'];
        $campaign_date = $_POST['campaign_date'];
        $SQL = "SELECT * FROM cdpm_agile_row_upload WHERE program='" . $program . "' AND campaign_date='" . $campaign_date . "'";
        $query = $this->db->query($SQL)->row();
        $fileTakerCsv = $query->file_taker1;
        $this->load->helper('download');
        $file = '/home/mcdserver/datacdpm/data/agile/taker/' . $fileTakerCsv;
        force_download($file, NULL);
    }

    public function delete_data_taker()
    {
        $id = $_POST['id'];
        $file1 = $_POST['file1'];
        $file2 = $_POST['file2'];
        $file_upload = $_POST['file_upload'];
        $file_upload_new = substr($file1, 0, -10);

        require_once APPPATH . '/third_party/Net/SFTP/Stream.php';
        require_once APPPATH . '/third_party/Net/SFTP.php';
        require_once APPPATH . '/third_party/Net/SSH2.php';
        require_once APPPATH . '/third_party/Math/BigInteger.php';
        require_once APPPATH . '/third_party/Crypt/RC4.php';
        require_once APPPATH . '/third_party/Crypt/Rijndael.php';
        require_once APPPATH . '/third_party/Crypt/Random.php';
        require_once APPPATH . '/third_party/Crypt/Hash.php';
        require_once APPPATH . '/third_party/Crypt/Twofish.php';
        require_once APPPATH . '/third_party/Crypt/Blowfish.php';
        require_once APPPATH . '/third_party/Crypt/TripleDES.php';
        $host = '10.32.18.206';
        $port = '22';
        $username = 'mcdserver';
        $password = 'mcdserver';
        $ssh = new Net_SSH2($host);
        $sftp = new Net_SFTP($host, $port);
        $ssh->login($username, $password);
        $delete1 = "rm -r /home/mcdserver/datacdpm/data/agile/taker/" . $file1;
        $delete2 = "rm -r /home/mcdserver/datacdpm/data/agile/taker/" . $file2;
        $delete3 = "rm -r /home/mcdserver/datacdpm/data/agile/upload/" . $file_upload_new . ".csv";
        if ($sftp->login($username, $password)) {
            $sftp->exec($delete1);
            $sftp->exec($delete2);
            $sftp->exec($delete3);
        }
        $SQL = "DELETE FROM cdpm_agile_row_upload WHERE id='" . $id . "'";
        $query = $this->db->query($SQL);
        if ($query) {
            $response = [
                'status' => 'success',
                'message' => 'Successfully',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error',
            ];
        }
        echo json_encode($response);
    }

    public function filtergroup2($FileName)
    {
        // $fileName = file("public/resource/A10_BB_AG_C1_Segment3T_1601_2023-02-08-15-49-37_taker.txt");
        // $file = file("public/resource/" . $FileName);
        $file = file("/home/mcdserver/datacdpm/data/agile/taker/" . $FileName);
        $data = array();
        foreach ($file as $line) {
            $columns = explode("|", $line);
            $data = array(
                'msisdn' => $columns[0],
                'region' => $columns[1],
                'city' => $columns[2],
                'channel' => $columns[3],
                'revenue' => $columns[4],
                'trx_date' => $columns[5],
                'program' => $columns[6],
            );
            $response[] = $data;
        }
        $grouped_data = array();

        foreach ($response as $d) {
            if (!isset($grouped_data[$d['region']][$d['channel']])) {
                $grouped_data[$d['region']][$d['channel']] = 0;
            }

            $grouped_data[$d['region']][$d['channel']] += $d['revenue'];
        }

        foreach ($grouped_data as $kolom1 => $group1) {
            foreach ($group1 as $kolom2 => $group2) {
                $data2 = array(
                    'region' => $kolom1,
                    'channel' => $kolom2,
                    'revenue' => $group2,
                );
                $resp[] = $data2;
            }
        }

        echo json_encode($resp);
    }

    public function agile_data($program, $periode)
    {
        // echo $program . " " . $periode;
        $program_replace = str_replace("_", " ", $program);
        $NumbMonth = $this->m_agile->GetPeriodeBulan($periode);
        // echo $program_replace . " " . $NumbMonth;

        $value = $this->m_agile->FilterDataRowUploadAgile($program_replace, $NumbMonth);
        $aksi = "<div class='button-group'><button class='btn btn-sm btn-danger' onclick='delete_taker_from_filter()'><i class='fa fa-trash'></i></button><button class='btn btn-sm btn-primary' onclicik='show_modal_data_agile_from_filter()'><i class='fa fa-list'></i></button><button class='btn btn-sm btn-dark' onclick='download_file_txt_from_filter()'><i class='fa fa-file'></i></button><button class='btn btn-sm btn-success' onclick='download_file_csv_from_filter()'><i class='fa fa-file-excel'></i></button></div>";
        if (count($value) > 0) {
            $no = 1;
            foreach ($value as $row) {
                $data = [
                    'action' => $aksi,
                    'no' => $no++,
                    'program' => $row->program,
                    'campaign_date' => $row->campaign_date,
                    'file_upload' => $row->file_upload,
                    'file_taker' => $row->file_taker2,
                ];
                $response[] = $data;
            }
            echo json_encode($response);
        } else {
            $data = [
                'action' => "",
                'no' => "",
                'program' => "",
                'campaign_date' => "",
                'file_upload' => "",
                'file_taker' => "",
            ];
            $response[] = $data;
            echo json_encode($response);
        }
    }

    public function agile_data_download($program, $bulan)
    {
        $program_replace = str_replace("_", " ", $program);
        $NumbMonth = $this->m_agile->GetPeriodeBulan($bulan);
        $value = $this->m_agile->FilterDataRowUploadAgile($program_replace, $NumbMonth);
        $this->load->helper('download');
        $this->load->library('zip');
        if (count($value) > 0) {
            $no = 1;
            foreach ($value as $row) {
                $file = '/home/mcdserver/datacdpm/data/agile/taker/' . $row->file_taker2;
                $this->zip->read_file($file);
            }
            $this->zip->download($program . "_" . "$bulan" . '_txt.zip');
        }
    }

    public function agile_data_download_csv($program, $bulan)
    {
        $program_replace = str_replace("_", " ", $program);
        $NumbMonth = $this->m_agile->GetPeriodeBulan($bulan);
        $value = $this->m_agile->FilterDataRowUploadAgile($program_replace, $NumbMonth);
        $this->load->helper('download');
        $this->load->library('zip');
        if ($program == "All") {
        } else {
            if (count($value) > 0) {
                $no = 1;
                foreach ($value as $row) {
                    $file = '/home/mcdserver/datacdpm/data/agile/taker/' . $row->file_taker1;
                    $this->zip->read_file($file);
                }
                $this->zip->download($program . "_" . "$bulan" . '_csv.zip');
            }
        }
    }

    public function insert_database()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $file_taker = $_POST['file_taker'];
        $CekFileTaker = $this->m_agile->CekDataBerdasarkanFileTaker($file_taker);
        if (!empty($CekFileTaker->file)) {
            $respon = [
                'status' => 'any',
                'message' => 'Success',
            ];
            echo json_encode($respon);
        } else {
            require_once APPPATH . '/third_party/Net/SFTP/Stream.php';
            require_once APPPATH . '/third_party/Net/SFTP.php';
            require_once APPPATH . '/third_party/Net/SSH2.php';
            require_once APPPATH . '/third_party/Math/BigInteger.php';
            require_once APPPATH . '/third_party/Crypt/RC4.php';
            require_once APPPATH . '/third_party/Crypt/Rijndael.php';
            require_once APPPATH . '/third_party/Crypt/Random.php';
            require_once APPPATH . '/third_party/Crypt/Hash.php';
            require_once APPPATH . '/third_party/Crypt/Twofish.php';
            require_once APPPATH . '/third_party/Crypt/Blowfish.php';
            require_once APPPATH . '/third_party/Crypt/TripleDES.php';
            $host = '10.32.18.206';
            $port = '22';
            $username = 'mcdserver';
            $password = 'mcdserver';
            $ssh = new Net_SSH2($host);
            $sftp = new Net_SFTP($host, $port);
            $RunningSH = $this->m_agile->RunningInjectAgilePorgramToTable($file_taker);
            $ssh->login($username, $password);
            if ($sftp->login($username, $password)) {
                $sftp->exec($RunningSH);
                $data = [
                    'status_table' => "Y",
                    'file_taker2' => $file_taker,
                ];
                $query = $this->m_agile->UpdateDataUpload($data);
                $respon = [
                    'status' => 'success',
                    'message' => 'Success',
                ];
                echo json_encode($respon);
            }
        }
    }

    public function check_ulang_taker()
    {
        $id = $this->input->post('id');
        $valuerow = $this->m_agile->getDataRowByid($id);
        $program = $valuerow->program;
        $file_upload = $valuerow->file_upload;
        $campaign_date = $valuerow->campaign_date;
        $campaign_date_h1 = date('Y-m-d', strtotime('+1 days', strtotime($campaign_date)));
        $file_taker_subs = substr($valuerow->file_taker1, 0, -10) . '.csv';
        $file_taker1 = $valuerow->file_taker1;
        $file_taker2 = $valuerow->file_taker2;

        // echo $file_taker1;
        // $this->load->helper('download');
        // $file = '/home/mcdserver/datacdpm/data/agile/upload/' . $file_taker1;
        // force_download($file, NULL);


        require_once APPPATH . '/third_party/Net/SFTP/Stream.php';
        require_once APPPATH . '/third_party/Net/SFTP.php';
        require_once APPPATH . '/third_party/Net/SSH2.php';
        require_once APPPATH . '/third_party/Math/BigInteger.php';
        require_once APPPATH . '/third_party/Crypt/RC4.php';
        require_once APPPATH . '/third_party/Crypt/Rijndael.php';
        require_once APPPATH . '/third_party/Crypt/Random.php';
        require_once APPPATH . '/third_party/Crypt/Hash.php';
        require_once APPPATH . '/third_party/Crypt/Twofish.php';
        require_once APPPATH . '/third_party/Crypt/Blowfish.php';
        require_once APPPATH . '/third_party/Crypt/TripleDES.php';
        $host = '10.32.18.206';
        $port = '22';
        $username = 'mcdserver';
        $password = 'mcdserver';
        $ssh = new Net_SSH2($host);
        $sftp = new Net_SFTP($host, $port);

        // Mulai chektaker
        $bba_date = "/mnt/data2/campaign_area/cdpm/raw_bba_daily_region_new_" . $campaign_date . ".txt";
        $bba_date_d1 = "/mnt/data2/campaign_area/cdpm/raw_bba_daily_region_new_" . $campaign_date_h1 . ".txt";
        $bba_gabungan = "/home/mcdserver/datacdpm/data/agile/upload/sumber.txt";
        $bba_filter_program = "/home/mcdserver/datacdpm/data/agile/upload/bba_program.txt";

        // WhitelistUpload = 
        $WhitelistUpload = "/home/mcdserver/datacdpm/data/agile/upload/" . $file_taker_subs;
        $WhitelistTaker = "/home/mcdserver/datacdpm/data/agile/taker/" . $file_taker1;
        $WhitelistTaker_txt = "/home/mcdserver/datacdpm/data/agile/taker/" . $file_taker2;
        $WLCopy = "/home/mcdserver/datacdpm/data/agile/upload/wl.txt";

        $bba_proses_gabungan = "cat " . $bba_date . "  "  . $bba_date_d1 . " > " . $bba_gabungan;

        $SedDulu = "sed -i 's/.$//' " . $WhitelistUpload;
        $script = $this->m_agile->FilterBBA_ByProgram($program, $bba_gabungan, $bba_filter_program);
        $CopyWL = $this->m_agile->CopyWL($WhitelistUpload, $WLCopy);
        $CopyWLTaker = $this->m_agile->CopyWLTaker($WhitelistTaker);
        $CopyWLTaker2 = $this->m_agile->CopyWLTaker2($WhitelistTaker_txt);
        // echo $CopyWL;
        $join = $this->m_agile->JoinWhitelistProgram();
        $scriptFilterJoin = $this->m_agile->FilterFileJoin($WhitelistTaker, $program);
        $inject = $this->m_agile->InjectToTableMysql();
        $rm1 = $this->m_agile->RemoveFileSql();
        $rm2 = $this->m_agile->RemoveFiletxt();
        $rm3 = $this->m_agile->RemoveFileProgramBBA();
        $rm4 = $this->m_agile->RemoveFileGabunganBBA();
        $rm5 = $this->m_agile->RemoveFileCopyTaker();
        $rm6 = $this->m_agile->RemoveFileCopyWL();
        $ssh->login($username, $password);
        if ($sftp->login($username, $password)) {
            // 
            // $sftp->put($WhitelistUpload, $tmpFile, NET_SFTP_LOCAL_FILE);
            // $ssh->exec($SedDulu);
            $ssh->exec($CopyWL);
            $ssh->exec($bba_proses_gabungan);
            $sftp->exec($script);
            $sftp->exec($join);
            $ssh->exec($CopyWLTaker);
            $sftp->exec($scriptFilterJoin);
            $sftp->exec($CopyWLTaker2);
            // // $sftp->exec($inject);
            $sftp->exec($rm1);
            $sftp->exec($rm2);
            $sftp->exec($rm3);
            $sftp->exec($rm4);
            $sftp->exec($rm5);
            $sftp->exec($rm6);

            // $value = [
            //     'file_upload' => $filedokumen['name'],
            //     'file_taker1' => $newFileName_taker,
            //     'file_taker2' => $newFileName_taker_txt,
            //     'campaign_date' => $campaign_date,
            //     'program' => $program,
            //     'user_id' => $this->session->userdata('user_id'),
            //     'created_at' => $now,
            // ];
            // $query = $this->m_agile->InsertData($value, "cdpm_agile_row_upload");
            $data = [
                'status' => "success",
                'message' => "successfully"
            ];
            echo json_encode($data);
        } else {
            $data = [
                'status' => "Failed",
                'message' => "Alert"
            ];
            echo json_encode($data);
        }
    }

    public function getdata_summary_agile()
    {
        $query = $this->m_agile->getSummaryAgile();
        if (count($query) > 0) {
            $no = 1;
            foreach ($query as $row) {
                $data = [
                    'no' => $no++,
                    'region' => $row->region,
                    'channel' => $row->channel,
                    'program' => $row->program,
                    'subs' => $row->subs,
                    'rev' => $row->rev,
                ];
                $temp[] = $data;
            }
            $response = [
                'status' => 'success',
                'agile' => $temp,
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status' => 'empty',
            ];
            echo json_encode($response);
        }
    }
}
