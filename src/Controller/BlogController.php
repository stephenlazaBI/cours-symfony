<?php

namespace App\Controller;

use App\Form\Article1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;



class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_list", methods={"GET","POST"})
     */
    public function index(Request $request)
    {
        $repositori = $this->getDoctrine()->getManager();

        if ($request->getMethod()==="GET") {
            $articles = $repositori->getRepository(Article::class)->findAll();
        }
        if ($request->isMethod("POST")){
            $recherche = $request->get('recherche');
            $articles = $repositori->getRepository(Article::class)->rechercheByTitre($recherche);

        }
        $onblog = true;

        return $this->render('blog/index.html.twig', [
            'onblog' => $onblog,
            'articles' => $articles,
        ]);
    }


    /**
     * @Route("/blog/edit/{id}", name="blog_edit")
     * @Route("/blog/new", name="blog_create")
     */

    public function edit( Request $request)
    {
        $repositori = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $article = null;
        if ($id !==null){
            $article = $repositori->getRepository(Article::class)->find($id);

        }

        if(!$article){
            $article = new Article();
        }

        $form = $this->createForm(Article1Type::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            if (!$article->getId()){
                $article->setCreatedAt(new \DateTime());
            }
            $repositori->persist($article);
            $repositori->flush();
            return $this->redirectToRoute ('blog_list');

        }

        $isCreate = true;
        return $this->render('blog/creation.html.twig', [
            'oncreate' => $isCreate,
            'article' => $article,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/blog/delete/{id}" , name="blog_delete")
     */
    public function suppr (Article $article){
        if ($article){
            $repositori = $this->getDoctrine()->getManager();
            $repositori->remove($article);
            $repositori->flush();
            return $this->redirectToRoute('blog_list');
        }
        throw new NotFoundHttpException('Article introuvable');
        //return $this->render('blog/creation.html.twig');
    }

    /**
     * @Route("/blog/{id}" , name="blog_show1")
     */
    public function show( Request $request)
    {
        $repositori = $this->getDoctrine()->getManager();
        $articleId = $request->get('id');

        $article = $repositori->getRepository(Article::class)->find($articleId);
        $onblog = true;

        if (!$article instanceof Article){
            throw new NotFoundHttpException('Article introuvable');
        }

        return $this->render('blog/show.html.twig', [

            'onblog' => $onblog,
            'article' => $article,
        ]);
    }




}
