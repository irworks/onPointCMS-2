<?php
/**
 * Created by irworks on 07.09.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: Represents the admin user.
 * File: irworksWeb/user.object.php
 * Depends: [NONE]
 */

require_once __DIR__ . '/baseModel.object.php';

class User extends BaseModel
{
    protected $userId;
    protected $username;
    protected $password;

    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }


}