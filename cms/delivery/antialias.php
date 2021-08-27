<?php
//header("Content-type: image/png");
$im = imagecreate ($_GET['width'], $_GET['height']);


//START-----THIS PART IS FOR ANTI-ALIAS BETWEEN BACKGROUN COLOR WITH FONT COLOR////
//THE TASK IS TO DETECT THE MIDDLE BACKGROUND COLOR- and craete the aliasing color/////

$getExt = explode ('.', $_GET['background']);
$file_ext = $getExt[count($getExt)-1];

if($file_ext=='jpeg' || $file_ext=='jpg' || $file_ext=='png' || $file_ext=='gif'){
	
	if($file_ext=='jpeg' || $file_ext=='jpg')
	$background_im = imagecreatefromjpeg($_GET['background']);
	
	if($file_ext=='png')
	$background_im = imagecreatefrompng($_GET['background']);
	
	if($file_ext=='gif')
	$background_im = imagecreatefromgif($_GET['background']);
	
	// get a color
	if($_GET['cart']=='1'){
			$start_x = 75;
			$start_y = 75;
	}else{
			$start_x = 150;
			$start_y = 150;
	}
	$color_index = imagecolorat($background_im, $start_x, $start_y);
	
	// make it human readable
	$color_tran = imagecolorsforindex($background_im, $color_index);
	
	// what is it ?
	//print_r($color_tran);
	$background_color = imagecolorallocate ($im, $color_tran[red], $color_tran[green], $color_tran[blue]);
}else{
	$background_color = imagecolorallocate ($im, 255, 255, 255);
}

//END-----THIS PART IS FOR ANTI-ALIAS BETWEEN BACKGROUN COLOR WITH FONT COLOR////
//THE TASK IS TO DETECT THE MIDDLE BACKGROUND COLOR/////

$transparencyIndex = imagecolortransparent($im, $background_color);

$text_color = ImageColorAllocate ($im, $_GET['r'], $_GET['g'], $_GET['b']);

		$x1 = $_GET['x1'];
		$center_check1 = $_GET['center1'];
		if($center_check1=='1'){
				$bbox1 = imagettfbbox($_GET['s1'], $_GET['rotate1'], $_GET['font'], $_GET['text']);	
				$x1 = ((300-(abs($bbox1[2]) - abs($bbox1[0])))/2);
				$x1 = $x1;
			}		
		$x1 = $x1;
		$y1 = $y1;
		imagettftext($im, $_GET['s1'], $_GET['rotate1'], $x1, $_GET['y1'], $text_color, $_GET['font'], $_GET['text']);


		$x2 = $_GET['x2'];
				
		if($_GET['cart']=='1'){
			$size2 = ($_GET['s2']/2);
		}else{
			$size2 = $_GET['s2'];
		}
		
		$center_check2 = $_GET['center2'];
			if($center_check2=="1"){
				
					$bbox2 = imagettfbbox($size2, $_GET['rotate2'], $_GET['font'], $_GET['text2']);	
					$x2 = (($_GET['width']-(abs($bbox2[2]) - abs($bbox2[0])))/2);
					$x2 = $x2;
			}		
		$x2 = $x2;
		$y2 = $y2;
		//imagettftext($im, $_GET['s2'], $_GET['rotate2'], $x2, $_GET['y2'], $text_color, $_GET['font'], $_GET['text2']);
		imagettftext($im, $_GET['s2'], $_GET['rotate2'], $x2, $_GET['y2'], $text_color, str_replace("../../","",$_GET['font']), str_replace("../../","",$_GET['font']));
	
	
		$x3 = $_GET['x3'];
		$center_check3 = $_GET['center3'];
		if($_GET['center3']=='1'){
				$bbox3 = imagettfbbox($_GET['s3'], $_GET['rotate3'], $_GET['font'], $_GET['text3']);	
				$x3 = ((300-(abs($bbox3[2]) - abs($bbox3[0])))/2);
				$x3 = $x3;
		}		
		$x3 = $x3;
		$y3 = $y3;
		imagettftext($im, $_GET['s3'], $_GET['rotate3'], $x3, $_GET['y3'], $text_color, $_GET['font'], $_GET['text3']);
		
		
ImagePng ($im);
?>