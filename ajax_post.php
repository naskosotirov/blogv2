<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('core/database.php');
require_once('models/blogmodel.php');

if(empty($_POST)) {
    die('Not allowed accsess!');
}

$output = '';
$post_data = array();

$blogmodel = new Blogmodel(); 
$post_id = $blogmodel->insertPost($_POST);

if($post_id) {
    $post_data = $blogmodel->getSiglePost($post_id);
}

if(empty($post_data)) {
    $output = json_encode(array('error' => 1));
} else {
    $output = json_encode(array('error' => 0, 'postData' => $post_data[0]));
}

die($output);
?>
