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
    $json = '';
    
    for($page=1; $page<605; $page++) {
        $sql = "SELECT DISTINCT sura_fullname FROM quran_text WHERE page = $page";
        $rs = mysql_query($sql, $conn) or die(mysql_error());

        while($rsNextSura = mysql_fetch_assoc($rs)) {
            $sql = "SELECT CONCAT(sentence,aya_arabic) sentence FROM quran_text WHERE page = $page AND sura_fullname = '".str_replace("'","''",$rsNextSura['sura_fullname'])."'";
            $rs2 = mysql_query($sql, $conn) or die(mysql_error());
            $sentence = "";
            while($rsNextSentence = mysql_fetch_assoc($rs2)) {
                $sentence .= $rsNextSentence['sentence'];
            }
            echo $sentence."<br>";
            if($sentence!="") {
                $json .= '{"sura_fullname":"'.$rsNextSura['sura_fullname'].'", "sentence":"'.$sentence.'", "page":"'.$page.'", "score":0}, ';
            }
        }
    }
    
    $myfile = fopen('../sura_json/sura.json', 'w') or die("Unable to open file!");
    fwrite($myfile, str_replace(', ]',']',"[$json]"));
    fclose($myfile);
    
    $endtime = microtime(true);
	echo "Completed in " . ($endtime - $starttime) . " seconds";
?>