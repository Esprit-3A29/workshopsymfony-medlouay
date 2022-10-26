<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


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


    /**
     * @Route("/studentList", name="list_students")
     */

    public function listStudents(StudentRepository $repository)
    {
        $student=$repository->findAll();
        $sortBymoyenne=$repository->sortByMoyenne();
        $topstudents=$repository->topStudent();
        return $this->render("student/studentList.html.twig",array ("tabStudent"=>$student,"sorted"=>$sortBymoyenne,"topstudents"=>$topstudents));
    }


    /**
     * @Route("/addstudent3", name="add3_student")
     */
    
    public function addStudent(ManagerRegistry $doctrine,Request $request,StudentRepository $repository)
    {
        $student= new Student;
        $form= $this->createForm(StudentType::class,$student);
        $form->handleRequest($request) ;
        if ($form->isSubmitted()){

                $repository->add($student,true);
            //  $em= $doctrine->getManager();
            //  $em->persist($student);
            //  $em->flush();
             return  $this->redirectToRoute("list_students");
         }
        return $this->renderForm("student/addstudent.html.twig",array("formStudent"=>$form));
    }


    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function removeStudent(ManagerRegistry $doctrine,$id,StudentRepository $repository)
    {
        $student= $repository->find($id);
        $repository->remove($student,true);
        // $em = $doctrine->getManager();
        // $em->remove($student);
        // $em->flush();
        return  $this->redirectToRoute("list_students");
    }
}
