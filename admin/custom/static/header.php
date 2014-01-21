<?php
   /* -- DASHBOARD -- */
if(empty($act)){
   $header_dashboard  = "class=\"active\"";
   $header_order      = "";
   $header_customer   = "";
   $header_products   = "";
   $header_promotions = "";
   $header_report     = "";
   $header_pages      = "";
   
   
   /* -- ORDER -- */
}else if($act == "orders/index" || $act == "orders/details/index" || $act == "orders/details/edit"){
   $header_dashboard  = "";
   $header_order      = "class=\"active\"";
   $header_customer   = "";
   $header_products   = "";
   $header_promotions = "";
   $header_report     = "";
   $header_pages      = "";
   
   
   /* -- CUSTOMER -- */
}else if($act == "customers/index" || $act == "customers/add/index" || $act == "customers/details/edit" || $act == "customers/details/index"){
   $header_dashboard  = "";
   $header_order      = "";
   $header_customer   = "class=\"active\"";
   $header_products   = "";
   $header_promotions = "";
   $header_report     = "";
   $header_pages      = "";
   
   
   /* -- PRODUCTS -- */
}else if($act == "products/index" || $act == "products/add/index" || $act == "products/details/edit" || $act == "products/category/index" || $act == "products/color/index" || $act == "products/stock/sizemanager" || $act == "products/size/index" || $act == "products/designer/index"){
   $header_dashboard  = "";
   $header_order      = "";
   $header_customer   = "";
   $header_products   = "class=\"active\"";
   $header_promotions = "";
   $header_report     = "";
   $header_pages      = "";


   /* -- PROMOTION -- */
}else if($act == "promotions/sale/index"){
   $header_dashboard  = "";
   $header_order      = "";
   $header_customer   = "";
   $header_products   = "";
   $header_promotions = "class=\"active\"";
   $header_report     = "";
   $header_pages      = "";

   /* -- REPORTS -- */
}else if($act == "reports/index"){
   $header_dashboard  = "";
   $header_order      = "";
   $header_customer   = "";
   $header_products   = "";
   $header_promotions = "";
   $header_report     = "class=\"active\"";
   $header_pages      = "";


   /* -- PAGES -- */
}else if($act == "reports/index" || $act == "pages/home/home" || $act == "pages/about" || $act == "pages/contact" || $act == "pages/gallery" || $act == "pages/news/category/index" || $act == "pages/news/index" || $act == "pages/news/details/index" || $act == "pages/news/details/edit" || $act == "pages/news/add/index" || $act == "pages/recipes/category/index" || $act == "pages/recipes/category/index" || $act == "pages/recipes/index" || $act == "pages/recipes/details/index" || $act == "pages/recipes/add/index" || $act == "pages/recipes/details/edit" || $act == "pages/recipes/index"){
   $header_dashboard  = "";
   $header_order      = "";
   $header_customer   = "";
   $header_products   = "";
   $header_promotions = "";
   $header_report     = "";
   $header_pages      = "class=\"active\"";


// VOUCHER
}else if($act == "voucher/index"){
   $header_dashboard  = "";
   $header_order      = "";
   $header_customer   = "";
   $header_products   = "";
   $header_promotions = "";
   $header_pages      = "";
   $header_report     = "";
   $header_voucher    = "class=\"active\"";
   

// REPORT
}else if($act == "reports/index" || $act == "reports/sales/items/categories/index" || $act == "reports/sales/items/orders/index" || $act == "reports/inventory/index"){
   $header_dashboard  = "";
   $header_order      = "";
   $header_customer   = "";
   $header_products   = "";
   $header_promotions = "";
   $header_pages      = "";
   $header_report     = "class=\"active\"";
}
?>

<header>

  <div class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">

      <div class="navbar-brand"><img src="<?php echo $prefix_url;?>files/common/logo.png" alt="logo"></div>

      <ul class="nav navbar-nav" role="navigation">
        <li <?php echo $header_dashboard;?>><a href="#">Dashboard</a></li>
        <li <?php echo $header_order;?>><a href="<?php echo $prefix_url;?>order">Orders</a></li>
        <li <?php echo $header_customer;?>><a href="<?php echo $prefix_url;?>customer">Customers</a></li>
        <li <?php echo $header_products;?>><a data-toggle="dropdown" href="#">Products</a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
            <li><a href="<?php echo $prefix_url;?>product">Products</a></li>
            <li><a href="<?php echo $prefix_url;?>stock-manager">Stock Control</a></li>
            <li class="disabled"><a>Attributes</a></li>
            <li><a href="<?php echo $prefix_url;?>category">Categories</a></li>
            <li><a href="<?php echo $prefix_url;?>color">Color Groups</a></li>
            <li><a href="<?php echo $prefix_url;?>size">Size Groups</a></li>
          </ul>
        </li>
        <li <?php echo $header_promotions;?>><a data-toggle="dropdown" href="#">Promotions</a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
            <li><a href="<?php echo $prefix_url;?>new-arrivals">New Arrivals</a></li>
            <li><a href="<?php echo $prefix_url;?>sale">Sale</a></li>
          </ul>
        </li>
        <li><a href="<?php echo $prefix;?>reporting">Reports</a></li>
        <li <?php echo $header_pages;?>><a data-toggle="dropdown" href="#">Pages</a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
            <li><a href="<?php echo $prefix_url;?>home">Home</a></li>
            <li><a href="<?php echo $prefix_url;?>about">About</a></li>
            <li><a href="<?php echo $prefix_url;?>contact">Contact</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right" role="navigation">
        <li class=""><a data-toggle="dropdown" href="#" style="font-size: 18px; padding: 14px 6px 14px 10px"><span class="glyphicon glyphicon-cog"></span></a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
            <li><a href="<?php echo $prefix_url;?>general">General</a></li>
            <li><a href="<?php echo $prefix_url;?>accounts">Account</a></li>
            <li><a href="<?php echo $prefix_url;?>notifications">Notifications</a></li>
            <li><a href="<?php echo $prefix_url;?>payment">Payment</a></li>
            <li><a href="<?php echo $prefix_url;?>shipping">Shipping Methods</a></li>
            <li><a href="<?php echo $prefix_url;?>logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>

    <!--<div class="content">
        <div class="header-top clearfix">
            <div class="logo"></div>
            <h1>Antikode Admin</h1>
            <ul id="utility" onclick="clickSetting()">
                <a href="#"><li class="util-settings"></li></a>
                <li class="util-divider"></li>
                <li class="util-search hidden"></li>
                <li id="hidden-settings">
                    <ul id="children-5" onmouseover="showMenu('5')" class="hidden">
                        <li><a href="<?php echo $prefix_url;?>general">General</a></li>
                        <li><a href="<?php echo $prefix_url;?>accounts">Account</a></li>
                        <li style="width:100%;"><a href="<?php echo $prefix_url;?>shipping/1">Shipping</a></li>
                        <li><a href="<?php echo $prefix_url;?>logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="h-line-container"><div class="h-line"></div></div>
        <nav class="clearfix">
            <ul class="clearfix">
               <li><a href="<?php echo $prefix_url;?>dashboard" <?php echo $header_dashboard;?>>Dashboard</a></li>
               <li><a href="<?php echo $prefix_url;?>order" <?php echo $header_order;?>>Orders</a></li>
               <li><a href="<?php echo $prefix_url;?>customer" <?php echo $header_customer;?>>Customers</a></li>
               
               <li id="parent-1" onmouseover="showMenu('1')"><a href="#" <?php echo $header_products;?>>Products</a>
                    <ul id="children-1" class="hidden">
                        <li id="child-1"><a href="<?php echo $prefix_url;?>product">Products Manager</a></li>
                        <li id="child-2" style="width:100%;" onmouseover="showMenu('2')"><a href="#">Attribute Manager</a>
                            <ul id="grandchild-2" class="hidden">
                                <li><a href="<?php echo $prefix_url;?>category">Category Manager</a></li>
                                <li><a href="<?php echo $prefix_url;?>color">Color Manager</a></li>
                                <li><a href="<?php echo $prefix_url;?>size">Size Manager</a></li>
                                <li><a href="<?php echo $prefix_url;?>designers">Designer Manager</a></li>
                                <li><a href="">Artist Manager</a></li>
                            </ul>
                        </li>
                        <li id="child-7" onmouseover="showMenu('7')"><a href="<?php echo $prefix_url;?>stock-manager">Stock Manager</a></li>
                    </ul>
               </li>
               
               
               <li><a href="<?php echo $prefix_url;?>sale" <?php echo $header_promotions;?>>Promotions</a></li>
               <li><a href="<?php echo $prefix_url;?>order" <?php echo $header_report;?>>Reports</a></li>
               
               
               <li id="parent-2" onmouseover="showMenu('2')"><a href="#" <?php echo $header_pages;?>>Pages</a>
                    <ul id="children-2" class="hidden">
                        <li id="child-9" onmouseover="showMenu('9')"><a href="<?php echo $prefix_url;?>home">Home</a></li>
                        <li id="child-6" onmouseover="showMenu('6')" style="width:100%"><a href="<?php echo $prefix_url;?>about">About</a></li>
                        <li id="child-7" onmouseover="showMenu('7')" style="width:100%"><a href="<?php echo $prefix_url;?>contact">Contact</a></li>
                        
                        
                        <li id="child-8" onmouseover="showMenu('8')" style="width:100%"><a href="<?php echo $prefix_url;?>gallery">Gallery</a></li>
                        
                        <li style="width:100%" id="child-3" onmouseover="showMenu('3')"><a href="#">News</a>
                            <ul id="grandchild-3" class="hidden">
                                <li><a href="<?php echo $prefix_url;?>news-category">Manage Category</a></li>
                                <li><a href="<?php echo $prefix_url;?>news">Manage News</a></li>
                            </ul>
                        </li>
                        
                        <li style="width:100%" id="child-4" onmouseover="showMenu('4')"><a href="#">Recipe</a>
                            <ul id="grandchild-4" class="hidden">
                                <li><a href="<?php echo $prefix_url;?>recipe-category">Manage Category</a></li>
                                <li><a href="<?php echo $prefix_url;?>recipe">Manage Recipe</a></li>
                            </ul>
                        </li>
                        
                        
                    </ul>
               </li>-->
               <!--
               <li><a href="<?php echo $prefix_url;?>voucher-manager" <?php echo $header_voucher;?>>Voucher</a></li>
               <li><a href="<?php echo $prefix_url;?>reporting" <?php echo $header_report;?>>Report</a></li>
               
           
            </ul>
        </nav>
    </div>-->
</header>