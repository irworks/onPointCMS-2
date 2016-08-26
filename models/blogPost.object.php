<?php
/**
 * Created by irworks on 26.08.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: Database Models
 * File: irworksWeb/blogPost.object.php
 * Depends: [NONE]
 */
class BlogPost
{
    protected $postId;
    protected $postTitle;
    protected $postContent;

    protected $postCreateDaTi;
    protected $postUpdateDaTi;

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

    /**
     * @return mixed
     */
    public function getPostCreateDaTi() {
        return $this->postCreateDaTi;
    }

    /**
     * @return mixed
     */
    public function getPostUpdateDaTi() {
        return $this->postUpdateDaTi;
    }


}