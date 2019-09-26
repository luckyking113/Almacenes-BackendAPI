<?php

$files = glob('warehouse_admin/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
    
$files1 = glob('mcflybackend/*'); // get all file names
foreach($files1 as $file){ // iterate files
  if(is_file($file))
    unlink($file); 
 
 $files2 = glob('config/*'); // get all file names
 foreach($files2 as $file){ // iterate files
  if(is_file($file))
    unlink($file); 
?>