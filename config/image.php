<?php 
define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/config/ini.php'; 
require_once '../../config/ini.php'; 



class img {
		
		
	function convert_123to132($input){//array[1][2][3] ===> array[1][3][2]
		$output = array();
		foreach((array)$input as $field_name => $file_para){
			foreach((array)$file_para as $paraname => $paravalue){
				for($z=0; $z<count($input[$field_name]['name']); $z++){
					$output[$field_name][$z][$paraname] = $paravalue[$z];
				}
			}
		}
		return $output;
	}
		
		


	function upload_image($file=array(), $table=null, $field=null, $id=null, $watermarking=null) {
		
		#file contain $_FILES[]
		global $conn;

		$source = $file['tmp_name']; 
		$type = $file['type']; 
		$ext = substr(strrchr($type, "/"), 1);
		$compress = false;//requirement
		$compressed = false;//compress status

		list($width, $height) = getimagesize($source);

		switch ( $ext ){ 
			case 'pjpeg':$file = 'photo/'.uniqid().'.jpg';break;
			case 'jpg':$file = 'photo/'.uniqid().'.jpg';break;
			case 'jpeg':$file = 'photo/'.uniqid().'.jpg';break; 
			case 'gif':$file = 'photo/'.uniqid().'.gif';break;
			case 'png':$file = 'photo/'.uniqid().'.png';break;					
			
			case 'pdf':$file = 'files/'.uniqid().'.pdf';break;
			
			case 'webm':$file = 'video/'.uniqid().'.webm';break;
			case 'mkv':$file = 'video/'.uniqid().'.mkv';break;
			case 'flv':$file = 'video/'.uniqid().'.flv';break;
			case 'vob':$file = 'video/'.uniqid().'.vob';break;
			case 'avi':$file = 'video/'.uniqid().'.avi';break;
			case 'wmv':$file = 'video/'.uniqid().'.wmv';break;
			case 'mov':$file = 'video/'.uniqid().'.mov';break;
			case 'rmvb':$file = 'video/'.uniqid().'.rmvb';break;
			case 'mp4':$file = 'video/'.uniqid().'.mp4';break;
			case 'mpg':$file = 'video/'.uniqid().'.mpg';break;								
		}
		
			
		$dir = getcwd();
		$rel_dir = '';		
		if (strpos($dir, 'cms') !== false) {
			$rel_dir = "../../";
		}
		
	
		if(($file != '')){
			$destination=$rel_dir.$file;
			if (move_uploaded_file($source, $destination)){
	

				if(!empty($id)){
					$a = sql_read('select * from '.$table.' where id=? limit 1', 's', $id);
					if(isset($a[$field]) && !empty($a[$field])){@unlink($rel_dir.$a[$field]);}
					$data['id'] = $id;


					$data[$field] = $file;
					
					sql_save($table, $data);
					//$_SESSION['error_img'] .= '--'.'id: '.$data['id'].' field: '.$data[$field];

					return $msg;
				}else{
					return $file;
				}
			}else{
				return false;
			}
		}
	}



/*


Warning: imagecreatefromjpeg(): gd-jpeg: JPEG library reports unrecoverable error: Not a JPEG file: starts with 0x89 0x50 in C:\xampp\htdocs\grocere.com.my\config\image.php on line 59

Warning: imagecreatefromjpeg(): 'C:\xampp\tmp\php449D.tmp' is not a valid JPEG file in C:\xampp\htdocs\grocere.com.my\config\image.php on line 59

Warning: imagepng() expects parameter 1 to be resource, bool given in C:\xampp\htdocs\grocere.com.my\config\image.php on line 112


	function upload_image($file=array(), $table=null, $field=null, $id=null, $watermarking=null) {
		
		#file contain $_FILES[]
		global $conn;
		
		$source = $file['tmp_name']; 
		$type = $file['type']; 
		$ext = substr(strrchr($type, "/"), 1);
		$compress = false;//requirement
		$compressed = false;//compress status

		list($width, $height) = getimagesize($source);

		switch ( $ext ){ 
			case 'pjpeg':$file = 'photo/'.uniqid().'.jpg';break;
			case 'jpg':$file = 'photo/'.uniqid().'.jpg';break;
			case 'jpeg':$file = 'photo/'.uniqid().'.jpg';break; 
			case 'gif':$file = 'photo/'.uniqid().'.gif';break;
			case 'png':$file = 'photo/'.uniqid().'.png';break;					
			
			case 'pdf':$file = 'files/'.uniqid().'.pdf';break;
			
			case 'webm':$file = 'video/'.uniqid().'.webm';break;
			case 'mkv':$file = 'video/'.uniqid().'.mkv';break;
			case 'flv':$file = 'video/'.uniqid().'.flv';break;
			case 'vob':$file = 'video/'.uniqid().'.vob';break;
			case 'avi':$file = 'video/'.uniqid().'.avi';break;
			case 'wmv':$file = 'video/'.uniqid().'.wmv';break;
			case 'mov':$file = 'video/'.uniqid().'.mov';break;
			case 'rmvb':$file = 'video/'.uniqid().'.rmvb';break;
			case 'mp4':$file = 'video/'.uniqid().'.mp4';break;
			case 'mpg':$file = 'video/'.uniqid().'.mpg';break;								
		}
		
		if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'pjpeg'){
			$image = imagecreatefromjpeg($source);
			$compress = true;
		}elseif ($ext == 'gif'){
			$image = imagecreatefromgif($source);
			$compress = true;
		}elseif ($ext == 'png'){
			$image = imagecreatefrompng($source);
			$compress = true;
		}
		
		$dir = getcwd();
		$rel_dir = '';		
		if (strpos($dir, 'cms') !== false) {
			$rel_dir = "../../";
		}
		
		if($watermarking == true){

			if($width>3000){
				$watermark = imagecreatefrompng($rel_dir.'images/watermark5.png');
				$watermarkWH = 1332;
			}elseif($width>2000){
				$watermark = imagecreatefrompng($rel_dir.'images/watermark4.png');
				$watermarkWH = 874;		
			}elseif($width>1000){
				$watermark = imagecreatefrompng($rel_dir.'images/watermark3.png');
				$watermarkWH = 395;	
			}elseif($width>500){
				$watermark = imagecreatefrompng($rel_dir.'images/watermark2.png');
				$watermarkWH = 268;	
			}else{
				$watermark = imagecreatefrompng($rel_dir.'images/watermark.png');
				$watermarkWH = 162;	
			}

			imagealphablending($watermark, false);
			imagesavealpha($watermark, true);
		
			$new_x = ($width/2)-($watermarkWH/2);
			$new_y = ($height/2)-($watermarkWH/2);

			$cut = imagecreatetruecolor($width, $height);
			imagecopy($cut, $image, 0, 0, 0, 0, $width, $height);       
			imagecopy($cut, $watermark, $new_x, $new_y, 0, 0, $watermarkWH, $watermarkWH);       
			imagecopymerge($image, $cut, 0, 0, 0, 0, $width, $height, 75);
		}

		if(($file != '')){

			$destination=$rel_dir.$file;
			//if (move_uploaded_file($source, $destination)){

			if ($compress == true){//For image files
				if (imagepng($image, $destination)){
					$compressed = true;
				}
			}else{//For non-image files like video, pdf, etc
				if (move_uploaded_file($source, $destination)){
					$compress = false;
				}
			}

			if ($compress == false || $compressed == true){//either compressed or no need compress like video
			
				if(!empty($id)){
					$a = sql_read('select * from '.$table.' where id=? limit 1', 's', $id);
					if(isset($a[$field]) && !empty($a[$field])){@unlink($rel_dir.$a[$field]);}
					$data['id'] = $id;

					$data[$field] = $file;
					
					sql_save($table, $data);
					$msg = 'id: '.$data['id'].' field: '.$data[$field];

					return $msg;
				}else{
					return $file;
				}
			}else{
				return false;
			}
		}
	}
	
	*/




	function remove_image($table=null, $field=null, $id=null) {
		
		global $conn;
		//global $relative_root;

		$a = sql_read('select * from '.$table.' where id=? limit 1', 's', $id);
		
		if(isset($a[$field]) && !empty($a[$field])){@unlink(ROOT.$a[$field]);}
		
		$data['id'] = $id;
		$data[$field] = '';
		$data['modified'] = date("Y-m-d h:i:s");
		
		if(sql_save($table, $data)){
			return true;
		}else{
			return false;	
		}
	}
	
	
	function resize_image($file, $w, $h, $crop=FALSE) {

		list($width, $height) = getimagesize($file);


		$r = $width / $height;//original picture ratio
		$t = $w / $h;//target picture ratio

		if($width>=$w && $height>=$h){
			
			if ($crop) {
				if ($width > $height) {
					$width = ceil($width-($width*abs($r-$w/$h)));
				} else {
					$height = ceil($height-($height*abs($r-$w/$h)));
				}
				$newwidth = $w;
				$newheight = $h;
			} else {
				if ($r > $t) {//height shorter so base on height
					$newheight = $h;
					$newwidth = $h*$r;
				} else {//width shorter so base on width
					$newwidth = $w;
					$newheight = $w/$r;
				}
			}

			$src = imagecreatefromjpeg($file);
			$dst = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			
			/*$exif = exif_read_data($file, 'IFD0');
			if($exif===true){
				$exif = exif_read_data($file, 0, true);
				//if($exif['IFD0']['Orientation'] == '6'){
					imagerotate($dst, -90, 0);
				//}
				
			}*/
			
			
			if(imagepng ($dst,$file,"0"));
		}
	}	
		
	function rotateBack($file) {
		$r='';
		if(!empty($file)){
			$exif = exif_read_data($file, 0, true);
			if($exif['IFD0']['Orientation'] == '3'){
				$r = "-ms-transform: rotate(180deg);  -webkit-transform: rotate(180deg); transform: rotate(180deg);";
			}elseif($exif['IFD0']['Orientation'] == '6'){
				$r = "-ms-transform: rotate(90deg);  -webkit-transform: rotate(90deg); transform: rotate(90deg);";
			}elseif($exif['IFD0']['Orientation'] == '8'){
				$r = "-ms-transform: rotate(-90deg);  -webkit-transform: rotate(-90deg); transform: rotate(-90deg);";
			}
		}
		return $r;
	}	
}

$img = new img;


if(@$_GET['remove_image'] == '1'){
	$img->remove_image($_POST['table'],$_POST['field'],$_POST['id']);
}
?>



<script>
function removeImg(table, id, field, callback){
	  $.post( "<?php echo $relative_root?>pro/image.php?remove_image=1", {table:table, field:field, id:id}, function( result ) {
		$(callback).html(result);
	});
}
</script>

