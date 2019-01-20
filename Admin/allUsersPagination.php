<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 8/10/2018
 * Time: 11:12 AM
 */
include '../Settings.php';
//continue only if $_POST is set and it is a Ajax request
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
                $results = $connection->query("SELECT COUNT(*) FROM users");
        } else {
//            if ($type == 1)
//                $results = $connection->query("SELECT COUNT(*) FROM users WHERE dastebandi='$dastebandi'");
        }
    } else {
        $D = 0;
        $command = "WHERE";
        $command2 = "WHERE";
        $X = mbsplit(" ", $query);
        for ($II = 0; $II < count($X); $II = $II + 1) {
            if (strlen($X[$II]) > 0) {
                if ($D === 0) {
                    $command2 = $command2 . " name LIKE '%" . $X[$II] . "%' OR email LIKE '%" . $X[$II] . "%' OR address LIKE '%" . $X[$II] . "%'";
                    $command = $command . " name LIKE '%" . $X[$II] . "%'  OR email LIKE '%" . $X[$II] . "%' OR address LIKE '%" . $X[$II] . "%'";
                } else {
                    $command2 = $command2 . "OR name LIKE '%" . $X[$II] . "%'  OR email LIKE '%" . $X[$II] . "%' OR address LIKE '%" . $X[$II] . "%'";
                    $command = $command . "OR name LIKE '%" . $X[$II] . "%'  OR email LIKE '%" . $X[$II] . "%' OR address LIKE '%" . $X[$II] . "%'";
                }
                $D = $D + 1;
            }
        }
        if ($D === 0) {
            if ($dastebandi == 'all') {
                if ($type == 1)
                    $results = $connection->query("SELECT COUNT(*) FROM users");
            } else {
//                if ($type == 1)
//                    $results = $connection->query("SELECT COUNT(*) FROM users WHERE dastebandi='$dastebandi'");
            }
        } else {
            if ($dastebandi == 'all') {
                if ($type == 1)
                    $results = $connection->query("SELECT COUNT(*) FROM users " . $command);
            } else {
//                if ($type == 1)
//                    $results = $connection->query("SELECT COUNT(*) FROM users " . $command . " and dastebandi='$dastebandi'");
            }
        }
    }

    $get_total_rows = $results->fetch_row(); //hold total records in variable
    //break records into pages
    $total_pages = ceil($get_total_rows[0] / $item_per_page);

    //get starting position to fetch the records
    $page_position = (($page_number - 1) * $item_per_page);
    $D = 0;
    if ($query === "=====+++=====") {
        $D = 1;
        if ($dastebandi == 'all') {
            if ($type == 1)
                $results = $connection->query("SELECT * FROM users ORDER BY ID DESC  LIMIT $page_position, $item_per_page ");
        } else {
//            if ($type == 1)
//                $results = $connection->query("SELECT * FROM users WHERE dastebandi='$dastebandi' ORDER BY ID DESC  LIMIT $page_position, $item_per_page ");
        }
    } else {
        $command = "WHERE";
        $command2 = "WHERE";
        $X = mbsplit(" ", $query);
        for ($II = 0; $II < count($X); $II = $II + 1) {
            if (strlen($X[$II]) > 0) {
                if ($D === 0) {
//                    $command=$command." name LIKE '%".$X[$II]."%' OR Mokhtasar LIKE '%".$X[$II]."%'";
                    $command2 = $command2 . " name LIKE '%" . $X[$II] . "%'";
                } else {
//                    $command=$command."OR name LIKE '%".$X[$II]."%' OR Mokhtasar LIKE '%".$X[$II]."%'";
                    $command2 = $command2 . "OR name LIKE '%" . $X[$II] . "%'";
                }
                $D = $D + 1;
            }
        }
        if ($D === 0) {
            if ($dastebandi == 'all') {
                if ($type == 1)
                    $results = $connection->query("SELECT * FROM users ORDER BY ID DESC  LIMIT $page_position, $item_per_page ");
            } else {
//                if ($type == 1)
//                    $results = $connection->query("SELECT * FROM users  WHERE dastebandi='$dastebandi' ORDER BY ID DESC  LIMIT $page_position, $item_per_page ");
            }
        } else {
            if ($dastebandi == 'all') {
                if ($type == 1)
                    $results = $connection->query("SELECT * FROM users " . $command . " ORDER BY ID DESC LIMIT $page_position, $item_per_page ");
            } else {
//                if ($type == 1)
//                    $results = $connection->query("SELECT * FROM users " . $command . "and dastebandi='$dastebandi'" . " ORDER BY ID DESC LIMIT $page_position, $item_per_page ");
            }
        }
    }

    //Display records fetched from database.
    if ($type == 1)
        echo '<table class="table user-list text-right">
                                <thead>
                                <tr>
                                    <th><input id="checkAll" type="checkbox"/></th>
                                    <th><span>تصویر</span></th>
                                    <th><span>نام</span></th>
                                    <th><span>موبایل</span></th>       
                                    <th><span>ایمیل</span></th>                                  
                                    <th><span>وضعیت</span></th> 
                                    <th><span>دسته</span></th>   
                                    <th><span>اشتراک</span></th>                   
                                    <th><span>زمان عضویت</span></th>
                                    <th><span>تایید عضویت</span></th>        
                                    <th><span>آدرس</span></th>        
                                    <th><span>دسترسی</span></th>                                   
                                </tr>
                                </thead>';
    echo '<tbody>';

    while ($row = $results->fetch_assoc()) { //fetch values
//echo $row['name'];

        echo '<tr>';
        $NEWNAME = str_replace(" ", "-", $row['name']);
        $IDOA = $row['ID'];
        $NEWNAME = $NEWNAME . "/";
        if ($type == 1) {
            $img = $row['image'];
            $name = $row['name'];
            $mobile = $row['mobile'];
            $email = $row['email'];
            $stat = $row['stat'];
            $categoryID = $row['categoryID'];
            $eshterakID = $row['eshterakID'];
            $realtime = $row['realtime'];
            $verified = $row['verified'];
            $address = $row['address'];
            $typ = $row['typ'];



            echo "                     <td>
                                        <input type=\"checkbox\"/>
                                    </td>
                                    <td>                                                                                                               
                                        <span> <img src=\"../".$img."\" width='50px' height='50px' class='img" .$IDOA . "' ></span>
                                        <a onClick=\"return confirming();\"  href='allUsers.php' class=\"" . $IDOA . "\" id='deleteImage'>
                                            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x text-danger\" ></i>
                                                <i class=\"far fa-trash-alt fa-stack-1x fa-inverse\"></i>
                                            </span>
                                        </a>
                                    </td>";



            echo "                  <td>
                                        <div class=\"info\">
                                            <a target='_blank' href='/' class=\"user-link\">" . $name . "</a>
                                        </div>
                                    </td>  
                                    <td>                                                                                                               
                                        <span>" . $mobile . "</span>
                                    </td>
                                    <td>                                                                                                               
                                        <span>" . $email . "</span>
                                    </td>";
            if ($stat == 0) {
                $tp = "عدم نمایش ";
                echo "<td dir='ltr'>                                                                                                               
                                        <span class='status" . $IDOA . "' style=\"color: red;\" >" . $tp . "</span>
                                    ";
            } else {
                $tp = "نمایش ";
                echo "<td dir='ltr'>                                                                                                               
                                        <span class='status" .$IDOA . "' style=\"color: green;\" >" . $tp . "</span>
                                     ";
            }

            echo "  
                                       <a  href='allUsers.php' class=\"" . $IDOA . "\" id='changestatusOk'>
            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x greencolor\"></i>
                <i class=\"far fa-check-square fa-stack-1x fa-inverse\"></i>
                                            </span>
            </a>

            <a  href='allUsers.php' class=\"" . $IDOA . "\" id='changestatusNO'>
            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x specialcolor \"></i>
                <i class=\"fas fa-times fa-stack-1x fa-inverse\"></i>
                                            </span>
            </a>
                                    </td> ";
            ?>

            <td >
                <select id="category" name="category" class="status form-control input-lg">
                    <?php
                    $query = "SELECT * FROM userCategory;";
                    $result = $connection->query($query);
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $id = $row['ID'];
                        ?>
                        <option value="<?php echo $id; ?>"
                                class="<?php echo $IDOA ?>" <?php if ($categoryID == $id) echo "selected" ?> > <?php echo $name; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>

            </td>
            <td >
                <select id="eshterak" name="eshterak" class="eshterak form-control input-lg">
                    <?php
                    $query = "SELECT * FROM userEshterak;";
                    $result = $connection->query($query);
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $id = $row['ID'];
                        ?>
                        <option value="<?php echo $id; ?>"
                                class="<?php echo $IDOA ?>" <?php if ($eshterakID == $id) echo "selected" ?> > <?php echo $name; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>

            </td>
            <?php



            echo "<td dir='ltr'>                                                                                                               
                                        <span>" . $realtime . "</span>
                                    </td>";

            if ($verified == 0) {
                $tp = "تایید نشده";
                echo "<td dir='ltr'>                                                                                                               
                                        <span class='verify" . $IDOA . "' style=\"color: red;\" >" . $tp . "</span>
                                    ";
            } else {
                $tp = "تایید شده";
                echo "<td dir='ltr'>                                                                                                               
                                        <span class='verify" . $IDOA . "' style=\"color: green;\" >" . $tp . "</span>
                                    ";
            }

            echo "  
                                       <a  href='allUsers.php' class=\"" . $IDOA . "\" id='changeverifyOk'>
            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x greencolor\"></i>
                <i class=\"far fa-check-square fa-stack-1x fa-inverse\"></i>
                                            </span>
            </a>

            <a  href='allUsers.php' class=\"" . $IDOA . "\" id='changeverifyNO'>
            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x specialcolor \"></i>
                <i class=\"fas fa-times fa-stack-1x fa-inverse\"></i>
                                            </span>
            </a>
            </td> ";

            echo "   
                                    <td dir='ltr'>                                                                                                               
                                        <span>" . $address . "</span>
                                    </td>";
            if ($typ == 0) {
                $tp = "کاربر عادی";
                echo "<td dir='ltr'>                                                                                                               
                                        <span class='type" . $IDOA . "' style=\"color: red;\" >" . $tp . "</span>
                                    </td>";
            } else {
                $tp = "ادمین";
                echo "<td dir='ltr'>                                                                                                               
                                        <span class='type" . $IDOA . "' style=\"color: green;\" >" . $tp . "</span>
                                    </td>";
            }

        }
        echo "                                                                      
                                    <td style=\"width: 20%;\">
                                        <a  target='_blank' href='addUser.php?type=$type&product=" . $IDOA . "' class=\"table-link\">
                                            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x bluecolor\"></i>
                                                <i class=\"fas fa-edit fa-stack-1x fa-inverse \"></i>
                                            </span>
                                        </a>
                                        <a onClick=\"return confirming();\"  href='deleteblog.php?type=2&product=" . $IDOA . "' class=\"table-link danger\">
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
