<?php
/**
 * Created by irworks on 07.09.16.
 * © Copyright irworks, 2016
 * @link https://github.com/irworks/onPointCMS-2
 */

/**
 * Module: General admin page.
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
    protected $siteContent;

    function __construct(DB $db, User $loginUser = NULL) {
        parent::__construct($db, -1, 'Admin interface', 'Admin interface');

        $loginError = '';
        if($loginUser) {
            if(!$this->loginUser($loginUser)) {
                $loginError = 'Login failed. Check username and Password.';
            }
        }

        if(!empty($_SESSION[ADMIN_SESSION])) {
            /** The user is signed in. */
            $this->tpl->loadHTML('admin-navigation.html');
            $this->siteContent = $this->tpl->getFullHTML('admin-navigation.html');
        }else{
            /** Show the login screen. */
            $this->tpl->loadHTML('admin-login.html');
            $this->tpl->assign('loginError', $loginError, 'admin-login.html');
            $this->siteContent = $this->tpl->getFullHTML('admin-login.html');
        }
    }

    public function renderPage() {
        $this->tpl->assign('siteContent', $this->siteContent);
        parent::renderPage();
    }

    protected function getUser() {
        if(isset($_SESSION[ADMIN_SESSION])) {
            return new User($_SESSION[ADMIN_SESSION]);
        }

        return null;
    }

    protected function isLoggedIn() {
        return $this->getUser() ?? false;
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
                $_SESSION[ADMIN_SESSION] = $dbUser->toArray();
                return true;
            }
        }

        return false;
    }
}