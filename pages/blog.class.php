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
        $isSinglePost = false;

        $q = 'SELECT postId, postTitle, postContent, createDaTi, updateDaTi' . PHP_EOL;
        $q .= 'FROM' . PHP_EOL;
        $q .= 'blog' . PHP_EOL;

        if(!empty($this->contentID)) {
            //only one post should be displayed
            $q .= 'WHERE postId = ' . $this->db->cl($this->contentID) . PHP_EOL;

            $limit           = 1;
            $isSinglePost    = true;
        }
        $q .= 'LIMIT ' . $limit;

        $siteContent = '';

        $countPosts = 0;
        $result = $this->db->query($q);
        while($result && $blogPost = mysqli_fetch_object($result, \BlogPost::class)) {
            $this->tpl->loadHTML('blog-post.html');

            $content = nl2br($blogPost->getPostContent());
            $content = $isSinglePost ? $content : mb_substr($content, 0, BLOG_POST_PREVIEW_LENGTH, 'UTF-8');

            if(!$isSinglePost && strlen($blogPost->getPostContent()) > BLOG_POST_PREVIEW_LENGTH) {
                $content .= '...';
            }

            $this->tpl->assign('postId', $blogPost->getPostId());
            $this->tpl->assign('postName', $blogPost->getPostTitle());
            $this->tpl->assign('postContent',  $content);
            $this->tpl->assign('postPublishDate', $this->parseMySQLDate($blogPost->getCreateDaTi()));

            $readMoreClass = 'post';
            if($isSinglePost) {
                $readMoreClass = 'ir-display-none';
            }
            $this->tpl->assign('readMoreClass', $readMoreClass);

            $siteContent .= $this->tpl->getFullHTML('blog-post.html');
            $countPosts++;
        }

        if(!$result || $countPosts <= 0) {
            $this->setPageNotFound();
        }else{
            $this->tpl->assign('siteContent', $siteContent);
        }
    }

}
