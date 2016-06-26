<?php
/**
 * Created by irworks on 26.06.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: [INSERT]
 * File: irworksWeb/Controller.php
 * Depends: [NONE]
 */

require_once 'Template.php';

class Controller
{
    protected $tpl;
    
    function __construct() {
        $this->tpl = new Template();
    }
}