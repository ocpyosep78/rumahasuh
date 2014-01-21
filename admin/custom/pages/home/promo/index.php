<?php
include('../../../static/general.php');
include('control.php');
?>

<li class="field-divider"></li>
<li class="field input-file clearfix">
        
        <style>
		#promo-1 { position:relative; z-index:90;}
		#promo-2 { position:relative; z-index:90;}
		</style>
        
    <label>Promo Banners</label>
    <div class="clearfix" style="width: 550px; padding-bottom: 8px">
        <div class="fl image" style="width: 174px; height: 80px" onMouseOver="removeButtonPromo('1')" id="promo-1">
            <div class="hidden" id="remove-promo-1">
               <div class="image-delete" id="btn-promo-1" onClick="clearImagePromo('1')"></div>
               <div class="image-overlay" onClick="openBrowserPromo('1')"></div>
            </div>
            <img class="" id="upload-promo-1" width="174px" src="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/";?><?php $get_promo = get_promo('1'); echo $get_promo['filename'];?>">
            <input type="file" name="upload_promo_1" id="promos-1" onchange="readURLPromo(this,'1')" class="hidden"/>
            <input type="hidden" name="promo_id[]" value="1">
            <input type="hidden" name="promo_flag_1" id="promo-flag-1" value="<?php $get_promo = get_promo('1'); echo $get_promo['filename'];?>">
        </div>
        
        
        <div class="fl image" style="width: 174px; height: 80px" onMouseOver="removeButtonPromo('2')" id="promo-2">
            <div class="hidden" id="remove-promo-2">
               <div class="image-delete" id="btn-promo-1" onClick="clearImagePromo('2')"></div>
               <div class="image-overlay" onClick="openBrowserPromo('2')"></div>
            </div>
            <img class="" id="upload-promo-2" width="174px" src="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/";?><?php $get_promo = get_promo('2'); echo $get_promo['filename'];?>">
            <input type="file" name="upload_promo_2" id="promos-2" onchange="readURLPromo(this,'2')" class="hidden"/>
            <input type="hidden" name="promo_id[]" value="2">
            <input type="hidden" name="promo_flag_2" id="promo-flag-2" value="<?php $get_promo = get_promo('2'); echo $get_promo['filename'];?>">
        </div>
        
    </div>
    <!--<div style="fl">
        <div class="btn grey row" onclick="getFile()" style="margin-right: 5px">Change Image</div>
        <div class="btn red row">Remove</div>
        <div style='height: 0px; width: 0px; overflow:hidden;'>
            <input type="file" id="upfile" name="xxxx" onchange="sub(this)">
        </div>
    </div>-->
    <p class="field-message" style="padding-top: 10px">Recommended dimensions of 300 x 138 px.</p>
</li>



<script>

<?php 
for($i=1;$i<3;$i++){
$get_promo = get_promo($i);

if(empty($get_promo['filename'])){
?>
$("#upload-promo-<?php echo $i;?>").hide();
<?php
} 
}//foreach
?>

function readURLPromo(input,i) {

if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$("#upload-promo-"+i).fadeIn("slow");
$("#upload-promo-"+i).attr('src', e.target.result);
$("#promo-flag-"+i).val('notempty');
}

reader.readAsDataURL(input.files[0]);
}

}

function openBrowserPromo(i){
document.getElementById("promos-"+i).click();
}

function removeButtonPromo(i){
$("#remove-promo-"+i).removeClass("hidden");
$("#remove-promo-"+i).fadeIn("slow");
$("#btn-promo-"+i).attr('style','z-index:1000; position:absolute');

$("#promo-"+i).mouseleave(function(){
$("#remove-promo-"+i).fadeOut("slow");
});
}

function clearImagePromo(i){
$("#upload-promo-"+i).attr('src', '');
$("#upload-promo-"+i).fadeOut("slow");
$("#promo-flag-"+i).val('');
}
</script>