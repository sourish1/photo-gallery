<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Dashboard</small>
            </h1>
            <?php

            // $result = User::find_user_by_id(2);
            // $user = User::instantiation($result);
            // echo $user->first_name;

            // $users = User::find_all();
            // foreach ($users as $user)
            // {
            //   echo $user->username . "<br>";
            // }

            // $found_user = User::find_user_by_id(2);
            // echo $found_user->username;

            // $user = new User();
            // $user->username = "sunny";
            // $user->password = "sunny";
            // $user->first_name = "sunny";
            // $user->last_name = "sen";
            // $user->create();

            // $user = User::find_user_by_id(2);
            // $user->last_name = "musib";
            // $user->update();
            // $user->delete();

            // $user = User::find_user_by_id(3);
            // $user->first_name = "sunday";
            // $user->save();

            // $user = new User();
            // $user->username = "example002";
            // $user->save();

            // $user = User::find_user_by_id(4);
            // $user->delete();

            // $photos = Photo::find_all();
            // foreach ($photos as $photo)
            // {
            //   echo $photo->title . "<br>";
            // }
            //
            // $user = new Photo();
            // $user->title = "sunny";
            // $user->description = "sunny";
            // $user->filename = "sunny";
            // $user->type = "sen";
            // $user->size = 5;
            // $user->create();

            // echo SITE_ROOT . "<br>";
            // echo INCLUDES_PATH;



             ?>


                      <!-- /.row -->

      <div class="row">
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-file-text fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo Photo::count_all(); ?></div>
                              <div>Photos</div>
                          </div>
                      </div>
                  </div>
                  <a href="photos.php">
                      <div class="panel-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-green">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-comments fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                           <div class='huge'><?php echo Comment::count_all(); ?></div>
                            <div>Comments</div>
                          </div>
                      </div>
                  </div>
                  <a href="comments.php">
                      <div class="panel-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-yellow">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-user fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                          <div class='huge'><?php echo User::count_all(); ?></div>
                              <div>Users</div>
                          </div>
                      </div>
                  </div>
                  <a href="users.php">
                      <div class="panel-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-red">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-list fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class='huge'><?php echo $session->visitor_count(); ?></div>
                               <div>New Views</div>
                          </div>
                      </div>
                  </div>
                  <a href="categories.php">
                      <div class="panel-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
      </div>
              <div class="row">
                <div id="piechart" style="width: 900px; height: 500px;"></div>
              </div>

        </div>
        <!-- col-lg-12 -->
    </div>
    <!-- /.row -->

</div>
