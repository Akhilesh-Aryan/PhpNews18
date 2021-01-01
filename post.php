<?php include "include/config.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="utf-8">
        <title>news7</title> 
          <link href="bootstrap.css" rel="stylesheet">
           </head>
           <body class="bg-secondary">
               <?php include("include/header.php");?>
               <div class="container mt-3">
                   <div class="row">
                       <div class="col-lg-3">
                           <div class="list-group">
                               <a href="" class="list-group-item list-group-item-action bg-dark text-white">Categories</a>
                               
                               <?php
                               $callingCat = mysqli_query($connection, "SELECT * from category");
                               while($row = mysqli_fetch_array($callingCat)):
                               ?>
                               <a href="index.php?cat=<?= $row['cat_id'];?>" class="list-group-item list-group-item-action"><?= $row['cat_title'];?></a>
                               <?php endwhile; ?>
                           </div>
                       </div>
                       <div class="col-lg-9">
                         <?php
                                $post_id = $_GET['id'];
                                $callingPost = mysqli_query($connection, "SELECT *from posts JOIN category ON posts.post_category = category.cat_id WHERE posts.post_id = '$post_id'");
                    
                           $post = mysqli_fetch_array($callingPost);
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
                                   <p class="lead"><?= $post['post_content'];?></p>
                                   
                               </div>
                           </div>
                       </div>
                   </div>
                    
                       </div>
                   </div>
               </div>
                               
              <?php include("include/footer.php");?>
           </body>    
</html>