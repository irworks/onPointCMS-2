<?php
/**
 * Created by irworks on 30.08.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 might*
 * Module: [INSERT]
 * File: irworksWeb/databaseFailedPage.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\GUI;
require_once __DIR__ . '/../classes/controller.class.php';

use irworksWeb\Controller\Controller;

class DatabaseFailedPage extends Controller {
    function __construct($db, $reason) {
        parent::__construct($db);

        if(SRV_TYPE_PRODUCTION) {
            $reason = 'We are aware of the problem and are currently investigating what caused it.<br>We are sorry for any inconvenience this might cause.';
        }

        $this->tpl->loadHTML('test.html');

        $this->tpl->assign('pageOpener', 'ERROR');
        $this->tpl->assign('pageTitle', 'ERROR');
        $this->tpl->assign('pageSubtitle', 'A database error occured, please try again later.');
        $this->tpl->assign('extraHead', '');
        $this->tpl->assign('siteContent', $reason);
        $this->tpl->assign('footer', '');

        $this->pageContent .= $this->tpl->getFullHTML('test.html');

        $this->renderPage();
    }
}