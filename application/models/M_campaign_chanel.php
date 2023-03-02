<?php
class M_campaign_chanel extends CI_Model
{

    public function GetDataLastUpdateSubmittion()
    {
        $SQL = "SELECT 
        MAX(periode) as tanggal
        FROM cdpm_performance_taker_cluster";
        $query = $this->db->query($SQL)->row();
        return $query->tanggal;
    }

    public function GetTakerChannelWhatsApp($awal, $akhir)
    {
        $SQL = "SELECT
        a.region,
        a.branch,
        a.cluster,
        a.insak_wl,
        a.insak_taker,
        a.rev_insak,
        a.comsak_wl,
        a.comsak_taker,
        a.rev_comsak,
        a.hotpromo_wl,
        a.hotpromo_taker,
        a.rev_hotpromo,
		a.digital_wl,
		a.suprise_deal_wl,
		a.voice_wl
        FROM
        (
        SELECT
        a.region as region,
        a.branch as branch,
        a.cluster as cluster,
        (
            SELECT 
            b.subs 
            FROM cdpm_subs_region b 
            WHERE 
            b.periode = '" . $akhir . "' AND 
            b.product IN ('Internet-Sakti') AND 
            REPLACE(b.cluster,'-', ' ') = a.cluster AND 
            b.channel NOT IN ('All-Channel')
        ) as insak_wl,
        (
            SELECT 
            SUM(b.taker) as jlh 
            FROM cdpm_performance_taker_cluster b 
            WHERE 
            b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
            b.product IN ('Internet Sakti')
            AND REPLACE(b.cluster,'-', ' ') = a.cluster
        ) as insak_taker,
        (
            SELECT 
            SUM(b.revenue) as jlh 
            FROM cdpm_performance_taker_cluster b 
            WHERE 
            b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
            b.product IN ('Internet Sakti')
            AND REPLACE(b.cluster,'-', ' ') = a.cluster
        ) as rev_insak,
        (
            SELECT 
            b.subs 
            FROM cdpm_subs_region b 
            WHERE 
            b.periode = '" . $akhir . "' AND  
            b.product IN ('Comsak') AND 
            REPLACE(b.cluster,'-', ' ') = a.cluster AND 
            b.channel NOT IN ('All-Channel')
        ) as comsak_wl,
        (
            SELECT 
            SUM(b.taker) as jlh 
            FROM cdpm_performance_taker_cluster b 
            WHERE 
            b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND  
            b.product IN ('Comsak')
            AND REPLACE(b.cluster,'-', ' ') = a.cluster
        ) as comsak_taker,
        (
            SELECT 
            SUM(b.revenue) as jlh 
            FROM cdpm_performance_taker_cluster b 
            WHERE 
            b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
            b.product IN ('Comsak')
            AND REPLACE(b.cluster,'-', ' ') = a.cluster
        ) as rev_comsak,
        (
            SELECT 
            b.subs 
            FROM cdpm_subs_region b 
            WHERE 
            b.periode = '" . $akhir . "' AND  
            b.product IN ('Hot-Promo') AND 
            REPLACE(b.cluster,'-', ' ') = a.cluster AND 
            b.channel NOT IN ('All-Channel')
        ) as hotpromo_wl,
        (
            SELECT 
            SUM(b.taker) as jlh 
            FROM cdpm_performance_taker_cluster b 
            WHERE 
            b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
            b.product IN ('Hot Promo')
            AND REPLACE(b.cluster,'-', ' ') = a.cluster
        ) as hotpromo_taker,
        (
            SELECT 
            SUM(b.revenue) as jlh 
            FROM cdpm_performance_taker_cluster b 
            WHERE 
            b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
            b.product IN ('Hot Promo')
            AND REPLACE(b.cluster,'-', ' ') = a.cluster
        ) as rev_hotpromo,
        (
            SELECT 
            b.subs 
            FROM cdpm_subs_region b 
            WHERE 
            b.periode = '" . $akhir . "' AND  
            b.product IN ('Digital') AND 
            REPLACE(b.cluster,'-', ' ') = a.cluster AND 
            b.channel NOT IN ('All-Channel')
        ) as digital_wl,
        (
            SELECT 
            b.subs 
            FROM cdpm_subs_region b 
            WHERE 
            b.periode = '" . $akhir . "' AND  
            b.product IN ('Suprise-Deal') AND 
            REPLACE(b.cluster,'-', ' ') = a.cluster AND 
            b.channel NOT IN ('All-Channel')
        ) as suprise_deal_wl,
        (
            SELECT 
            b.subs 
            FROM cdpm_subs_region b 
            WHERE 
            b.periode = '" . $akhir . "' AND  
            b.product IN ('Voice') AND 
            REPLACE(b.cluster,'-', ' ') = a.cluster AND 
            b.channel NOT IN ('All-Channel')
        ) as voice_wl
        FROM
        (
        SELECT
        region,
        branch,
        cluster
        FROM tof_territory a
        ) a
    ) a";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function GetTakerChannelWhatsAppRegion($awal, $akhir)
    {
        $SQL = "SELECT
        b.region as region,
        '' as branch,
        '' as cluster,
        SUM(b.insak_wl) as insak_wl,
        SUM(b.insak_taker) as insak_taker,
        SUM(b.rev_insak) as rev_insak,
        SUM(b.comsak_wl) as comsak_wl,
        SUM(b.comsak_taker) as comsak_taker,
        SUM(b.rev_comsak) as rev_comsak,
        SUM(b.hotpromo_wl) as hotpromo_wl,
        SUM(b.hotpromo_taker) as hotpromo_taker,
        SUM(b.rev_hotpromo) as rev_hotpromo,
        SUM(b.digital_wl) as digital_wl,
        SUM(b.suprise_deal_wl) as suprise_deal_wl,
        SUM(b.voice_wl) as voice_wl
        FROM
        (
        
        SELECT
        a.region as region,
        a.branch as branch,
        a.cluster as cluster,
        a.insak_wl as insak_wl,
        a.insak_taker as insak_taker,
        a.rev_insak as rev_insak,
        a.comsak_wl as comsak_wl,
        a.comsak_taker as comsak_taker,
        a.rev_comsak as rev_comsak,
        a.hotpromo_wl as hotpromo_wl,
        a.hotpromo_taker as hotpromo_taker,
        a.rev_hotpromo as rev_hotpromo,
        a.digital_wl as digital_wl,
        a.suprise_deal_wl as suprise_deal_wl,
        a.voice_wl as voice_wl
        FROM
        (
                SELECT
                a.region as region,
                a.branch as branch,
                a.cluster as cluster,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND 
                    b.product IN ('Internet-Sakti') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as insak_wl,
                (
                    SELECT 
                    SUM(b.taker) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
                    b.product IN ('Internet Sakti')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as insak_taker,
                (
                    SELECT 
                    SUM(b.revenue) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
                    b.product IN ('Internet Sakti')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as rev_insak,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND 
                    b.product IN ('Comsak') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as comsak_wl,
                (
                    SELECT 
                    SUM(b.taker) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
                    b.product IN ('Comsak')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as comsak_taker,
                (
                    SELECT 
                    SUM(b.revenue) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
                    b.product IN ('Comsak')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as rev_comsak,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND 
                    b.product IN ('Hot-Promo') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as hotpromo_wl,
                (
                    SELECT 
                    SUM(b.taker) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
                    b.product IN ('Hot Promo')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as hotpromo_taker,
                (
                    SELECT 
                    SUM(b.revenue) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND  
                    b.product IN ('Hot Promo')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as rev_hotpromo,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND 
                    b.product IN ('Digital') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as digital_wl,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND
                    b.product IN ('Suprise-Deal') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as suprise_deal_wl,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND 
                    b.product IN ('Voice') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as voice_wl
                FROM
                (
                SELECT
                region,
                branch,
                cluster
                FROM tof_territory a
                ) a
             ) a
        ) b GROUP BY 1 ORDER BY 1 DESC";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function GetTakerChannelWhatsAppArea($awal, $akhir)
    {
        $SQL = "SELECT
        'AREA 1' as region,
        '' as branch,
        '' as cluster,
        SUM(b.insak_wl) as insak_wl,
        SUM(b.insak_taker) as insak_taker,
        SUM(b.rev_insak) as rev_insak,
        SUM(b.comsak_wl) as comsak_wl,
        SUM(b.comsak_taker) as comsak_taker,
        SUM(b.rev_comsak) as rev_comsak,
        SUM(b.hotpromo_wl) as hotpromo_wl,
        SUM(b.hotpromo_taker) as hotpromo_taker,
        SUM(b.rev_hotpromo) as rev_hotpromo,
        SUM(b.digital_wl) as digital_wl,
        SUM(b.suprise_deal_wl) as suprise_deal_wl,
        SUM(b.voice_wl) as voice_wl
        FROM
        (
        
        SELECT
        a.region as region,
        a.branch as branch,
        a.cluster as cluster,
        a.insak_wl as insak_wl,
        a.insak_taker as insak_taker,
        a.rev_insak as rev_insak,
        a.comsak_wl as comsak_wl,
        a.comsak_taker as comsak_taker,
        a.rev_comsak as rev_comsak,
        a.hotpromo_wl as hotpromo_wl,
        a.hotpromo_taker as hotpromo_taker,
        a.rev_hotpromo as rev_hotpromo,
        a.digital_wl as digital_wl,
        a.suprise_deal_wl as suprise_deal_wl,
        a.voice_wl as voice_wl
        FROM
        (
                SELECT
                a.region as region,
                a.branch as branch,
                a.cluster as cluster,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND 
                    b.product IN ('Internet-Sakti') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as insak_wl,
                (
                    SELECT 
                    SUM(b.taker) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
                    b.product IN ('Internet Sakti')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as insak_taker,
                (
                    SELECT 
                    SUM(b.revenue) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
                    b.product IN ('Internet Sakti')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as rev_insak,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND 
                    b.product IN ('Comsak') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as comsak_wl,
                (
                    SELECT 
                    SUM(b.taker) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
                    b.product IN ('Comsak')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as comsak_taker,
                (
                    SELECT 
                    SUM(b.revenue) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
                    b.product IN ('Comsak')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as rev_comsak,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND 
                    b.product IN ('Hot-Promo') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as hotpromo_wl,
                (
                    SELECT 
                    SUM(b.taker) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND 
                    b.product IN ('Hot Promo')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as hotpromo_taker,
                (
                    SELECT 
                    SUM(b.revenue) as jlh 
                    FROM cdpm_performance_taker_cluster b 
                    WHERE 
                    b.periode BETWEEN '" . $awal . "' AND '" . $akhir . "' AND  
                    b.product IN ('Hot Promo')
                    AND REPLACE(b.cluster,'-', ' ') = a.cluster
                ) as rev_hotpromo,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND 
                    b.product IN ('Digital') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as digital_wl,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND
                    b.product IN ('Suprise-Deal') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as suprise_deal_wl,
                (
                    SELECT 
                    b.subs 
                    FROM cdpm_subs_region b 
                    WHERE 
                    b.periode = '" . $akhir . "' AND 
                    b.product IN ('Voice') AND 
                    REPLACE(b.cluster,'-', ' ') = a.cluster AND 
                    b.channel NOT IN ('All-Channel')
                ) as voice_wl
                FROM
                (
                SELECT
                region,
                branch,
                cluster
                FROM tof_territory a
                ) a
             ) a
        ) b";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function GetLastDateTakerChannellAll()
    {
        $SQL = "SELECT MAX(periode) as periode FROM cdpm_subs_region";
        $query = $this->db->query($SQL)->row();
        return $query->periode;
    }

    public function GetTakerChannelAll($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $mont_update, $year_update, $date_update, $max_date)
    {
        $SQL = "SELECT
        a.region,
        a.branch,
        a.cluster,
        a.target,
        a.subs_m1,
        a.subs_m0,
        FORMAT(((a.subs_m0 / a.target) * 100),2) as acv,
        FORMAT(((((a.subs_m0 / " . $date_update . ") * " . $max_date . ") / a.target)*100),2) as drr,
        FORMAT((((a.subs_m0 / a.subs_m1)-1)*100),2) as MoM,
        a.taker_subs_m1,
        a.taker_subs_m0,
        FORMAT(((a.taker_subs_m0 / a.subs_m0)*100),2) as Tur_m0,
        FORMAT(((a.taker_subs_m1 / a.subs_m1)*100),2) as Tur_m1,
        a.rev_subs_m0,
        a.rev_subs_m1,
        ROUND((a.subs_m0 / " . $date_update . "),0) as daily
        FROM
       ( 
               SELECT
               a.region as region,
               a.branch as branch,
               a.cluster as cluster,
               (
                  SELECT 
                   b.subs 
                   FROM cdpm_subs_region b 
                   WHERE 
                   b.periode = '" . $akhir_m1 . "' AND  
                   b.product IN ('All') AND 
                   REPLACE(b.cluster,'-', ' ') = a.cluster
                   LIMIT 1
               ) as subs_m1,
              (
                  SELECT 
                   b.subs 
                   FROM cdpm_subs_region b 
                   WHERE 
                   b.periode = '" . $akhir_m0 . "' AND  
                   b.product IN ('All') AND 
                   REPLACE(b.cluster,'-', ' ') = a.cluster
                   LIMIT 1
               ) as subs_m0,
                (
                  SELECT 
                   b.value 
                   FROM cdpm_target_cluster_channel_wa b 
                   WHERE 
                   REPLACE(b.cluster,'-', ' ') = a.cluster
               ) as target,
               (
                   SELECT 
                   SUM(b.taker) as jlh 
                   FROM cdpm_performance_taker_cluster_all b 
                   WHERE 
                   b.periode BETWEEN '" . $awal_m1 . "' AND '" . $akhir_m1 . "' AND 
                   b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                   AND REPLACE(b.cluster,'-', ' ') = a.cluster
               ) as taker_subs_m1,
               (
                   SELECT 
                   SUM(b.revenue) as jlh 
                   FROM cdpm_performance_taker_cluster_all b 
                   WHERE 
                   b.periode BETWEEN '" . $awal_m1 . "' AND '" . $akhir_m1 . "' AND 
                   b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                   AND REPLACE(b.cluster,'-', ' ') = a.cluster
               ) as rev_subs_m1,
                       (
                               SELECT 
                   SUM(b.taker) as jlh 
                   FROM cdpm_performance_taker_cluster_all b 
                   WHERE 
                   b.periode BETWEEN '" . $awal_m0 . "' AND '" . $akhir_m0 . "' AND 
                   b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                   AND REPLACE(b.cluster,'-', ' ') = a.cluster
               ) as taker_subs_m0,
                (
                   SELECT 
                   SUM(b.revenue) as jlh 
                   FROM cdpm_performance_taker_cluster_all b 
                   WHERE 
                   b.periode BETWEEN '" . $awal_m0 . "' AND '" . $akhir_m0 . "' AND 
                   b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                   AND REPLACE(b.cluster,'-', ' ') = a.cluster
               ) as rev_subs_m0
               FROM
               (
               SELECT
               region,
               branch,
               cluster
               FROM tof_territory a
               ) a
       ) a";

        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function GetTakerChannelAllRegion($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $mont_update, $year_update, $date_update, $max_date)
    {
        $SQL = "SELECT
        c.region,
        '' as branch,
        '' as cluster,
        SUM(c.subs_m0) as subs_m0,
        SUM(c.subs_m1) as subs_m1,
        SUM(c.target) as target,
        FORMAT(((SUM(c.subs_m0) / SUM(c.target)) * 100),2) as acv,
        FORMAT(((((SUM(c.subs_m0) / 8) * 28) / SUM(c.target))*100),2) as drr,
        FORMAT((((SUM(c.subs_m0) / SUM(c.subs_m1))-1)*100),2) as MoM,
        SUM(c.taker_subs_m0) as taker_subs_m0,
        SUM(c.taker_subs_m1) as taker_subs_m1,
        FORMAT(((SUM(c.taker_subs_m0) / SUM(c.subs_m0))*100),2) as Tur_m0,
        FORMAT(((SUM(c.taker_subs_m1) / SUM(c.subs_m1))*100),2) as Tur_m1,
        SUM(c.rev_subs_m0) as rev_subs_m0,
        SUM(c.rev_subs_m1) as rev_subs_m1,
        ROUND((SUM(c.subs_m0)/8),0) as daily
        FROM
        (
        SELECT
               a.region as region,
               a.branch as branch,
               a.cluster as cluster,
                       a.subs_m0 as subs_m0,
               a.subs_m1 as subs_m1,
                       a.target as target,
               FORMAT(((a.subs_m0 / a.target) * 100),2) as acv,
               FORMAT(((((a.subs_m0 / " . $date_update . ") * " . $max_date . ") / a.target)*100),2) as drr,
               FORMAT((((a.subs_m0 / a.subs_m1)-1)*100),2) as MoM,
               a.taker_subs_m1,
               a.taker_subs_m0,
               FORMAT(((a.taker_subs_m0 / a.subs_m0)*100),2) as Tur_m0,
               FORMAT(((a.taker_subs_m1 / a.subs_m1)*100),2) as Tur_m1,
               a.rev_subs_m0,
               a.rev_subs_m1,
               ROUND((a.subs_m0/" . $date_update . "),0) as daily
               FROM
              ( 
                      SELECT
                      a.region as region,
                      a.branch as branch,
                      a.cluster as cluster,
                      (
                         SELECT 
                          b.subs 
                          FROM cdpm_subs_region b 
                          WHERE 
                          b.periode = '" . $akhir_m1 . "' AND  
                          b.product IN ('All') AND 
                          REPLACE(b.cluster,'-', ' ') = a.cluster
                          LIMIT 1
                      ) as subs_m1,
                     (
                         SELECT 
                          b.subs 
                          FROM cdpm_subs_region b 
                          WHERE 
                          b.periode = '" . $akhir_m0 . "' AND  
                          b.product IN ('All') AND 
                          REPLACE(b.cluster,'-', ' ') = a.cluster
                          LIMIT 1
                      ) as subs_m0,
                       (
                         SELECT 
                          b.value 
                          FROM cdpm_target_cluster_channel_wa b 
                          WHERE 
                          REPLACE(b.cluster,'-', ' ') = a.cluster
                      ) as target,
                      (
                          SELECT 
                          SUM(b.taker) as jlh 
                          FROM cdpm_performance_taker_cluster_all b 
                          WHERE 
                          b.periode BETWEEN '" . $awal_m1 . "' AND '" . $akhir_m1 . "' AND 
                          b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                          AND REPLACE(b.cluster,'-', ' ') = a.cluster
                      ) as taker_subs_m1,
                      (
                          SELECT 
                          SUM(b.revenue) as jlh 
                          FROM cdpm_performance_taker_cluster_all b 
                          WHERE 
                          b.periode BETWEEN '" . $awal_m1 . "' AND '" . $akhir_m1 . "' AND 
                          b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                          AND REPLACE(b.cluster,'-', ' ') = a.cluster
                      ) as rev_subs_m1,
                              (
                                      SELECT 
                          SUM(b.taker) as jlh 
                          FROM cdpm_performance_taker_cluster_all b 
                          WHERE 
                          b.periode BETWEEN '" . $awal_m0 . "' AND '" . $akhir_m0 . "' AND 
                          b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                          AND REPLACE(b.cluster,'-', ' ') = a.cluster
                      ) as taker_subs_m0,
                       (
                          SELECT 
                          SUM(b.revenue) as jlh 
                          FROM cdpm_performance_taker_cluster_all b 
                          WHERE 
                          b.periode BETWEEN '" . $awal_m0 . "' AND '" . $akhir_m0 . "' AND 
                          b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                          AND REPLACE(b.cluster,'-', ' ') = a.cluster
                      ) as rev_subs_m0
                      FROM
                      (
                      SELECT
                      region,
                      branch,
                      cluster
                      FROM tof_territory a
                      ) a
       ) a
       ) c GROUP BY 1 ORDER BY 1 DESC";

        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function GetTakerChannelAllArea($awal_m1, $akhir_m1, $awal_m0, $akhir_m0, $mont_update, $year_update, $date_update, $max_date)
    {
        $SQL = "SELECT
        'AREA 1' as region,
        '' as branch,
        '' as cluster,
        SUM(c.subs_m0) as subs_m0,
        SUM(c.subs_m1) as subs_m1,
        SUM(c.target) as target,
        FORMAT(((SUM(c.subs_m0) / SUM(c.target)) * 100),2) as acv,
        FORMAT(((((SUM(c.subs_m0) / 8) * 28) / SUM(c.target))*100),2) as drr,
        FORMAT((((SUM(c.subs_m0) / SUM(c.subs_m1))-1)*100),2) as MoM,
        SUM(c.taker_subs_m0) as taker_subs_m0,
        SUM(c.taker_subs_m1) as taker_subs_m1,
        FORMAT(((SUM(c.taker_subs_m0) / SUM(c.subs_m0))*100),2) as Tur_m0,
        FORMAT(((SUM(c.taker_subs_m1) / SUM(c.subs_m1))*100),2) as Tur_m1,
        SUM(c.rev_subs_m0) as rev_subs_m0,
        SUM(c.rev_subs_m1) as rev_subs_m1,
        ROUND((SUM(c.subs_m0)/8),0) as daily
        FROM
        (
        SELECT
               a.region as region,
               a.branch as branch,
               a.cluster as cluster,
                       a.subs_m0 as subs_m0,
               a.subs_m1 as subs_m1,
                       a.target as target,
               FORMAT(((a.subs_m0 / a.target) * 100),2) as acv,
               FORMAT(((((a.subs_m0 / " . $date_update . ") * " . $max_date . ") / a.target)*100),2) as drr,
               FORMAT((((a.subs_m0 / a.subs_m1)-1)*100),2) as MoM,
               a.taker_subs_m1,
               a.taker_subs_m0,
               FORMAT(((a.taker_subs_m0 / a.subs_m0)*100),2) as Tur_m0,
               FORMAT(((a.taker_subs_m1 / a.subs_m1)*100),2) as Tur_m1,
               a.rev_subs_m0,
               a.rev_subs_m1,
               ROUND((a.subs_m0/" . $date_update . "),0) as daily
               FROM
              ( 
                      SELECT
                      a.region as region,
                      a.branch as branch,
                      a.cluster as cluster,
                      (
                         SELECT 
                          b.subs 
                          FROM cdpm_subs_region b 
                          WHERE 
                          b.periode = '" . $akhir_m1 . "' AND  
                          b.product IN ('All') AND 
                          REPLACE(b.cluster,'-', ' ') = a.cluster
                          LIMIT 1
                      ) as subs_m1,
                     (
                         SELECT 
                          b.subs 
                          FROM cdpm_subs_region b 
                          WHERE 
                          b.periode = '" . $akhir_m0 . "' AND  
                          b.product IN ('All') AND 
                          REPLACE(b.cluster,'-', ' ') = a.cluster
                          LIMIT 1
                      ) as subs_m0,
                       (
                         SELECT 
                          b.value 
                          FROM cdpm_target_cluster_channel_wa b 
                          WHERE 
                          REPLACE(b.cluster,'-', ' ') = a.cluster
                      ) as target,
                      (
                          SELECT 
                          SUM(b.taker) as jlh 
                          FROM cdpm_performance_taker_cluster_all b 
                          WHERE 
                          b.periode BETWEEN '" . $awal_m1 . "' AND '" . $akhir_m1 . "' AND 
                          b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                          AND REPLACE(b.cluster,'-', ' ') = a.cluster
                      ) as taker_subs_m1,
                      (
                          SELECT 
                          SUM(b.revenue) as jlh 
                          FROM cdpm_performance_taker_cluster_all b 
                          WHERE 
                          b.periode BETWEEN '" . $awal_m1 . "' AND '" . $akhir_m1 . "' AND 
                          b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                          AND REPLACE(b.cluster,'-', ' ') = a.cluster
                      ) as rev_subs_m1,
                              (
                                      SELECT 
                          SUM(b.taker) as jlh 
                          FROM cdpm_performance_taker_cluster_all b 
                          WHERE 
                          b.periode BETWEEN '" . $awal_m0 . "' AND '" . $akhir_m0 . "' AND 
                          b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                          AND REPLACE(b.cluster,'-', ' ') = a.cluster
                      ) as taker_subs_m0,
                       (
                          SELECT 
                          SUM(b.revenue) as jlh 
                          FROM cdpm_performance_taker_cluster_all b 
                          WHERE 
                          b.periode BETWEEN '" . $awal_m0 . "' AND '" . $akhir_m0 . "' AND 
                          b.product IN ('Comsak', 'Internet Sakti', 'Hot Promo')
                          AND REPLACE(b.cluster,'-', ' ') = a.cluster
                      ) as rev_subs_m0
                      FROM
                      (
                      SELECT
                      region,
                      branch,
                      cluster
                      FROM tof_territory a
                      ) a
       ) a
       ) c GROUP BY 1";
        $query = $this->db->query($SQL)->result();
        return $query;
    }
}
