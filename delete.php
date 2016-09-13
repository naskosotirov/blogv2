<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('core/database.php');
require_once('models/blogmodel.php');

$blogmodel = new Blogmodel();

if(empty($_GET['id'])) {
    die('Not allowed accsess!');
}

$post_id = $blogmodel->deletePost($_GET['id']);

if($post_id) {
    header('Location: index.php');
    exit;
} else {
    header('Content-Type: text/plain; charset=utf-8');
    die("НЕУСПЕШНО ИЗТРИВАНЕ НА ПОСТА ПО ЗАДАДЕНИЯ КЛЮЧ");
}
