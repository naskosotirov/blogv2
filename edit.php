<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('core/database.php');
require_once('models/blogmodel.php');

$blogmodel = new Blogmodel();

if(!empty($_POST)) {
    $post_id = $blogmodel->updatePost($_POST);

    if($post_id) {
        header('Location: index.php');
        exit;
    } else {
        $_GET['id'] = $_POST['post_id'];
        $error_update = "НЕУСПЕШНО РЕДАКТИРАНЕ НА ПОСТ";
    }
}

if(empty($_GET['id'])) {
    die('Not allowed accsess!');
}

$single_post = $blogmodel->getSiglePost($_GET['id']);
$author_data = $blogmodel->getAuthors();

if(!empty($single_post)) {
    require_once('views/edit.php');
} else {
    header('Content-Type: text/plain; charset=utf-8');
    die("НЯМА НАМЕРЕН ПОСТ ПО ЗАДАДЕНИЯ КЛЮЧ");
}
