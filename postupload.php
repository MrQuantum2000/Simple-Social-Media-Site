<?php
session_start();
include("classes/connect.php");
include("classes/loginclass.php");


$login = new Login();
$user_data = $login->check_login($_SESSION['nsl_userid']);

$postId = $login->create_postid(4,'NSLPOST','postid');

$id = $user_data['userid'];
//upload.php

if(isset($_POST['postImage']) && isset($_POST['postCaption']))
{
	$data = $_POST['postImage'];
    $pCaption = $_POST['postCaption'];

    $folder = "uploads/" . $id . "/" ;
    if(!file_exists($folder))
    {
        mkdir($folder,0777,true);
        file_put_contents($folder . "index.php", "");
    }

	$image_array_1 = explode(";", $data);

	$image_array_2 = explode(",", $image_array_1[1]);
    
	$data = base64_decode($image_array_2[1]);

	$image_name = $folder . $postId . "-" . time() .'.png';

    file_put_contents($image_name, $data);

    if(file_exists($image_name))
    {
        $query = "insert into posts
       (userid,postid,post,image)
       values
       ('$id','$postId','$pCaption','$image_name')";

        $DB = new Database();
        $DB->save($query);
    }

	echo $image_name;
}

?>
