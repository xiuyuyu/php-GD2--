<?php
include ("conn/conn.php");
$query = mysql_query ( "select product_count from tb_data " );
$data = array ();
while ( $myrow = mysql_fetch_array ( $query ) ) {
	$data [] = $myrow [product_count];
}
$widths = 580; //宽度
$heights = 150; //高度


$width = 280; //宽度
$height = 130; //高度
$angle = array (); //角度
$total = 0;
for($i = 0; $i < count ( $data ); $i ++) {
	if (! is_numeric ( $data [$i] ))
		die ( "1" );
	$total += $data [$i];
}
for($i = 0; $i < count ( $data ); $i ++) {
	array_push ( $angle, round ( 360 * $data [$i] / $total ) );
}

$image = imagecreate ( $widths, $heights );
$white = imagecolorallocate ( $image, 0xEE, 0xEE, 0xEE );
$color = array (array (imagecolorallocate ( $image, 0x97, 0xbd, 0x00 ), imagecolorallocate ( $image, 0x00, 0x99, 0x00 ), imagecolorallocate ( $image, 0xcc, 0x33, 0x00 ), imagecolorallocate ( $image, 0xff, 0xcc, 0x00 ), imagecolorallocate ( $image, 0x33, 0x66, 0xcc ), imagecolorallocate ( $image, 0x33, 0xcc, 0x33 ), imagecolorallocate ( $image, 0xff, 0x99, 0x33 ), imagecolorallocate ( $image, 0xcc, 0xcc, 0x99 ), imagecolorallocate ( $image, 0x99, 0xcc, 0x66 ), imagecolorallocate ( $image, 0x66, 0xff, 0x99 ) ), array (imagecolorallocate ( $image, 0x4f, 0x66, 0x00 ), imagecolorallocate ( $image, 0x00, 0x33, 0x00 ), imagecolorallocate ( $image, 0x48, 0x10, 0x00 ), imagecolorallocate ( $image, 0x7d, 0x64, 0x00 ), imagecolorallocate ( $image, 0x17, 0x30, 0x64 ), imagecolorallocate ( $image, 0x1a, 0x6a, 0x1a ), imagecolorallocate ( $image, 0x97, 0x4b, 0x00 ), imagecolorallocate ( $image, 0x78, 0x79, 0x3c ), imagecolorallocate ( $image, 0x55, 0x7e, 0x27 ), imagecolorallocate ( $image, 0x00, 0x93, 0x37 ) ) );
$rounds_x = $width / 2; //原线
for($h = $height / 2 + 5; $h > $height / 2 - 5; $h --) {
	$start = 0;
	$stop = 0;
	for($i = 0; $i < count ( $data ); $i ++) {
		$start = $start + 0;
		$stop = $start + $angle [$i];
		$color_i = fmod ( $i, 10 );
		imagefilledarc ( $image, $rounds_x, $h, $width, $height - 20, $start, $stop, $color [1] [$color_i], IMG_ARC_PIE );
		$start += $angle [$i];
		$stop += $angle [$i];
	}
}
for($i = 0; $i < count ( $data ); $i ++) {
	$start = $start + 0;
	$stop = $start + $angle [$i];
	$color_i = fmod ( $i, 10 );
	imagefilledarc ( $image, $rounds_x, $h, $width, $height - 20, $start, $stop, $color [0] [$color_i], IMG_ARC_PIE );
	$start += $angle [$i];
	$stop += $angle [$i];
}
$fnt = "Font/FZHCJW.TTF"; //定义字体
$m = - 1;
$result = mysql_query ( "select * from tb_data " );
while ( $myrow = mysql_fetch_array ( $result ) ) {
	$m ++;
	
	imagefilledrectangle ( $image, 295, 15 + 20 * $m, 380, 5 + 20 * $m, $color [0] [$m] ); //绘制并填充柱形图
	$comment = $myrow [product_name] . "：" . number_format ( $myrow [product_count] / $_GET [counts], 2 ) * 100 . "%";
	imageTTFText ( $image, 15, 0, 390, 18 + 20 * $m, $color [0] [$m], $fnt, $comment ); //写TTF文字到图中	
}
imagepng ( $image );
imagedestroy ( $image );
?>
