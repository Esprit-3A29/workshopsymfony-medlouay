<?php

namespace App\Controller;

use App\Entity\ClassRoom;
use App\Form\ClassroomType;
use App\Repository\ClassRoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="app_classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    /**
     * @Route("/listclass", name="list_classroom")
     */
    public function listStudent(ClassRoomRepository $repository)
    {
        $classroom= $repository->findAll();
       // $students= $this->getDoctrine()->getRepository(StudentRepository::class)->findAll();
       return $this->render("classroom/list.html.twig",array("tabclassroom"=>$classroom));
    }

/**
     * @Route("/addForm", name="add_classroom")
     */
    
    public function addForm(ManagerRegistry $doctrine,Request $request)
    {
        $classroom= new ClassRoom;
        $form= $this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request) ;
        if ($form->isSubmitted()){
             $em= $doctrine->getManager();
             $em->persist($classroom);
             $em->flush();
             return  $this->redirectToRoute("list_classroom");
         }
        return $this->renderForm("classroom/add.html.twig",array("formClassroom"=>$form));
    }


    /**
     * @Route("/update/{id}", name="update")
     */

    public function  updateForm($id,ClassRoomRepository $repository,ManagerRegistry $doctrine,Request $request)
    {
        $classroom= $repository->find($id);
        $form= $this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request) ;
        if ($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->flush();
            return  $this->redirectToRoute("list_classroom");
        }
        return $this->renderForm("classroom/update.html.twig",array("formClassroom"=>$form));
    }
/**
     * @Route("/remove/{id}", name="remove")
     */
    public function removeStudent(ManagerRegistry $doctrine,$id,ClassRoomRepository $repository)
    {
        $classroom= $repository->find($id);
        $em = $doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return  $this->redirectToRoute("list_classroom");
    }
}
