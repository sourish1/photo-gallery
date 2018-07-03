<?php include "includes/admin_header.php"; ?>

<?php

if(!$session->is_signed_in())
{
  redirect("login.php");
}

 ?>


 <?php
$message = "";
 // if(isset($_POST['submit']))
if(isset($_FILES['file']))
{
  $photo = new Photo();
  $photo->title = $_POST['title'];
  // $photo->set_file($_FILES['file_upload']);
    $photo->set_file($_FILES['file']);
  if($photo->save())
  {
    $message = "photo uploaded successfully";
  }else {
    $message = join("<br>",$photo->errors);
  }

}

  ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->

            <?php include "includes/top_nav.php"; ?>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

            <?php include "includes/side_nav.php"; ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

          <div class="container-fluid">

              <!-- Page Heading -->
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          Upload

                      </h1>
                      <div class="row">
                      <div class="col-md-6">
                        <?php echo $message; ?>
                      <form class="" action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <input type="text" name="title" value="" class="form-control">
                        </div>

                        <div class="form-group">
                          <input type="file" name="file" value="">
                        </div>

                        <div class="form-group">
                          <input type="submit" name="submit" value="submit">
                        </div>

                        </div>
                        </div>

                      </form>


                  </div>
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-lg-12">
                  <form class="dropzone" action="upload.php">

                  </form>
                </div>
              </div>

          </div>

            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php"; ?>
