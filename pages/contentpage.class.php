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
    require_once __DIR__ . '/../models/page.object.php';

    use irworksWeb\Controller\Controller;
    use irworksWeb\Controller\DB;
    use Page;

    class Contentpage extends Controller
    {
        protected $pageTitle;
        protected $pageSubtitle;
        protected $contentID;
        protected $pageOpener;
        protected $pageModel;
        protected $pages;

        function __construct(DB $db, $contentID, $pageTitle = '', $pageSubtitle = '', $pageOpener = 'IR WORKS') {
            parent::__construct($db);

            $this->contentID        = $contentID;
            $this->pageTitle        = $pageTitle;
            $this->pageSubtitle     = $pageSubtitle;
            $this->pageOpener       = $pageOpener;

            $this->pages = $this->getAllPages();
            $this->preparePage();
        }

        function preparePage() {
            $this->tpl->loadHTML('test.html');
        }

        public function renderPage() {
            $this->tpl->assign('pageOpener', $this->pageOpener);
            $this->tpl->assign('pageTitle', $this->pageTitle);
            $this->tpl->assign('pageSubtitle', $this->pageSubtitle);

            $this->tpl->assign('footer', '&copy; ' . date('Y') . ', ' . SITE_KEYWORD);

            $this->pageContent .= $this->tpl->getFullHTML('test.html');
            parent::renderPage();
        }

        private function getAllPages() {
            $q  = 'SELECT pageId, pageTitle, pageContent, pageURI' . PHP_EOL;
            $q .=   'FROM' . PHP_EOL;
            $q .= 'page';

            $pages = array();
            $result = $this->db->query($q);
            while($result && $page = mysqli_fetch_object($result, Page::class)) {
                $this->addNavigationItem($page->getPageTitle(), '/page/' . $page->getPageURI());
                $pages[] = $page;
            }

            return $pages;
        }

    }
}