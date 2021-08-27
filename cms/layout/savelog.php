<?php



if(!empty($_POST) && !empty($_SESSION['user_id'])){
    $action = 'save data';
    if(!empty($_POST['action'])){
        $action = 'delete data';
    }
    $u = readFirst($conn, 'login', "id='".$_SESSION['user_id']."'");		
    $url = 'http'.$_SERVER['SERVER_NAME'].'/'.$_SERVER['REQUEST_URI'];
    if(!empty($u)){	
        $whoDoWhatWhere = 'login:'.$u['id'].':'.$u['name'].' '.$action.' at '.$url;
        mysqli_query($conn, "INSERT INTO visitors (user, login_logout) VALUES ('$whoDoWhatWhere','$action')");
    }
}

?>