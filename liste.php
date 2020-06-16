<?php
$folder = $path = "videos";
$out="out";
$files = array_diff(scandir($path), array('.', '..'));
foreach ($files as $key => $value) 
{
	$dosya="videos/".$value;
	if (file_exists($dosya)) 
	{
		$filename = $value;
		$input=$folder.DIRECTORY_SEPARATOR.$filename;
		$outfile=$out.DIRECTORY_SEPARATOR.date ("dmYHis", filemtime($dosya)).".mp4";
		 $cmd="d:/ffmpeg/bin/ffmpeg -i ".$input." -threads 0 -c:v libx264 -preset ultrafast -crf 19 -qmin 10 -qmax 51 -c:a libfdk_aac -b:a 128k -y ".$outfile."  2>&1";
		 //echo $cmd."<br>";
		
		if (exec($cmd, $outp,$res))
		{
			if($res != 0) 
			{
				error_log(var_export($outp, true));
				error_log(var_export($res, true));

				throw new \Exception("Error!");
			}		
		}
	}
}
?>