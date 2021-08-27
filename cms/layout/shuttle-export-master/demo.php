<?php 
include ('dumper.php');

try {
	$world_dumper = Shuttle_Dumper::create(array(
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'db_name' => 'kuchingig',
	));

	// dump the database to gzipped file
	//$world_dumper->dump('world.sql.gz');

	// dump the database to plain text file
	$world_dumper->dump('shuttle-export-master/backup_db/database.'.date("Ymdhis").'.txt');
/*
	$wp_dumper = Shuttle_Dumper::create(array(
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'db_name' => 'ocs',
	));

	// Dump only the tables with wp_ prefix
	$wp_dumper->dump('wordpress.sql', 'wp_');
	
	$countries_dumper = Shuttle_Dumper::create(array(
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'db_name' => 'ocs',
		'include_tables' => array('area'), // only include those tables
	));
	$countries_dumper->dump('world.sql.gz');

	$world_dumper = Shuttle_Dumper::create(array(
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'db_name' => 'ocs',
		'exclude_tables' => array('area'), 
	));
	$world_dumper->dump('world-no-cities.sql.gz');
*/
} catch(Shuttle_Exception $e) {
	echo "Couldn't dump database: " . $e->getMessage();
}