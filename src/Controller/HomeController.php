<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $isAcceuil = true;
        return $this->render('home/index.html.twig', [
            'onacceuil' => $isAcceuil,

        ]);
    }

    /**
     * @Route("/", name="home_rien")
     */
    public function home()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


}
