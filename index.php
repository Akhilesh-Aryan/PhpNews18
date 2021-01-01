<?php include("include/config.php");?>
<!DOCTYPE html>
<html lang="en">
   <meta charset="utf-8">
    <head>
       <link rel="stylesheet" href="bootstrap.css">
        <title>news18</title>
    </head>
    <body class="bg-light"><?php
       include ("include/header.php");
        ?>
        <div class="container mt-3">
            <div class="row">
                <div class="col-lg-3">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action bg-dark text-white">Categories</a>
                        <?php
                        $callingCat = mysqli_query($connection,"Select * from category");q
                        while($row = mysqli_fetch_array($callingCat)):
                            ?>
                        <a href="index.php?cat=<?= $row['cat_id'];?>"class="list-group-item list-group-item-action"><?= $row['cat_title'];?></a>
                        <?php endwhile;?>
                    </div>
                </div>
                <div class="col-lg-9">
                    <?php
                    if(isset($_GET['cat'])){
                        $cat_id = $_GET['cat'];
                        $callingPost = mysqli_query($connection,"Select * from posts JOIN category ON posts.post_category = category.cat_id WHERE posts.post_category ='$cat_id'");
                    }
                    elseif(isset($_GET['find'])){
                        $search = $_GET['search'];
                        $callingPost = mysqli_query($connection, "Select *from posts JOIN category ON posts.post_category= category.cat_id WHERE posts.post_title LIKE '%$search%'");
                    }
                    else{
                        $callingPost = mysqli_query($connection, "select * from posts JOIN category ON posts.post_category=category.cat_id");
                    }
                    while($post = mysqli_fetch_array($callingPost)):
                    ?>
                    <div class="card mb-4">
                              <div class="row">
                              <?php
                                  if($post['post_image']!=""):?>
                              <div class="col-lg-3">
                              <img src="<?= "images/".$post['post_image'];?>" alt="" height="100%" class="card-img-top">
                                  </div>
                                  <?php endif;?>
                                  <div class="col">
                               <div class="card-body">
                                   <h4><?= $post['post_title'];?></h4>
                                   <p class="small float-left"><?= $post['post_author'];?></p>
                                    <p class="small float-right badge bg-dark text-white ml-2"><?= $post['post_date'];?></p>
                                   <p class="small float-right badge bg-danger text-white"><?= $post['cat_title'];?></p>
                                   <div class="clearfix"></div>
                                   <p class="lead"><?= substr($post['post_content'],0,200);?></p>
                                   <a  href="post.php?id=<?= $post['post_id'];?>" class="btn btn-success float-right btn-sm">Read more</a>
                               </div>
                           </div>
                       </div>
                   </div>
                       <?php endwhile;?>
                </div>
            </div>
        </div>
     <?php include("include/footer.php");?>
    </body>
</html>