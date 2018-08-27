<?php
if ($_FILES["file"]["error"] > 0){
echo "Error: " . $_FILES["file"]["error"];
}else{
echo "filename:" . $_FILES["file"]["name"]."<br/>";
echo "filetype " . $_FILES["file"]["type"]."<br/>";
echo "filesize: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
echo "tempname: " . $_FILES["file"]["tmp_name"];
if (file_exists("upload/" . $_FILES["file"]["name"])){
echo "sessus upload";}
else{
move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]);
}
header('Location:'."upload/".$_FILES["file"]["name"]);
exit;
}
?> 
