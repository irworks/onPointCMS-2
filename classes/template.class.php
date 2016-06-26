<?php
/**
 * Created by irworks on 26.06.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: Template loader, load html files
 * File: irworksWeb/template.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\Controllers;

class Template
{

    private $BASE_PATH = '../html/';
    private $fileNameToContent = array();

    /**
     * loadHTML - loads the content of a file on disk to the assignment array.
     * if a template is already loaded, it won't be overwritten.
     *
     * @param string $fileName - the HTML template to load
     * @return bool - if the reading was successful
     */
    public function loadHTML($fileName) {
        //check if something already loaded with the filename
        if(isset($this->fileNameToContent[$fileName])) {
            return true;
        }

        //not yet loaded
        $fileContent = file_get_contents($this->BASE_PATH . $fileName);

        //reading failed!
        if($fileContent === false) {
            return false;
        }

        //save content to
        $this->fileNameToContent[$fileName] = $fileContent;
        return true;
    }

    /**
     * assign - Assigns a variable to a given value
     * @param bool $key - the variable
     * @param bool $value - the value
     * @param bool $fileName - optional, specify which cached template should be used for search (faster)
     */
    public function assign($key = false, $value = false, $fileName = false) {
        if($key === false || $value === false) {
            return;
        }

        if($fileName === false) {
            foreach ($this->fileNameToContent as $templateKey => $templateValue) {
                $this->fileNameToContent[$templateKey] = $this->replaceVariables($key, $value, $templateValue);
            }
        }else{
            $this->fileNameToContent[$fileName] = $this->replaceVariables($key, $value, $this->getFullHTML($fileName));
        }
    }


    /**
     * replaceVariables - intern method to replace variables
     * @param $var - the key we are searching for
     * @param $value - the value to be replaced to
     * @param $content - the text in which we should search
     * @return mixed
     */
    private function replaceVariables($var, $value, $content) {
        return str_replace('{$' . $var . '}', $value, $content);
        //return preg_replace("/\{\$" . $var . "\}/", $value, $content);
    }

    /**
     * getFullHTML - outputs the full HTML string with hopefully all replaced variables
     * if the file was never loaded/not found an empty string is returned
     * 
     * @param string $fileName - the HTML template to be returned
     * @return string - the full HTML string
     */
    public function getFullHTML($fileName) {
        return isset($this->fileNameToContent[$fileName]) ? $this->fileNameToContent[$fileName] : '';
    }

}