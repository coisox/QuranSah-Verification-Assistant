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
    
    for($page=1; $page<605; $page++) {
        $sql = "SELECT DISTINCT sura_fullname, sura_arabic FROM quran_text WHERE page = $page";
        $rs = mysql_query($sql, $conn) or die(mysql_error());

        while($rsNextSura = mysql_fetch_assoc($rs)) {
            $sql = "
                INSERT INTO sura_by_page (
                    sura_fullname,
                    sura_arabic,
                    page
                ) VALUES (
                    '".mysql_real_escape_string($rsNextSura['sura_fullname'])."',
                    '".$rsNextSura['sura_arabic']."',
                    $page
                )
            ";
            mysql_query($sql, $conn) or die(mysql_error());
            
            $sql = "SELECT CONCAT(sentence,aya_arabic) sentence FROM quran_text WHERE page = $page AND sura_fullname = '".mysql_real_escape_string($rsNextSura['sura_fullname'])."'";
            $rs2 = mysql_query($sql, $conn) or die(mysql_error());
            $sentence = '';
            while($rsNextSentence = mysql_fetch_assoc($rs2)) {
                $sentence .= $rsNextSentence['sentence'];
            }
            $sql = "
                UPDATE sura_by_page SET sentence = '$sentence'
                WHERE
                    sura_fullname = '".mysql_real_escape_string($rsNextSura['sura_fullname'])."'
                    AND page = $page
            ";
            mysql_query($sql, $conn) or die(mysql_error());
        }
    }

    $endtime = microtime(true);
	echo "Completed in " . ($endtime - $starttime) . " seconds";
?>