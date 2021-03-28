<?php  include "includes/db.php"; ?>
 <?php  //include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  //include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">

            
               
               <?php

    if(isset($_GET['p_id'])){
    
       $the_post_id = $_GET['p_id'];



        $update_statement = mysqli_prepare($connection, "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = ?");

        mysqli_stmt_bind_param($update_statement, "i", $the_post_id);

        mysqli_stmt_execute($update_statement);

        // mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
    


     if(!$update_statement) {

        die("query failed" );
    }


    if(isset($_SESSION['username']) && is_admin($_SESSION['username']) ) {


         $stmt1 = mysqli_prepare($connection, "SELECT post_title, post_author, post_date, post_image, post_content, page FROM posts WHERE post_id = ?");


    } else {
        $stmt2 = mysqli_prepare($connection , "SELECT post_title, post_author, post_date, post_image, post_content, page FROM posts WHERE post_id = ? AND post_status = ? ");

        $published = 'published';



    }



    if(isset($stmt1)){

        mysqli_stmt_bind_param($stmt1, "i", $the_post_id);

        mysqli_stmt_execute($stmt1);

        mysqli_stmt_bind_result($stmt1, $post_title, $post_author, $post_date, $post_image, $post_content,$page);

      $stmt = $stmt1;


    }else {


        mysqli_stmt_bind_param($stmt2, "is", $the_post_id, $published);

        mysqli_stmt_execute($stmt2);

        mysqli_stmt_bind_result($stmt2, $post_title, $post_author, $post_date, $post_image, $post_content,$page);

     $stmt = $stmt2;

    }




    while(mysqli_stmt_fetch($stmt)) {



        ?>
        
          <h1 class="page-header"></h1>
                   <h4> Read more</h4>

                   <br>
                   
                  
        

                <p style="font-size:16px";><?php echo $page ?></p>
                
    <?php }} ?>












                
         
           
  

            </div>
            
              

            <!-- Blog Sidebar Widgets Column -->
            
            
            <?php //include "includes/sidebar.php";?>
             

        </div>
        <!-- /.row -->

       

   

<?php //include "includes/footer.php";?>



       


         
            




       

   


