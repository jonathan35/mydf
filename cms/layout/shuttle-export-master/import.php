<?php 
if(!empty($_FILES)){
	$uploads_dir = 'shuttle-export-master/import_db/';
	$tmp_name = $_FILES["sql_file"]["tmp_name"];
	$name = basename($_FILES["sql_file"]["name"]);
	if(move_uploaded_file($tmp_name, "$uploads_dir/$name")){
		echo 'Move upload done';	
	}
}

$sql = file_get_contents("$uploads_dir/$name");
$db_name = 'kuchingig';
$mysqli = new mysqli("localhost", "root", "", $db_name);


$tables_q = mysqli_query($conn, "SELECT table_name FROM information_schema.tables WHERE table_schema = '".$db_name."'");

while($tables = mysqli_fetch_assoc($tables_q)){
	mysqli_query($conn, "DROP TABLE IF EXISTS ".$tables['table_name']);
};




if (mysqli_connect_errno()) { /* check connection */
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* execute multi query */
if ($mysqli->multi_query($sql)) {
    echo "success";
} else {
   echo "error";
}

?>