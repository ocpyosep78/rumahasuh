<div class="nav nav-2 col-xs-2">
    <div class="nav-brand">
      <a href="<?php echo $prefix_url;?>index.php">
          <img src="<?php echo $prefix_url;?>files/common/nav-bar.png" width="193"></a>
      </div>
  <ul class="">
    <li><a <?php if($_GET['alias']=='sayembara'){echo 'class="selected"';}?> href="<?php echo $prefix_url;?>projects">Projects</a></li>
    <li><a <?php if($_GET['act']=='awards_/index'){echo 'class="selected"';}?> href="<?php echo $prefix_url;?>awards">Awards</a></li>
    <li><a <?php if($_GET['act']=='activities_/index'){echo 'class="selected"';}?> href="<?php echo $prefix_url;?>publications">Publications</a></li>
    <li><a <?php if($_GET['act']=='about_/index'){echo 'class="selected"';}?> href="<?php echo $prefix_url;?>news-events">News &amp; Events</a></li>
    <li><a <?php if($_GET['act']=='about_/index'){echo 'class="selected"';}?> href="<?php echo $prefix_url;?>about">About</a></li>
    <li><a <?php if($_GET['act']=='contact_/index'){echo 'class="selected"';}?> href="<?php echo $prefix_url;?>contact">Contact</a></li>
    <li><img class="logo" src="<?php echo $prefix_url;?>files/common/logo.png"></li>
  </ul>
</div>