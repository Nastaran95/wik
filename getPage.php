<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 8/3/18
 * Time: 11:51 PM
 */
include "Settings.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$page = $_GET['page'];
$typ = $_GET['typ'];


if ($typ==1){
    $cat = $_GET['cat'];
    if ($page==-1)
        $page = 1;
//    $query = "SELECT * FROM Paper WHERE (stat>0 and dastebandi in (".$cat.") ) ORDER by realtime DESC " ;
    $query = "SELECT Paper.ID FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND dastebandi in (".$cat.")) ;";
    $result = $connection->query($query);
    $pagenum = $result->num_rows;
    if ($page==-2)
        $page = floor(($pagenum+6) / 7);

    $a = ($page-1)*7;
//    $query = "SELECT * FROM Paper WHERE (stat>0 and dastebandi in (".$cat.") )  ORDER by realtime DESC LIMIT $a , 7;";
    $query = "SELECT Paper.name as name1,Paper.writerID,Paper.realtime,Paper.post_name,Paper.Mokhtasar,Paper.image,users.name as name2 FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND dastebandi in (".$cat.")) ORDER by Paper.realtime DESC  LIMIT $a , 7;";

    $result = $connection->query($query);


    while ($row=$result->fetch_assoc()) {
        $name = $row['name1'];
        $writerID = $row['writerID'];
        $writer = $row['name2'];
        $time = $row['realtime'];
        $link = '/paper/'.$row['post_name'];
        $mokhtasar = $row['Mokhtasar'];
        $image = $row['image'];
//        $image = substr($image,3);

        ?>

        <div class="col-md-12 Paperdiv col-12 float-left">

            <div class="col-md-3 float-right col-12 ">
                <a href="<?php echo $link;?>">
                    <img src="/<?php echo $image; ?>" width="100%" height="100%" alt="paperimg">
                </a>
            </div>

            <div class="col-md-9 PaperText float-right col-12">
                <div class="col-md-12 col-12 ">
                    <h2 class="papname">
                        <a href="<?php echo $link;?>">
                            <?php echo $name; ?>
                        </a>
                    </h2>
                </div>

                <div class="col-md-12 nametime col-12 row">
                    <div class="col-md-4 col-12 ">
                        <?php echo $writer; ?>
                    </div>
                    <div class="col-md-8 col-12 ">
                        <?php echo $time; ?>
                    </div>


                </div>
                <div class="col-md-12 summ col-12 ">
                    <?php echo $mokhtasar; ?>
                </div>
            </div>

        </div>
        <br>

        <?php
    }
    ?>

    <div class="pagination-container float-left">
        <ul class="pagination">
            <li id="-1" class="PagedList-skipToNext paginationoldPapers" rel="prev"> >> </li>
            <li id="1" class="paginationoldPapers <?php if (1==$page) echo "active" ?>">1</li>
            <?php
            if($page>3)
                echo "<li>...</li>";
            $x = ($pagenum+6) / 7 ;
            for ($i=max(2,$page-1) ; $i <= min($page+1,$x) ; $i++){
                ?>
                <li id="<?php echo $i?>" class="paginationoldPapers <?php if ($i==$page) echo "active" ?>"><?php echo $i?></li>
                <?php
            }
            $i--;
            if ($i<max(1,floor($x)-1))
                echo "<li>...</li>";
            if ($i<max(1,floor($x))){
                ?>
                <li id="<?php echo floor($x)?>" class="paginationoldPapers"><?php echo floor($x)?></li>
                <?php
            }
            ?>
            <li id="-2" class="PagedList-skipToNext paginationoldPapers" rel="next"> << </li>
        </ul>

    </div>


    <?php
}
else if ($typ==2){
    $writerID = $_GET['writer'];
    if ($page==-1)
        $page = 1;
//    $query = "SELECT * FROM Paper WHERE (writerID LIKE '%$writerID%' and stat>0 )  ORDER by realtime DESC " ;
    $query = "SELECT Paper.ID FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.writerID LIKE '%$writerID%' ) ;";
//    echo $query;
    $result = $connection->query($query);
    $pagenum = $result->num_rows;
    if ($page==-2)
        $page = floor(($pagenum+1) / 2);

    $a = ($page-1)*2;
//    $query = "SELECT * FROM Paper WHERE (writerID LIKE '%$writerID%' and stat>0 ) ORDER by realtime DESC LIMIT $a , 2;";
    $query = "SELECT Paper.name as name1, Paper.writerID, Paper.realtime, Paper.post_name, Paper.Mokhtasar, Paper.image,users.name as name2 FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.writerID LIKE '%$writerID%' ) ORDER by Paper.realtime DESC  LIMIT $a , 2;";

    $result = $connection->query($query);


    while ($row=$result->fetch_assoc()) {
//        $name = $row['name'];
//        $writerID = $row['writerID'];
//        $q = "SELECT * FROM users WHERE mobile=".$writerID.";";
//        $res = $connection->query($q);
//        if($rw=$res->fetch_assoc())
//            $writer = $rw['name'];
//        else
//            $writer = 'ناشناس';

        $name = $row['name1'];
        $writerID = $row['writerID'];
        $writer = $row['name2'];
        $time = $row['realtime'];
        $link = '/paper/'.$row['post_name'];
        $mokhtasar = $row['Mokhtasar'];
        $image = $row['image'];
//        $image = substr($image,3);

        ?>

        <div class="col-md-12 Paperdiv col-12 float-left ">
            <div class="col-md-3 float-right col-12 ">
                <a  href="<?php echo $link; ?> ">
                    <img src="/<?php echo $image; ?>" width="100%" height="100%"
                         alt="paperimg">
                </a>
            </div>

            <div class="col-md-9 PaperText float-right col-12 col-12 ">
                <div class="col-md-12 col-12 ">
                    <h2 class="papname">
                        <a href="<?php echo $link; ?>">
                            <?php echo $name; ?>
                        </a>
                    </h2>
                </div>

                <div class="col-md-12 nametime col-12 row">
                    <div class="col-md-4 col-12 ">
                        <?php echo $writer; ?>
                    </div>
                    <div class="col-md-8 col-12 ">
                        <?php echo $time; ?>
                    </div>

                </div>
                <div class="col-md-12 summ col-12 ">
                    <?php echo $mokhtasar; ?>
                </div>
            </div>

        </div>
        <br>

        <?php
    }
    ?>

    <div class="pagination-container float-left">
        <ul class="pagination">
            <li id="-1" class="PagedList-skipToNext paginationoldPapers1" rel="prev"> >> </li>
            <li id="1" class="paginationoldPapers1 <?php if (1==$page) echo "active" ?>">1</li>
            <?php
            if($page>3)
                echo "<li>...</li>";
            $x = ($pagenum+1) / 2 ;
            for ($i=max(2,$page-1) ; $i <= min($page+1,$x) ; $i++){
                ?>
                <li id="<?php echo $i?>" class="paginationoldPapers1 <?php if ($i==$page) echo "active" ?>"><?php echo $i?></li>
                <?php
            }
            $i--;
            if ($i<max(1,floor($x)-1))
                echo "<li>...</li>";
            if ($i<max(1,floor($x))){
                ?>
                <li id="<?php echo floor($x)?>" class="paginationoldPapers1"><?php echo floor($x)?></li>
                <?php
            }
            ?>
            <li id="-2" class="PagedList-skipToNext paginationoldPapers1" rel="next"> << </li>
        </ul>
    </div>
    <?php
}


else if ($typ==3){
    $dastebandi = $_GET['daste'];
    if ($page==-1)
        $page = 1;
    $query = "SELECT Paper.ID FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.dastebandi='$dastebandi' ) ;";
//    $query = "SELECT * FROM Paper WHERE (dastebandi='$dastebandi' and stat>0 ) ORDER by realtime DESC " ;
    $result = $connection->query($query);
    $pagenum = $result->num_rows;
    if ($page==-2)
        $page = floor(($pagenum+1) / 2);

    $a = ($page-1)*2;

    $query = "SELECT Paper.name as name1,Paper.writerID,Paper.realtime,Paper.post_name,Paper.Mokhtasar,Paper.image,users.name as name2 FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.dastebandi='$dastebandi') ORDER by Paper.realtime DESC  LIMIT $a , 2;";
//    $query = "SELECT * FROM Paper WHERE (dastebandi='$dastebandi' and stat>0 ) ORDER by realtime DESC  LIMIT $a , 2;";
    $result = $connection->query($query);


    while ($row=$result->fetch_assoc()) {
        $name = $row['name1'];
        $writerID = $row['writerID'];
        $writer = $row['name2'];
        $time = $row['realtime'];
        $link = '/paper/'.$row['post_name'];
        $mokhtasar = $row['Mokhtasar'];
        $image = $row['image'];
//        $image = substr($image,3);

        ?>

        <div class="col-md-12 Paperdiv col-12 float-left ">
            <div class="col-md-3 float-right col-12 ">
                <a  href="<?php echo $link; ?> ">
                    <img src="/<?php echo $image; ?>" width="100%" height="100%"
                         alt="paperimg">
                </a>
            </div>

            <div class="col-md-9 PaperText float-right col-12 col-12 ">
                <div class="col-md-12 col-12 ">
                    <h2 class="papname">
                        <a href="<?php echo $link; ?>">
                            <?php echo $name; ?>
                        </a>
                    </h2>
                </div>

                <div class="col-md-12 nametime col-12 row">
                    <div class="col-md-4 col-12 ">
                        <?php echo $writer; ?>
                    </div>
                    <div class="col-md-8 col-12 ">
                        <?php echo $time; ?>
                    </div>

                </div>
                <div class="col-md-12 summ col-12 ">
                    <?php echo $mokhtasar; ?>
                </div>
            </div>

        </div>
        <br>

        <?php
    }
    ?>

    <div class="pagination-container float-left">
        <ul class="pagination">
            <li id="-1" class="PagedList-skipToNext paginationoldPapers2" rel="prev"> >> </li>
            <li id="1" class="paginationoldPapers2 <?php if (1==$page) echo "active" ?>">1</li>
            <?php
            if($page>3)
                echo "<li>...</li>";
            $x = ($pagenum+1) / 2 ;
            for ($i=max(2,$page-1) ; $i <= min($page+1,$x) ; $i++){
                ?>
                <li id="<?php echo $i?>" class="paginationoldPapers2 <?php if ($i==$page) echo "active" ?>">
                    <?php echo $i?>
                </li>
                <?php
            }
            $i--;
            if ($i<max(1,floor($x)-1))
                echo "<li>...</li>";
            if ($i<max(1,floor($x))){
                ?>
                <li id="<?php echo floor($x)?>" class="paginationoldPapers2"><?php echo floor($x)?></li>
                <?php
            }
            ?>
            <li id="-2" class="PagedList-skipToNext paginationoldPapers2" rel="next"> << </li>
        </ul>
    </div>
    <?php
}
else if ($typ==4){
    $writerID = $_GET['writer'];
    if ($page==-1)
        $page = 1;
//    $query = "SELECT * FROM Paper WHERE (writerID LIKE '%$writerID%' and stat>0 ) ORDER by realtime DESC " ;
    $query = "SELECT Paper.ID FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.writerID LIKE '%$writerID%' ) ;";
    $result = $connection->query($query);
    $pagenum = $result->num_rows;
    if ($page==-2)
        $page = floor(($pagenum+1) / 2);

    $a = ($page-1)*2;
    $query = "SELECT Paper.ID,Paper.name as name1, Paper.writerID, Paper.realtime, Paper.post_name, Paper.Mokhtasar, Paper.image,users.name as name2 FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.writerID LIKE '%$writerID%' ) ORDER by Paper.realtime DESC  LIMIT $a , 2;";
//    $query = "SELECT * FROM Paper WHERE (writerID LIKE '%$writerID%' and stat>0 ) ORDER by realtime DESC LIMIT $a , 2;";
    $result = $connection->query($query);


    while ($row=$result->fetch_assoc()) {
        $id = $row['ID'];
        $name = $row['name1'];
        $writerID = $row['writerID'];
        $writer = $row['name2'];
        $time = $row['realtime'];
        $link = '/paper/'.$row['post_name'];
        $mokhtasar = $row['Mokhtasar'];
        $image = $row['image'];
//        $image = substr($image,3);

        ?>

        <div class="col-md-12 Paperdiv col-12 float-left ">
            <div class="col-md-3 float-right col-12 ">
                <a  href="<?php echo $link; ?> ">
                    <img src="/<?php echo $image; ?>" width="100%" height="100%"
                         alt="paperimg">
                </a>
            </div>

            <div class="col-md-9 PaperText float-right col-12 col-12 ">
                <div class="col-md-12 col-12 ">
                    <h2 class="papname">
                        <a href="<?php echo $link; ?>">
                            <?php echo $name; ?>
                        </a>
                    </h2>
                </div>

                <div class="col-md-12 nametime col-12 row">
                    <div class="col-md-4 col-12 ">
                        <?php echo $writer; ?>
                    </div>
                    <div class="col-md-6 col-12 ">
                        <?php echo $time; ?>
                    </div>
                    <div class="col-md-1 col-12" >
                        <a href="/profile.php?requestEdit=<?php echo $id;?>" class="edit"><i class="fas fa-edit"></i></a>
                    </div>
                    <div class="col-md-1 col-12">
                        <a  href="/profile.php?requestDelete=<?php echo $id;?>" class="delete"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
                <div class="col-md-12 summ col-12 ">
                    <?php echo $mokhtasar; ?>
                </div>
            </div>

        </div>
        <br>

        <?php
    }
    ?>

    <div class="pagination-container float-left">
        <ul class="pagination">
            <li id="-1" class="PagedList-skipToNext paginationoldPapers1" rel="prev"> >> </li>
            <li id="1" class="paginationoldPapers1 <?php if (1==$page) echo "active" ?>">1</li>
            <?php
            if($page>3)
                echo "<li>...</li>";
            $x = ($pagenum+1) / 2 ;
            for ($i=max(2,$page-1) ; $i <= min($page+1,$x) ; $i++){
                ?>
                <li id="<?php echo $i?>" class="paginationoldPapers1 <?php if ($i==$page) echo "active" ?>"><?php echo $i?></li>
                <?php
            }
            $i--;
            if ($i<max(1,floor($x)-1))
                echo "<li>...</li>";
            if ($i<max(1,floor($x))){
                ?>
                <li id="<?php echo floor($x)?>" class="paginationoldPapers1"><?php echo floor($x)?></li>
                <?php
            }
            ?>
            <li id="-2" class="PagedList-skipToNext paginationoldPapers1" rel="next"> << </li>
        </ul>
    </div>
    <?php
}

else if ($typ==5){
    $ID = $_GET['writer'];
    $query = "SELECT * FROM users WHERE ID = '$ID' ;" ;
    $result = $connection->query($query);
    if($row=$result->fetch_assoc()) {
        $writerID = $row['mobile'];
        if ($page == -1)
            $page = 1;
        $query = "SELECT * FROM Paper WHERE (writerID LIKE '%$writerID%' and stat>0 ) ORDER by realtime DESC ";
        $result = $connection->query($query);
        $pagenum = $result->num_rows;
        if ($page == -2)
            $page = floor(($pagenum + 1) / 2);

        $a = ($page - 1) * 2;
        $query = "SELECT * FROM Paper WHERE (writerID LIKE '%$writerID%' and stat>0 ) ORDER by realtime DESC LIMIT $a , 2;";
        $result = $connection->query($query);


        while ($row = $result->fetch_assoc()) {
            $id = $row['ID'];
            $name = $row['name'];
            $writerID = $row['writerID'];
            $q = "SELECT * FROM users WHERE mobile=" . $writerID . ";";
            $res = $connection->query($q);
            if ($rw = $res->fetch_assoc())
                $writer = $rw['name'];
            else
                $writer = 'ناشناس';
            $time = $row['realtime'];
            $link = '/paper/' . $row['post_name'];
            $mokhtasar = $row['Mokhtasar'];
            $image = $row['image'];
//        $image = substr($image,3);

            ?>

            <div class="col-md-12 Paperdiv col-12 float-left ">
                <div class="col-md-3 float-right col-12 ">
                    <a href="<?php echo $link; ?> ">
                        <img src="/<?php echo $image; ?>" width="100%" height="100%"
                             alt="paperimg">
                    </a>
                </div>

                <div class="col-md-9 PaperText float-right col-12 col-12 ">
                    <div class="col-md-12 col-12 ">
                        <h2 class="papname">
                            <a href="<?php echo $link; ?>">
                                <?php echo $name; ?>
                            </a>
                        </h2>
                    </div>

                    <div class="col-md-12 nametime col-12 row">
                        <div class="col-md-4 col-12 ">
                            <?php echo $writer; ?>
                        </div>
                        <div class="col-md-6 col-12 ">
                            <?php echo $time; ?>
                        </div>
                    </div>
                    <div class="col-md-12 summ col-12 ">
                        <?php echo $mokhtasar; ?>
                    </div>
                </div>

            </div>
            <br>

            <?php
        }
        ?>

        <div class="pagination-container float-left">
            <ul class="pagination">
                <li id="-1" class="PagedList-skipToNext paginationoldPapers1" rel="prev"> >></li>
                <li id="1" class="paginationoldPapers1 <?php if (1 == $page) echo "active" ?>">1</li>
                <?php
                if ($page > 3)
                    echo "<li>...</li>";
                $x = ($pagenum + 1) / 2;
                for ($i = max(2, $page - 1); $i <= min($page + 1, $x); $i++) {
                    ?>
                    <li id="<?php echo $i ?>"
                        class="paginationoldPapers1 <?php if ($i == $page) echo "active" ?>"><?php echo $i ?></li>
                    <?php
                }
                $i--;
                if ($i < max(1, floor($x) - 1))
                    echo "<li>...</li>";
                if ($i < max(1, floor($x))) {
                    ?>
                    <li id="<?php echo floor($x) ?>" class="paginationoldPapers1"><?php echo floor($x) ?></li>
                    <?php
                }
                ?>
                <li id="-2" class="PagedList-skipToNext paginationoldPapers1" rel="next"> <<</li>
            </ul>
        </div>
        <?php
    }
}

else if ($typ==6){
    if ($page==-1)
        $page = 1;

    $query = "SELECT * FROM users WHERE stat>0  " ;
    $result = $connection->query($query);
    $pagenum = $result->num_rows;
    if ($page==-2)
        $page = floor(($pagenum+17) / 18);

    $a = ($page-1)*18;
    $query = "SELECT * FROM users WHERE stat>0 ORDER by name ASC LIMIT $a , 18;";
    $result = $connection->query($query);
    ?>
    <div class="row">
    <?php
    while ($row=$result->fetch_assoc()) {
        $name = $row['name'];
        $img = $row['image'];
        $id = $row['ID'];

        $link = '/user/'.$id;

        ?>

        <div class="col-md-4 float-right col-6 col-xs-6 p-3">
            <a href="<?php echo $link;?>">
                <div class="profile-header-container">
                    <div class="profile-header-img">
                        <img class="img-circle m-3" src="<?php echo $img; ?>" />
                        <!-- badge -->
                        <div class="rank-label-container">
                            <div class="label label-default rank-label"><?php echo $name;?></div>
                        </div>
                    </div>
                </div>

            </a>
        </div>



        <?php
    }
    ?>
    </div>
    <div class="pagination-container float-left">
        <ul class="pagination">
            <li id="-1" class="PagedList-skipToNext paginationoldPapers" rel="prev"> >> </li>
            <li id="1" class="paginationoldPapers <?php if (1==$page) echo "active" ?>">1</li>
            <?php
            if($page>3)
                echo "<li>...</li>";
            $x = ($pagenum+17) / 18 ;
            for ($i=max(2,$page-1) ; $i <= min($page+1,$x) ; $i++){
                ?>
                <li id="<?php echo $i?>" class="paginationoldPapers <?php if ($i==$page) echo "active" ?>"><?php echo $i?></li>
                <?php
            }
            $i--;
            if ($i<max(1,floor($x)-1))
                echo "<li>...</li>";
            if ($i<max(1,floor($x))){
                ?>
                <li id="<?php echo floor($x)?>" class="paginationoldPapers"><?php echo floor($x)?></li>
                <?php
            }
            ?>
            <li id="-2" class="PagedList-skipToNext paginationoldPapers" rel="next"> << </li>
        </ul>

    </div>


    <?php
}


