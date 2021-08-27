<?php 
include_once('geoip/geoip.inc');

//set an IPv6 address for testing
$ip=$_SERVER['REMOTE_ADDR'];
/*
test if $ip is v4 or v6 and assign appropriate .dat file in $gi
run appropriate function geoip_country_code_by_addr() vs geoip_country_code_by_addr_v6()  
*/
if((strpos($ip, ":") === false)) {
    //ipv4
    $gi = geoip_open("geoip/GeoIP.dat",GEOIP_STANDARD);
    $country = geoip_country_code_by_addr($gi, $ip);
    $country_name = geoip_country_name_by_addr($gi, $ip);
}
else {
    //ipv6
    $gi = geoip_open("geoip/GeoIPv6.dat",GEOIP_STANDARD);
    $country = geoip_country_code_by_addr_v6($gi, $ip);
}




$HTTP_REFERER = '';

if($_GET['previous']){
	$HTTP_REFERER = $_GET['previous'];
}elseif($_POST['previous']){
	$HTTP_REFERER = $_POST['previous'];
}else{
	$HTTP_REFERER = $_SERVER['HTTP_REFERER'];
}


mysqli_query($conn, "INSERT INTO visitors (ip, user, country, previous_url, login_logout, created) 
					VALUES ('".$ip."', '".$visitor."', '".$country_name."', '".$HTTP_REFERER."', '".$login_logout."', '".date('Y-m-d H:i:s')."')") or die(mysqli_error($conn));



                
$visitors_qry = "SELECT * FROM visitors ORDER BY id DESC";					 
$visitors_query = mysqli_query($conn, $visitors_qry) or die(mysqli_error());
$visitors = mysqli_fetch_assoc($visitors_query);

					
?>