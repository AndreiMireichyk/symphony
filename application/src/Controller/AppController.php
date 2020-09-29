<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app.home")
     */
    public function index()
    {
        return $this->render('/app/index.html.twig');
    }

    /**
     * @Route("/contacts", name="app.contacts")
     */
    public function contacts(){
        return $this->render('/app/contacts.html.twig');
    }
}
