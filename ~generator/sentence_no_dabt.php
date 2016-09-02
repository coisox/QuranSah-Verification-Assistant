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

    $starttime = microtime(true);
    
    $sql = "SELECT sentence, id FROM sura_by_page";
    $rs = mysql_query($sql, $conn) or die(mysql_error());
    while($rsNext = mysql_fetch_assoc($rs)) {       
        $string = $rsNext['sentence'];
        $remove = array('ِ', 'ُ', 'ٓ', 'ٰ', 'ْ', 'ٌ', 'ٍ', 'ً', 'ّ', 'َ');
        $string = str_replace($remove, '', $string);
        
        $sql = "UPDATE sura_by_page SET sentence_no_dhabt = '$string' WHERE id = ".$rsNext['id'];
        mysql_query($sql, $conn) or die(mysql_error());
    }

    $endtime = microtime(true);
	echo "Completed in " . ($endtime - $starttime) . " seconds";
?>