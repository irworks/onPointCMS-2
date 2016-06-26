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

abstract class Controller
{
    protected $tpl;
    protected $navigationContent;
    protected $pageContent;
    
    function __construct() {
        $this->tpl = new Template();
        $this->tpl->loadHTML('general.html');
        $this->tpl->loadHTML('navigation.html');

        $this->pageContent = '';
        $this->navigationContent = '<li><a href="./">Home</a></li>';
    }
    
    function renderPage() {
        $this->tpl->assign('navigationItems', $this->navigationContent, 'navigation.html');

        $this->tpl->assign('body', $this->pageContent, 'general.html');
        $this->tpl->assign('navigation', $this->tpl->getFullHTML('navigation.html'), 'general.html');

        echo $this->tpl->getFullHTML('general.html');
    }
}