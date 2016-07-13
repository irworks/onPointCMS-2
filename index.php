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
    use irworksWeb\Controller;
    use irworksWeb\GUI\Homepage;

    $contentType = isset($_GET['content-type']) ? $_GET['content-type'] : 'page';
    $contentID   = isset($_GET['content-id'])   ? $_GET['content-id']   : '404';

    switch ($contentType) {

        case 'blog':
            break;

        case 'page':
            require_once './pages/homepage.class.php';
            new Homepage();
            break;

    }
}

?>