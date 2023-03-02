<?php
class M_cvm extends CI_Model
{
    public function GetdataLastCVM()
    {
        $SQL = "SELECT MAX(a.period) as periode FROM cdpm_raw_cvm_performance a";
        $query = $this->db->query($SQL)->row();
        return $query->periode;
    }

    public function DropTableCVM_PIVOT()
    {
        $SQL = "DROP TABLE IF EXISTS cdpm_pivot_cvm";
        $query = $this->db->query($SQL);
        return $query;
    }

    public function CreataPivotCvm($date2, $date1, $datenow)
    {
        $SQL = "CREATE TABLE cdpm_pivot_cvm AS select * from (
            SELECT 
            a.region as region,
            a.paket_group as paket_group,
            a.subs_m2 as subs_m2,
            a.subs_m1 as subs_m1,
            a.subs_m0 as subs_m0,
            CAST(((a.subs_m0/a.subs_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_Subs,
            CAST(((a.subs_m0/a.subs_m1)-1)*100 AS DECIMAL(10,2)) as MoM_Subs,
            a.trx_m2 as trx_m2,
            a.trx_m1 as trx_m1,
            a.trx_m0 as trx_m0,
            CAST(((a.trx_m0/a.trx_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_trx,
            CAST(((a.trx_m0/a.trx_m1)-1)*100 AS DECIMAL(10,2)) as MoM_trx,
            FORMAT((a.rev_m2/1000000000),2) as rev_m2,
            FORMAT((a.rev_m1/1000000000),2) as rev_m1,
            FORMAT((a.rev_m0/1000000000),2) as rev_m0,
            CAST(((a.rev_m0/a.rev_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_rev,
            CAST(((a.rev_m0/a.rev_m1)-1)*100 AS DECIMAL(10,2)) as MoM_rev
            FROM 
            (SELECT
            b.region as region,
            b.cat_pack_subgroup as paket_group,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.region = b.region AND a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date2 . "'
            ) as subs_m2,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.region = b.region AND a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date1 . "'
            ) as subs_m1,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.region = b.region AND a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $datenow . "'
            ) as subs_m0,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.region = b.region AND a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date2 . "'
            ) as trx_m2,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a
                WHERE a.region = b.region AND a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date1 . "'
            ) as trx_m1,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.region = b.region AND a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $datenow . "'
            ) as trx_m0,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.region = b.region AND a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date2 . "'
            ) as rev_m2,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.region = b.region AND a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date1 . "'
            ) as rev_m1,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.region = b.region AND a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $datenow . "'
            ) as rev_m0
            FROM
            (SELECT region, cat_pack_subgroup FROM cdpm_raw_cvm_performance GROUP BY 1,2) b
            GROUP BY 1,2 ORDER BY 1 DESC ) a
            
            UNION ALL
            
            SELECT 
            a.region as region,
            a.paket_group as paket_group,
            a.subs_m2 as subs_m2,
            a.subs_m1 as subs_m1,
            a.subs_m0 as subs_m0,
            CAST(((a.subs_m0/a.subs_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_Subs,
            CAST(((a.subs_m0/a.subs_m1)-1)*100 AS DECIMAL(10,2)) as MoM_Subs,
            a.trx_m2 as trx_m2,
            a.trx_m1 as trx_m1,
            a.trx_m0 as trx_m0,
            CAST(((a.trx_m0/a.trx_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_trx,
            CAST(((a.trx_m0/a.trx_m1)-1)*100 AS DECIMAL(10,2)) as MoM_trx,
            FORMAT((a.rev_m2/1000000000),2) as rev_m2,
            FORMAT((a.rev_m1/1000000000),2) as rev_m1,
            FORMAT((a.rev_m0/1000000000),2) as rev_m0,
            CAST(((a.rev_m0/a.rev_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_rev,
            CAST(((a.rev_m0/a.rev_m1)-1)*100 AS DECIMAL(10,2)) as MoM_rev
            FROM 
            (SELECT
            'AREA 1' as region,
            b.cat_pack_subgroup as paket_group,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date2 . "'
            ) as subs_m2,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date1 . "'
            ) as subs_m1,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $datenow . "'
            ) as subs_m0,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date2 . "'
            ) as trx_m2,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date1 . "'
            ) as trx_m1,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $datenow . "'
            ) as trx_m0,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date2 . "'
            ) as rev_m2,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a
                WHERE a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $date1 . "'
            ) as rev_m1,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.cat_pack_subgroup = b.cat_pack_subgroup AND a.period = '" . $datenow . "'
            ) as rev_m0
            FROM
            (SELECT cat_pack_subgroup FROM cdpm_raw_cvm_performance GROUP BY 1) b
            GROUP BY 1,2 ORDER BY 1 ASC ) a
            
            UNION ALL
            
            SELECT 
            a.region as region,
            a.paket_group as paket_group,
            a.subs_m2 as subs_m2,
            a.subs_m1 as subs_m1,
            a.subs_m0 as subs_m0,
            CAST(((a.subs_m0/a.subs_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_Subs,
            CAST(((a.subs_m0/a.subs_m1)-1)*100 AS DECIMAL(10,2)) as MoM_Subs,
            a.trx_m2 as trx_m2,
            a.trx_m1 as trx_m1,
            a.trx_m0 as trx_m0,
            CAST(((a.trx_m0/a.trx_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_trx,
            CAST(((a.trx_m0/a.trx_m1)-1)*100 AS DECIMAL(10,2)) as MoM_trx,
            FORMAT((a.rev_m2/1000000000),2) as rev_m2,
            FORMAT((a.rev_m1/1000000000),2) as rev_m1,
            FORMAT((a.rev_m0/1000000000),2) as rev_m0,
            CAST(((a.rev_m0/a.rev_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_rev,
            CAST(((a.rev_m0/a.rev_m1)-1)*100 AS DECIMAL(10,2)) as MoM_rev
            FROM 
            (SELECT
            b.region as region,
            'Total' as paket_group,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.region = b.region AND a.period = '" . $date2 . "'
            ) as subs_m2,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.region = b.region AND a.period = '" . $date1 . "'
            ) as subs_m1,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.region = b.region AND a.period = '" . $datenow . "'
            ) as subs_m0,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.region = b.region AND a.period = '" . $date2 . "'
            ) as trx_m2,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.region = b.region AND a.period = '" . $date1 . "'
            ) as trx_m1,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.region = b.region AND a.period = '" . $datenow . "'
            ) as trx_m0,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.region = b.region AND a.period = '" . $date2 . "'
            ) as rev_m2,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a
                WHERE a.region = b.region AND a.period = '" . $date1 . "'
            ) as rev_m1,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.region = b.region AND a.period ='" . $datenow . "'
            ) as rev_m0
            FROM
            (SELECT region FROM cdpm_raw_cvm_performance GROUP BY 1) b
            GROUP BY 1,2 ORDER BY 1 DESC ) a
            
            UNION ALL
            
            SELECT 
            a.region as region,
            a.paket_group as paket_group,
            a.subs_m2 as subs_m2,
            a.subs_m1 as subs_m1,
            a.subs_m0 as subs_m0,
            CAST(((a.subs_m0/a.subs_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_Subs,
            CAST(((a.subs_m0/a.subs_m1)-1)*100 AS DECIMAL(10,2)) as MoM_Subs,
            a.trx_m2 as trx_m2,
            a.trx_m1 as trx_m1,
            a.trx_m0 as trx_m0,
            CAST(((a.trx_m0/a.trx_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_trx,
            CAST(((a.trx_m0/a.trx_m1)-1)*100 AS DECIMAL(10,2)) as MoM_trx,
            FORMAT((a.rev_m2/1000000000),2) as rev_m2,
            FORMAT((a.rev_m1/1000000000),2) as rev_m1,
            FORMAT((a.rev_m0/1000000000),2) as rev_m0,
            CAST(((a.rev_m0/a.rev_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_rev,
            CAST(((a.rev_m0/a.rev_m1)-1)*100 AS DECIMAL(10,2)) as MoM_rev
            FROM 
            (SELECT
            'AREA 1' as region,
            'Total' as paket_group,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a  
                WHERE a.period = '" . $date2 . "'
            ) as subs_m2,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.period = '" . $date1 . "'
            ) as subs_m1,
            (
                SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.period = '" . $datenow . "'
            ) as subs_m0,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.period = '" . $date2 . "'
            ) as trx_m2,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a
                WHERE a.period = '" . $date1 . "'
            ) as trx_m1,
            (
                SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.period = '" . $datenow . "'
            ) as trx_m0,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.period = '" . $date2 . "'
            ) as rev_m2,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a
                WHERE  a.period = '" . $date1 . "'
            ) as rev_m1,
            (
                SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a 
                WHERE a.period = '" . $datenow . "'
            ) as rev_m0
            FROM
            (SELECT region FROM cdpm_raw_cvm_performance GROUP BY 1) b
            GROUP BY 1,2 ORDER BY 1 DESC ) a
            
            ) cdpm_pivot_cvm
        ";
        $query = $this->db->query($SQL);
        return $query;
    }

    public function DropTableCircleGrafik()
    {
        $SQL = "DROP TABLE IF EXISTS cdpm_pivot_cvm_circle_grafik";
        $query = $this->db->query($SQL);
        return $query;
    }

    public function CreateTableCircleGrafik()
    {
        $SQL = "CREATE TABLE cdpm_pivot_cvm_circle_grafik as (SELECT 
		region,
		FORMAT((subs_m0/(SELECT subs_m0 FROM cdpm_pivot_cvm WHERE paket_group='Total' AND region='AREA 1')) * 100,2) as percent
		FROM cdpm_pivot_cvm WHERE paket_group ='Total' AND region IN ('SUMBAGUT', 'SUMBAGTENG', 'SUMBAGSEL'))";
        $query = $this->db->query($SQL);
        return $query;
    }

    public function DropTableCVMGrafik2()
    {
        $SQL = "DROP TABLE IF EXISTS cdpm_pivot_cvm_grafik2";
        $query = $this->db->query($SQL);
        return $query;
    }

    public function CreateTableCVMGrafik2()
    {
        $SQL = "CREATE TABLE cdpm_pivot_cvm_grafik2 as (SELECT 
		region,
		trx_m0,
		FORMAT((trx_m0/(SELECT trx_m0 FROM cdpm_pivot_cvm WHERE paket_group='Total' AND region='AREA 1')) * 100,2) as percent
		FROM cdpm_pivot_cvm WHERE paket_group ='Total' AND region IN ('SUMBAGUT', 'SUMBAGTENG', 'SUMBAGSEL'))";
        $query = $this->db->query($SQL);
        return $query;
    }

    public function ShowSVMPerformance($date)
    {
        $SQL = "SELECT 
                region, 
                paket_group, 
                FORMAT(subs_m2/1000,2) as subs_m2, 
                FORMAT(subs_m1/1000,2) as subs_m1, 
                FORMAT(subs_m0/1000,2) as subs_m0, 
                MoM_M2_Subs, 
                MoM_Subs,
                FORMAT(trx_m2/1000,2) as trx_m2, 
                FORMAT(trx_m1/1000,2) as trx_m1, 
                FORMAT(trx_m0/1000,2) as trx_m0, 
                MoM_M2_trx, 
                MoM_trx,  
                rev_m2 as rev_m2, 
                rev_m1 as rev_m1, 
                rev_m0 as rev_m0, 
                MoM_M2_rev, 
                MoM_rev
                FROM cdpm_raw_pivot_cvm a
                LEFT JOIN 
                rank_reg b
                on a.region = b.cat
                LEFT JOIN
                rank_sg c
                on a.paket_group= c.cat
                WHERE a.periode = '" . $date . "' 
                ORDER BY b.Rank asc, c.Rank asc";
        $query = $this->db->query($SQL)->result();
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

    public function ShowSVMPerformanceLadTable($date)
    {
        $SQL = "SELECT 
                region, 
                paket_group, 
                FORMAT(subs_m2/1000,2) as subs_m2, 
                FORMAT(subs_m1/1000,2) as subs_m1, 
                FORMAT(subs_m0/1000,2) as subs_m0, 
                MoM_M2_Subs, 
                MoM_Subs,
                FORMAT(trx_m2/1000,2) as trx_m2, 
                FORMAT(trx_m1/1000,2) as trx_m1, 
                FORMAT(trx_m0/1000,2) as trx_m0, 
                MoM_M2_trx, 
                MoM_trx,  
                rev_m2 as rev_m2, 
                rev_m1 as rev_m1, 
                rev_m0 as rev_m0, 
                MoM_M2_rev, 
                MoM_rev
                FROM cdpm_raw_pivot_cvm a
                LEFT JOIN 
                rank_reg b
                on a.region = b.cat
                LEFT JOIN
                rank_sg c
                on a.paket_group= c.cat
                WHERE a.periode = '" . $date . "' 
                ORDER BY b.Rank asc, c.Rank asc";
        $query = $this->db->query($SQL)->result_array();
        return $query;
    }


    public function ShowSVMPerformanceCluster($datenow)
    {
        $SQL = "SELECT * FROM cdpm_pivot_cvm_cluster WHERE period = '" . $datenow . "'";
        $query = $this->db->query($SQL)->result();
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



    public function ShowCVMPerformanceDetailAREA1($date2, $date1, $datenow, $cat_package)
    {
        $SQL = "SELECT
        c.region as region,
        c.package_subgroup as package_subgroup,
        (FORMAT(c.subs_m2/1000,2)) as subs_m2,
        (FORMAT(c.subs_m1/1000,2)) as subs_m1,
        (FORMAT(c.subs_m0/1000,2)) as subs_m0,
        CAST(((c.subs_m0/c.subs_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_Subs,
        CAST(((c.subs_m0/c.subs_m1)-1)*100 AS DECIMAL(10,2)) as MoM_Subs,
        (FORMAT(c.trx_m2/1000,2)) as trx_m2,
        (FORMAT(c.trx_m1/1000,2)) as trx_m1,
        (FORMAT(c.trx_m0/1000,2)) as trx_m0,
        CAST(((c.trx_m0/c.trx_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_trx,
        CAST(((c.trx_m0/c.trx_m1)-1)*100 AS DECIMAL(10,2)) as MoM_trx,
        FORMAT((c.rev_m2/1000000000),2) as rev_m2,
        FORMAT((c.rev_m1/1000000000),2) as rev_m1,
        FORMAT((c.rev_m0/1000000000),2) as rev_m0,
        CAST(((c.rev_m0/c.rev_m1)-1)*100 AS DECIMAL(10,2)) as MoM_M2_rev,
        CAST(((c.rev_m0/c.rev_m2)-1)*100 AS DECIMAL(10,2)) as MoM_rev
        FROM
        (
        SELECT
        'AREA 1' as region,
        b.package_subgroup,
        (
            SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a  
            WHERE a.package_subgroup = b.package_subgroup AND a.period = '" . $date2 . "'
        ) as subs_m2,
        (
            SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.package_subgroup = b.package_subgroup AND a.period = '" . $date1 . "'
        ) as subs_m1,
        (
            SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.package_subgroup = b.package_subgroup AND a.period = '" . $datenow . "'
        ) as subs_m0,
        (
            SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.package_subgroup = b.package_subgroup AND a.period = '" . $date2 . "'
        ) as trx_m2,
        (
            SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a
            WHERE a.package_subgroup = b.package_subgroup AND a.period = '" . $date1 . "'
        ) as trx_m1,
        (
            SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a  
            WHERE a.package_subgroup = b.package_subgroup AND a.period = '" . $datenow . "'
        ) as trx_m0,
        (
            SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.package_subgroup = b.package_subgroup AND a.period = '" . $date2 . "'
        ) as rev_m2,
        (
            SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.package_subgroup = b.package_subgroup AND a.period = '" . $date1 . "'
        ) as rev_m1,
        (
            SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.package_subgroup = b.package_subgroup AND a.period = '" . $datenow . "'
        ) as rev_m0
        FROM
        (SELECT package_subgroup as package_subgroup FROM cdpm_raw_cvm_performance WHERE (cat_pack_subgroup lIKE '%" . $cat_package . "%') GROUP BY 1
        ) b
        GROUP BY 1,2,3,4,5
        ) c
        GROUP BY 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17
        ";
        $query = $this->db->query($SQL)->result();
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

    public function ShowCVMPerformanceDetailRegion($date2, $date1, $datenow, $region, $cat_package)
    {
        $SQL = "SELECT
        c.region as region,
        c.package_subgroup as package_subgroup,
        (FORMAT(c.subs_m2/1000,2)) as subs_m2,
        (FORMAT(c.subs_m1/1000,2)) as subs_m1,
        (FORMAT(c.subs_m0/1000,2)) as subs_m0,
        CAST(((c.subs_m0/c.subs_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_Subs,
        CAST(((c.subs_m0/c.subs_m1)-1)*100 AS DECIMAL(10,2)) as MoM_Subs,
        (FORMAT(c.trx_m2/1000,2)) as trx_m2,
        (FORMAT(c.trx_m1/1000,2)) as trx_m1,
        (FORMAT(c.trx_m0/1000,2)) as trx_m0,
        CAST(((c.trx_m0/c.trx_m2)-1)*100 AS DECIMAL(10,2)) as MoM_M2_trx,
        CAST(((c.trx_m0/c.trx_m1)-1)*100 AS DECIMAL(10,2)) as MoM_trx,
        FORMAT((c.rev_m2/1000000000),2) as rev_m2,
        FORMAT((c.rev_m1/1000000000),2) as rev_m1,
        FORMAT((c.rev_m0/1000000000),2) as rev_m0,
        CAST(((c.rev_m0/c.rev_m1)-1)*100 AS DECIMAL(10,2)) as MoM_M2_rev,
        CAST(((c.rev_m0/c.rev_m2)-1)*100 AS DECIMAL(10,2)) as MoM_rev
        FROM
        (
        SELECT
        '" . $region . "' as region,
        b.package_subgroup,
        (
            SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a  
            WHERE a.region = '" . $region . "' AND a.package_subgroup = b.package_subgroup AND a.period = '" . $date2 . "'
        ) as subs_m2,
        (
            SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.region = '" . $region . "' AND a.package_subgroup = b.package_subgroup AND a.period = '" . $date1 . "'
        ) as subs_m1,
        (
            SELECT SUM(a.subs) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.region = '" . $region . "' AND a.package_subgroup = b.package_subgroup AND a.period = '" . $datenow . "'
        ) as subs_m0,
        (
            SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.region = '" . $region . "' AND a.package_subgroup = b.package_subgroup AND a.period = '" . $date2 . "'
        ) as trx_m2,
        (
            SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a
            WHERE a.region = '" . $region . "' AND a.package_subgroup = b.package_subgroup AND a.period = '" . $date1 . "'
        ) as trx_m1,
        (
            SELECT SUM(a.trx) as jlh FROM cdpm_raw_cvm_performance a  
            WHERE a.region = '" . $region . "' AND a.package_subgroup = b.package_subgroup AND a.period = '" . $datenow . "'
        ) as trx_m0,
        (
            SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.region = '" . $region . "' AND a.package_subgroup = b.package_subgroup AND a.period = '" . $date2 . "'
        ) as rev_m2,
        (
            SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.region = '" . $region . "' AND a.package_subgroup = b.package_subgroup AND a.period = '" . $date1 . "'
        ) as rev_m1,
        (
            SELECT SUM(a.revenue) as jlh FROM cdpm_raw_cvm_performance a 
            WHERE a.region = '" . $region . "' AND a.package_subgroup = b.package_subgroup AND a.period = '" . $datenow . "'
        ) as rev_m0
        FROM
        (SELECT package_subgroup as package_subgroup FROM cdpm_raw_cvm_performance WHERE (cat_pack_subgroup lIKE '%" . $cat_package . "%') GROUP BY 1
        ) b
        GROUP BY 1,2,3,4,5
        ) c
        GROUP BY 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17";
        $query = $this->db->query($SQL)->result();
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

    public function UpdateAllProductCVM($lastdate)
    {
        $SQL = "SELECT
                a.paket,
                FORMAT(SUM(a.subs0),2) as subs,
                FORMAT(SUM(a.trx0),2) as trx,
                FORMAT(SUM(a.rev_m0),2) as rev
                FROM cdpm_pivot_cvm_cluster a
                WHERE 
                a.period = '" . $lastdate . "'
                GROUP BY 1 ORDER BY 1 ASC";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function ShowPerformanceCVMClusterComboSakti($datenow)
    {
        $SQL = "SELECT * FROM cdpm_pivot_cvm_cluster WHERE period = '" . $datenow . "' AND paket='Combo Sakti'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function ShowPerformanceCVMClusterInternetSakti($datenow)
    {
        $SQL = "SELECT * FROM cdpm_pivot_cvm_cluster WHERE period = '" . $datenow . "' AND paket='Internet Sakti'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function ShowPerformanceCVMClusterOthers($datenow)
    {
        $SQL = "SELECT * FROM cdpm_pivot_cvm_cluster WHERE period = '" . $datenow . "' AND paket='Others'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function ShowPerformanceCVMClusterMultisim($datenow)
    {
        $SQL = "SELECT * FROM cdpm_pivot_cvm_cluster WHERE period = '" . $datenow . "' AND paket='Multisim'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function ShowPerformanceCVMClusterHotPromo($datenow)
    {
        $SQL = "SELECT * FROM cdpm_pivot_cvm_cluster WHERE period = '" . $datenow . "' AND paket='Hot Promo'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function ShowPerformanceCVMClusterInlife($datenow)
    {
        $SQL = "SELECT * FROM cdpm_pivot_cvm_cluster WHERE period = '" . $datenow . "' AND paket='Inlife'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function ShowPerformanceCVMClusterChurn($datenow)
    {
        $SQL = "SELECT * FROM cdpm_pivot_cvm_cluster WHERE period = '" . $datenow . "' AND paket='Churn'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function ShowPerformanceCVMCluster4G($datenow)
    {
        $SQL = "SELECT * FROM cdpm_pivot_cvm_cluster WHERE period = '" . $datenow . "' AND paket='4G'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }
}