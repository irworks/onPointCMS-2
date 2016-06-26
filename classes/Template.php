<?php
/**
 * Created by irworks on 26.06.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: Template loader, load html files
 * File: irworksWeb/Template.php
 * Depends: [NONE]
 */
class Template
{

    private $BASE_PATH = './html/';
    private $fileNameToContent = array();

    /**
     * loadHTML - loads the content of a file on disk to the assignment array.
     * if a template is already loaded, it won't be overwritten.
     *
     * @param string $fileName - the HTML template to load
     * @return bool - if the reading was successful
     */
    function loadHTML($fileName) {
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
     * getFullHTML - outputs the full HTML string with hopefully all replaced variables
     * if the file was never loaded/not found an empty string is returned
     * 
     * @param string $fileName - the HTML template to be returned
     * @return string - the full HTML string
     */
    function getFullHTML($fileName) {
        return isset($this->fileNameToContent[$fileName]) ? $this->fileNameToContent[$fileName] : '';
    }

}