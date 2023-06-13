<?php

namespace App\Controller\Member;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/dashboard/member', name: 'dashboard_member_')]
class DashboardController extends BaseController
{
    #[Route('/home', name: 'home')]
    public function index(Request $request): Response
    {
        return $this->render('member/dashboard_member.html.twig', [

            'value' => "TEST",
        ]);
    }
}


