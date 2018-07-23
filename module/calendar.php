<?php

$year = (!empty($_GET['year']))? intval($_GET['year']): date('Y');

$arrPageData['year'] = $year;

$arrPageData['arYears'] = array();
$select = 'SELECT DISTINCT DATE_FORMAT(cd.`day`, "%Y") AS `year` FROM `'.CALENDAR_DATES_TABLE.'` cd ';
$where  = 'WHERE cd.`day` IS NOT NULL ';
$order  = 'ORDER BY cd.`day`';
$query  = $select.$where.$order;
$result = mysql_query($query);
if (mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_assoc($result)) {
        $arrPageData['arYears'][] = $row['year'];
    }
}

$arrPageData['calendar'] = array(
    $year => array()
);

for ($m = 1; $m <= 12; $m++) {
    $arrPageData['calendar'][$year][$m] = array();
    
    $select = 'SELECT DISTINCT DATE_FORMAT(cd.`day`, "%e") AS `md`, c.`link`, c.`title` FROM `'.CALENDAR_DATES_TABLE.'` cd ';
    $join   = 'LEFT JOIN `'.CALENDAR_TABLE.'` c ON(c.`id` = cd.`cid`) ';
    $where  = 'WHERE DATE_FORMAT(cd.`day`, "%c")="'.$m.'" AND DATE_FORMAT(cd.`day`, "%Y")="'.$year.'" AND cd.`cid`=c.`id` AND cd.`day` IS NOT NULL ';
    $order  = 'GROUP BY cd.`id` ORDER BY cd.`day`';
    $query  = $select.$join.$where.$order;
    $result = mysql_query($query);
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_assoc($result)) {
            $arrPageData['calendar'][$year][$m][$row['md']]['link'] = $row['link'];
            $arrPageData['calendar'][$year][$m][$row['md']]['title'] = $row['title'];
        }
    }
}

/*
$arrPageData['calendar'] = array(
    2013    => array(
        6   => array(
            22  => '/reportazh_o_1-om_ture_shkoli_22-29_iyunya_2013.html',
            23  => '/reportazh_o_1-om_ture_shkoli_22-29_iyunya_2013.html',
            24  => '/reportazh_o_1-om_ture_shkoli_22-29_iyunya_2013.html',
            25  => '/reportazh_o_1-om_ture_shkoli_22-29_iyunya_2013.html',
            26  => '/reportazh_o_1-om_ture_shkoli_22-29_iyunya_2013.html',
            27  => '/reportazh_o_1-om_ture_shkoli_22-29_iyunya_2013.html',
            28  => '/reportazh_o_1-om_ture_shkoli_22-29_iyunya_2013.html',
            29  => '/reportazh_o_1-om_ture_shkoli_22-29_iyunya_2013.html',
        ),
        7   => array(),
        8   => array(),
        10  => array(
            17  => '/reportazh_o_gastro-ture_shkoli_17-22_sentyabrya_2013.html',
            18  => '/reportazh_o_gastro-ture_shkoli_17-22_sentyabrya_2013.html',
            19  => '/reportazh_o_gastro-ture_shkoli_17-22_sentyabrya_2013.html',
            20  => '/reportazh_o_gastro-ture_shkoli_17-22_sentyabrya_2013.html',
            21  => '/reportazh_o_gastro-ture_shkoli_17-22_sentyabrya_2013.html',
            22  => '/reportazh_o_gastro-ture_shkoli_17-22_sentyabrya_2013.html',
        ),
        11  => array(),
        12  => array(
            20  => '/programma_i_dati_shkoli_v_2013_godu.html',
            21  => '/programma_i_dati_shkoli_v_2013_godu.html',
            22  => '/programma_i_dati_shkoli_v_2013_godu.html',
            23  => '/programma_i_dati_shkoli_v_2013_godu.html',
            24  => '/programma_i_dati_shkoli_v_2013_godu.html',
            25  => '/programma_i_dati_shkoli_v_2013_godu.html',
            26  => '/programma_i_dati_shkoli_v_2013_godu.html',
            27  => '/programma_i_dati_shkoli_v_2013_godu.html',
        )
    ),
    2014 => array(
        1   => array(
            22  => '/kulinarnaya_shkola_dnk.html',
            23  => '/kulinarnaya_shkola_dnk.html',
            24  => '/kulinarnaya_shkola_dnk.html',
            25  => '/kulinarnaya_shkola_dnk.html',
            26  => '/kulinarnaya_shkola_dnk.html',
            27  => '/kulinarnaya_shkola_dnk.html',
            28  => '/kulinarnaya_shkola_dnk.html',
            29  => '/kulinarnaya_shkola_dnk.html',
        ),
        2   => array(
            22  => '/kulinarnaya_shkola_dnk.html',
            23  => '/kulinarnaya_shkola_dnk.html',
            24  => '/kulinarnaya_shkola_dnk.html',
            25  => '/kulinarnaya_shkola_dnk.html',
            26  => '/kulinarnaya_shkola_dnk.html',
            27  => '/kulinarnaya_shkola_dnk.html',
            28  => '/kulinarnaya_shkola_dnk.html',
            29  => '/kulinarnaya_shkola_dnk.html',
        ),
        3   => array(
            9   => '/kulinarnaya_shkola_dnk.html',
            10  => '/kulinarnaya_shkola_dnk.html',
            11  => '/kulinarnaya_shkola_dnk.html',
            12  => '/kulinarnaya_shkola_dnk.html',
            13  => '/kulinarnaya_shkola_dnk.html',
            14  => '/kulinarnaya_shkola_dnk.html',
            15  => '/kulinarnaya_shkola_dnk.html',
            16  => '/kulinarnaya_shkola_dnk.html',
        ),
        4   => array(
            27  => '/kulinarnaya_shkola_dnk.html',
            28  => '/kulinarnaya_shkola_dnk.html',
            29  => '/kulinarnaya_shkola_dnk.html',
            30  => '/kulinarnaya_shkola_dnk.html',
        ),
        5   => array(
            1   => '/kulinarnaya_shkola_dnk.html',
            2   => '/kulinarnaya_shkola_dnk.html',
            3   => '/kulinarnaya_shkola_dnk.html',
            4   => '/kulinarnaya_shkola_dnk.html',
            9   => '/kulinarnaya_shkola_dnk.html',
            10  => '/kulinarnaya_shkola_dnk.html',
            11  => '/kulinarnaya_shkola_dnk.html',
            12  => '/kulinarnaya_shkola_dnk.html',
            13  => '/kulinarnaya_shkola_dnk.html',
            14  => '/kulinarnaya_shkola_dnk.html',
            15  => '/kulinarnaya_shkola_dnk.html',
            16  => '/kulinarnaya_shkola_dnk.html',
        ),
        6   => array(
            21  => '/kulinarnaya_shkola_dnk.html',
            22  => '/kulinarnaya_shkola_dnk.html',
            23  => '/kulinarnaya_shkola_dnk.html',
            24  => '/kulinarnaya_shkola_dnk.html',
            25  => '/kulinarnaya_shkola_dnk.html',
            26  => '/kulinarnaya_shkola_dnk.html',
            27  => '/kulinarnaya_shkola_dnk.html',
            28  => '/kulinarnaya_shkola_dnk.html',
        )
    )
);

*/