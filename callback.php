<?php
define('DIR_BASE', __DIR__);
define('DIR_LIB', DIR_BASE . '/lib/');

include(DIR_LIB."Downloader.php");

if(!isset($_POST['url']) || empty($_POST['url'])) 
{
	$View ='
		<div class="container">

			<div class="starter-template">
				<h1>Ce lien youtube est invalide</h1>
			</div>

		</div><!-- /.container -->';	
	echo $View;
	exit();
}



$media = load_infos($_POST['url']);
if(empty($media))
{
	$View ='
			<div class="container">

			  <div class="starter-template">
				<h1>Ce lien youtube est invalide !</h1>

			  </div>

			</div><!-- /.container -->
			';	
}
else
{
do_download($_POST['url']);
	$media->fulltitle = str_replace('"', "'" , $media->fulltitle);
	$View ='
		<div class="container">
		
		  <div class="starter-template">
			<h1>Télécharger votre titre </h1>
			<p class="text-center" >'.$media->fulltitle.'</p>
			<p class="text-center"><iframe width="560" height="315" src=" https://www.youtube.com/embed/'.$media->display_id.'" frameborder="0" allowfullscreen></iframe></p>
			<a href="download.php?file='.$media->fulltitle.'.mp3" download><input type="submit" value="Télécharger" class="btn btn-primary form-control" /></a>
		  </div>

		</div><!-- /.container -->';
}

echo $View;
exit();


?>