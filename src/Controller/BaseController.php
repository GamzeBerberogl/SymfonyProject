<?php

namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    protected function getCurrentUser(): ?User
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user === null) {
            return null;
        }

        return $user;
    }


}
