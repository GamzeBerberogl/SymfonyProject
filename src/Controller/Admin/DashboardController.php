<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/dashboard/admin', name: 'dashboard_admin_')]
class DashboardController extends BaseController
{
    #[Route('/home', name: 'home')]
    public function index(Request $request): Response
    {
        return $this->render('admin/dashboard_admin.html.twig', [

            'value' => "TEST",
        ]);
    }
}


