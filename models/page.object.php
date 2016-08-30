<?php
/**
 * Created by irworks on 26.08.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: Page model from the database.
 * File: irworksWeb/page.object.php
 * Depends: [NONE]
 */
require_once __DIR__ . '/baseModel.object.php';
class Page extends BaseModel
{
    protected $pageId;
    protected $pageTitle;
    protected $pageContent;
    protected $pageURI;
    protected $pageIdParent;
    protected $idUser;
    protected $children = array();

    /**
     * @return mixed
     */
    public function getPageId() {
        return $this->pageId;
    }

    /**
     * @return mixed
     */
    public function getPageTitle() {
        return $this->pageTitle;
    }

    /**
     * @return mixed
     */
    public function getPageContent() {
        return $this->pageContent;
    }

    /**
     * @return mixed
     */
    public function getPageURI() {
        return $this->pageURI;
    }

    /**
     * @return mixed
     */
    public function getPageIdParent() {
        return $this->pageIdParent;
    }

    /**
     * @return mixed
     */
    public function getIdUser() {
        return $this->idUser;
    }

    /**
     * @return array
     */
    public function getChildren(): array {
        return $this->children;
    }

    public function addChildren(Page $child) {
        $this->children[] = $child;
    }


}