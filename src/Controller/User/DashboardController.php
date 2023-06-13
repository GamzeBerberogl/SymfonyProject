<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/user")
 * @Security("is_granted('ROLE_USER')")
 */
#[Route('/user/dashboard', name: 'dashboard_user_')]
class DashboardController extends BaseController
{
    #[Route('/home', name: 'home')]
    public function index(Request $request): Response
    {
        return $this->render('user/dashboard_user.html.twig', [

            'value' => "TEST",
        ]);
    }
}


