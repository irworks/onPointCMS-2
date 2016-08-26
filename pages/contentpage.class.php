<?php
/**
 * Created by irworks on 26.06.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: GUI pages
 * File: irworksWeb/testpage.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\GUI {
    require_once __DIR__ . '/../classes/controller.class.php';
    use irworksWeb\Controller\Controller;
    use irworksWeb\Controller\DB;

    class Contentpage extends Controller
    {
        protected $pageTitle;
        protected $contentID;
        protected $pageOpener;

        function __construct(DB $db, $contentID, $pageTitle = '', $pageOpener = 'IR WORKS') {
            parent::__construct($db);

            $this->pageTitle        = $pageTitle;
            $this->contentID        = $contentID;
            $this->pageOpener       = $pageOpener;

            $this->preparePage();
        }

        function preparePage() {
            $this->tpl->loadHTML('test.html');
            $this->tpl->assign('pageOpener', $this->pageOpener);
            $this->tpl->assign('pageTitle', $this->pageTitle);

            $this->tpl->assign('footer', '&copy; ' . date('Y') . ', ' . SITE_KEYWORD);
        }

        function renderPage() {
            //$this->addNavigationItem($this->pageTitle, 'index.php?content-type=page&content-id=' . urlencode($this->pageTitle));

            $this->pageContent .= $this->tpl->getFullHTML('test.html');
            parent::renderPage();
        }

    }
}