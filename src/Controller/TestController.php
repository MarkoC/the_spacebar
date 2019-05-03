<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
class TestController extends AbstractController
{
    /**
     * @Route("/test/{user}", name="test")
     */
    public function index(User $user, UserPasswordEncoderInterface $passwordEncoder)
    {

         $pswd = $passwordEncoder->encodePassword(
                $user,
                '1234'
            );
       dd($pswd);
       return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
