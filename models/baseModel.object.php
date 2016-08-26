<?php
/**
 * Created by irworks on 26.08.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: Base model!
 * File: irworksWeb/baseModel.object.php
 * Depends: [NONE]
 */
class BaseModel
{
    protected $createDaTi;
    protected $updateDaTi;

    /**
     * @return mixed
     */
    public function getCreateDaTi() {
        return $this->createDaTi;
    }

    /**
     * @return mixed
     */
    public function getUpdateDaTi() {
        return $this->updateDaTi;
    }


}