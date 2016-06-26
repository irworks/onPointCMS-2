<?php
/**
 * Created by irworks on 26.06.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: GUI pages
 * File: irworksWeb/Testpage.php
 * Depends: [NONE]
 */

namespace irworksWeb\Pages;

require_once '../classes/Controller.php';

class Testpage extends Controller
{

    function __construct() {
        parent::__construct();
        $this->renderPage();
    }

    function renderPage() {
        $this->tpl->loadHTML('test.html');
        $this->tpl->assign('pageOpener', 'This is a test!');
        $this->tpl->assign('pageTitle', 'Testpage');
        $this->tpl->assign('sampleText', 'Lorem ipsum dolar sit amet...');

        $this->pageContent .= $this->tpl->getFullHTML('test.html');
        parent::renderPage();
    }

}