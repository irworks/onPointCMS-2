<?php
/**
 * Created by irworks on 26.06.16.
 * © Copyright irworks, 2016
 * @link https://github.com/irworks/onPointCMS-2
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
    use irworksWeb\Controller\MySQLTables;
    use Page;

    class Contentpage extends Controller
    {
        protected $pageTitle;
        protected $pageSubtitle;
        protected $contentID;
        protected $pageOpener;
        protected $pageModel;
        protected $pages;
        protected $extraHead;

        function __construct(DB $db, $contentID, $pageTitle = '', $pageSubtitle = '', $pageOpener = 'IR WORKS', $extraHead = '') {
            parent::__construct($db);

            $this->contentID        = $contentID;
            $this->pageTitle        = $pageTitle;
            $this->pageSubtitle     = $pageSubtitle;
            $this->pageOpener       = $pageOpener;
            $this->extraHead        = $extraHead;

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
            $this->tpl->assign('extraHead', $this->extraHead);

            $this->tpl->assign('footer', '&copy; ' . date('Y') . ', ' . SITE_KEYWORD);

            $this->pageContent .= $this->tpl->getFullHTML('test.html');
            parent::renderPage();
        }

        private function getAllPages() {
            $q  = 'SELECT pageId, pageTitle, pageContent, pageURI, pageIdParent' . PHP_EOL;
            $q .=   'FROM' . PHP_EOL;
            $q .= $this->db->clr(MySQLTables::$PAGE_TABLE) . ' LEFT JOIN ' . $this->db->clr(MySQLTables::$PAGE_CHILD_TABLE) .' ON page.pageId = page_child.pageIdChild' . PHP_EOL;
            $q .=   'ORDER BY pageId';

            $pages = array();
            $result = $this->db->query($q);
            while($result && $page = mysqli_fetch_object($result, Page::class)) {
                $pages[] = $page;
            }

            for($i = 0; $i < count($pages); $i++) {
                for($j = 0; $j < count($pages); $j++) {
                    if($pages[$i]->getPageId() == $pages[$j]->getPageIdParent()) {
                        $pages[$i]->addChildren($pages[$j]);
                    }
                }

                if(empty($pages[$i]->getPageIdParent())) {
                    $this->addNavigationItem($pages[$i]->getPageTitle(), '/page/' . $pages[$i]->getPageURI(), 'mobile-nav-hide', $pages[$i]->getChildren());
                }
            }

            return $pages;
        }

        protected function setPageNotFound() {
            $this->tpl->loadHTML('page-not-found.html');
            $this->pageSubtitle = 'Error 404';
            $this->tpl->assign('siteContent', $this->tpl->getFullHTML('page-not-found.html'));
        }

    }
}