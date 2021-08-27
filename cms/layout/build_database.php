<?php 
require_once '../../config/ini.php';


$fields = array();


    $sql = "CREATE DATABASE $DB->database";
    $conn->query($sql);

    mysqli_select_db($conn, $DB->database);	

    $conn->query("
        CREATE TABLE `login` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `group_id` int(11) NULL DEFAULT NULL,
        `location` int(11) NULL DEFAULT NULL,
        `name` varchar(200) NULL DEFAULT NULL,
        `email` varchar(255) NULL DEFAULT NULL,
        `username` varchar(150) NULL DEFAULT NULL,
        `password` varchar(100) NULL DEFAULT NULL,
        `temp_password` varchar(100) NULL DEFAULT NULL,
        `status` int(11) NULL DEFAULT NULL,
        `created` datetime DEFAULT NULL,
        `modified` datetime DEFAULT NULL,
        PRIMARY KEY (id)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
    ");

    $conn->query("
    CREATE TABLE `visitors` (
        `id` int(11) NOT NULL,
        `user` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
        `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
        `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
        `previous_url` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
        `login_logout` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
        `created` datetime DEFAULT NULL,
        PRIMARY KEY (id)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
    ");


    $conn->query("
        INSERT INTO `login` (`id`, `group_id`, `location`, `name`, `email`, `username`, `password`, `temp_password`, `status`, `created`, `modified`) VALUES
        (1, 1, 5, 'Administrator', 'jonathan.wphp@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 1, '2020-07-30 14:31:35', '2020-09-04 15:47:13');
    ");




function build_table($table, $fields, $type){

    global $conn;

    unset($fields[0]);
    unset($type['id']);

    echo '<br>---------'.$table.'--------<br>';
    //print_r($fields);
    //print_r($type);

    $query = "
        CREATE TABLE $table (
        id int(11) NOT NULL AUTO_INCREMENT,";
    
    foreach((array)$fields as $field){

        $type = "varchar(255)";

        if(@$type[$field] == 'number' || @$field == 'position'){
            $type = "int(11)"; 
        }elseif(@$type[$field] == 'textarea' ){
            $type = "longtext"; 
        }
        
        $query .= "
            $field $type NULL DEFAULT NULL,
        ";
    }
    
    $query .= "
        created datetime DEFAULT NULL,
        modified datetime DEFAULT NULL,
        PRIMARY KEY (id)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
        ";

    echo $query;


    $conn->query($query);

}



$_POST['get_config_only'] = 'true';
$folders = array('content', 'account', 'property', 'layout');
$modules = array('category.php', 'property.php', 'developer.php', 'banner.php', 'home_block.php', 'photos.php'

, 'contact_us.php'
);

foreach((array)$folders as $folder){

    $files = scandir('../'.$folder);
    $i = 1;

    foreach((array)$files as $file){
    
        if(in_array($file, $modules)){
            if(strpos($file, '.php') !== false){

                include '../'.$folder.'/'.$file;

                ${"table$i"} = $table;        
                ${"fields$i"} = $fields;
                ${"type$i"} = $type;

                build_table(${"table$i"}, ${"fields$i"}, ${"type$i"});

                $i++;

            }
        }
        //
    }
}


?>