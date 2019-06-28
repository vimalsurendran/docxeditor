<?php

  //file to be edited
	$file = "test.docx";
  
  //new file to generated after editing
	$file2 = "test2.docx";
  
  //get current working directory 
	$dir = getcwd();


	if (!is_dir("temp")) 
  {
		mkdir("temp");
	} 
  else 
  {
		shell_exec("rm -rf temp");
	}

	$edir = escapeshellarg($dir);
 
	echo shell_exec("unzip $edir/$file -d $edir/temp");

	$c = file_get_contents("temp/word/document.xml");
	
	$c = str_replace("replacing-content", "https://github.com/vimalsurendran/", $c); 	 
  
	unlink("temp/word/document.xml");
  
	file_put_contents("temp/word/document.xml", $c);

	if(is_file($file2)) unlink($file2);

	$cmd = "cd $edir/temp && zip -r ../$file2 *";
  
	echo shell_exec($cmd);



?>
