<?php 
include_once 'head.php';

$contact_us = sql_read("select * from contact_us where id = ? limit 1", 'i', 1);




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
            <title>Document</title>
        </head>
        <body>
            Dear Staff,
            '.$_POST['name'].' sent a message to you from sepandco.com.my. You can login CMS to view or view below:<br><br>
            Company/Organisation: '.$_POST['company'].'<br><br>
            Name: '.$_POST['designation'].' '.$_POST['name'].'<br><br>
            Property: '.$_POST['property'].'<br><br>
            Email: '.$_POST['email'].'<br><br>
            Address: '.$_POST['address'].'<br><br>
            Message: '.$_POST['message'].'<br><br>
        </body>
        </html>';
        
        unset($_POST['submit'], $_POST['g-recaptcha-response']);
        $_POST['status'] = 'New';
        $_POST['date'] = date('Y-m-d H:i:s');
        if(sql_save('message_contact', $_POST)){

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
                Contact Us
            </div>
        </div>
        <div class="row wave_rec">        
            <div class="col-12 p-4">
                <div class="row">
                    <div class="col-12 col-md-7 p-4">
                        <?php
                        $contact_us['content'] = str_replace(array('../../', '<img'), array(ROOT, '<img class="img-fluid"'), $contact_us['content']);                
                        echo $contact_us['content'];?>
                    </div>
                    <div class="col-12 col-md-4 offset-md-1">

                        <div class="row"><div class="col-12"><br></div></div>
                        <div class="row">
                            <div class="col-12 p-2 pl-4 pr-4">
                                <h1>Contact Us</h1>
                            </div>
                        </div>
                        <form action="" class="form-group" method="post">
                            <div class="row">
                                <div class="col-12 p-2 pl-4 pr-4">
                                    <input type="text" name="company" placeholder="Company / Organisation" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-2 pl-4 pr-4">
                                    <select name="designation" class="form-control">
                                        <option value="Mr.">Mr.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Mdm.">Mdm.</option>
                                        <option value="Dr.">Dr.</option>
                                    </select>
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
                                    <input type="text" name="address" placeholder="Address" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-2 pl-4 pr-4">
                                    <input type="text" name="contact" placeholder="Contact number" class="form-control">
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

