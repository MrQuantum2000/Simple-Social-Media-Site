<?php
session_start();
include("classes/connect.php");
include("classes/loginclass.php");


$login = new Login();
$user_data = $login->check_login($_SESSION['nsl_userid']);
$id = $user_data['userid'];
//upload.php

if(isset($_POST['image']))
{
	$data = $_POST['image'];

    $folder = "uploads/" . $id . "/" ;
    if(!file_exists($folder))
    {
        mkdir($folder,0777,true);
        file_put_contents($folder . "index.php", "");
    }
	
	$image_array_1 = explode(";", $data);

	$image_array_2 = explode(",", $image_array_1[1]);

	$data = base64_decode($image_array_2[1]);

	$image_name = $folder . 'profile'. time() .'.png';

    if(file_exists($user_data['profile_image']))
    {
         unlink($user_data['profile_image']);
    }

    file_put_contents($image_name, $data);

    if(file_exists($image_name))
    {
        $query = "update users set profile_image = '$image_name' where userid = '$id' limit 1";
        $DB = new Database();
        $DB->save($query);
    }

	echo $image_name;
}

?>
