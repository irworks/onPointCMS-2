<?php
/**
 * Created by irworks on 13.07.16.
 * © Copyright irworks, 2016
 * @link https://github.com/irworks/onPointCMS-2
 */

/**
 * Module: Homepage, custom page for the landing one.
 * File: irworksWeb/homepage.class.php
 * Depends: DB, Contentpage etc.
 */

namespace irworksWeb\GUI;
use irworksWeb\Controller\DB;

require_once __DIR__ . '/contentpage.class.php';

class Homepage extends Contentpage
{
    function __construct(DB $db) {
        parent::__construct($db, '', 'Homepage', false);

        $this->extraHead .= '<script src="/js/slider.js" type="text/javascript"></script>';

        $this->tpl->assign('pageSubtitle', 'More than just code.');
        $this->tpl->assign('sampleText', 'Lorem ipsum...');

        $this->tpl->loadHTML('homepage.html');
        $this->tpl->assign('siteContent', $this->tpl->getFullHTML('homepage.html'));

        $this->renderPage();
    }
}