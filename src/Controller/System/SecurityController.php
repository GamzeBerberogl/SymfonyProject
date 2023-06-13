<?php

namespace App\Controller\System;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/sys/security', name: 'system_security_')]
class SecurityController extends AbstractController
{

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('system_security_success');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($error) {
            $this->addFlash("danger", $error->getMessage());
        }

        return $this->render('security/login.html.twig', [
            'title' => "Oturum Açın",
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        return $this->redirectToRoute("system_security_login");
    }

    #[Route('/success', name: 'success')]
    public function success(TranslatorInterface $translator): Response
    {
        $title = "Hoş Geldiniz";
        $header = "Oturumunuz başarıyla açıldı";
        $message = "Vermiş olduğunuz bilgiler ile oturumunuzu açtık. Açılış/Dashboard sayfanıza gidebilirsiniz.";
        $buttonDashboard = "Dashboard/Açılış Sayfama Git";

        return $this->render('welcome.html.twig', [
            'header' => $header,
            'message' => $message,
            'buttonDashboard' => $buttonDashboard,
        ]);
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function dashboard(Request $request, UserRepository $userRepository): ?RedirectResponse
    {
        $ip = $request->getClientIp();
        //        $ip = $request->getClientIps();

        if (!$ip) {
            $ip = "0.0.0.0";
        }
        $this->updateUserLastLogin($ip, $userRepository);

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('dashboard_admin_home');
        } elseif ($this->isGranted('ROLE_SALE')) {
            return $this->redirectToRoute('dashboard_sale_home');
        } elseif ($this->isGranted('ROLE_COMPANY')) {
            return $this->redirectToRoute('dashboard_company_home');
        } elseif ($this->isGranted('ROLE_MEMBER')) {
            return $this->redirectToRoute('dashboard_member_home');
        } elseif ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('dashboard_user_home');
        }else {
            return $this->redirectToRoute("app_logout");
        }
    }

    private function updateUserLastLogin(string $ip, UserRepository $userRepository)
    {
        /** @var User $user */
        $user = $this->getUser();

        $userId = $user->getId();

        $userId = intval($userId);

        if ($userId) {
            $userRepository->updateUserLastLogin($userId, $ip);
        }
    }
}


