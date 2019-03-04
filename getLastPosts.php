<?php
///**
// * Created by PhpStorm.
// * User: Nastaran
// * Date: 8/2/18
// * Time: 7:57 PM
// */
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//$connection = new mysqli("127.0.0.1", "root", "a@bdermiwikiSAN135", "LastPostsDB");
////$connection = new mysqli("127.0.0.1", "root", "a@bdermiwikiSAN135", "wikiderm");
//// Check connection
//if ($connection->connect_error) {
//    die("Connection failed: " . $connection->connect_error);
//}
//$connection->query("SET NAMES utf8");
//$connection->query("SET CHARACTER SET utf8;");
//
//$query = "SELECT wp_posts.ID,wp_posts.post_title,wp_posts.post_content,wp_posts.post_date,wp_term_relationships.term_taxonomy_id  FROM  wp_posts INNER JOIN wp_term_relationships on wp_posts.ID=wp_term_relationships.object_id where (post_type='post' and post_status='publish' and post_parent=0 ) group by post_name order by wp_posts.post_date ;";
//$result = $connection->query($query);
//
//
//
//$connection2 = new mysqli("127.0.0.1", "root", "a@bdermiwikiSAN135", "wikiderm");
////$connection = new mysqli("127.0.0.1", "root", "a@bdermiwikiSAN135", "wikiderm");
//// Check connection
//if ($connection2->connect_error) {
//    die("Connection failed: " . $connection2->connect_error);
//}
//$connection2->query("SET NAMES utf8mb4");
//$connection2->query("SET CHARACTER SET utf8mb4;");
//// Change character set to utf8
//$a=5;
//while ($row=$result->fetch_assoc() ) {
//    $sub = $row['post_title'];
//    $data = $row['post_content'];
//    $DATE = $row['post_date'];
//    $writerID = '09124025451';
//    $cat = $row['term_taxonomy_id'];
//    $id = $row['ID'];
//
//    $query3 = "SELECT * FROM Paper where name='".$sub."' ;";
//
//    $result3 = $connection2->query($query3);
//    if($rr=$result3->fetch_assoc() )
//        $filename = $rr['XMLNAME'];
//    else
//        continue;
////    var_dump($result3);
////    var_dump($rr);
//
////    $BBB = (string)uniqid();
////    $englishtopic = 'paper'.$BBB;
////    $englishtopic=str_replace(" ","-",$englishtopic);
////    $filename = 'XMLs/PaperXMLs/' . $englishtopic . '.xml';
//
//
//    $data = $row['post_content'];
//    $data =  str_replace("https://wikiderm.ir/","/",$data);
////    $data = preg_replace("/\r\n|\r|\n/",'<br/>',$data);
//
//    $writer = new XMLWriter();
//    $writer->openMemory();
//    $writer->setIndent(true);
//    $writer->startDocument('1.0" encoding="UTF-8');
//    $writer->startElement('Paper');
//    $writer->writeElement('subject', $sub);
//    $writer->writeElement('data',$data);
//
//
////    $a--;
////    if($a<0)
////        break;
////    echo $sub;
////    echo $data;
////    echo $date;
////    echo $category;
//
//    $xxxx = $data;
//    $tmp = strip_tags($xxxx);
//    if (strlen($tmp)>0)
//        $mokh = substr($tmp,0,197) ;
//    else
//        $mokh = " ";
//
//
//
//
////    echo $data.'<br>';
//
//
////    echo $mokh.'<br>';
////    echo $data.'<br>';
//    list($date, $time) = explode(" ", $DATE);
//    list($year, $month, $day) = explode("-", $date);
//    list($jyear, $jmonth, $jday) = gregorian_to_jalali($year, $month, $day);
//    if (strlen($jmonth) == 1) {
//        $jmonth = "0" . $jmonth;
//    }
//    if (strlen($jday) == 1) {
//        $jday = "0" . $jday;
//    }
//    $date = $jyear . '/' . $jmonth . '/' . $jday.' '.$time;
//
////    echo $id.'<br>';
//
//    $query2 = "SELECT * FROM lastpostsdb.wp_posts where (post_parent=".$id." and post_type='attachment') order by ID Desc;";
//    $result2 = $connection->query($query2);
//
//    if ($row2=$result2->fetch_assoc()) {
//        $dt = $row2['post_date'];
//        $nm = $row2['guid'];
//        $nm2 = $row2['post_name'];
//        $strs = mb_split("-",$dt);
////        $target_file = 'wp-content/uploads/'.$strs[0].'/'.$strs[1].'/'.$nm.'.jpg';
//
//        $x = strpos($nm,"wp-content");
//        echo '1 '.$x.'<br>';
//        if($x!=false)
//            $target_file = substr($nm,$x);
//        else {
//            $target_file = 'wp-content/uploads/'.$strs[0].'/'.$strs[1].'/'.$nm2.'.jpg';
//        }
////        echo $nm.'<br>';
////        echo $target_file.'<br>';
//    }
//    else
//        $target_file = 'images/no-product-image-available.png';
//
//
//    switch ($cat) {
//        case 22:
//            $category = 4;
//        break;
//
//        case 23:
//            $category = 2;
//        break;
//
//        case 35:
//            $category = 3;
//        break;
//
//        case 36:
//            $category = 5;
//            break;
//
//        case 37:
//            $category = 6;
//            break;
//
//        case 38:
//            $category = 7;
//            break;
//
//        case 39:
//            $category = 1;
//            break;
//
//        case 40:
//            $category = 8;
//            break;
//
//        case 41:
//            $category = 9;
//            break;
//
//        case 42:
//            $category = 10;
//            break;
//
//        case 1:
//            $category = 11;
//            break;
//
//        default:
//            $category = 11;
//    }
//
//    $a = "\xD8";
//
//
////    $writer->writeElement('summary', $mokh);
//    $writer->endElement();
//    $writer->endDocument();
//    $file = $writer->outputMemory();
//    file_put_contents($filename, $file);
//
//
//
//    $stat = '1';
//
//
////    $stmt = $connection2->prepare("INSERT INTO Paper (XMLNAME,name,post_name,writerID, realtime , dastebandi,Mokhtasar,image,stat)  VALUES (?,?,?,?,?,?,?,?,?)");
////    $stmt->bind_param("sssssssss", $filename, $sub, $englishtopic, $writerID, $date, $category, $mokh, $target_file,$stat);
////    $result2 = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
////    $stmt->store_result();
////    $result2 = $stmt->get_result();
////    echo $connection2->error;
//
//}
//
//
//function gregorian_to_jalali($gy,$gm,$gd,$mod=''){
//    list($gy,$gm,$gd)=explode('_',tr_num($gy.'_'.$gm.'_'.$gd));/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
//    $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
//    if($gy > 1600){
//        $jy=979;
//        $gy-=1600;
//    }else{
//        $jy=0;
//        $gy-=621;
//    }
//    $gy2=($gm > 2)?($gy+1):$gy;
//    $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100)) +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
//    $jy+=33*((int)($days/12053));
//    $days%=12053;
//    $jy+=4*((int)($days/1461));
//    $days%=1461;
//    $jy+=(int)(($days-1)/365);
//    if($days > 365)$days=($days-1)%365;
//    if($days < 186){
//        $jm=1+(int)($days/31);
//        $jd=1+($days%31);
//    }else{
//        $jm=7+(int)(($days-186)/30);
//        $jd=1+(($days-186)%30);
//    }
//    return($mod==='')?array($jy,$jm,$jd):$jy .$mod .$jm .$mod .$jd;
//}
//
//function tr_num($str,$mod='en',$mf='٫'){
//    $num_a=array('0','1','2','3','4','5','6','7','8','9','.');
//    $key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf);
//    return($mod=='fa')?str_replace($num_a,$key_a,$str):str_replace($key_a,$num_a,$str);
//}