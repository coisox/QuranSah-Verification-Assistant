<?php
	error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    $hostname_conn = "localhost";
    $database_conn = "quran_uthmani";
    $username_conn = "root";
    $password_conn = "";
    $conn = mysql_connect($hostname_conn, $username_conn, $password_conn) or die("");
    mysql_select_db($database_conn, $conn);
    mysql_query("SET time_zone = 'Asia/Kuala_Lumpur'");
    mysql_query("SET NAMES utf8");

    $json = array();
    $sql = "
        SELECT * FROM sura_by_page
        WHERE MATCH(sentence_no_dhabt) AGAINST('".$_POST['keyword']."')
        ORDER BY MATCH(sentence_no_dhabt) AGAINST('".$_POST['keyword']."') DESC
        LIMIT ".$_POST['more'].", 10
    ";
    $rs = mysql_query($sql, $conn) or die(mysql_error());

    while($rsNextMatch = mysql_fetch_assoc($rs)) {
        array_push($json, array('id'=>$rsNextMatch['id'], 'sura_fullname'=>$rsNextMatch['sura_fullname'], 'sura_arabic'=>$rsNextMatch['sura_arabic'], 'sentence'=>$rsNextMatch['sentence'], 'page'=>$rsNextMatch['page']));
    }
    
    echo json_encode($json);
?>