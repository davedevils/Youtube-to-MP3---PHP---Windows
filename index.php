<?php


$View = '	<!DOCTYPE html>
	<html lang="fr">
	  <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="youtube to mp3">
		<meta name="author" content="davedevils">

		<title>Youtube-to-MP3</title>

		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	  </head>

	  <body>

		<nav class="navbar navbar-inverse">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="#">Youtube-To-MP3</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
			  <ul class="nav navbar-nav">
				<li class="active"><a href="index.php">Acceuil</a></li>
				<li><a href="https://github.com/davedevils/Youtube-to-MP3---PHP---Windows">Github</a></li>
			  </ul>
			</div><!--/.nav-collapse -->
		  </div>
		</nav>';

	$View .='
		<div class="container" id="ajaxpage">

		  <div class="starter-template">
			<h1>Convertir et télécharger Youtube en mp3</h1>
			<p>
				<form method="POST">
					<input type="text" placeholder="Mettez votre lien youtube" class="form-control" name="link" id="linkdll"><br>
					<input id="download" type="submit" value="Convertir" class="btn btn-primary form-control" />
				</form>
			</p>

		  </div>

		</div><!-- /.container -->';

$View .= '
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<script src="ajax.js"></script>
		  </body>
		</html> ';
		

echo $View ;