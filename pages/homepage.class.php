<?php
/**
 * Created by irworks on 13.07.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: [INSERT]
 * File: irworksWeb/homepage.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\GUI;
require_once __DIR__ . '/contentpage.class.php';

class Homepage extends Contentpage
{
    function __construct() {
        parent::__construct('Homepage');

        $this->tpl->assign('pageSubtitle', 'More than just code.');
        $this->tpl->assign('sampleText', 'Lorem ipsum...');

        $this->tpl->loadHTML('homepage.html');
        $this->tpl->assign('siteContent', $this->tpl->getFullHTML('homepage.html'));

        $this->renderPage();
    }
}