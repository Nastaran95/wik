<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 2/1/19
 * Time: 5:07 AM
 */
$query = "SELECT * FROM advertisement WHERE (active>0 and stat>0) ORDER by ID DESC ;";
$result = $connection->query($query);
$x = 0;
while ($row=$result->fetch_assoc()) {
    $id = $row['ID'];
    $name = $row['name'];
    $image = $row['image'];
    $status = $row['stat'];
    $end = $row['endTime'];

    date_default_timezone_set("Iran");
    $DATE = date('Y-m-d H:i:s');
    list($date, $time) = explode(" ", $DATE);
    list($year, $month, $day) = explode("-", $date);
    list($jyear, $jmonth, $jday) = gregorian_to_jalali2($year, $month, $day);
    if (strlen($jmonth) == 1) {
        $jmonth = "0" . $jmonth;
    }
    if (strlen($jday) == 1) {
        $jday = "0" . $jday;
    }
    $today = $jyear . '/' . $jmonth . '/' . $jday . ' ' . $time;

//    if($id==13){
//        echo $today."<br>";
//        echo $end."<br>";
//        die();
//    }

    if($end>$today) {
        ?>

        <div class="col-md-12 add">
            <a href="/addPage/<?php echo $id; ?>" title="<?php echo $name; ?>">
                <img src="/<?php echo $image; ?>" width="100%"  alt="<?php echo $name; ?>">
            </a>
        </div>
        <?php
    }
    else{
        $stmt = $connection->prepare("UPDATE advertisement set active=0 WHERE (ID=?)");
        $stmt->bind_param("s", $id);
        $result = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
        $stmt->store_result();
        $result = $stmt->get_result();
    }

}


function gregorian_to_jalali2($gy,$gm,$gd,$mod=''){
    list($gy,$gm,$gd)=explode('_',tr_num2($gy.'_'.$gm.'_'.$gd));/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
    $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
    if($gy > 1600){
        $jy=979;
        $gy-=1600;
    }else{
        $jy=0;
        $gy-=621;
    }
    $gy2=($gm > 2)?($gy+1):$gy;
    $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100)) +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
    $jy+=33*((int)($days/12053));
    $days%=12053;
    $jy+=4*((int)($days/1461));
    $days%=1461;
    $jy+=(int)(($days-1)/365);
    if($days > 365)$days=($days-1)%365;
    if($days < 186){
        $jm=1+(int)($days/31);
        $jd=1+($days%31);
    }else{
        $jm=7+(int)(($days-186)/30);
        $jd=1+(($days-186)%30);
    }
    return($mod==='')?array($jy,$jm,$jd):$jy .$mod .$jm .$mod .$jd;
}


function tr_num2($str,$mod='en',$mf='٫'){
    $num_a=array('0','1','2','3','4','5','6','7','8','9','.');
    $key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf);
    return($mod=='fa')?str_replace($num_a,$key_a,$str):str_replace($key_a,$num_a,$str);
}