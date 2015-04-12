<?php
/*
------------ABOUT THIS PROJECT-------------

Everything is on Github.
https://github.com/Darkxell/2048-in-php

-------------------------------------------
$_GET[] names

move=(1,2,3,4)
score=()
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
		$string = '<div class="tile_'.$tilevalue.'"><br/>'.$tilevalue.'</div>';
		return $string;
	}
}





/*
-----End of functions-----
Redirects the user with the appropriate GET values if needed.*/
if(!isset($_GET["score"])){
	header("Location:2048.php?score=0&c11=0&c12=0&c13=0&c14=0&c21=0&c22=0&c23=0&c24=0&c31=0&c32=0&c33=0&c34=0&c41=0&c42=0&c43=0&c44=0");
	exit();
}




?>
<!Doctype html>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>
		2048 in php
	</title>
	<style type="text/css">
		body{
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
			height:85px;
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
		}
		header.sub span.new{
			margin-left:15px;
			font-size:25px;
			background-color:GoldenRod;
			border-radius: 10px;
			height:35px;
			padding-left:5px;
			padding-right:5px;
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
		}
		div.dpad{
			
			
			
			
		}
		div.dpad span.key{
			
			
			
		}
		p.easteregg{
			color:#fcfcfc;
			font-size:9px;
		}
		div.tile_2{
			height:80px;
			width:80px;
			background-color:Yellow;
			border-radius: 15px;
			font-size:22px;
		}
		div.tile_4{
			height:80px;
			width:80px;
			background-color:Yellow;
			border-radius: 15px;
			font-size:22px;
		}
		div.tile_8{
			height:80px;
			width:80px;
			background-color:Yellow;
			border-radius: 15px;
			font-size:22px;
		}
		div.tile_16{
			height:80px;
			width:80px;
			background-color:Yellow;
			border-radius: 15px;
			font-size:22px;
		}
		div.tile_32{
			height:80px;
			width:80px;
			background-color:Yellow;
			border-radius: 15px;
			font-size:22px;
		}
		div.tile_64{
			height:80px;
			width:80px;
			background-color:Yellow;
			border-radius: 15px;
			font-size:22px;
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
			score : <?php echo($_GET["score"]) ; ?>
			</span>
			<span class="new">
				<a href="2048.php">New game<a>
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
		<br/>
		<footer class="sub">
			
			
			
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
