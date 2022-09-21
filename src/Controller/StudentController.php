<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="app_student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    /**
     * @Route("/list", name="list_student")
     */

    public function listStudent(){
        return new Response("bonjour 3a29");
    }
    /**
     * @Route("/redirc", name="redirc_student")
     */

    public function redirc():RedirectResponse
    {
        
        return $this->redirect('/student');
    }
}
