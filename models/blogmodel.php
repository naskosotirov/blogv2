<?php

class Blogmodel {

    private $_db;
    private $_result;

    function __construct() {
        $this->_db = Database::getInstance();
        $this->_result = array(); 
    }

    public function getBlogData() {
        $this->_result = $this->_db->getRows('SELECT `posts`.`post_id`, `posts`.`post_title`, `posts`.`post_text`, `posts`.`post_date`, `authors`.`author_name` FROM `posts` INNER JOIN `authors` ON(`posts`.`post_author` = `authors`.`author_id`) ORDER BY `posts`.`post_id` DESC');

        return $this->_result;
    }

    public function getAuthors() {
        $this->_result = $this->_db->getRows('SELECT * FROM `authors`');

        return $this->_result;
    }

    public function getLongestPostAuthor() {
        $this->_result = $this->_db->getRows('SELECT  `authors`.`author_name` FROM  `authors` INNER JOIN  `posts` ON (  `posts`.`post_author` =  `authors`.`author_id` ) WHERE LENGTH(  `posts`.`post_text` ) = ( SELECT MAX( LENGTH(  `posts`.`post_text` ) ) FROM  `posts` )');

        return $this->_result;   
    }

    public function insertPost($data) {
        $return_id = false;
        $data['post_text'] = filter_var($data['post_text'], FILTER_SANITIZE_STRING);

        foreach($data as $key => $data_value) {
            $data[$key] = $this->_db->RealEscapreSting($data_value);
        }

        $this->_result = $this->_db->insertUpdateDeleteQuery("INSERT INTO `posts` (`post_title`, `post_author`, `post_text`) VALUES ('{$data['post_title']}', '{$data['post_author']}', '{$data['post_text']}')");
        
        if($this->_result) {
            $return_id = $this->_db->getLastId();
        }

        return $return_id;
    }

    public function getSiglePost($post_id) {
        if(!is_numeric($post_id)) {
            return array();
        }

        $post_id = $this->_db->RealEscapreSting($post_id);

        $this->_result = $this->_db->getRows('SELECT `posts`.`post_id`, `posts`.`post_title`, `posts`.`post_text`, `posts`.`post_date`, `authors`.`author_name` FROM `posts` INNER JOIN `authors` ON(`posts`.`post_author` = `authors`.`author_id`) WHERE `posts`.`post_id`='.$post_id);

        return $this->_result;        
    }
}
?>
