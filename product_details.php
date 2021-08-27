<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/str_convert.php';
include_once 'head.php';



if(!empty($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){
    if(empty($_POST['g-recaptcha-response'])){
        $_SESSION['session_msg'] = '<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
        style="position:relative; top:-2px;">×</a>
        Please fill in captcha.</div>';
    }else{

        $to      = 'info@sepandco.com.my';
        $subject = 'Website Enquiry';
        $headers[] = 'From: sepandco.com.my';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $message = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.$subject.'</title>
        </head>
        <body>
            Dear Staff,
            '.$_POST['name'].' sent a message to you from sepandco.com.my. You can login CMS to view or view below:<br><br>            
            Name: '.$_POST['name'].'<br><br>
            Product: '.$_POST['product'].'<br><br>
            Email: '.$_POST['email'].'<br><br>
            Message: '.$_POST['message'].'<br><br>
        </body>
        </html>';
        
        unset($_POST['submit'], $_POST['g-recaptcha-response']);
        $_POST['status'] = 'New';
        $_POST['date'] = date('Y-m-d H:i:s');
        if(sql_save('message', $_POST)){

            $_SESSION['session_msg'] = '<div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
            style="position:relative; top:-2px;">×</a>
            Thank you for sent us the message, we will reply you through email soon.</div>';

            mail($to, $subject, $message, implode("\r\n", $headers));
        }
        
    }
}

?>



<html lang="en">

<body class="container-fluid p-0">
    <div class="my-container">

        <?php include 'header.php';?>
        <div style="height:66px;">
            <div class="page_title">
                Product
            </div>
        </div>

        <div class="row"><div class="col-12"><br></div></div>
        
        <?php 
        if(!empty($_GET['p'])){
            $product_name = $str_convert->to_query($_GET['p']);
            $product = sql_read("select * from product where status=1 and name like ? limit 1", 's', '%'.$product_name.'%');
            $photos = sql_read("select * from photos where parent_table=? and parent_id=?", 'si', array('product', $product['id']));
      
        }
        ?>
        <div class="row wave_rec">
            <div class="col-12">
                <div class="p-2">
                    <a href="../product" style="text-decoration:none;">
                        <i class="fa fa-chevron-circle-left" aria-hidden="true" style="font-size:28px; opacity:.3; vertical-align: middle;"></i>
                        Back to Listing
                    </a>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">

                            <?php 
                            if(empty($_GET['p'])){?>
                                <div class="col-12">No product found</div>
                            <?php }else{?>
                                <div class="col-12 col-md-7">
                                    <img src="<?php echo ROOT.$product['photo'];?>" class="img-fluid pro-bg">
                                </div>
                                <div class="col-12 col-md-5 p-4 p-md-2 pr-md-5 text-left">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-2 bg-cover pro-thum" style="height:calc(100vh / 9);;background-image:url('<?php echo ROOT.$product['photo'];?>');"></div>
                                                <?php foreach((array)$photos as $photo){?>
                                                <div class="col-2 bg-cover pro-thum" style="height:calc(100vh / 9);;background-image:url('<?php echo ROOT.$photo['photo'];?>');"></div>
                                                <?php }?>
                                                <script>
                                                $('.pro-thum').hover(function(){
                                                    switch_photo(this);
                                                });
                                                $('.pro-thum').click(function(){
                                                    switch_photo(this);
                                                });
                                                function switch_photo(target){
                                                    var bg = $(target).css('background-image');
                                                    var bg_to_src = bg.replace('url("','').replace('")','');
                                                    $('.pro-bg').attr('src', bg_to_src);
                                                }
                                                </script>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(!empty($product['name'])){?>
                                        <div class="row">
                                            <h4 class="p-3 pt-0 p-md-2"><?php echo $product['name'];?></h4>
                                        </div>
                                    <?php }?>
                                    <?php if(!empty($product['location'])){?>
                                        <div class="row">
                                            <div class="col-5">Location</div>
                                            <div class="col-7"><?php echo $product['location'];?></div>
                                        </div>
                                    <?php }?>
                                    <?php if(!empty($product['size'])){?>
                                        <div class="row">
                                            <div class="col-5">Size</div>
                                            <div class="col-7"><?php echo $product['size'];?><span style="color:#999;">ft²</span>
                                            </div>
                                        </div>
                                    <?php }?>
                                    <?php if(!empty($product['new'])){?>
                                        <div class="row">
                                            <div class="col-5">New</div>
                                            <div class="col-7"><?php echo $product['new'];?></div>
                                        </div>
                                    <?php }?>
                                    <?php if(!empty($product['bedrooms'])){?>
                                        <div class="row">
                                            <div class="col-5">Bedrooms</div>
                                            <div class="col-7"><?php echo $product['bedrooms'];?></div>
                                        </div>
                                    <?php }?>
                                    <?php if(!empty($product['bathrooms'])){?>
                                        <div class="row">
                                            <div class="col-5">Bathrooms</div>
                                            <div class="col-7"><?php echo $product['bathrooms'];?></div>
                                        </div>
                                    <?php }?>
                                    <?php if(!empty($product['description'])){?>
                                        <div class="row">
                                            <div class="col-12 pt-4">
                                                <?php 
                                                $product['description'] = str_replace(array('../../', '<img'), array(ROOT, '<img class="img-fluid"'), $product['description']);                
                                                echo $product['description'];?>                                    
                                            </div>
                                        </div>
                                    <?php }?>


                                    <div class="row"><div class="col-12"><br></div></div>
                                    <div class="row">
                                        <div class="col-12 p-2 pl-4 pr-4">
                                            <h1>Leave a message</h1>
                                        </div>
                                    </div>
                                    <form action="" class="form-group" method="post">
                                        <div class="row">
                                            <div class="col-12 p-2 pl-4 pr-4">
                                                <input type="text" name="product" value="<?php echo $product['name'];?>" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 p-2 pl-4 pr-4">
                                                <input type="text" name="name" placeholder="Name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 p-2 pl-4 pr-4">
                                                <input type="email" name="email" placeholder="Email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 p-2 pl-4 pr-4">
                                                <input type="text" name="contact" placeholder="Contact number" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 p-2 pl-4 pr-4">
                                                <textarea type="text" name="message" placeholder="Message" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 p-2 pl-4 pr-4">
                                                <div id="recaptcha" title="no"></div>
                                            </div>
                                        </div>

                                        

                                        <div class="row">
                                            <div class="col-12 p-2 pl-4 pr-4">
                                                <input type="submit" name="submit" value="Send Message" class="btn btn-primary pl-4 pr-4">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php }?>

                        </div>
                    </div>
                    

                </div>             
            </div>            
        </div>
   
    </div>


    <div class="row">
        <div class="col-12">
            <div class="row"><div class="col-12"><br><br><br><br><br></div></div>
            <? include 'footer.php';?>        
        </div>
    </div>                
            

</body>

</html>
<?php include 'config/session_msg.php';?>
