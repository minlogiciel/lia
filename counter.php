<?php 
$counterFile = "counter.inc";

function show_hits() {
	global $counterFile;
	$hits = get_hits();
	print_hits($hits); 
}

function get_hits() {
	global $counterFile;
	$hits = 1;
	
	$filename = $counterFile;

	if (file_exists($filename)) {
		$fp = fopen($filename, "r+");
		$hits = chop(fread($fp, filesize($filename)));
		$hits = $hits + 1;
		rewind($fp);
		fwrite($fp, (string)$hits);
		fclose($fp);
	}
	else {
		$fp = fopen($filename, "w");
		fwrite($fp, $hits);
		fclose($fp);
	}
	return (string)$hits;
}

function print_hits($str)
{
	$len = strlen($str);
	$str_tmp = array("0", "0", "0", "0", "0", "0");
	$tmp = strrev($str);
	for ($i = 0; $i < 6; $i++)
	{
		if ($i > $len-1)
			$str_tmp[$i] = "0";
		else
			$str_tmp[$i] = $tmp[$i];
	}
	echo(" | ");
	for ($i = 5; $i >= 0; $i--) {
		echo("<font color=yellow>$str_tmp[$i]</font> | ");
	}
}

function draw_hits($str1)
{
	//header("countent-type: image/gif");

	$len1 = strlen($str1);
	$str2 = "000000000";
	$len2 = 9;
	$dif = $len2 - $len1;
	$rest = substr($str2, 0, $dif);
	$string = $rest.$str1;

	$font = 4;
	$im = imagecreate(88, 31);
	$black = imagecolorallocate($im, 0, 0, 0);
	$white = imagecolorallocate($im, 255, 255, 255);
	imagefill($im, 0, 0, $black);
	$px = (imagesx($im) - 8.3 *strlen($string))/2;
	imagestring($im, 3, $px, 2, "e&J counter", $white);
	imageline ($im, 1, 14, 85, 14, $white);
	imagestring($im, $font, $px, 15.5, $string, $white);
	imagegif($im);
	//imagedestroy($im);
	echo $string;
}
?>
	
