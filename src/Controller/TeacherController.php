<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    /**
     * @Route("/teacher", name="app_teacher")
     */
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }

    /**
     * @Route("/show/{name}", name="show_teacher")
     */

    public function ShowTeacher($name){
        return new Response("bonjour:".$name);
        
    }
    /**
     * @Route("/showinterface/{name1}", name="interface_teacher")
     */
    public function showInterface($name1){
        return $this->render('teacher/showTeacher.html.twig',['name1' =>   $name1,]);
    }
}
