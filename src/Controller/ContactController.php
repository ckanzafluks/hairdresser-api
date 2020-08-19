<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
        // template is stored in src/Resources/views/hello/index.html.php
        return $this->render('contact/index.html.php', [
            'name' => 'toto'
        ]);

    }
}
