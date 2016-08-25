<?php
/**
 * Created by irworks on 25.08.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: [INSERT]
 * File: irworksWeb/db.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\Controller;


use mysqli;

class DB extends mysqli
{
    /**
     * Escapes a MySQL input string.
     * @param string $input
     * @return string
     */
    public function cl($input = '') {
        if ($input === null || $input === false) {
            return 'NULL';
        }

        return "'" .  \mysqli::escape_string($input) . "'" ;
    }

    /**
     * Escapes a MySQL field name.
     * @param $input
     * @return string
     */
    public function clr($input) {
        return "`" .  \mysqli::escape_string($input) . "`" ;
    }

    /**
     * Executes a given query.
     * @param string $input
     * @return bool|\mysqli_result
     */
    public function query($input) {
        $out = parent::query($input);

        if(empty($out)){
            error_log('Qurey failed! Error: ' . $this->error);
        }

        while ($this->more_results() && $this->next_result()){
            //free each result.
            $result = $this->use_result();

            if(!empty($result)){
                $result->free();
            }
        }

        return $out;
    }

}