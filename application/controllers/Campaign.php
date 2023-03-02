<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Campaign extends CI_Controller
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
        $this->load->model('m_campaign_chanel');
    }
    public function taker_wa()
    {
        $last_date = $this->m_campaign_chanel->GetDataLastUpdateSubmittion();
        // $last_date = "2023-01-31";
        $awal = date('Y-m-' . "01", strtotime($last_date));
        $data = [
            'title' => 'CAS - Perfomance CVM',
            'fullname' => $this->session->userdata('fullname'),
            'email' => $this->session->userdata('email'),
            'content' => "pages/camp_taker_wa",
            'last_update' => $last_date,
            'cluster' =>  $this->m_campaign_chanel->GetTakerChannelWhatsApp($awal, $last_date),
            'region' => $this->m_campaign_chanel->GetTakerChannelWhatsAppRegion($awal, $last_date),
            'area' => $this->m_campaign_chanel->GetTakerChannelWhatsAppArea($awal, $last_date),
        ];
        $this->load->view('layout/content', $data);
    }

    public function taker_wa_filter()
    {
        $date_value = $_POST['date_filter'];
        $awal = date('Y-m-' . "01", strtotime($date_value));
        $data = $this->m_campaign_chanel->GetTakerChannelWhatsApp($awal, $date_value);
        $output = [];
        if (count($data) > 0) {
            foreach ($data as $row) {
                $total_wl = $row->insak_wl + $row->comsak_wl + $row->hotpromo_wl + $row->digital_wl + $row->suprise_deal_wl + $row->voice_wl;
                $percent_insak = ($row->insak_wl / $total_wl) * 100;
                $percent_comsak = ($row->comsak_wl / $total_wl) * 100;
                $percent_hotpromo = ($row->hotpromo_wl / $total_wl) * 100;
                $percent_digital = ($row->digital_wl / $total_wl) * 100;
                $percent_suprise_deal_wl = ($row->suprise_deal_wl / $total_wl) * 100;
                $percent_voice_wl = ($row->voice_wl / $total_wl) * 100;
                $data = [
                    'region' => $row->region,
                    'branch' => $row->branch,
                    'cluster' => $row->cluster,
                    'insak_wl' => str_replace(',', '.', number_format($row->insak_wl, 0)),
                    'insak_taker' => str_replace(',', '.', number_format($row->insak_taker, 0)),
                    'rev_insak' => str_replace(',', '.', number_format($row->rev_insak, 0)),
                    'percent_insak' =>  number_format($percent_insak, 2) . "%",
                    'comsak_wl' => str_replace(',', '.', number_format($row->comsak_wl, 0)),
                    'comsak_taker' => str_replace(',', '.', number_format($row->comsak_taker, 0)),
                    'rev_comsak' => str_replace(',', '.', number_format($row->rev_comsak, 0)),
                    'percent_comsak' => number_format($percent_comsak, 2) . "%",
                    'hotpromo_wl' => str_replace(',', '.', number_format($row->hotpromo_wl, 0)),
                    'hotpromo_taker' => str_replace(',', '.', number_format($row->hotpromo_taker, 0)),
                    'rev_hotpromo_wl' => str_replace(',', '.', number_format($row->rev_hotpromo, 0)),
                    'percent_hotpromo' => number_format($percent_hotpromo, 2) . "%",
                    'digital_wl' => str_replace(',', '.', number_format($row->digital_wl, 0)),
                    'percent_digital' => number_format($percent_digital, 2) . "%",
                    'suprise_deal_wl' => str_replace(',', '.', number_format($row->suprise_deal_wl, 0)),
                    'percent_suprise_deal' => number_format($percent_suprise_deal_wl, 2) . "%",
                    'voice_wl' => str_replace(',', '.', number_format($row->voice_wl, 0)),
                    'percent_voice' => number_format($percent_voice_wl, 2) . "%"
                ];

                $output[] = $data;
            }
        } else {
            $output['empty'] = ['empty'];
        }
        echo json_encode($output);
    }

    public function download_last_update_wa_manual()
    {
        $last_date = $this->m_campaign_chanel->GetDataLastUpdateSubmittion();
        $awal = date('Y-m-' . "01", strtotime($last_date));
        $value1 = $this->m_campaign_chanel->GetTakerChannelWhatsAppArea($awal, $last_date);
        $value2 = $this->m_campaign_chanel->GetTakerChannelWhatsAppRegion($awal, $last_date);
        $value3 = $this->m_campaign_chanel->GetTakerChannelWhatsApp($awal, $last_date);
        $data = [
            'date_first' => $awal,
            'date_last' => $last_date,
            'area' => $value1,
            'region' => $value2,
            'cluster' => $value3,
            'content' => "pages/export/last_wa",
        ];
        $this->load->view('layout/export', $data);
    }

    public function download_last_update_wa_manual_filter($date_filter)
    {
        $awal = date('Y-m-' . "01", strtotime($date_filter));
        // echo $last_date . " " . $awal;
        $value = $this->m_campaign_chanel->GetTakerChannelWhatsApp($awal, $date_filter);
        $data = [
            'date_first' => $awal,
            'date_last' => $date_filter,
            'area' => $value,
            'content' => "pages/export/wa_filter",
        ];
        $this->load->view('layout/export', $data);
    }

    public function dowload_last_wa()
    {
        $last_date = $this->m_campaign_chanel->GetDataLastUpdateSubmittion();
        $awal = date('Y-m-' . "01", strtotime($last_date));
        // echo $last_date . " " . $awal;

        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Data Siswa")
            ->setSubject("Siswa")
            ->setDescription("Laporan Semua Data Siswa")
            ->setKeywords("Data Siswa");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "TMP_Report_Taker_Daily_" . $last_date); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:C1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "Region"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "Branch"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "Cluster"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "Insak WL"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Insak Taker WL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Insak Rev"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "%"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "Comsak WL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "Comsak Taker WL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "Comsak Rev"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "%"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "Hot Promo WL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "Hot Promo Taker WL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('N3', "Hot Promo Rev"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "%"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "Digital WL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('Q3', "Digital Taker WL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('R3', "Digital Rev"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('S3', "%"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "Suprise Deal WL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "Suprise Deal Taker"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('V3', "Suprise Deal Rev%"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('W3', "%"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('X3', "Voice WL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('Y3', "Voice Taker WL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('Z3', "Voice Rev"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('AA3', "%"); // Set kolom E3 dengan tulisan "ALAMAT"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);

        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        $value = $this->m_campaign_chanel->GetTakerChannelWhatsApp($awal, $last_date);
        foreach ($value as $data) { // Lakukan looping pada variabel siswa
            $total_wl = $data->insak_wl + $data->comsak_wl + $data->hotpromo_wl + $data->digital_wl + $data->suprise_deal_wl + $data->voice_wl;
            $percent_insak = ($data->insak_wl / $total_wl) * 100;
            $percent_comsak = ($data->comsak_wl / $total_wl) * 100;
            $percent_hotpromo = ($data->hotpromo_wl / $total_wl) * 100;
            $percent_digital = ($data->digital_wl / $total_wl) * 100;
            $percent_suprise_deal_wl = ($data->suprise_deal_wl / $total_wl) * 100;
            $percent_voice_wl = ($data->voice_wl / $total_wl) * 100;

            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $data->region);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->branch);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->cluster);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->insak_wl);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->insak_taker);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->rev_insak);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, number_format($percent_insak, 2) . "%");
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->comsak_wl);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->comsak_taker);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->rev_comsak);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, number_format($percent_comsak, 2) . "%");
            $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $data->hotpromo_wl);
            $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $data->hotpromo_taker);
            $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $data->rev_hotpromo);
            $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, number_format($percent_hotpromo, 2) . "%");
            $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, $data->digital_wl);
            $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, 0);
            $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, 0);
            $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, number_format($percent_digital, 2) . "%");
            $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, $data->suprise_deal_wl);
            $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, 0);
            $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, 0);
            $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, number_format($percent_suprise_deal_wl, 2) . "%");
            $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, $data->voice_wl);
            $excel->setActiveSheetIndex(0)->setCellValue('Y' . $numrow, 0);
            $excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrow, 0);
            $excel->setActiveSheetIndex(0)->setCellValue('AA' . $numrow, number_format($percent_voice_wl, 2) . "%");

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('X' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('Y' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('Z' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('AA' . $numrow)->applyFromArray($style_row);

            // $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(20); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('N')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('Q')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('R')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('S')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('V')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('W')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('X')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('Y')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('Z')->setWidth(10); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('AA')->setWidth(10); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Campaign Daily Results");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Campaign_Daily.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    // end wa taker


    public function taker_all_channel()
    {
        $lastdate = $this->m_campaign_chanel->GetDataLastUpdateSubmittion();
        // $lastdate = "2023-02-08";
        $awal_m1 = date('Y-m-01', strtotime('-1 month', strtotime($lastdate)));
        $akhir_m1 = date('Y-m-d', strtotime('-1 month', strtotime($lastdate)));
        $awal_m0 = date('Y-m-' . "01", strtotime($lastdate));
        $akhir_m0 = $lastdate;
        $date_update = date('d', strtotime($lastdate));
        $month_update  = date('m', strtotime($lastdate));
        $year_update  = date('Y', strtotime($lastdate));
        $date_max = date('t', strtotime($lastdate));
        // echo $date_update . " " . $month_update . " " . $year_update . " " . $date_max;
        $value = $this->m_campaign_chanel->GetTakerChannelAll($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $month_update, $year_update, $date_update, $date_max);
        $value2 = $this->m_campaign_chanel->GetTakerChannelAllRegion($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $month_update, $year_update, $date_update, $date_max);
        $value3 = $this->m_campaign_chanel->GetTakerChannelAllArea($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $month_update, $year_update, $date_update, $date_max);
        $data = [
            'title' => 'CAS - Perfomance Taker All Channel',
            'fullname' => $this->session->userdata('fullname'),
            'email' => $this->session->userdata('email'),
            'content' => "pages/camp_taker_all_channel",
            'last_update' => $lastdate,
            'subs_m1' => $akhir_m1,
            'subs_m0' => $akhir_m0,
            'cluster' => $value,
            'region' => $value2,
            'area' => $value3,
        ];
        $this->load->view('layout/content', $data);
    }

    public function filter_all_channel()
    {
        $date_filter = $_POST['date_filter'];
        $awal_m1 = date('Y-m-01', strtotime('-1 month', strtotime($date_filter)));
        $akhir_m1 = date('Y-m-d', strtotime('-1 month', strtotime($date_filter)));
        $awal_m0 = date('Y-m-' . "01", strtotime($date_filter));
        $akhir_m0 = $date_filter;
        $date_update = date('d', strtotime($date_filter));
        $month_update  = date('m', strtotime($date_filter));
        $year_update  = date('Y', strtotime($date_filter));
        $date_max = date('t', strtotime($date_filter));
        $value = $this->m_campaign_chanel->GetTakerChannelAll($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $month_update, $year_update, $date_update, $date_max);
        $output = [];
        if (count($value) > 0) {
            foreach ($value as $row) {
                if ($row->acv > 0) {
                    $acv_value = "positif";
                } else {
                    $acv_value = "negatif";
                }
                if ($row->drr > 0) {
                    $drr_value = "positif";
                } else {
                    $drr_value = "negatif";
                }
                if ($row->MoM > 0) {
                    $MoM_value = "positif";
                } else {
                    $MoM_value = "negatif";
                }
                if ($row->Tur_m0 > 0) {
                    $Tur_m0_value = "positif";
                } else {
                    $Tur_m0_value = "negatif";
                }

                if ($row->Tur_m1 > 0) {
                    $Tur_m1_value = "positif";
                } else {
                    $Tur_m1_value = "negatif";
                }
                $data = [
                    'region' => $row->region,
                    'branch' => $row->branch,
                    'cluster' => $row->cluster,
                    'subs_m0' => str_replace(",", ".", number_format($row->subs_m0, 0)),
                    'subs_m1' => str_replace(",", ".", number_format($row->subs_m1, 0)),
                    'target' => str_replace(",", ".", number_format($row->target, 0)),
                    'acv' => str_replace(".", ",", number_format($row->acv, 2)) . "%",
                    'drr' => str_replace(".", ",", number_format($row->drr, 2)) . "%",
                    'MoM' => str_replace(".", ",", number_format($row->MoM, 2)) . "%",
                    'taker_subs_m0' => str_replace(",", ".", number_format($row->taker_subs_m0, 0)),
                    'taker_subs_m1' => str_replace(",", ".", number_format($row->taker_subs_m1, 0)),
                    'tur_m0' => str_replace(".", ",", number_format($row->Tur_m0, 2)) . "%",
                    'tur_m1' => str_replace(".", ",", number_format($row->Tur_m1, 2)) . "%",
                    'rev_subs_m0' => str_replace(",", ".", number_format($row->rev_subs_m0, 0)),
                    'rev_subs_m1' => str_replace(",", ".", number_format($row->rev_subs_m1, 0)),
                    'daily' => str_replace(",", ".", number_format($row->daily, 0)),
                    'acv_st' => $acv_value,
                    'drr_st' => $drr_value,
                    'MoM_st' => $MoM_value,
                    'Tur_m0_value' => $Tur_m0_value,
                    'Tur_m1_value' => $Tur_m1_value,
                ];
                $output[] = $data;
            }
        } else {
            $output['empty'] = ['empty'];
        }
        echo json_encode($output);
    }

    public function download_all_channel_last()
    {
        $lastdate = $this->m_campaign_chanel->GetLastDateTakerChannellAll();
        // $lastdate = "2023-02-08";
        // echo $lastdate;
        $awal_m1 = date('Y-m-01', strtotime('-1 month', strtotime($lastdate)));
        $akhir_m1 = date('Y-m-d', strtotime('-1 month', strtotime($lastdate)));
        $awal_m0 = date('Y-m-' . "01", strtotime($lastdate));
        $akhir_m0 = $lastdate;
        $date_update = date('d', strtotime($lastdate));
        $month_update  = date('m', strtotime($lastdate));
        $year_update  = date('Y', strtotime($lastdate));
        $date_max = date('t', strtotime($lastdate));
        // echo $date_update . " " . $month_update . " " . $year_update . " " . $date_max;
        $value = $this->m_campaign_chanel->GetTakerChannelAll($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $month_update, $year_update, $date_update, $date_max);
        $value2 = $this->m_campaign_chanel->GetTakerChannelAllRegion($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $month_update, $year_update, $date_update, $date_max);
        $value3 = $this->m_campaign_chanel->GetTakerChannelAllArea($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $month_update, $year_update, $date_update, $date_max);
        $data = [
            'date_first' => $awal_m0,
            'date_last' => $lastdate,
            'cluster' => $value,
            'region' => $value2,
            'area' => $value3,
            'content' => "pages/export/export_all_channel",
            'subs_m1' => $akhir_m1,
            'subs_m0' => $akhir_m0,
        ];
        $this->load->view('layout/export', $data);
    }

    public function download_all_channel_filter($date)
    {
        $awal = date('Y-m-' . "01", strtotime($date));
        $awal_m1 = date('Y-m-01', strtotime('-1 month', strtotime($date)));
        $akhir_m1 = date('Y-m-d', strtotime('-1 month', strtotime($date)));
        $awal_m0 = date('Y-m-' . "01", strtotime($date));
        $akhir_m0 = $date;
        $date_update = date('d', strtotime($date));
        $month_update  = date('m', strtotime($date));
        $year_update  = date('Y', strtotime($date));
        $date_max = date('t', strtotime($date));
        // echo $date_update . " " . $month_update . " " . $year_update . " " . $date_max;
        $value = $this->m_campaign_chanel->GetTakerChannelAll($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $month_update, $year_update, $date_update, $date_max);
        $value2 = $this->m_campaign_chanel->GetTakerChannelAllRegion($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $month_update, $year_update, $date_update, $date_max);
        $value3 = $this->m_campaign_chanel->GetTakerChannelAllArea($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $month_update, $year_update, $date_update, $date_max);
        $data = [
            'date_first' => $awal,
            'date_last' => $date,
            'date_filter' => $date,
            'cluster' => $value,
            'region' => $value2,
            'area' => $value3,
            'content' => "pages/export/export_all_channel_filter",
            'subs_m1' => $akhir_m1,
            'subs_m0' => $akhir_m0,
        ];
        $this->load->view('layout/export', $data);
    }
}
