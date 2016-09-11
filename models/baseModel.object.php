<?php
/**
 * Created by irworks on 26.08.16.
 * © Copyright irworks, 2016
 * @link https://github.com/irworks/onPointCMS-2
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
     * BaseModel constructor - Map a key => value array to a class
     * @param array $keyValueArray
     */
    function __construct($keyValueArray = array()) {
        foreach ($keyValueArray as $key => $value) {
            foreach (get_class_vars(get_class($this)) as $varKey => $varValue) {
                if($varKey === $key) {
                    $this->$varKey = $value;
                }
            }
        }

    }

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

    /**
     * Return self as an array.
     * @return array
     */
    public function toArray() {
        return get_object_vars($this);
    }

}