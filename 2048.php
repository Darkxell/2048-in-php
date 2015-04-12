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
			height:300px;
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
				<th class="key"><a href="">■■</a></th>
				<th></th>
			</tr>
			<tr>
				<th class="key"><a href="">■■</a></th>
				<th></th>
				<th class="key"><a href="">■■</a></th>
			</tr>
			<tr>
				<th></th>
				<th class="key"><a href="">■■</a></th>
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
