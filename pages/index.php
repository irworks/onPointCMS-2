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
    use irworksWeb\GUI\Testpage;

    require_once 'testpage.class.php';
    new Testpage();
}

?>