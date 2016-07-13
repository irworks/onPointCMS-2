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

    class Contentpage extends Controller
    {
        
        protected $pageTitle;
        protected $pageOpener;
        protected $showInNavigation;

        function __construct($pageTitle = '', $showInNavigation = true, $pageOpener = 'IR WORKS') {
            parent::__construct();

            $this->pageTitle        = $pageTitle;
            $this->pageOpener       = $pageOpener;
            $this->showInNavigation = $showInNavigation;

            $this->preparePage();
        }

        function preparePage() {
            $this->tpl->loadHTML('test.html');
            $this->tpl->assign('pageOpener', $this->pageOpener);
            $this->tpl->assign('pageTitle', $this->pageTitle);
        }

        function renderPage() {
            if($this->showInNavigation) {
                $this->addNavigationItem($this->pageTitle, 'index.php?content-type=page&content-id=' . urlencode($this->pageTitle));
            }

            $this->pageContent .= $this->tpl->getFullHTML('test.html');
            parent::renderPage();
        }

    }
}