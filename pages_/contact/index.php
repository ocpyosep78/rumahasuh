<?php
if(isset($_POST['btn_contact'])){
   
   if($_POST['btn_contact'] == "Submit"){
   
      //send mail
      $_POST['message'] = removeHtmlTags($_POST['message']);

      $name      = $_POST['contact_name']; 
      $email     = $_POST['email']; 
      $recipient = $info['email']; 
      $mail_body = preg_replace("/\n/","\n<br>",$_POST['message']);;
      $subject   = "[".$general['website_title']."] ".$_POST['subject']; 
      $headers   = "Content-Type: text/html; charset=ISO-8859-1\r\n".
      $headers  .= "From: ". $name . " <" . $email . ">\r\n";

      mail($recipient, $subject, $mail_body, $headers);
	  
	  $_SESSION['alert'] = "success";
	  $_SESSION['msg']   = "Thank you! We will review your email as soon as possible.";
   }
   
}
?>

<style>
.has-error { border:1px solid #d15656;}
</style>


    <div class="container main">
      <div class="content">

        <div class="row">

          <?php include("static/navbar-2.php");?>

          <div class="col-xs-10 m_t_10">

          
            <h2 class="m_b_20 text-right">Contact</h2>

            <div class="row">
          

              <div class="col-xs-4">
                <strong>Rumah Asuh</strong><br>
                Jl. Palem Puri No. 7 RT 003/006<br>
                Serua Poncol - Sawah Baru<br>
                Bintaro Sektor IX Tangerang 15413<br>
                <br>
                p/ (62-21) 7457797, 7456697<br>
                f/ (62--21) 7458922<br>
                e/ rumahasuh@gmail.com
              </div>
              
              <div class="col-xs-8">

                <?php 
                // ALERT NOTIFICATION
                
                if(!empty($_SESSION['alert'])){
                   echo '<div class="alert alert-'.$_SESSION['alert'].'">'.$_SESSION['msg'].'</div>';
                }
                
                if($_POST['btn_contact'] == ""){
                   unset($_SESSION['alert']);
                   unset($_SESSION['msg']);
                }
                ?>

                <form role="form" method="post">
                  <div class="form-group row">
                    <label class="col-xs-3 hidden">Name</label>
                    <div class="col-xs-12">
                      <input type="text" class="form-control" name="contact_name" id="id_contact_name" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-xs-3 hidden">Email</label>
                    <div class="col-xs-12">
                      <input type="email" class="form-control" name="contact_email" id="id_contact_email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-xs-3 hidden">Subject</label>
                    <div class="col-xs-12">
                      <input type="text" class="form-control" name="contact_subject" id="id_contact_subject" placeholder="Subject">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-xs-3 hidden">Message</label>
                    <div class="col-xs-12">
                      <textarea class="form-control" rows="5" name="contact_msg" id="id_contact_msg" placeholder="Message"></textarea>
                    </div>
                  </div>
                  <input type="button" class="btn btn-default pull-right " value="Submit" onclick="validation()" id="btn_alias">
                  <input type="submit" class="hidden" value="Submit" name="btn_contact" id="id_btn_contact">
                </form>

              </div><!--.col-xs-6-->

            </div><!--.row-->

          </div>
        </div><!--.row-->

      </div><!--.content-->
    </div><!--.container.main-->
    
<script src="<?php echo $prefix_url.'script/contact.js'?>"></script>
