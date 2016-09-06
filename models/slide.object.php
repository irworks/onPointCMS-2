<?php
/**
 * Created by irworks on 06.09.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: [INSERT]
 * File: irworksWeb/slide.object.php
 * Depends: [NONE]
 */

require_once __DIR__ . '/baseModel.object.php';
class Slide extends BaseModel
{
    protected $slideId;
    protected $target;
    protected $source;
}