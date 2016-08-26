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

    use irworksWeb\Controller\DB;
    use irworksWeb\GUI\Blog;
    use irworksWeb\GUI\Homepage;

    $contentType = isset($_GET['content-type']) ? removeTags($_GET['content-type']) : 'page';
    $contentID   = isset($_GET['content-id'])   ? removeTags($_GET['content-id'])   : '';

    //var_dump($_GET);

    /* connect to the database */
    $db = new DB(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);

    /* find out what we want */
    switch ($contentType) {

        case 'blog':
            require_once './pages/blog.class.php';
            new Blog($db, $contentID, 'Blog', true, false);
            break;

        case 'page':
            require_once './pages/homepage.class.php';
            new Homepage($db);
            break;

    }

    function removeTags($input = '') {
        return str_replace('/', '', $input);
    }
}

?>