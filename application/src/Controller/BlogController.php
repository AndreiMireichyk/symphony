<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{page<\d+>?1}", name="blog.index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig');
    }

    /**
     * @Route("/blog/{slug}", name="blog.article")x
     */
    public function article($slug){
       return $this->render('blog/article.html.twig');
    }
}
