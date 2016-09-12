<?php
/**
 * Created by irworks on 12.09.16.
 * © Copyright irworks, 2016
 * @link https://github.com/irworks/onPointCMS-2
 */

/**
 * Module: A list of the table Names.
 * File: irworksWeb/mySQLTables.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\Controller;


class MySQLTables
{
    public static $USER_TABLE           = 'users';
    public static $USER_SESSION_TABLE   = 'users_session';
    public static $BLOG_TABLE           = 'blog';
    public static $PAGE_TABLE           = 'page';
    public static $PAGE_CHILD_TABLE     = 'page_child';
    public static $SLIDER_TABLE         = 'slide';
}