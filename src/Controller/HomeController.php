<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/hello", name="home")
     */
    public function index()
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',

        ]);
    }

    /**
     * @Route("/", name="blog")
     */
    public function blog()
    {
        return $this->render('blog/index.html.twig');
    }


}
