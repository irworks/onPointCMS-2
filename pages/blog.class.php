<?php
/**
 * Created by irworks on 26.08.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: The main Blog entry point
 * File: irworksWeb/blog.class.php
 * Depends: Contentpage
 */

namespace irworksWeb\GUI;

use irworksWeb\Controller\DB;

require_once __DIR__ . '/contentpage.class.php';
require_once __DIR__ . '/../models/blogPost.object.php';

class Blog extends Contentpage
{
    function __construct(DB $db, $contentID, $pageTitle, $showInNavigation, $pageOpener) {
        parent::__construct($db, $contentID, $pageTitle, $showInNavigation, $pageOpener);

        $this->getBlogPosts();
        $this->renderPage();
    }

    private function getBlogPosts($limit = 10) {
        $q = 'SELECT postId, postCont' . PHP_EOL;
        $q .= 'FROM' . PHP_EOL;
        $q .= 'TBNAME' . PHP_EOL; //TODO: insert table name

        if(!empty($this->contentID)) {
            //only one post should be displayed
            $q .= 'WHERE postId = ' . $this->db->cl($this->contentID) . PHP_EOL;
            $limit = 1;
        }

        $q .= 'LIMIT ' . $this->db->cl($limit);

        $result = $this->db->query($q);
        while($result && $blogPost = mysqli_fetch_object($result, \BlogPost::class)) {

        }
    }

}
