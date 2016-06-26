<?php
/**
 * Created by irworks on 26.06.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: [INSERT]
 * File: irworksWeb/Testpage.php
 * Depends: [NONE]
 */

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

        echo($this->tpl->getFullHTML('test.html'));
    }

}