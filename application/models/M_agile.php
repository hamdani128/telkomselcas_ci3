<?php
class M_agile extends CI_Model
{
    public function FilterBBA_ByProgram($program, $bba_gabungan, $bba_program)
    {
        if ($program == "Winback YYN Comsak - Non Insak") {
            $shell = "awk -F \"|\" '{if($14==\"03-00. Combo Max\" || $14==\"03-01. Combo BAU\" || $14==\"03-02. Combo Zoning\"  || $14==\"03-03. Combo Pacman\" ) print $0}' " . $bba_gabungan . " > " . $bba_program;
        } else if ($program == "Winback YYN Insak") {
            $shell = "awk -F \"|\" '{if($14==\"03-11. Internet Sakti\") print $0}' " . $bba_gabungan . " > " . $bba_program;
        } else if ($program == "Stimulate NNN Sakti") {
            $shell = "awk -F \"|\" '{if($14==\"03-00. Combo Max\" || $14==\"03-01. Combo BAU\" || $14==\"03-02. Combo Zoning\"  || $14==\"03-03. Combo Pacman\" && $14==\"03-11. Internet Sakti\") print $0}' " . $bba_gabungan . " > " . $bba_program;
        } else if ($program == "Core Lapser") {
            $contenStr = str_replace(",", "|", "00037086,00043761,00023488,00036565,00048133,00036295,00036306,00036308,00027716,00049173");
            $shell = "awk -F \"|\" '$5 ~ /" . $contenStr . "/ {print $0}' " . $bba_gabungan  . " > " . $bba_program;
        } else if ($program == "Core Downgrade Consistent") {
            $contenStr = str_replace(",", "|", "00048123,00048124,00048133,00048564,00048121,00048125,00048129,00048131,00048135");
            $shell = "awk -F \"|\" '$5 ~ /" . $contenStr . "/ {print $0}' " . $bba_gabungan  . " > " . $bba_program;
        } else if ($program == "Core Retention") {
            $contenStr = str_replace(",", "|", "00041000,00048090,00048091,00041002,00041005,00041012,00048094,00048095,00041013,00044952,00041014,00044953,00041017,00041021");
            $shell = "awk -F \"|\" '$5 ~ /" . $contenStr . "/ {print $0}' " . $bba_gabungan  . " > " . $bba_program;
        } else if ($program == "Lapser HP Non Taker") {
            $shell = "awk -F \"|\" '{if($14==\"03-13. Hot Promo\") print $0}' " . $bba_gabungan . " > " . $bba_program;
        } else if ($program == "USIM No Pack") {
            $contenStr = str_replace(",", "|", "00035257,00040058");
            $shell = "awk -F \"|\" '$5 ~ /" . $contenStr . "/ {print $0}' " . $bba_gabungan  . " > " . $bba_program;
        } else if ($program == "Prepaid Churn High Prospensity") {
            $contenStr = str_replace(",", "|", "00039170,00039230,00039171,00039175,00033058,00039174,00039172,00039176");
            $shell = "awk -F \"|\" '$5 ~ /" . $contenStr . "/ {print $0}' " . $bba_gabungan  . " > " . $bba_program;
        } else if ($program == "Uplift LVC to HVC") {
            $contenStr = str_replace(",", "|", "00026253,00022987,00026252,00022987,00023492,00027718");
            $shell = "awk -F \"|\" '$5 ~ /" . $contenStr . "/ {print $0}' " . $bba_gabungan  . " > " . $bba_program;
        } else if ($program == "Winback Lapser HVC") {
            $contenStr = str_replace(",", "|", "00026253,00022987,00026252,00022987,00023492,00027718");
            $shell = "awk -F \"|\" '$5 ~ /" . $contenStr . "/ {print $0}' " . $bba_gabungan  . " > " . $bba_program;
        } else if ($program == "HVC Prevention") {
            $contenStr = str_replace(",", "|", "00026253,00022987,00026252,00022987,00023492,00027718");
            $shell = "awk -F \"|\" '$5 ~ /" . $contenStr . "/ {print $0}' " . $bba_gabungan  . " > " . $bba_program;
        } else if ($program == "Multisim") {
            $contenStr = str_replace(",", "|", "00035101,00036053,00035097,00035094,00035098,00036052,00055295,00055297,00035101");
            $shell = "awk -F \"|\" '$5 ~ /" . $contenStr . "/ {print $0}' " . $bba_gabungan  . " > " . $bba_program;
        }
        return $shell;
    }

    public function CopyWL($WhitelistUpload, $Wl)
    {
        $Shell = "cp " . $WhitelistUpload . "  " . $Wl;
        return $Shell;
    }

    public function JoinWhitelistProgram()
    {
        $Shell = "sh /home/mcdserver/datacdpm/data/agile/joinwl.sh";
        return $Shell;
    }

    public function CopyWLTaker($WhitelistTaker)
    {
        $Shell = "cp /home/mcdserver/datacdpm/data/agile/taker/taker.txt  " . $WhitelistTaker;
        return $Shell;
    }

    public function CopyWLTaker2($WhitelistTaker_txt)
    {
        $Shell = "cp /home/mcdserver/datacdpm/data/agile/taker/data.txt  " . $WhitelistTaker_txt;
        return $Shell;
    }

    public function FilterFileJoin($WhitelistTaker, $program)
    {
        $Shell = "awk -F \"|\" '{if($2!=\"NULL\") print $1\"|\"$3\"|\"$4\"|\"$10\"|\"$17\"|\"$2\"|\"\"" . $program . "\"}' " . $WhitelistTaker . " > /home/mcdserver/datacdpm/data/agile/taker/data.txt";
        return $Shell;
    }

    public function InjectToTableMysql()
    {
        $Shell = "sh /home/mcdserver/datacdpm/data/agile/taker/agile.sh";
        return $Shell;
    }

    public function RemoveFileSql()
    {
        $Shell = "rm -r /home/mcdserver/datacdpm/data/agile/taker/data.sql";
        return $Shell;
    }

    public function RemoveFiletxt()
    {
        $Shell = "rm -r /home/mcdserver/datacdpm/data/agile/taker/data.txt";
        return $Shell;
    }
    public function RemoveFileProgramBBA()
    {
        $Shell = "rm -r /home/mcdserver/datacdpm/data/agile/upload/bba_program.txt";
        return $Shell;
    }

    public function RemoveFileGabunganBBA()
    {
        $Shell = "rm -r /home/mcdserver/datacdpm/data/agile/upload/sumber.txt";
        return $Shell;
    }

    public function RemoveFileCopyTaker()
    {
        $Shell = "rm -r /home/mcdserver/datacdpm/data/agile/taker/taker.txt";
        return $Shell;
    }

    public function RemoveFileCopyWL()
    {
        $Shell = "rm -r /home/mcdserver/datacdpm/data/agile/upload/wl.txt";
        return $Shell;
    }

    function InsertData($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function GetDataRowUpload()
    {
        $SQL = "SELECT * FROM cdpm_agile_row_upload";
        $query = $this->db->query($SQL);
        return $query->result();
    }

    public function GetPeriodeBulan($bulan)
    {
        if ($bulan == "Januari") {
            $numb = "01";
        } elseif ($bulan == "Februari") {
            $numb = "02";
        } elseif ($bulan == "Maret") {
            $numb = "03";
        } elseif ($bulan == "April") {
            $numb = "04";
        } elseif ($bulan == "Mei") {
            $numb = "05";
        } elseif ($bulan == "Juni") {
            $numb = "06";
        } elseif ($bulan == "Juli") {
            $numb = "07";
        } elseif ($bulan == "Agustus") {
            $numb = "08";
        } elseif ($bulan == "September") {
            $numb = "09";
        } elseif ($bulan == "Oktober") {
            $numb = "10";
        } elseif ($bulan == "November") {
            $numb = "11";
        } elseif ($bulan == "Desember") {
            $numb = "12";
        }
        return $numb;
    }

    public function FilterDataRowUploadAgile($program, $date_month)
    {
        if ($program == "All") {
            $SQL = "SELECT * FROM cdpm_agile_row_upload WHERE MONTH(campaign_date)='" .  $date_month . "' AND YEAR(campaign_date)='" . date('Y-m-d') . "'";
        } else {
            $SQL = "SELECT * FROM cdpm_agile_row_upload WHERE MONTH(campaign_date)='" .  $date_month . "' AND YEAR(campaign_date)='" . date('Y-m-d') . "' AND program='" . $program . "'";
        }
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function CekDataBerdasarkanFileTaker($fileTaker)
    {
        $SQL = "SELECT file FROM cdpm_agile_program WHERE file='" . $fileTaker . "' GROUP BY 1";
        $query = $this->db->query($SQL);
        return $query->row();
    }

    public function RunningInjectAgilePorgramToTable($fileTaker)
    {
        $Shell = "sh /home/mcdserver/datacdpm/data/filter/agile_insert.sh " . $fileTaker;
        return $Shell;
    }

    public function UpdateDataUpload($data)
    {
        $SQL = "UPDATE cdpm_agile_row_upload SET status_table='" . $data['status_table'] . "' WHERE file_taker2='" . $data['file_taker2'] . "'";
        return $this->db->query($SQL);
    }

    public function getDataRowByid($id)
    {
        $SQL = "SELECT * FROM cdpm_agile_row_upload WHERE id='" . $id . "'";
        return $this->db->query($SQL)->row();
    }

    public function getSummaryAgile()
    {
        $SQL = "SELECT
                a.region as region,
                a.channel as channel,
                a.program as program,
                COUNT(a.msisdn) as subs,
                SUM(a.revenue) as rev
                FROM cdpm_agile_program a
                GROUP BY 1,2,3 ORDER BY 1 DESC";
        return $this->db->query($SQL)->result();
    }



    public function GetFuntionInfoBBA()
    {
        $folder = "/mnt/data2/campaign_area/cdpm";
        return $file_list = scandir($folder);
    }
}
