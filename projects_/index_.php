
    <div class="container main">
      <div class="content">
        
        <div class="row">
  
          <div class="col-xs-12 col-md-10">

            <!--BLOG INDEX 1-->
            <?php 
            for($i=0;$i<6;$i++){
            ?>
            <div class="post row">
              <div class="col-xs-12 col-sm-3">
                <h2 style="margin-top: 10px">Rumah Asuh</h2>
                <p class="timestamp">25 November 2013</p>
              </div>
              <div class="col-xs-12 col-sm-9">
                <img class="m_b_10" src="<?php echo $prefix_url;?>files/common/img_project-1.png" width="100%">
                <p class="m_b_10">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <a class="read-more" href="<?php echo $prefix_url;?>blog/details.php">Read More</a>
              </div>
            </div>
            <?php
            }
            ?>


            <!--PAGINATION-->
            <ul class="pagination pull-right">
              <li><a href="#">&laquo;</a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&raquo;</a></li>
            </ul>

          </div><!--.col-->

          <!--BLOG CATEGORY-->
          <div class="col-xs-2 hidden-xs hidden-sm">
            <div class="category p_l_15">
              <p>Categories</p>
              <ul>
                <li><a href="">All Posts</a></li>
                <li><a href="">News</a></li>
                <li><a href="">Events</a></li>
                <li><a href="">Others</a></li>
              </ul>
            </div>
          </div>

        </div><!--.row-->


      </div><!--.content-->
    </div><!--.container.main-->