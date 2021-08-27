<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'config/session_msg.php';
?>
<script src="js/jquery-3.5.0.js"></script>
<script src="js/functions.jquery.js"></script>

<?php 
if(!empty($_SESSION['auth_user']['id'])){

    $data = array();
    $data['id'] = $_SESSION['auth_user']['id'];
    $usethis = 'USE THIS';
    $usebtn = 'checkout-address-not-in-use-btn';
    $useedit = 'checkout-delivery-not-in-use-edit';
    if(!empty($_POST['address'])){
        $data['address'] = $_POST['address'];
        $change_address = 'change_address1';
        $modal = '#editAddressModal';
        $add_option = '1';
        if(!empty($_POST['area'])){
            $area_id = $data['area'] = $defender->encrypt('decrypt', $_POST['area']);
        }
        if($_SESSION['address'] == 1){
            $usethis = 'IN USE';
            $usebtn = 'checkout-address-in-use-btn';
            $useedit = 'checkout-delivery-in-use-edit';
        }
    }elseif(!empty($_POST['address2'])){
        $data['address2'] = $_POST['address2'];
        $change_address = 'change_address2';
        $modal = '#editAddressModal2';
        $add_option = '2';
        if(!empty($_POST['area'])){
            $area_id = $data['area2'] = $defender->encrypt('decrypt', $_POST['area']);
        }
        if($_SESSION['address'] == 2){
            $usethis = 'IN USE';
            $usebtn = 'checkout-address-in-use-btn';
            $useedit = 'checkout-delivery-in-use-edit';
        }
    }
    

    if(sql_save('member', $data)){
        $auth_user = sql_read('select * from member where id=? limit 1', 's', $data['id']);
        $_SESSION['auth_user'] = $auth_user;
        $_SESSION['area'] = $data['area'];
    }
    
    $area = sql_read('select area from area where id=? limit 1', 's', $area_id);

}
?>
<?php /*

<div class="col-12 col-sm-12 col-md-9 col-lg-9">
    <p><?php echo $data['address'].$data['address2']?></p>
</div>
<div class="col-12 col-sm-12 col-md-3 col-lg-3">
<button type="button"
    class="btn <?php echo $usebtn?> btn-block p-2 text-center <?php echo $change_address?> navigator" nav-target="#session_address" nav-link="session_address.php" nav-post='{"address":"<?php echo $add_option?>"}'><?php echo $usethis?></button>
</div>
<div class="col-12 col-sm-12 col-md-9 col-lg-9">
    <p>Area: <?php echo $area['area']?></p>
</div>
<div
class="col-12 col-sm-12 col-md-3 col-lg-3 <?php echo $useedit?> edit-use text-center">
<a data-toggle="modal" data-target="<?php echo $modal?>" href=#>Edit</a>
</div>


<script>
$('.change_address1').click(function(){
    $('.change_address1').text('IN USE');
    $('.change_address1').removeClass('checkout-address-not-in-use-btn');
    $('.change_address1').addClass('checkout-address-in-use-btn');
    $('.address-block-1').addClass('checkout-address-in-use');
    $('.address-block-1').removeClass('checkout-address-not-in-use');
    $('.address-block-1 .edit-use').addClass('checkout-delivery-in-use-edit');
    $('.address-block-1 .edit-use').removeClass('checkout-delivery-not-in-use-edit');

    $('.change_address2').text('USE THIS');
    $('.change_address2').removeClass('checkout-address-in-use-btn');
    $('.change_address2').addClass('checkout-address-not-in-use-btn');
    $('.address-block-2').addClass('checkout-address-not-in-use');
    $('.address-block-2').removeClass('checkout-address-in-use');
    $('.address-block-2 .edit-use').addClass('checkout-delivery-not-in-use-edit');
    $('.address-block-2 .edit-use').removeClass('checkout-delivery-in-use-edit');
})
$('.change_address2').click(function(){
    $('.change_address2').text('IN USE');
    $('.change_address2').removeClass('checkout-address-not-in-use-btn');
    $('.change_address2').addClass('checkout-address-in-use-btn');
    $('.address-block-2').addClass('checkout-address-in-use');
    $('.address-block-2').removeClass('checkout-address-not-in-use');
    $('.address-block-2 .edit-use').addClass('checkout-delivery-in-use-edit');
    $('.address-block-2 .edit-use').removeClass('checkout-delivery-not-in-use-edit');

    $('.change_address1').text('USE THIS');
    $('.change_address1').removeClass('checkout-address-in-use-btn');
    $('.change_address1').addClass('checkout-address-not-in-use-btn');
    $('.address-block-1').addClass('checkout-address-not-in-use');
    $('.address-block-1').removeClass('checkout-address-in-use');  
    $('.address-block-1 .edit-use').addClass('checkout-delivery-not-in-use-edit');
    $('.address-block-1 .edit-use').removeClass('checkout-delivery-in-use-edit');
})
</script>

*/?>