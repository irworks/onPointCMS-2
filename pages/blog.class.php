<?php
/**
 * Created by irworks on 26.08.16.
 * © Copyright irworks, 2016
 * @link https://github.com/irworks/onPointCMS-2
 */

/**
 * Module: The main Blog entry point
 * File: irworksWeb/blog.class.php
 * Depends: Contentpage
 */

namespace irworksWeb\GUI;

use irworksWeb\Controller\DB;
use irworksWeb\Controller\MySQLTables;

require_once __DIR__ . '/contentpage.class.php';
require_once __DIR__ . '/../models/blogPost.object.php';

class Blog extends Contentpage
{
    function __construct(DB $db, $contentID, $pageTitle) {
        parent::__construct($db, $contentID, $pageTitle, 'More than just a blog?', $pageTitle);

        $this->tpl->loadHTML('blog-head.html');
        $this->extraHead = $this->tpl->getFullHTML('blog-head.html');

        $this->getBlogPosts(10, $this->contentID);
        $this->renderPage();
    }

    /**
     * Get all, or one specific Blogpost.
     * @param int $limit
     * @param bool $contentId
     */
    private function getBlogPosts($limit = 10, $contentId = false) {
        $isSinglePost = false;

        $q = 'SELECT postId, postTitle, postContent, createDaTi, updateDaTi' . PHP_EOL;
        $q .= 'FROM' . PHP_EOL;
        $q .= $this->db->clr(MySQLTables::$BLOG_TABLE) . PHP_EOL;

        if(!empty($contentId)) {
            //only one post should be displayed
            $q .= 'WHERE postId = ' . $this->db->cl($contentId) . PHP_EOL;

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
