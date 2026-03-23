<?php

namespace App\Controller;

use App\Service\CategoryService;
use App\Controller\AbstractController;
use App\Service\SecurityService;

class SecurityController extends AbstractController
{
    private SecurityService $securityService;

    public function __construct()
    {
        $this->securityService = new SecurityService();
    }

    public function createAccount() : mixed 
    {
        $data= [];
        if (isset($_POST["submit"])) {
            $data["msg"] = $this->securityService->register($_POST);
        }
        return $this->render("register","inscription", $data);
    }
}
