<?php
/**
 * Created by irworks on 26.08.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: [INSERT]
 * File: irworksWeb/staticPage.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\GUI;

use irworksWeb\Controller\DB;

require_once __DIR__ . '/contentpage.class.php';
require_once __DIR__ . '/../models/page.object.php';
class StaticPage extends Contentpage
{
    protected $pageTitle;
    protected $contentID;
    protected $pageOpener;
    protected $pageModel;

    function __construct(DB $db, $contentID, $pageOpener = 'IR WORKS') {
        parent::__construct($db, $contentID, $this->pageTitle);

        foreach($this->pages as $page) {
            if($page->getPageURI() === $contentID) {
                $this->pageModel = $page;
            }
        }

        if($this->pageModel) {
            $this->pageTitle    = $this->pageModel->getPageTitle();
            $this->pageSubtitle = $this->pageTitle;
            $this->tpl->assign('siteContent', $this->pageModel->getPageContent());
        }else{
            $this->setPageNotFound();
        }

        $this->renderPage();
    }

}