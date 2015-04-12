<?php
/*
------------ABOUT THIS PROJECT-------------

Everything is on Github.
https://github.com/Darkxell/2048-in-php

-------------------------------------------
$_GET[] names

move=(1,2,3,4) (Optionnal)
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
/* getmoveresult : Return the GET values using the existing ones moved to a set direction.
1 up - 2 right - 3 down - 4 left
Keep in mind that this also generates a new 2 or 4 tile.
(int) -> (String) */
function getmoveresult($direction){
	$string = "c11=0&c12=2&c13=4&c14=8&c21=16&c22=32&c23=64&c24=128&c31=256&c32=512&c33=1024&c34=2048&c41=4096&c42=8192&c43=16384&c44=32768";
	return $string;
}
/* randomstart : returns a random GET url to start the game.
(void) -> (String) */
function randomstart(){
	
}



/*
-----End of functions-----
Redirects the user with the appropriate GET values if needed.*/
if(!isset($_GET["score"])){
	header("Location:2048.php?score=0&c11=0&c12=2&c13=4&c14=8&c21=16&c22=32&c23=64&c24=128&c31=256&c32=512&c33=1024&c34=2048&c41=4096&c42=8192&c43=16384&c44=32768");
	exit();
}
/*Redirects the user if he meant to move*/
if(isset($_GET["move"])){
	header("Location: 2048.php?score=".$_GET["score"]."&".getmoveresult($_GET["move"]));
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
				<th class="key"><a href="<?php echo("2048.php?score=".$_GET["score"]."&move=1&".gettiles()) ; ?>">■■</a></th>
				<th></th>
			</tr>
			<tr>
				<th class="key"><a href="<?php echo("2048.php?score=".$_GET["score"]."&move=4&".gettiles()) ; ?>">■■</a></th>
				<th></th>
				<th class="key"><a href="<?php echo("2048.php?score=".$_GET["score"]."&move=2&".gettiles()) ; ?>">■■</a></th>
			</tr>
			<tr>
				<th></th>
				<th class="key"><a href="<?php echo("2048.php?score=".$_GET["score"]."&move=3&".gettiles()) ; ?>">■■</a></th>
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
