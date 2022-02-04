<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     */
    public function showAccount(UserInterface $user, EntityManagerInterface $entityManager): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $points = $user->getPoint();
    
        if (isset($_POST['points']) && $_POST['points'] !== null) {
            $pointDb = $_POST['points'];
            $points = intVal($pointDb);
            if ($points !== 0) {
                $user->setPoint($points);
                $entityManager->persist($user);
            }
        } else {
            $_POST['points'] = 0;
        }
        $entityManager->flush();

        return $this->render('account/index.html.twig', [
            'user' => 'user',
        ]);
    }
}
