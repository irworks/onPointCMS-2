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
use User;

require_once __DIR__ . '/../pages/contentpage.class.php';
require_once __DIR__ . '/../models/user.object.php';
class AdminPage extends Contentpage
{
    protected $user;

    function __construct(DB $db, User $loginUser = NULL) {
        parent::__construct($db, -1, $this->pageTitle, 'Admin interface');

        $loginError = '';
        if($loginUser) {
            if(!$this->loginUser($loginUser)) {
                $loginError = 'Login failed. Check username and Password.';
            }
        }

        if(!empty($_SESSION[ADMIN_SESSION])) {
            /** The user is signed in. */
            $this->tpl->loadHTML('admin-navigation.html');
            $siteContent = $this->tpl->getFullHTML('admin-navigation.html');
        }else{
            /** Show the login screen. */
            $this->tpl->loadHTML('admin-login.html');
            $this->tpl->assign('loginError', $loginError, 'admin-login.html');
            $siteContent = $this->tpl->getFullHTML('admin-login.html');
        }

        $this->tpl->assign('siteContent', $siteContent);
        $this->renderPage();
    }

    /**
     * Try to log the given user in.
     * @param User $user
     * @return bool - returns success.
     */
    private function loginUser(User $user) {
        $q  = 'SELECT userId, username, password' . PHP_EOL;
        $q .=   'FROM' . PHP_EOL;
        $q .= 'users' . PHP_EOL;
        $q .=   'WHERE username = ' . $this->db->cl($user->getUsername());

        $result = $this->db->query($q);
        if($result && $dbUser = mysqli_fetch_object($result, User::class)) {
            if($dbUser->getPassword() === crypt($user->getPassword(), PASSWORD_SALT)) {
                $_SESSION[ADMIN_SESSION] = $dbUser;
                return true;
            }
        }

        return false;
    }
}