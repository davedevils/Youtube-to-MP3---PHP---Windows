<?php

@ini_set('error_reporting', E_ALL & ~ E_NOTICE);
@apache_setenv('no-gzip', 1);
@ini_set('zlib.output_compression', 'Off');

if(!isset($_GET['file']) || empty($_GET['file'])) 
{
	header("HTTP/1.0 400 Bad GET");
	exit;
}

$file_name  = utf8_decode($_GET['file']);
$file_path  = './download/' . $file_name;

if (file_exists($file_path))
{
	$file_size  = filesize($file_path);
	$file = @fopen($file_path,"rb");
	if ($file)
	{
		// set the headers, prevent caching
		header("Pragma: public");
		header("Expires: -1");
		header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
		header("Content-Disposition: attachment; filename=\"$file_name\"");
        header("Content-Type: audio/mpeg");

		if(isset($_SERVER['HTTP_RANGE']))
		{
			list($size_unit, $range_orig) = explode('=', $_SERVER['HTTP_RANGE'], 2);
			if ($size_unit == 'bytes')
			{
				list($range, $extra_ranges) = explode(',', $range_orig, 2);
			}
			else
			{
				$range = '';
				header('HTTP/1.1 416 Requested Range Not Satisfiable');
				exit;
			}
		}
		else
		{
			$range = '';
		}

		list($seek_start, $seek_end) = explode('-', $range, 2);
		$seek_end   = (empty($seek_end)) ? ($file_size - 1) : min(abs(intval($seek_end)),($file_size - 1));
		$seek_start = (empty($seek_start) || $seek_end < abs(intval($seek_start))) ? 0 : max(abs(intval($seek_start)),0);
	 
		if ($seek_start > 0 || $seek_end < ($file_size - 1))
		{
			header('HTTP/1.1 206 Partial Content');
			header('Content-Range: bytes '.$seek_start.'-'.$seek_end.'/'.$file_size);
			header('Content-Length: '.($seek_end - $seek_start + 1));
		}
		else
		  header("Content-Length: $file_size");

		header('Accept-Ranges: bytes');
    
		set_time_limit(0);
		fseek($file, $seek_start);
		
		while(!feof($file)) 
		{
			print(@fread($file, 1024*8));
			ob_flush();
			flush();
			if (connection_status()!=0) 
			{
				@fclose($file);
				exit;
			}			
		}
		
		@fclose($file);
		exit;
	}
	else 
	{
		header("HTTP/1.0 500 Internal Server Error");
		exit;
	}
}
else
{
	header("HTTP/1.0 404 Not Found");
	exit;
}
?>