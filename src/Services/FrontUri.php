<?php

namespace App\Services;

/**
 * Class FrontUri
 */
class FrontUri {

    /**
     * @var String
     */
    private $frontURL;

    /**
     * FrontUri constructor.
     * @param $frontURL
     */
    public function __construct($frontURL)
    {
        $this->frontURL = $frontURL;
    }

    /**
     * Retourne l'URL du front office
     * @return String
     */
    public function getFrontURL(): string
    {
        return $this->frontURL;
    }



}