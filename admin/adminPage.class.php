<?php
/**
 * Created by irworks on 07.09.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: [INSERT]
 * File: irworksWeb/adminPage.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\GUI;

use irworksWeb\Controller\DB;

require_once __DIR__ . '/../pages/contentpage.class.php';
require_once __DIR__ . '/../models/page.object.php';
class AdminPage extends Contentpage
{
    protected $user;

    function __construct(DB $db, $pageOpener = 'IR WORKS - ADM') {
        parent::__construct($db, -1, $this->pageTitle, 'Admin interface');

        if(!empty($_SESSION[ADMIN_SESSION])) {
            /** The user is signed in. */
            $this->tpl->loadHTML('admin-navigation.html');
            $siteContent = $this->tpl->getFullHTML('admin-navigation.html');
        }else{
            /** Show the login screen. */
            $this->tpl->loadHTML('admin-login.html');
            $siteContent = $this->tpl->getFullHTML('admin-login.html');
        }

        $this->tpl->assign('siteContent', $siteContent);
        $this->renderPage();
    }
}