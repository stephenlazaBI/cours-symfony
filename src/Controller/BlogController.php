<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_list")
     */
    public function index()
    {
        $onblog = true;
        return $this->render('blog/index.html.twig', [
            'onblog' => $onblog,
        ]);
    }

    /**
     * @Route("/creation_blog", name="blog_create")
     */
    public function creation()
    {
        $isCreate = true;
        return $this->render('blog/creation.html.twig', [
            'oncreate' => $isCreate,
        ]);
    }
}
