<?php
/**
 * Created by irworks on 26.06.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: [INSERT]
 * File: irworksWeb/controller.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\Controller;

require_once 'template.class.php';
require_once __DIR__ . '/../config/static.php';

abstract class Controller
{
    protected $tpl;
    protected $navigationContent;
    protected $pageContent;
    protected $db;
    
    function __construct(DB $db) {
        $this->db = $db;

        $this->tpl = new Template();
        $this->tpl->loadHTML(GENERAL_NAME);
        $this->tpl->loadHTML('navigation.html');

        $this->pageContent = '';
        $this->addNavigationItem('IRWORKS.DE', '/', 'big-navigation-item');
        $this->addNavigationItem('Home', '/');
        $this->addNavigationItem('Blog', '/blog/');
    }
    
    function renderPage() {
        $this->tpl->assign('navigationItems', $this->navigationContent, 'navigation.html');

        $this->tpl->assign('siteOrigName', SITE_NAME, GENERAL_NAME);
        $this->tpl->assign('siteDescription', SITE_DESCRIPTION, GENERAL_NAME);
        $this->tpl->assign('siteKeywords', SITE_KEYWORD, GENERAL_NAME);
        
        $this->tpl->assign('body', $this->pageContent, GENERAL_NAME);
        $this->tpl->assign('navigation', $this->tpl->getFullHTML('navigation.html'), GENERAL_NAME);

        echo $this->tpl->getFullHTML(GENERAL_NAME);
    }

    protected function addNavigationItem($displayName, $link, $specialClasses = '') {
        $this->navigationContent .= '<li class="navigation-item ' . $specialClasses . '"><a class="navigation-item-link" href="' . $link . '">' . $displayName . '</a></li>';
    }

    protected function getNavigationList() {

    }
}