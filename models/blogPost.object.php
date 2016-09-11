<?php
/**
 * Created by irworks on 26.08.16.
 * © Copyright irworks, 2016
 * @link https://github.com/irworks/onPointCMS-2
 */

/**
 * Module: Database Models
 * File: irworksWeb/blogPost.object.php
 * Depends: [NONE]
 */

require_once __DIR__ . '/baseModel.object.php';
class BlogPost extends BaseModel
{
    protected $postId;
    protected $postTitle;
    protected $postContent;

    /**
     * @return mixed
     */
    public function getPostId() {
        return $this->postId;
    }

    /**
     * @return mixed
     */
    public function getPostTitle() {
        return $this->postTitle;
    }

    /**
     * @return mixed
     */
    public function getPostContent() {
        return $this->postContent;
    }

}