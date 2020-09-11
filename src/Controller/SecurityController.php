<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/inscription", name="security_inscription")
     */
    public function registration (Request $request, UserPasswordEncoderInterface $encoder)
    {
        $repositori = $this->getDoctrine()->getManager();
        $user = new User();
        $forminscription = $this->createForm(RegistrationType::class, $user);
        $oni = true;

        $forminscription->handleRequest($request);

        //$pass = 'exemple';


        if ($forminscription->isSubmitted() && $forminscription->isValid()){
            $p = $user->getPassword();
            $hash = $encoder->encodePassword($user, $p);
            $user->setPassword($hash);

            $repositori->persist($user);
            $repositori->flush();
        }

        return $this->render ('security/registration.html.twig',[
            'form' => $forminscription->createView(),
            'oni' => $oni,
            ]);
    }
}
