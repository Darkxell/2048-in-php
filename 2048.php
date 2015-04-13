<?php
/*
------------ABOUT THIS PROJECT-------------

Everything is on Github.
https://github.com/Darkxell/2048-in-php

-------------------------------------------
$_GET[] names

move=(1) (Optionnal)
score=(integer)
c11= c12= c13= c14=
c21= c22= c23= c24=  (int "tiles values")
c31= c32= c33= c34=
c41= c42= c43= c44=

*/
/*-----Functions-----*/

/* html_tile : Get the tile id and return the HTML div for that tile if needed,
returns an empty String if the tile is blank.
(int) -> (String) */
function html_tile($tileid){
	$string = "";
	$tilevalue = $_GET[$tileid];
	if($tilevalue==0){
		return $string;
	}else{
		if($tilevalue <= 2048){
			$string = '<div class="tile_'.$tilevalue.'"><br/>'.$tilevalue.'</div>';
			return $string;
		}
		else{
			$string = '<div class="tile_max"><br/>'.$tilevalue.'</div>';
			return $string;
		}
	}
}
/* gettiles : returns the GET values of tiles in a get string
(void) -> (String) */
function gettiles(){
	$string = "c11=".$_GET["c11"]."&c12=".$_GET["c12"]."&c13=".$_GET["c13"]."&c14=".$_GET["c14"]."&c21=".$_GET["c21"]."&c22=".$_GET["c22"]."&c23=".$_GET["c23"]."&c24=".$_GET["c24"]."&c31=".$_GET["c31"]."&c32=".$_GET["c32"]."&c33=".$_GET["c33"]."&c34=".$_GET["c34"]."&c41=".$_GET["c41"]."&c42=".$_GET["c42"]."&c43=".$_GET["c43"]."&c44=".$_GET["c44"]."" ;
	return $string;
}
/* line_move : takes four values and return them moved to the right.
(int,int,int,int) -> array(1,2,3,4) */
function line_move($v1,$v2,$v3,$v4){
	if( $v4 == 0 ){
		$v4=$v3;
		$v3=0;
	}
	if( $v3 == 0 ){
		$v3=$v2;
		$v2=0;
	}
	if( $v4 == 0 ){
		$v4=$v3;
		$v3=0;
	}
	if( $v2 == 0 ){
		$v2=$v1;
		$v1=0;
	}
	if( $v3 == 0 ){
		$v3=$v2;
		$v2=0;
	}
	if( $v4 == 0 ){
		$v4=$v3;
		$v3=0;
	}
	//Merge 3 and 4
	if( $v4 == $v3 ){
		$v4 = $v4 * 2 ;
		$v3 = 0 ;
	}
	if( $v3 == 0 ){
		$v3=$v2;
		$v2=0;
	}
	if( $v2 == 0 ){
		$v2=$v1;
		$v1=0;
	}
	//Merge 2 and 3
	if( $v3 == $v2 ){
		$v3 = $v3 * 2 ;
		$v2 = 0 ;
	}
	if( $v2 == 0 ){
		$v2=$v1;
		$v1=0;
	}
	//Merge 1 and 2
	if( $v2 == $v1 ){
		$v2 = $v2 * 2 ;
		$v1 = 0 ;
	}
	$ret = [ 1 => $v1 , 2 => $v2 , 3 => $v3 , 4 => $v4 ] ;
	return $ret ;
}
/* getmoveresult : Return the GET values using the existing ones moved to a set direction.
1 up - 2 right - 3 down - 4 left
This doesn't generate any new tiles.
(int) -> (String) */
function getmoveresult($direction){
	$result = "";
	if($direction == 1){
		$a1 = line_move($_GET["c41"],$_GET["c31"],$_GET["c21"],$_GET["c11"]) ;
		$a2 = line_move($_GET["c42"],$_GET["c32"],$_GET["c22"],$_GET["c12"]) ;
		$a3 = line_move($_GET["c43"],$_GET["c33"],$_GET["c23"],$_GET["c13"]) ;
		$a4 = line_move($_GET["c44"],$_GET["c34"],$_GET["c24"],$_GET["c14"]) ;
		$result = "c11=".$a1[4]."&c12=".$a2[4]."&c13=".$a3[4]."&c14=".$a4[4]."&c21=".$a1[3]."&c22=".$a2[3]."&c23=".$a3[3]."&c24=".$a4[3]."&c31=".$a1[2]."&c32=".$a2[2]."&c33=".$a3[2]."&c34=".$a4[2]."&c41=".$a1[1]."&c42=".$a2[1]."&c43=".$a3[1]."&c44=".$a4[1] ;
		return $result ;
	}
	if($direction == 2){
		$a1 = line_move($_GET["c11"],$_GET["c12"],$_GET["c13"],$_GET["c14"]) ;
		$a2 = line_move($_GET["c21"],$_GET["c22"],$_GET["c23"],$_GET["c24"]) ;
		$a3 = line_move($_GET["c31"],$_GET["c32"],$_GET["c33"],$_GET["c34"]) ;
		$a4 = line_move($_GET["c41"],$_GET["c42"],$_GET["c43"],$_GET["c44"]) ;
		$result = "c11=".$a1[1]."&c12=".$a1[2]."&c13=".$a1[3]."&c14=".$a1[4]."&c21=".$a2[1]."&c22=".$a2[2]."&c23=".$a2[3]."&c24=".$a2[4]."&c31=".$a3[1]."&c32=".$a3[2]."&c33=".$a3[3]."&c34=".$a3[4]."&c41=".$a4[1]."&c42=".$a4[2]."&c43=".$a4[3]."&c44=".$a4[4] ;
		return $result ;
	}
	if($direction == 3){
		$a1 = line_move($_GET["c11"],$_GET["c21"],$_GET["c31"],$_GET["c41"]) ;
		$a2 = line_move($_GET["c12"],$_GET["c22"],$_GET["c32"],$_GET["c42"]) ;
		$a3 = line_move($_GET["c13"],$_GET["c23"],$_GET["c33"],$_GET["c43"]) ;
		$a4 = line_move($_GET["c14"],$_GET["c24"],$_GET["c34"],$_GET["c44"]) ;
		$result = "c11=".$a1[1]."&c12=".$a2[1]."&c13=".$a3[1]."&c14=".$a4[1]."&c21=".$a1[2]."&c22=".$a2[2]."&c23=".$a3[2]."&c24=".$a4[2]."&c31=".$a1[3]."&c32=".$a2[3]."&c33=".$a3[3]."&c34=".$a4[3]."&c41=".$a1[4]."&c42=".$a2[4]."&c43=".$a3[4]."&c44=".$a4[4] ;
		return $result ;
	}
	if($direction == 4){
		$a1 = line_move($_GET["c14"],$_GET["c13"],$_GET["c12"],$_GET["c11"]) ;
		$a2 = line_move($_GET["c24"],$_GET["c23"],$_GET["c22"],$_GET["c21"]) ;
		$a3 = line_move($_GET["c34"],$_GET["c33"],$_GET["c32"],$_GET["c31"]) ;
		$a4 = line_move($_GET["c44"],$_GET["c43"],$_GET["c42"],$_GET["c41"]) ;
		$result = "c11=".$a1[4]."&c12=".$a1[3]."&c13=".$a1[2]."&c14=".$a1[1]."&c21=".$a2[4]."&c22=".$a2[3]."&c23=".$a2[2]."&c24=".$a2[1]."&c31=".$a3[4]."&c32=".$a3[3]."&c33=".$a3[2]."&c34=".$a3[1]."&c41=".$a4[4]."&c42=".$a4[3]."&c43=".$a4[2]."&c44=".$a4[1] ;
		return $result ;
	}
	return $result;
}
/* addrandtile : generates a GET url with a new tile at a random location
(void) -> (string)*/
function addrandtile(){
	$test = ! canplay() ;
	while($test){
		$x = rand(1,4) ;
		$y = rand(1,4) ;
		if ($_GET["c".$x.$y] == 0) {
			$newtilevalue = 2 * rand(1,2) ;
			$test = false;
			$returnurl = gentileget($newtilevalue,$x,$y,11)."&".gentileget($newtilevalue,$x,$y,12)."&".gentileget($newtilevalue,$x,$y,13)."&".gentileget($newtilevalue,$x,$y,14)."&" ;
			$returnurl = $returnurl.gentileget($newtilevalue,$x,$y,21)."&".gentileget($newtilevalue,$x,$y,22)."&".gentileget($newtilevalue,$x,$y,23)."&".gentileget($newtilevalue,$x,$y,24)."&" ;
			$returnurl = $returnurl.gentileget($newtilevalue,$x,$y,31)."&".gentileget($newtilevalue,$x,$y,32)."&".gentileget($newtilevalue,$x,$y,33)."&".gentileget($newtilevalue,$x,$y,34)."&" ;
			$returnurl = $returnurl.gentileget($newtilevalue,$x,$y,41)."&".gentileget($newtilevalue,$x,$y,42)."&".gentileget($newtilevalue,$x,$y,43)."&".gentileget($newtilevalue,$x,$y,44) ;
			return $returnurl ;
		}
	}
	return "";
}
/* gentileget : Usual function for addrandtile() .
(int,int,int,int) -> (string)
*/
function gentileget ($tv,$sx,$sy,$tile_sid) {
	if("c".$sx.$sy == "c".$tile_sid){
				return "c".$tile_sid."=".$tv ;
			} else {
				return "c".$tile_sid."=".$_GET["c".$tile_sid] ;
			}
}
/* canplay : returns if the user can play using curent GET values
(void) -> (boolean)*/
function canplay(){
	
}
/* randomstart : returns a random GET url to start the game.
(void) -> (String) */
function randomstart(){
	
}



/*
-----End of functions-----
Redirects the user with the appropriate GET values if needed.*/
if(!isset($_GET["score"])){
	header("Location:2048.php?score=0&c11=0&c12=0&c13=0&c14=0&c21=0&c22=0&c23=0&c24=2&c31=4&c32=0&c33=0&c34=0&c41=0&c42=0&c43=0&c44=0");
	exit();
}
/*Spawns a tile if the user moved*/
if(isset($_GET["move"])){
	header("Location:2048.php?score=".$_GET["score"]."&".addrandtile()) ;
	exit();
}



?>
<!Doctype html>
<html>
<head>
	<!--
	-->
	<meta charset="UTF-8"/>
	<title>
		2048 in php
	</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
	<style type="text/css">
		body{
			font-family: 'Roboto', sans-serif;
			background-color:#dedede;
		}
		footer.main{
			margin-top:65px;
			background-color:#f9f9f9;
			height:25px;
			width:100%;
			text-align:right;
			box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.7);
		}
		header.main{
			height:100px;
			background-color:#f9f9f9;
			margin-bottom:65px;
			box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.7);
			text-align:center;
			margin-left:10px;
			margin-right:10px;
		}
		header.main p{
			font-size:16px;
		}
		footer.sub{
			margin-left:10px;
			margin-right:10px;
			margin-top:365px;
			padding-top:3px;
			padding-bottom:3px;
			background-color:#efefef;
			border-radius: 15px;
			box-shadow: -1px 2px 3px 1px #a9a9a9;
		}
		header.sub{
			margin-left:10px;
			margin-right:10px;
			height:85px;
			background-color:#efefef;
			border-radius: 15px;
			box-shadow: -1px 2px 3px 1px #a9a9a9;
		}
		header.sub span.title{
			font-size:40px;
			padding-left:180px;
		}
		header.sub span.score{
			font-size:25px;
			background-color:GoldenRod;
			border-radius:10px;
			padding-left:5px;
			padding-right:5px;
			margin-left:35px;
			box-shadow: -1px 2px 3px 1px #a9a9a9;
			transition: all .2s ease-in-out;
		}
		header.sub span.new{
			margin-left:15px;
			font-size:25px;
			background-color:GoldenRod;
			border-radius: 10px;
			height:35px;
			padding-left:5px;
			padding-right:5px;
			box-shadow: -1px 2px 3px 1px #a9a9a9;
			transition: all .2s ease-in-out;
		}
		header.sub span.new a{
			color:Black;
			text-decoration:none;
		}
		header.sub span.score:hover{
			background-color:Gold;
			box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.7);
		}
		header.sub span.new:hover{
			background-color:Gold;
			box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.7);
		}
		th.g{
			height:80px;
			width:80px;
			background-color:#fcfcfc;
			border-radius: 15px;
			font-size:25px;
		}
		div.page{
			width:700px;
			margin-right:auto;
			margin-left:auto;
			background-color:#fcfcfc;
			box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.7);
		}
		div.grid{
			margin-left:30px;
			background-color:#efefef;
			box-shadow: -1px 2px 3px 1px #a9a9a9;
			width:322px;
			border-radius: 15px;
			padding-top:10px;
			padding-bottom:10px;
			padding-left:10px;
			padding-right:10px;
			float:left;
		}
		div.dpad{
			float:right;
			width:150px;
			height:150px;
			background-color:#efefef;
			margin-right:70px;
			margin-top:70px;
			box-shadow: -1px 2px 3px 1px #a9a9a9;
			padding-top:10px;
			padding-bottom:10px;
			padding-left:10px;
			padding-right:10px;
			border-radius: 15px;
		}
		th.key{
			height:45px;
			width:45px;
			border-radius:10px;
			box-shadow: -1px 2px 3px 1px #a9a9a9;
			transition: all .15s ease-in-out;
		}
		th.key:hover{
			box-shadow: -1px 2px 3px 1px #c9c9c9;
			background-color:#e1e1e1;
		}
		th.key a{
			font-size:35px;
			text-decoration:none;
			color:#efefef;
			transition: all .15s ease-in-out;
		}
		th.key:hover a{
			color:#e1e1e1;
		}
		article.hbox{
			margin-top:20px;
			margin-bottom:20px;
			margin-left:20px;
			margin-right:20px;
			background-color:#f3f3f3;
			box-shadow: -1px 2px 3px 1px #a9a9a9;
			height:67px;
			overflow:hidden;
			transition: height 1s;
		}
		article.hbox:hover{
			height:333px;
		}
		article.hbox h1{
			text-align:center;
		}
		article.hbox header{
			background-color:#fcfcfc;
			box-shadow: -1px 2px 3px 1px #a9a9a9;
		}
		div.article_body{
			margin-left:20px;
			margin-right:20px;
			margin-bottom:20px;
			background-color:#fcfcfc;
			box-shadow: -1px 2px 3px 1px #a9a9a9;
			text-align:justify;
		}
		div.hidden{
			visibility:hidden;
			font-size:4px;
		}
		p.easteregg{
			color:#fcfcfc;
			font-size:9px;
		}
		div.tile_2{
			height:78px;
			width:78px;
			background-color:#eee4da;
			color:#786e64;
			border-radius: 15px;
			font-size:22px;
		}
		div.tile_4{
			height:78px;
			width:78px;
			background-color:#ece0c6;
			border-radius: 15px;
			font-size:22px;
			color:#786e64;
		}
		div.tile_8{
			height:78px;
			width:78px;
			background-color:#f2b179;
			border-radius: 15px;
			font-size:22px;
			color:White;
		}
		div.tile_16{
			height:78px;
			width:78px;
			background-color:#ef8d4c;
			border-radius: 15px;
			font-size:22px;
			color:White;
		}
		div.tile_32{
			height:78px;
			width:78px;
			background-color:#f77b61;
			border-radius: 15px;
			font-size:22px;
			color:White;
		}
		div.tile_64{
			height:78px;
			width:78px;
			background-color:#e85a36;
			border-radius: 15px;
			font-size:22px;
			color:White;
		}
		div.tile_128{
			height:78px;
			width:78px;
			background-color:#f1d96b;
			border-radius: 15px;
			font-size:22px;
			color:White;
		}
		div.tile_256{
			height:78px;
			width:78px;
			background-color:#ead34f;
			border-radius: 15px;
			font-size:22px;
			color:White;
		}
		div.tile_512{
			height:78px;
			width:78px;
			background-color:#e2c029;
			border-radius: 15px;
			font-size:22px;
			color:White;
		}
		div.tile_1024{
			height:78px;
			width:78px;
			background-color:#e4b914;
			border-radius: 15px;
			font-size:22px;
			color:White;
		}
		div.tile_2048{
			height:78px;
			width:78px;
			background-color:#efc302;
			border-radius: 15px;
			font-size:22px;
			color:White;
		}
		div.tile_max{
			height:78px;
			width:78px;
			background-color:Black;
			border-radius: 15px;
			font-size:22px;
			color:White;
		}
	</style>
</head>
<body>
	<header class="main">
		<h1>
			2048 in php
		</h1>
		<p>
			No javascript, no Flash
		</p>
	</header>
	<div class="page">
		<p class="easteregg">
			You found an easter egg. How lucky!
		</p>
		<header class="sub">
			<br/>
			<span class="title">
				<strong>
					2048
				</strong>
			</span>
			<span class="score">
				score :
				<?php echo($_GET["score"]) ; ?>
			</span>
			<span class="new">
				<a href="2048.php">New game</a>
			</span>
		</header>
		<br/>
		<div class="grid">
			<table>
				<tr>
					<th class="g"><?php echo(html_tile("c11")) ;?></th>
					<th class="g"><?php echo(html_tile("c12")) ;?></th>
					<th class="g"><?php echo(html_tile("c13")) ;?></th>
					<th class="g"><?php echo(html_tile("c14")) ;?></th>
				</tr>
				<tr>
					<th class="g"><?php echo(html_tile("c21")) ;?></th>
					<th class="g"><?php echo(html_tile("c22")) ;?></th>
					<th class="g"><?php echo(html_tile("c23")) ;?></th>
					<th class="g"><?php echo(html_tile("c24")) ;?></th>
				</tr>
				<tr>
					<th class="g"><?php echo(html_tile("c31")) ;?></th>
					<th class="g"><?php echo(html_tile("c32")) ;?></th>
					<th class="g"><?php echo(html_tile("c33")) ;?></th>
					<th class="g"><?php echo(html_tile("c34")) ;?></th>
				</tr>
				<tr>
					<th class="g"><?php echo(html_tile("c41")) ;?></th>
					<th class="g"><?php echo(html_tile("c42")) ;?></th>
					<th class="g"><?php echo(html_tile("c43")) ;?></th>
					<th class="g"><?php echo(html_tile("c44")) ;?></th>
				</tr>
			</table>
		</div>
		<div class="dpad">
			<table>
			<tr>
				<th></th>
				<th class="key"><a href="<?php echo("2048.php?score=".$_GET["score"]."&move=1&".getmoveresult(1)) ; ?>">■■</a></th>
				<th></th>
			</tr>
			<tr>
				<th class="key"><a href="<?php echo("2048.php?score=".$_GET["score"]."&move=1&".getmoveresult(4)) ; ?>">■■</a></th>
				<th></th>
				<th class="key"><a href="<?php echo("2048.php?score=".$_GET["score"]."&move=1&".getmoveresult(2)) ; ?>">■■</a></th>
			</tr>
			<tr>
				<th></th>
				<th class="key"><a href="<?php echo("2048.php?score=".$_GET["score"]."&move=1&".getmoveresult(3)) ; ?>">■■</a></th>
				<th></th>
			</tr>
			</table>
		</div>
		<br/>
		<footer class="sub">
			<article class="hbox">
				<header>
					<h1>
						How to play
					</h1>
				</header>
				<div class="article_body">
					<p>
						2048 is a puzzle game that got popular on smartphones devices.
						<br/><br/>
						It consist in merging similar tiles that appears on a grid to form bigger ones.
						<br/>
						Tiles that are going to appear are 2 and 4 , and you can slide them in a direction
						using the Dpad on the right. Each time you move a new tile will appear at a random location.
						<br/>
						You will lose if you can't make any move at all.
						<br/>
						Your score increases each time you merge two tiles together, by the value of the merged tile.
						<br/>
						Your goal is to form a 2048 tile.
						<br/><br/>
						Good luck!
						<br/>
						You will need it...
					</p>
				</div>
				<div class="hidden"><br/></div>
			</article>
			<article class="hbox">
				<header>
					<h1>
						About me
					</h1>
				</header>
				<div class="article_body">
					<p>
						You want to know about me do ya?
						<br/><br/>
						I'm Nicolas Candela, also known as Darkxell.
						<br/>
						I love programming, obviously, and computing in general. This project 
						is a little challenge for me, because I want a 2048 game in only one
						file, with no Javascript, no Cookies and no Flash. Here's the result!
						<br/><br/>
						I also love nekos, but that's not the point. You can mail me if you want
						to know something about me, want a collab on a project or if you are a 
						neko yourself.
						<br/><br/>
						Love ya!
						<br/><br/>
						<a href="mailto:darkxell.mc@gmail.com">Mail me</a>
					</p>
				</div>
				<div class="hidden"><br/></div>
			</article>
		</footer>
		<br/>
	</div>
	<footer class="main">
		<p>
			Code by <a href="mailto:darkxell.mc@gmail.com">Darkxell</a>, open source <a href="https://github.com/Darkxell/2048-in-php">here</a>.
		</p>
	</footer>
</body>
</html>
