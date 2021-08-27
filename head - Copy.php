<?php
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';



$regions = sql_read('select * from region where status=1 order by position asc, region asc');
$areas = sql_read('select * from area where status=1 order by position asc, area asc');
$locations = sql_read('select * from location where status=1 order by position asc, location asc');
$categories = sql_read('select * from category where status=1 order by position asc, category asc');


if(!empty($_GET['r'])){
    $region_id = $defender->encrypt('decrypt', $_GET['r']);
    $checkregion = sql_read('select * from region where status=1 AND id=? limit 1', 's', $region_id);
    if(!empty($checkregion['region'])){
        $_SESSION['region'] = $checkregion['id'];
    }
}


if(!empty($_SESSION['region'])){
    $region = sql_read('select * from region where status=1 AND id=? limit 1', 's', $_SESSION['region']);
    //Currently client has only one store location. FL decided, system will pick the LAST location of region only, even CMS allow to create more location.

}else{
    $region = sql_read('select * from region where status=1 ORDER BY id asc limit 1');
    $_SESSION['region'] = $region['id'];
}

$last_location = sql_read('select * from location where status=1 AND region=? ORDER BY id desc LIMIT 1', 's', $_SESSION['region']);
if(!empty($last_location['id'])){
    $_SESSION['location'] = $last_location['id'];
}

if(!empty($_SESSION['region'])){
    $region_areas = sql_read('select * from area where status=1 and region=? order by position asc, area asc', 's', $_SESSION['region']);
}

$items = sql_read('
    select i.product, i.product_id, i.uom, i.uom_id, i.quantity, i.unit_price, i.total_price, b.brand, sp.stock   
    from items as i 
    INNER JOIN product AS p ON p.id = i.product_id 
    INNER JOIN stock_promo AS sp ON sp.uom = i.uom_id AND sp.location = ?     
    join brand as b on b.id = p.brand     
    where session=? AND region_id=? AND location_id=? 
', 'ssss', array($_SESSION['location'], session_id(), $_SESSION['region'], $_SESSION['location']));



$items_id_qty = array();
if(@count($items)){
    foreach((array)$items as $ikey => $item){
            
        $enc_uom_id = $defender->encrypt('encrypt', $item['uom_id']);
        $items_id_qty[$enc_uom_id] = $item['quantity'];//A simple array like array('encrypted_id' => 'quantity');
        
        $photo = sql_read('select * from photos where status=1 AND product =? ORDER BY position asc, id asc limit 1', 's', $item['product_id']);

        if($photo['photo']){
            $items[$ikey]['photo'] = $photo['photo'];
        }else{
            $items[$ikey]['photo'] = '';
        }    
    }
}


if(!function_exists('mobile_format')){
    function mobile_format($number = null){
        if(!empty($number)){
            $number = substr($number,0,3).'-'.substr($number,3,3).' '.substr($number,6,4);
        }
        return $number;
    }
}


if(!function_exists('get_checkout_rebatible')){

    function get_checkout_rebatible($items, $total_rebatible){

        $max_rebate = 0.3;
        $final_rebatible = 0;
        

        if(@count($items)>0){
            foreach((array)$items as $item){
                $total_price += $item['total_price'];
            }
        }
        
        if($total_price>0){
        
            $max_redatible = $total_price*$max_rebate;
        
            if($total_rebatible >= $max_redatible){
                $final_rebatible = $max_redatible;
            }else{
                $final_rebatible = $total_rebatible;
            }  
        }
        
        if($final_rebatible < 0) $final_rebatible = 0;

        return number_format($final_rebatible,2,'.',',');

    }
}


if(!function_exists('get_total_rebatible')){

    function get_total_rebatible(){

        $total_rebatible = 0;

        if(@$_SESSION['auth_user']['id']){

            $rebates = sql_read("select rebate_earned, rebate_used from orders where member=? and payment_status='Paid'", 's', $_SESSION['auth_user']['id']);

            if(@count($rebates)>0){
                foreach((array)$rebates as $rebate){
                    $total_rebatible += $rebate['rebate_earned'];
                    $total_rebatible -= $rebate['rebate_used'];
                }
            }
        }

        if($total_rebatible < 0) $total_rebatible = 0;

        return number_format($total_rebatible,2,'.',',');
    }
}



if(!function_exists('item_total')){

    function item_total($total = 0){

        global $items;        

        if(@count($items)){
            foreach((array)$items as $i){
                $total += $i['total_price'];
            }
        }
        return number_format($total,2,'.',',');
    }
}


if(!function_exists('shipping_fee')){

    function shipping_fee(){

        if($_SESSION['delivery_method'] == 'deliver'){
            $shipping_fee = sql_read('select price from area where id=? limit 1', 's', $_SESSION['area']);
            return $shipping_fee['price'];
        }
    }
}



if(!function_exists('final_total')){

    function final_total($item_total, $shipping_fee, $final_rebatible){
       
        $final_total = 0;
        if($item_total>0){
            $final_total = $item_total + $shipping_fee;
        }

        if($_SESSION['rebate'] == 'yes'){
            $final_total = $final_total - $final_rebatible;
        }
        
        return number_format($final_total,2,'.',',');
    }
}


if(!function_exists('rebated_total')){

    function rebated_total($total = null){

        global $items;
        $total = 0;

        if(@count($items)){
            foreach((array)$items as $i){
                $total_price += $i['total_price'];
            }
        }
        return number_format($total,2,'.',',');
    }
}



if(!function_exists('get_products')){

    function get_products($filter = null, $value = null, $sort = null){

        global $_SESSION, $conn;
        $products = array();
        
        
        if(!empty($_SESSION['region']) && !empty($_SESSION['location'])){        

            if($sort == 'price_asc'){
                $uom_sort = ' ORDER BY uom.price ASC';
            }elseif($sort == 'price_desc'){
                $uom_sort = ' ORDER BY uom.price DESC';
            }

            $params = array();
            $_SESSION['error_location'] = $params[] = $_SESSION['location'];
            $_SESSION['error_region'] = $params[] = $_SESSION['region'];
            $uom_cond = $prod_cond = "";
            
            if($filter == 'best_deals'){
                $prod_cond = " AND p.best_deals='Yes' ";              
            }elseif($filter == 'best_sellers'){
                $prod_cond = " AND p.best_sellers='Yes' ";
            }elseif($filter == 'recommended'){
                $prod_cond = " AND p.recommended='Yes' ";
            }elseif($filter == 'category'){
                //prepared statement method not working in joined table
                $prod_cond = " AND p.category = ".mysqli_real_escape_string($conn, $value);    
            }elseif($filter == 'sub_category'){               
                $prod_cond = " AND p.sub_category= ".mysqli_real_escape_string($conn, $value);
            }elseif($filter == 'keyword' && !empty($value)){
                $prod_cond = " AND p.product_name LIKE '%".mysqli_real_escape_string($conn, $value)."%'";
            }



            $_SESSION['error'] = $query = "
                SELECT 
                    uom.id AS uom, uom.price AS price, uom.uom AS uom_name, 
                    p.id, p.product_name, p.region, p.brand, p.category AS category_id, 
                    p.sub_category AS sub_category_id, p.brand AS brand_id, p.sku, p.product_name, 
                    p.seo_title, p.seo_keyword, p.seo_description, p.viewed, 
                    p.best_deals, p.best_sellers, p.recommended, p.description, 
                    sp.stock, sp.promo, sp.was, c.category, sc.sub_category, brand.brand 
                FROM uom 
                INNER JOIN product AS p ON p.id = uom.product AND p.status=1 ".$prod_cond." 
                INNER JOIN stock_promo AS sp ON sp.uom = uom.id AND sp.location = ? 
                JOIN brand ON brand.id = p.brand 
                JOIN category AS c ON c.id =  p.category 
                JOIN sub_category AS sc ON sc.id = p.sub_category 
                WHERE uom.status=1 AND uom.price >0 AND uom.region=? ".$uom_sort." 
            ";
            $_SESSION['params'] = implode(',', $params);
            $uoms = sql_read($query, null, $params);
           
            
            $count_uoms = @count($uoms);
            
            if($count_uoms>0){
                foreach((array)$uoms as $uom){                            
                    $photos = sql_read('select * from photos where status=1 AND product =? ORDER BY position asc, id asc', 's', $uom['id']);
                    if(!is_array($photos)){
                        $photos = '';
                    }
                    $products[] = array_merge($uom, array('photos'=>$photos));            
                }

                if($sort == 'alphabet_asc' || $sort == 'alphabet_desc'){

                    $products_tmp = $products;
                    $products = $sorted_price = array();

                    foreach((array)$products_tmp as $pk => $pv){
                        $sorted_price[$pk] = $pv['product_name'];
                    }
 
                    if($sort == 'alphabet_asc'){
                        asort($sorted_price);
                    }else{         
                        arsort($sorted_price);
                    }

                    foreach((array)$sorted_price as $sk => $sv){
                        $products[] = $products_tmp[$sk];
                    }
                }

            }

        }
        return $products;
    }
}


?>


<head>
    <title>GROCERe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/custom.css" rel="stylesheet" />
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
<?php /*
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    
*/?>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/4.3.1/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.5.0.js"></script>
  
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="fontawesome/css/solid.css">
    <link rel="stylesheet" href="fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="css/animate.css">


    <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false
 || strpos($_SERVER['HTTP_USER_AGENT'], 'CriOS') !== false) {?>
    <link rel="stylesheet" href="css/custom-chrome.css">
    <?php }?>

<?php /*

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-169836269-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-169836269-1');
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-W9CZPT2');</script>
    <!-- End Google Tag Manager -->

    
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W9CZPT2"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1656914081130407');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1656914081130407&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->

*/?>

</head>