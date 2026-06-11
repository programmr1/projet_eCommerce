<?php
     ob_start();

     function getItem($catId)
     {
         global $con;
         $sqlItem= $con->prepare("SELECT * FROM items WHERE catID=?  ");
             $sqlItem->execute(array($catId));
             $itemDis= $sqlItem->fetchAll();
         return $itemDis;

     }
     function getCat()
     {
         global $con;
         $getCat =$con->prepare( "SELECT * FROM categories order by categoriesID DESC");
         $getCat->execute();
         $cats=$getCat->fetchAll();
         return $cats;

     }
function getTitle()
{
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    }else{
        echo 'default';
    }

}
/*
 * redirect functions
 * $errorMsg=echo the error message
 * $seconds=seconds before redirecting
 * */

function redirectHome($theMsg,$url=null,$seconds=10){
     if ($url===null){
          $url = 'index.php';
          $link='homePage';
     }else{
        $url =isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER']!=''?$_SERVER['HTTP_REFERER']:$url='index.php';
        $link='homePage';
     }
     echo $theMsg;
     echo "<div class='alert alert-info'> you will be redirected to $url home page after .$seconds. seconds</div>";

     header("refresh:.$seconds; url=$url");
     exit();
     }

     function checkItem($select,$from,$value){
     global $con;
     $statement=$con->prepare("SELECT $select FROM $from WHERE $select= ?");

//     $varArr = [$value];
     $statement->execute([$value]);
     $count=$statement->rowCount();
     return $count;
     }


     function countItems($item,$table){
     global $con;
     $stmt2=$con->prepare("SELECT COUNT($item) from $table");
     $stmt2->execute();
     return $stmt2->fetchColumn();
     }

     function getlatest ($select,$table,$order,$limit=5)
     {
          global $con;
          $getstmt=$con->prepare("SELECT $select FROM $table order by $order Desc limit $limit");
          $getstmt->execute();
          $rows=$getstmt->fetchAll();
          return $rows;

     }
     ob_end_flush();
