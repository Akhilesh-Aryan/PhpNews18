<?php include ("include/config.php");?>
<!DOCTYPE html>
<html lang="en">
   <meta charset="utf-8">
    <head>
    <link href="bootstrap.css" rel="stylesheet">
    <title>news18</title>
    </head>
    <body class="bg-secondary">
       <?php
       include ("include/header.php");
        ?>
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                 <div class="card">
                     <div class="card-body">
                         <form action="insert_news.php" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                 <label for="title">News Title</label>
                                 <input type="text" name="title" id="title" class="form-control">
                             </div>
                              <div class="form-group">
                                 <label for="author">Author's Name</label>
                                 <input type="text" name="author" id="author" class="form-control">
                             </div>
                              <div class="form-group">
                                 <label for="category">News Category</label>
                                  <select name="category" id="category" class="form-control">
                                     <?php
                                      $callingCat =mysqli_query($connection,"select * from category");
                                      while($cat = mysqli_fetch_array($callingCat)):
                                      ?>
                                      <option value="<?= $cat['cat_id'];?>"><?= $cat['cat_title'];?></option>
                                      <?php endwhile;?>
                                  </select>
                                  <a href="#rocking" data-toggle="modal" class="small">Create Category</a>
                             </div>
                              <div class="form-group">
                                 <label for="image">Image</label>
                                 <input type="file" name="image" id="image" class="form-control">
                             </div>
                              <div class="form-group">
                                 <label for="date">Publication Date</label>
                                 <input type="date" name="date" id="date" class="form-control">
                             </div>
                              <div class="form-group">
                                 <label for="content">Content</label>
                                  <textarea rows="10" name="content" id="content" class="form-control"></textarea>
                             </div>
                              <div class="form-group">
                                 <input type="submit" name="send"class="form-control btn btn-success btn-block" value="Insert Now">
                             </div>
                         </form> 
                        
                     </div>
                 </div>
                </div>
                   <div class="modal fade" role="dialog" id="rocking">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header bg-info text-white">Insert Category</div>
                                   <div class="modal-body">
                                   <form action="insert_news.php" method="post">
                                   <div class="form-group">
                                       <label for="">Insert Title</label>
                                      <input type="text" name="cat_title" class="form-control">
                                   </div>
                                   <div class="form-group">
                                       <input type="submit" name="send_cat" class="btn btn-block btn-success">
                                   </div>
                                </form>
                               </div>
                               </div>
                           </div>
                       </div>
            </div>
        </div>
      <?php include("include/footer.php");?>
    </body>
</html>
<?php
if(isset($_POST['send'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp_image,"images/$image");
    
    $query = mysqli_query($connection, "insert into posts(post_title,post_author,post_date,post_category,post_content,post_image)
    value('$title','$author','$date','$category','$content','$image')");
                        
    if($query){
        
        echo "<script>window.open('insert_news.php','_self')</script>";
    }
    else{
        echo "insertion failed";
    }
}
    if(isset($_POST['send_cat'])){
        $cat_title = $_POST['cat_title'];
        $query= mysqli_query($connection, "insert into category(cat_title) value( '$cat_title')");
          echo "<script>window.open('insert_news.php','_self')</script>";
    }
?>
