<?php
/**
 * Created by irworks on 06.09.16.
 * © Copyright irworks, 2016
 * @link https://github.com/irworks/onPointCMS-2
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
     * @param bool $asArray - Return the slides as a array of arrays instead of objects.
     * @return array
     */
    public function getSlides($asArray = false): array {

        if($asArray) {
            $jsonSlides = array();
            foreach ($this->slides as $slide) {
                $jsonSlides[] = $slide->toArray();
            }

            return $jsonSlides;
        }

        return $this->slides;
    }
}