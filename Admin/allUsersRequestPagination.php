<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 8/11/2018
 * Time: 2:37 AM
 */


include '../Settings.php';


//continue only if $_POST is set and it is a Ajax request
if(isset($_GET) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    //Get page number from Ajax POST
    $page_number=0;
    $item_per_page = $_GET["limit"];
    $type = $_GET["type"];
    $query = $_GET["query"];
    if (isset($_GET["category"])){
        $dastebandi=$_GET["category"];
    }else{
        $dastebandi="all";
    }
    if(isset($_GET["page"])){
        $page_number = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }
    //get total number of records from database for pagination
    if ($query==="=====+++=====") {
        if ($dastebandi=='all'){
            if ($type == 1)
                $results = $connection->query("SELECT COUNT(*) FROM user_request");
        }else{
//            if ($type == 1)
//                $results = $connection->query("SELECT COUNT(*) FROM user_request WHERE dastebandi='$dastebandi'");
        }
    }else {
        $D=0;
        $command="WHERE";
        $command2="WHERE";
        $X=mbsplit(" ",$query);
        for ($II=0;$II<count($X);$II=$II+1){
            if (strlen($X[$II])>0){
                if ($D===0){
                    $command=$command." company LIKE '%".$X[$II]."%' OR subject LIKE '%".$X[$II]."%'";
                    $command2=$command2." company LIKE '%".$X[$II]."%'";
                }else {
                    $command=$command."OR company LIKE '%".$X[$II]."%' OR subject LIKE '%".$X[$II]."%'";
                    $command2=$command2."OR company LIKE '%".$X[$II]."%'";
                }
                $D=$D+1;
            }
        }
        if ($D===0){
            if ($dastebandi=='all') {
                if ($type == 1)
                    $results = $connection->query("SELECT COUNT(*) FROM user_request");
            }else{
//                if ($type == 1)
//                    $results = $connection->query("SELECT COUNT(*) FROM user_request WHERE dastebandi='$dastebandi'");
            }
        }else {
            if ($dastebandi=='all') {
                if ($type == 1)
                    $results = $connection->query("SELECT COUNT(*) FROM user_request " . $command);
            }else{
//                if ($type == 1)
//                    $results = $connection->query("SELECT COUNT(*) FROM user_request " . $command." and dastebandi='$dastebandi'");
            }
        }
    }

    $get_total_rows = $results->fetch_row(); //hold total records in variable
    //break records into pages
    $total_pages = ceil($get_total_rows[0]/$item_per_page);

    //get starting position to fetch the records
    $page_position = (($page_number-1) * $item_per_page);
    $D=0;
    if ($query==="=====+++====="){
        $D=1;
        if ($dastebandi=='all') {
            if ($type == 1)
                $results = $connection->query("SELECT * FROM user_request ORDER BY ID DESC  LIMIT $page_position, $item_per_page ");
        }else{
//            if ($type == 1)
//                $results = $connection->query("SELECT * FROM user_request WHERE dastebandi='$dastebandi' ORDER BY ID DESC  LIMIT $page_position, $item_per_page ");
        }
    }else {
        $command="WHERE";
        $command2="WHERE";
        $X=mbsplit(" ",$query);
        for ($II=0;$II<count($X);$II=$II+1){
            if (strlen($X[$II])>0){
                if ($D===0){
                    $command=$command." company LIKE '%".$X[$II]."%' OR subject LIKE '%".$X[$II]."%'";
                    $command2=$command2." company LIKE '%".$X[$II]."%'";
                }else {
                    $command=$command."OR company LIKE '%".$X[$II]."%' OR subject LIKE '%".$X[$II]."%'";
                    $command2=$command2."OR company LIKE '%".$X[$II]."%'";
                }
                $D=$D+1;
            }
        }
        if ($D===0){
            if ($dastebandi=='all') {
                if ($type == 1)
                    $results = $connection->query("SELECT * FROM user_request ORDER BY ID DESC  LIMIT $page_position, $item_per_page ");
            }else {
//                if ($type == 1)
//                    $results = $connection->query("SELECT * FROM user_request  WHERE dastebandi='$dastebandi' ORDER BY ID DESC  LIMIT $page_position, $item_per_page ");
            }
        }else {
            if ($dastebandi=='all') {
                if ($type == 1)
                    $results = $connection->query("SELECT * FROM user_request " . $command . " ORDER BY ID DESC LIMIT $page_position, $item_per_page ");
            }else{
//                if ($type == 1)
//                    $results = $connection->query("SELECT * FROM user_request " . $command ."and dastebandi='$dastebandi'". " ORDER BY ID DESC LIMIT $page_position, $item_per_page ");
            }
        }
    }

    //Display records fetched from database.
    if ($type==1)
        echo '<table class="table user-list">
                                <thead>
                                <tr>
                                    <th><span>نام کاربر</span></th>
                                    <th><span>موضوع</span></th>
                                    <th><span>ایمیل</span></th>
                                    <th><span>وضعیت</span></th>
                                    <th><span>متن پیام</span></th>                                 
                                </tr>
                                </thead>';
    echo '<tbody>';

    while($row = $results->fetch_assoc()){ //fetch values
//echo $row['topic'];
        echo '<tr>';
        if ($type==1){
            echo  "
                                    <td style=\"width: 10%;\">
                                        <span>".$row['name']."</span>
                                    </td>";

            echo "   
                                    <td style=\"width: 10%;\">                                                                                                               
                                        <span>".$row['subject']."</span>
                                    </td>";
            echo "<td dir='ltr' style=\"width: 10%;\">                                                                                                               
                                        <span>".$row['email']."</span>
                                    </td>";
            ?>
            <td style="width: 8%;">
                <select id="status" name="status" class="status form-control input-lg">
                    <option value="0"
                            class="<?php echo $row['ID'] ?>" <?php if ($row['status'] == 0) echo "selected" ?> >کامنت اولیه
                    </option>
                    <option value="1"
                            class="<?php echo $row['ID'] ?>" <?php if ($row['status'] == 1) echo "selected" ?> >در حال بررسی
                    </option>
                    <option value="2"
                            class="<?php echo $row['ID'] ?>" <?php if ($row['status'] == 2) echo "selected" ?> >تمام شده
                    </option>
                </select>
            </td>
            <?php
            echo "   
                                    <td dir='rtl' style=\"width: 40%;\">                                                                                                               
                                        <span>".$row['message']."</span>
                                    </td>";
        }
        echo "                                                                      
                                    <td style=\"width: 3%;\">
                                        <a onClick=\"return confirming();\"  href='deleteblog.php?type=7&product=".$row['ID']."' class=\"table-link danger\">
                                            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x\"></i>
                                                <i class=\"fa fa-trash-o fa-stack-1x fa-inverse\"></i>
                                            </span>
                                        </a>
                                    </td>";
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

    echo '<div class="pull-left">';
    /* We call the pagination function here to generate Pagination link for us.
    As you can see I have passed several parameters to the function. */
    echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
    echo '</div>';

    exit;
}else{
    header('Location:/');
}
################ pagination function #########################################
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    if ($item_per_page >= $total_records) return '';
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';

        $right_links    = $current_page + 6;
        $previous       = $current_page - 1; //previous link
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link

        if($current_page > 1){
            $previous_link = ($previous==0)? 1: $previous;
            $pagination .= '<li class="first"><div><a href="#" data-page="1" title="First">&laquo;</a></div></li>'; //first link
            $pagination .= '<li><div><a href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></div></li>'; //previous link
            for($i = ($current_page-6); $i < $current_page; $i++){ //Create left-hand side links
                if($i > 0){
                    $pagination .= '<li><div><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></div></li>';
                }
            }
            $first_link = false; //set first link to false
        }

        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active">'.$current_page.'</li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active">'.$current_page.'</li>';
        }else{ //regular current link
            $pagination .= '<li class="active">'.$current_page.'</li>';
        }

        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><div><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></div></li>';
            }
        }
        if($current_page < $total_pages){
            $next_link = ($current_page > $total_pages) ? $current_page : $next;
            $pagination .= '<li><div><a href="#" data-page="'.$next_link.'" title="Next">&gt;</a></div></li>'; //next link
            $pagination .= '<li class="last"><div><a href="#" data-page="'.$total_pages.'" title="Last">&raquo;</a></div></li>'; //last link
        }

        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}

?>

