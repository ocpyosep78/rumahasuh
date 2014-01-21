<div class="nav">
    <div class="nav-brand">
      <a href="<?php echo $prefix;?>index.php">
          <img src="<?php echo $prefix;?>files/common/nav-bar.png" width="193"></a>
      </div>
  <ul class="">
    <li><a <?php if($_GET['alias']=='sayembara'){echo 'class="selected"';}?> href="<?php echo $prefix;?>projects">Projects</a></li>
    <li><a <?php if($_GET['act']=='awards_/index'){echo 'class="selected"';}?> href="<?php echo $prefix;?>awards">Awards</a></li>
    <li><a <?php if($_GET['act']=='activities_/index'){echo 'class="selected"';}?> href="<?php echo $prefix;?>publications">Publications</a></li>
    <li><a <?php if($_GET['act']=='about_/index'){echo 'class="selected"';}?> href="<?php echo $prefix;?>news-events">News &amp; Events</a></li>
    <li><a <?php if($_GET['act']=='about_/index'){echo 'class="selected"';}?> href="<?php echo $prefix;?>about">About</a></li>
    <li><a <?php if($_GET['act']=='contact_/index'){echo 'class="selected"';}?> href="<?php echo $prefix;?>contact">Contact</a></li>
    <li><img class="logo" src="<?php echo $prefix;?>files/common/logo.png"></li>
  </ul>
</div>