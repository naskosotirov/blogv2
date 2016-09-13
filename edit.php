<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('core/database.php');
require_once('models/blogmodel.php');

if(empty($_POST)) {
    die('Not allowed accsess!');
}
