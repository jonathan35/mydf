<?php 
require_once '../../config/ini.php'; 


if($_POST['table']){
	
	$select = "SELECT * FROM ".$_POST['table'];
	
	$export = mysqli_query ($conn, $select ) or die ( "Sql error : " . mysqli_error( ) );
	
	$fields = mysqli_num_fields ($conn, $export );
	
	for ( $i = 0; $i < $fields; $i++ )
	{
		$header .= mysqli_field_name($conn, $export , $i ) . "\t";
	}
	
	while( $row = mysqli_fetch_row( $export ) )
	{
		$line = '';
		foreach( $row as $value )
		{                                            
			if ( ( !isset( $value ) ) || ( $value == "" ) )
			{
				$value = "\t";
			}
			else
			{
				$value = str_replace( '"' , '""' , $value );
				$value = '"' . $value . '"' . "\t";
			}
			$line .= $value;
		}
		$data .= trim( $line ) . "\n";
	}
	$data = str_replace( "\r" , "" , $data );
	
	if ( $data == "" )
	{
		$data = "\n(0) Records Found!\n";                        
	}
	
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$_POST['table'].".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$data";	
	exit();
	
}

?>