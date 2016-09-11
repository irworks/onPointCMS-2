<?php
/**
 * Created by irworks on 11.09.16.
 * © Copyright irworks, 2016
 * @link https://github.com/irworks/onPointCMS-2
 */

/**
 * Module: Admin interface
 * File: irworksWeb/dashboard.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\GUI;

use irworksWeb\Controller\DB;

require_once __DIR__ . '/adminPage.class.php';
class Dashboard extends AdminPage
{
    function __construct(DB $db) {
        parent::__construct($db, null);

        if($this->isLoggedIn()) {
            $dashboardHTML = 'admin-dashboard.html';

            $this->tpl->loadHTML($dashboardHTML);

            $this->tpl->assign('softwareVersion', ONPOINT_VERSION, $dashboardHTML);
            $this->tpl->assign('phpVersion', phpversion(), $dashboardHTML);
            $this->tpl->assign('uptime', explode(",", shell_exec('uptime'))[0], $dashboardHTML);

            $this->siteContent .= $this->tpl->getFullHTML($dashboardHTML);
        }
    }
}