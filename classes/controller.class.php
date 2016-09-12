<?php
/**
 * Created by irworks on 26.06.16.
 * © Copyright irworks, 2016
 * @link https://github.com/irworks/onPointCMS-2
 */

/**
 * Module: [INSERT]
 * File: irworksWeb/controller.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\Controller;

require_once 'template.class.php';
require_once 'mySQLTables.class.php';
require_once __DIR__ . '/../config/static.php';
require_once __DIR__ . '/../config/onpoint.php';

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

    protected function addNavigationItem($displayName, $link, $specialClasses = 'mobile-nav-hide', $children = array()) {
        $childrenList = '';

        foreach ($children as $child) {
            $childrenList .= '<li class="navigation-item"><a class="navigation-item-link" href="' . '/page/' . $child->getPageURI()  .'">' . $child->getPageTitle() . '</a></li>';
        }

        $specialClasses = ' ' . $specialClasses;
        $this->navigationContent .= '<li class="navigation-item' . $specialClasses . '"><a class="navigation-item-link" href="' . $link . '">' . $displayName . '</a><ul class="children">' . $childrenList  .'</ul></li>';
    }

    protected function parseMySQLDate($mysqlDate = '', $format = 'd. M. Y, H:m') {
        return date($format, strtotime($mysqlDate));
    }

}