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
    function __construct(DB $db, $contentID, $pageTitle) {
        parent::__construct($db, $contentID, $pageTitle, '@ME - remember to add translation!', $pageTitle);

        $this->tpl->loadHTML('blog-head.html');
        $this->extraHead = $this->tpl->getFullHTML('blog-head.html');

        $this->getBlogPosts();
        $this->renderPage();
    }

    private function getBlogPosts($limit = 10) {
        $q = 'SELECT postId, postTitle, postContent' . PHP_EOL;
        $q .= 'FROM' . PHP_EOL;
        $q .= 'blog' . PHP_EOL;

        if(!empty($this->contentID)) {
            //only one post should be displayed
            $q .= 'WHERE postId = ' . $this->db->cl($this->contentID) . PHP_EOL;
            $limit = 1;
        }
        $q .= 'LIMIT ' . $limit;

        $siteContent = '';

        $result = $this->db->query($q);
        while($result && $blogPost = mysqli_fetch_object($result, \BlogPost::class)) {
            $this->tpl->loadHTML('blog-post.html');
            $this->tpl->assign('postName', $blogPost->getPostTitle());
            $this->tpl->assign('postContent', $blogPost->getPostContent());

            $siteContent .= $this->tpl->getFullHTML('blog-post.html');
        }

        $this->tpl->assign('siteContent', $siteContent);
    }

}
