<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        // template is stored in src/Resources/views/hello/index.html.php
        return $this->render('index/index.html.php', [
            'name' => 'toto'
        ]);

    }
}
