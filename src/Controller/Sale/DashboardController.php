<?php

namespace App\Controller\Sale;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/dashboard/sale', name: 'dashboard_sale_')]
class DashboardController extends BaseController
{
    #[Route('/home', name: 'home')]
    public function index(Request $request): Response
    {
        return $this->render('sale/dashboard_sale.html.twig', [

            'value' => "TEST",
        ]);
    }
}


