<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 8/2/18
 * Time: 7:57 PM
 */

$connection = new mysqli("127.0.0.1", "root", "12345", "wikiderm");
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$connection->query("SET NAMES utf8");
$connection->query("SET CHARACTER SET utf8;");

//$connection->query("INSERT INTO azmun(title, type, ostan, state, dateAzmun, dateKart, dateNatayej,englishName) VALUES ('دریافت کارت ورود به جلسه آزمون فولاد سیرجان ایرانیان', '1','تهران' , '1' , '1397/05/02' , '1397/05/02' , '1397/05/02' , 'fuladSirjan');");
//echo $connection->error;