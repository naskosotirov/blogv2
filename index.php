<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('models/blogmodel.php');

$blogmodel = new Blogmodel(); 
$blog_data = $blogmodel->getBlogData();
$author_data = $blogmodel->getAuthors();
$author_top = $blogmodel->getLongestPostAuthor();

require_once('views/list.php');
?>
