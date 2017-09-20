<?php
date_default_timezone_set('UTC');

	
function do_download($url)
{
		$cmd  = DIR_BASE.'/lib/youtube-dl.exe';
		$cmd .= ' -x --audio-format mp3';
		$cmd .= ' --output download/%(title)s.%(ext)s '.$url;
	
		shell_exec($cmd);
}

function load_infos($url)
{
	$cmd_root = DIR_BASE.'/lib/youtube-dl.exe';
	$cmd_root .= " --get-format";
	$cmd_root .= " --dump-json";
	
	$cmd = $cmd_root." ".$url;
	$result = shell_exec($cmd);
	$pos = strpos($result, '{');
	$lines = trim(substr($result, 0, 3));
	$json = json_decode(substr($result, $pos));
	
	if(!empty($json))
	{
		$json->error = 0;
		return $json;
	}
	else
	{
		return $json;
	}
}


?>
