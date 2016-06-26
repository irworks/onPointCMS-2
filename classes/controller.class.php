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

namespace irworksWeb\Controllers;

require_once 'template.class.php';

abstract class Controller
{
    protected $tpl;
    protected $pageContent;
    
    function __construct() {
        $this->tpl = new Template();
        $this->tpl->loadHTML('general.html');

        $this->pageContent = '';
    }
    
    function renderPage() {
        $this->tpl->assign('body', $this->pageContent, 'general.html');
        echo $this->tpl->getFullHTML('general.html');
    }
}