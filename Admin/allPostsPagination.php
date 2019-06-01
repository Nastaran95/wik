<?php
//continue only if $_POST is set and it is a Ajax request
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include '../Settings.php';
if (isset($_GET) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    //Get page number from Ajax POST
    $page_number = 0;
    $item_per_page = $_GET["limit"];
    $type = $_GET["type"];
    $query = $_GET["query"];
    if (isset($_GET["category"])) {
        $dastebandi = $_GET["category"];
    } else {
        $dastebandi = "all";
    }

    if (isset($_GET["status"])) {
        $status = $_GET["status"];
        if ($status == 'all') {
            $command2 = " Paper.stat < 2  ";
        }
        else {
            $command2 = " Paper.stat='$status' ";
        }
    } else {
        $status = "all";
        $command2 = " Paper.stat < 2  ";
    }

    if (isset($_GET["page"])) {
        $page_number = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if (!is_numeric($page_number)) {
            die('Invalid page number!');
        } //incase of invalid page number
    } else {
        $page_number = 1; //if there's no page number, set it to 1
    }
    //get total number of records from database for pagination
    if ($query === "=====+++=====") {
        if ($dastebandi == 'all') {
            if ($type == 1)
                $results = $connection->query("SELECT COUNT(*) FROM Paper WHERE ".$command2." ORDER BY realtime DESC ");
        } else {
            if ($type == 1)
                $results = $connection->query("SELECT COUNT(*) FROM Paper WHERE dastebandi='$dastebandi' and ".$command2." ORDER BY realtime DESC");
        }
    } else {
        $command = "WHERE (Paper.name LIKE '%" . $query . "%'" . " OR Paper.Mokhtasar LIKE '%" . $query . "%' OR users.name Like '%".$query."%' )";
        if ($dastebandi == 'all') {
//            echo "SELECT COUNT(*) FROM Paper INNER JOIN users on Paper.writerID = users.mobile " . $command . " ORDER BY realtime DESC";
            if ($type == 1)
                $results = $connection->query("SELECT COUNT(*) FROM Paper INNER JOIN users on Paper.writerID = users.mobile " . $command . " and ".$command2." ORDER BY Paper.realtime DESC");
        } else {
            if ($type == 1)
                $results = $connection->query("SELECT COUNT(*) FROM Paper INNER JOIN users on Paper.writerID = users.mobile " . $command . " and Paper.dastebandi='$dastebandi' and ".$command2." ORDER BY Paper.realtime DESC");
        }
    }

    $get_total_rows = $results->fetch_row(); //hold total records in variable
    //break records into pages
    $total_pages = ceil($get_total_rows[0] / $item_per_page);

    //get starting position to fetch the records
    $page_position = (($page_number - 1) * $item_per_page);
    if ($query === "=====+++=====") {
        if ($dastebandi == 'all') {
            if ($type == 1)
                $results = $connection->query("SELECT Paper.post_name, Paper.XMLNAME , Paper.name as name1 , users.name as name2,Paper.image as image , Paper.stat , Paper.ID,Paper.realtime,Paper.Mokhtasar FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE ".$command2." ORDER BY realtime DESC  LIMIT $page_position, $item_per_page  ");
        } else {
            if ($type == 1)
                $results = $connection->query("SELECT Paper.post_name,Paper.XMLNAME , Paper.name as name1 , users.name as name2,Paper.image as image , Paper.stat , Paper.ID,Paper.realtime,Paper.Mokhtasar FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE dastebandi='$dastebandi' and ".$command2." ORDER BY realtime DESC  LIMIT $page_position, $item_per_page ");
        }
    } else {
        if ($dastebandi == 'all') {
            if ($type == 1)
                $results = $connection->query("SELECT Paper.post_name,Paper.XMLNAME , Paper.name as name1 , users.name as name2,Paper.image as image , Paper.stat , Paper.ID,Paper.realtime,Paper.Mokhtasar FROM Paper INNER JOIN users on Paper.writerID = users.mobile " . $command . " and ".$command2." ORDER BY Paper.realtime DESC LIMIT $page_position, $item_per_page ");
        } else {
            if ($type == 1)
                $results = $connection->query("SELECT Paper.post_name,Paper.XMLNAME , Paper.name as name1 , users.name as name2,Paper.image as image , Paper.stat , Paper.ID,Paper.realtime,Paper.Mokhtasar FROM Paper INNER JOIN users on Paper.writerID = users.mobile " . $command . " and Paper.dastebandi='$dastebandi' and  ".$command2. " ORDER BY Paper.realtime DESC LIMIT $page_position, $item_per_page ");
        }
    }

    //Display records fetched from database.
    if ($type == 1)
        echo '<table class="table user-list text-right">
                                <thead>
                                <tr>
                                    <th><input id="checkAll" type="checkbox"/></th>
                                    <th><span>تصویر</span></th>
                                    <th><span>عنوان</span></th>
                                    <th><span>نویسنده</span></th>                                  
                                    <th><span>وضعیت</span></th> 
                                    <th><span>زمان آخرین تغییرات</span></th>
                                    <th><span>خلاصه</span></th>                                   
                                </tr>
                                </thead>';
    echo '<tbody>';

    while ($row = $results->fetch_assoc()) { //fetch values
//echo $row['name'];
        $productXMLNAME = $row['XMLNAME'];
        if (file_exists($productXMLNAME)) {
            $produc = simplexml_load_file($productXMLNAME);
            $produccode = $produc->code;
        }
        echo '<tr>';

        if ($type == 1) {
            $img = $row['image'];
            echo "                     <td>
                                        <input type=\"checkbox\"/>
                                    </td>
                                    <td>                                                                                                               
                                        <span> <img src=\"../" . $img . "\" width='50px' height='50px'></span>
                                    </td>
                                    <td>
                                        <div class=\"info\">
                                            <a target='_blank' href='/Paper/" . $row['post_name'] . "' class=\"user-link\">" . $row['name1'] . "</a>
                                        </div>
                                    </td>";


            echo "   
                                    <td>                                                                                                               
                                        <span>" . $row['name2'] . "</span>
                                    </td>";
            if ($row['stat'] == 0) {
                $tp = "تایید نشده ";
                echo "<td dir='ltr'>                                                                                                               
                                        <span class='status" . $row['ID'] . "' style=\"color: red;\" >" . $tp . "</span>
                                    ";
            } else {
                $tp = "تایید شده ";
                echo "<td dir='ltr'>                                                                                                               
                                        <span class='status" . $row['ID'] . "' style=\"color: green;\" >" . $tp . "</span>
                                    ";
            }

            echo "
                                        <a  href='allPosts.php' class=\"" . $row['ID'] . "\" id='changestatusOk'>
                                            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x greencolor\"></i>
                                                <i class=\"far fa-check-square fa-stack-1x fa-inverse\"></i>
                                            </span>
                                        </a>
                                        
                                        <a  href='allPosts.php' class=\"" . $row['ID'] . "\" id='changestatusNO'>
                                            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x specialcolor \"></i>
                                                <i class=\"fas fa-times fa-stack-1x fa-inverse\"></i>
                                            </span>
                                        </a>
                                        </td>
                ";


            echo "<td dir='ltr'>                                                                                                               
                                        <span>" . $row['realtime'] . "</span>
                                    </td>";
            echo "   
                                    <td dir='ltr'>                                                                                                               
                                        <span>" . $row['Mokhtasar'] . "</span>
                                    </td>";
        }
        echo "                                                                      
                                    <td style=\"width: 20%;\">
                                        <a  target='_blank' href='addPost.php?type=$type&product=" . $row['ID'] . "' class=\"table-link\">
                                            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x bluecolor\"></i>
                                                <i class=\"fas fa-edit fa-stack-1x fa-inverse \"></i>
                                            </span>
                                        </a>
                                        <a onClick=\"return confirming();\"  href='deleteblog.php?type=1&product=" . $row['ID'] . "' class=\"table-link danger\">
                                            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x\"></i>
                                                <i class=\"far fa-trash-alt fa-stack-1x fa-inverse\"></i>
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
} else {
    header('Location:/');
}

################ pagination function #########################################
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    if ($item_per_page >= $total_records) return '';
    $pagination = '';
    if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
        $pagination .= '<ul class="pagination">';

        $right_links = $current_page + 6;
        $previous = $current_page - 1; //previous link
        $next = $current_page + 1; //next link
        $first_link = true; //boolean var to decide our first link

        if ($current_page > 1) {
            $previous_link = ($previous == 0) ? 1 : $previous;
            $pagination .= '<li class="first"><div><a href="#" data-page="1" title="First">&laquo;</a></div></li>'; //first link
            $pagination .= '<li><div><a href="#" data-page="' . $previous_link . '" title="Previous">&lt;</a></div></li>'; //previous link
            for ($i = ($current_page - 6); $i < $current_page; $i++) { //Create left-hand side links
                if ($i > 0) {
                    $pagination .= '<li><div><a href="#" data-page="' . $i . '" title="Page' . $i . '">' . $i . '</a></div></li>';
                }
            }
            $first_link = false; //set first link to false
        }

        if ($first_link) { //if current active page is first link
            $pagination .= '<li class="first active">' . $current_page . '</li>';
        } elseif ($current_page == $total_pages) { //if it's the last active link
            $pagination .= '<li class="last active">' . $current_page . '</li>';
        } else { //regular current link
            $pagination .= '<li class="active">' . $current_page . '</li>';
        }

        for ($i = $current_page + 1; $i < $right_links; $i++) { //create right-hand side links
            if ($i <= $total_pages) {
                $pagination .= '<li><div><a href="#" data-page="' . $i . '" title="Page ' . $i . '">' . $i . '</a></div></li>';
            }
        }
        if ($current_page < $total_pages) {
            $next_link = ($current_page > $total_pages) ? $current_page : $next;
            $pagination .= '<li><div><a href="#" data-page="' . $next_link . '" title="Next">&gt;</a></div></li>'; //next link
            $pagination .= '<li class="last"><div><a href="#" data-page="' . $total_pages . '" title="Last">&raquo;</a></div></li>'; //last link
        }

        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}

?>

