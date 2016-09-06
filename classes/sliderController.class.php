<?php
/**
 * Created by irworks on 06.09.16.
 * © Copyright irworks, 2016
 * All rights reserved, do not distribute
 */

/**
 * Module: Slider
 * File: irworksWeb/sliderController.class.php
 * Depends: [NONE]
 */

namespace irworksWeb\Controller;

use Slide;

require_once __DIR__ . '/../models/slide.object.php';
require_once __DIR__ . '/../config/static.php';

class SliderController
{
    private $slides;
    private $db;

    public function __construct(DB $db) {
        $this->db = $db;

        $this->slides = $this->loadSlides();
    }

    /**
     * Load all slides from the database.
     * @return array
     */
    private function loadSlides() {
        $slides = array();

        $q  = 'SELECT slideId, target, source' . PHP_EOL;
        $q .=   'FROM' . PHP_EOL;
        $q .= 'slide' . PHP_EOL;

        $result = $this->db->query($q);
        while($result && $slide = mysqli_fetch_object($result, Slide::class)) {
            $slides[] = $slide;
        }

        return $slides;
    }

    /**
     * Return the list of slide models.
     * @return array
     */
    public function getSlides(): array {
        return $this->slides;
    }
}