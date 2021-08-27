<?php
require_once 'config/ini.php';
require_once 'config/security.php';

$regions = sql_read('select * from region where status=1');
$locations = sql_read('select * from location where status=1');
$categories = sql_read('select * from category where status=1');


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
    $region = sql_read('select * from region where status=1 order by id asc limit 1');
    $_SESSION['region'] = $region['id'];
}

$last_location = sql_read('select * from location where status=1 AND region=? order by id desc LIMIT 1', 's', $_SESSION['region']);
if(!empty($last_location['id'])){
    $_SESSION['location'] = $last_location['id'];
}



$items = sql_read('select * from items where session=? AND region_id=? AND location_id=?', 'sss', array(session_id(), $_SESSION['region'], $_SESSION['location']));






//debug($last_location);
//debug($categories);

if(!function_exists('get_products')){

    function get_products($filter = null, $value = null, $sort = null){

        global $_SESSION;
        $products = array();
        $_SESSION['error'] = 'error:';
        
        if(!empty($_SESSION['region']) && !empty($_SESSION['location'])){
        

            if(empty($sort)){
                $sort_sql = ' order by id DESC';
            }elseif($sort == 'alphabet_asc'){
                $sort_sql = ' order by product_name ASC';
            }elseif($sort == 'alphabet_desc'){
                $sort_sql = ' order by product_name DESC';
            }else{
                $sort_sql = '';
            }

        
            if($filter == 'best_deals'){
                $prods = sql_read("select * from product where status=1 AND region=? AND best_deals='Yes' ".$sort_sql, 's', $_SESSION['region']);
            }elseif($filter == 'best_sellers'){
                $prods = sql_read("select * from product where status=1 AND region=? AND best_sellers='Yes'".$sort_sql, 's', $_SESSION['region']);
            }elseif($filter == 'recommended'){
                $prods = sql_read("select * from product where status=1 AND region=? AND recommended='Yes'".$sort_sql, 's', $_SESSION['region']);
            }elseif($filter == 'category'){
                $prods = sql_read("select * from product where status=1 AND region=? AND category=?".$sort_sql, 'ss', array($_SESSION['region'], $value));
            }elseif($filter == 'sub_category'){
                $prods = sql_read("select * from product where status=1 AND region=? AND sub_category=?".$sort_sql, 'ss', array($_SESSION['region'], $value));
            }elseif($filter == 'keyword' && !empty($value)){
                $keyword = '%'.$value.'%';
                $prods = sql_read("select * from product where status=1 AND region=? AND product_name LIKE ?".$sort_sql, 'ss', array($_SESSION['region'], $keyword));
            }else{
                $prods = sql_read("select * from product where status=1 AND region=? ".$sort_sql);
            }

            
            if(@count($prods)>0){
                $_SESSION['error'] .= '. count with '.count($prods);

                foreach((array)$prods as $prod){
                    
                    $sql_uoms = sql_read("select * from uom where status=1 AND price >0 AND product = ? AND region=?", 'ss', array($prod['id'], $_SESSION['region']));
                            
                    $photos = sql_read('select * from photos where status=1 AND product =? order by position asc, id asc', 's', $prod['id']);
                    if(!is_array($photos)){
                        $photos = '';
                    }
                    
                    $_SESSION['error'] .= '-(-'.$sql_uoms.'-)';

                    if(@count($sql_uoms)>0){
                        foreach((array)$sql_uoms as $sql_uom){                
                            
                            $stock = sql_read('select * from stock_promo where stock > 0 AND uom = ? AND location=? order by modified desc limit 1', 'ss', array($sql_uom['id'], $_SESSION['location']));
                            if(!is_array($stock)){
                                $stock = '';
                            }
            
                            if(!empty($stock['stock'])){
                                $products[] = array_merge(
                                    $prod, 
                                    array(
                                        'uom'=>$sql_uom['id'], 
                                        'uom_name'=>$sql_uom['uom'], 
                                        'price'=>$sql_uom['price'], 
                                        'stock'=>$stock['stock'], 
                                        'promo'=>$stock['promo'], 
                                        'was'=>$stock['was'],
                                        'photos'=>$photos
                                    ),
                                    
                                );
                            }
                        }
                    }
            
                }


                if($sort == 'price_asc' || $sort == 'price_desc'){

                    $products_tmp = $products;
                    $products = $sorted_price = array();

                    foreach((array)$products_tmp as $pk => $pv){
                        $sorted_price[$pk] = $pv['price'];
                    }
 
                    if($sort == 'price_asc'){
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

</head>