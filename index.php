<?php
/**
 * Created by irworks on 26.06.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: [INSERT]
 * File: irworksWeb/index.php
 * Depends: [NONE]
 */

namespace irworksWeb {
    require_once __DIR__ . '/config/database.php';
    require_once __DIR__ . '/classes/db.class.php';

    if(SRV_TYPE_PRODUCTION) {
        error_reporting(0);
    }

    use irworksWeb\Controller\DB;
    use irworksWeb\GUI\Blog;
    use irworksWeb\GUI\Contentpage;
    use irworksWeb\GUI\DatabaseFailedPage;
    use irworksWeb\GUI\Homepage;
    use irworksWeb\GUI\StaticPage;

    $contentType = isset($_GET['content-type']) ? removeTags($_GET['content-type']) : 'page';
    $contentID   = isset($_GET['content-id'])   ? removeTags($_GET['content-id'])   : '';

    /* connect to the database */
    $db = new DB(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

    if($db->connect_errno) {
        require_once './pages/databaseFailedPage.class.php';
        new DatabaseFailedPage($db, $db->connect_error);
        exit();
    }

    /* find out what we want */
    switch ($contentType) {

        case 'blog':
            require_once './pages/blog.class.php';
            new Blog($db, $contentID, 'Blog');
            break;

        case 'page':
            if($contentID == '') {
                require_once './pages/homepage.class.php';
                new Homepage($db);
            }else{
                require_once './pages/staticPage.class.php';
                new StaticPage($db, $contentID);
            }
            break;

    }

    function removeTags($input = '') {
        return strip_tags(str_replace('/', '', $input));
    }
}

?>