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
        $sql = "SELECT DISTINCT sura FROM quran_text WHERE page = $page";
        $rs = mysql_query($sql, $conn) or die(mysql_error());

        while($rsNextSura = mysql_fetch_assoc($rs)) {
            $sql = "SELECT MIN(aya) ayamin, MAX(aya) ayamax FROM quran_text WHERE page = $page AND sura = ".$rsNextSura['sura'];
            $rs2 = mysql_query($sql, $conn) or die(mysql_error());
            $rsNext2 = mysql_fetch_assoc($rs2);

            $sql = "
                UPDATE quran_text SET
                    sura_fullname = CONCAT('Sura ', sura_name, ', Aya ', '".$rsNext2['ayamin']."-".$rsNext2['ayamax']."')
                WHERE page = $page AND sura = ".$rsNextSura['sura']."
            ";

            $rs3 = mysql_query($sql, $conn) or die(mysql_error());
        }
    }
    
    $endtime = microtime(true);
	echo "Completed in " . ($endtime - $starttime) . " seconds";
?>