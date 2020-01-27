<?php
namespace App\Controller\Admin;
 use App\Controller\PropertyController;
 use App\Entity\Property;
 use App\Form\PropertyType;
 use App\Repository\PropertyRepository;
 use Doctrine\Common\Persistence\ObjectManager;
 use Doctrine\ORM\EntityManagerInterface;
 use Symfony\Component\HttpFoundation\RedirectResponse;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

 class AdminPropertyController extends AbstractController {

     /**
      * @var PropertyRepository
      */
     private $repository;
     /**
      * @var ObjectManager
      */

     /**
      * @var EntityManagerInterface
      */
     private $em;

     public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
     {
         $this->repository=$repository;
         $this->em=$em;

     }

     /**
      * @Route("/admin/property/create",name= "admin.property.new")
      * @param Request $request
      * @return RedirectResponse
      */
     public function new(Request $request)
     {

         $property = new Property();

         $form= $this->createForm(PropertyType::class,$property);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
             $this->em->persist($property);
             $this->em->flush();
             $this->addFlash('success','Bien ajoute avec success');
             return  $this->redirectToRoute('admin.property.index');//redirger vers lis des bien
         }
         return $this->render('admin/property/new.html.twig',[
             'property' => $property,
             'form' => $form->createView()
         ]);



     }

     /**
      * @Route("/admin", name="admin.property.index")
      * @return Response
      */
     public function index()
     {
         $properties= $this->repository->findAll();
        return $this->render('admin/property/index.html.twig',compact('properties'));
     }

     /**
      * @Route("/admin/property/{id}",name="admin.property.edit", methods= "GET|POST")
      * @param Property $property
      * @param Request $request
      * @return Response
      */
     public function edit(Property $property, Request $request)
     {
         $form= $this->createForm(PropertyType::class,$property);
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
             $this->em->flush();
             $this->addFlash('success','Bien modifier avec success');
             return  $this->redirectToRoute('admin.property.index');//redirger vers lis des bien
         }

        return $this->render('admin/property/edit.html.twig',[
            'property' => $property,
            'form' => $form->createView()
        ]);
     }


     /**
      * @Route("/admin/property/{id}",name="admin.property.delete", methods="DELETE")
      * @param Property $property
      * @param Request $request
      * @return RedirectResponse
      */
     public function delete(Property $property, Request $request){

         if($this->isCsrfTokenValid('delete', $request->get('_token'))){
             $this->em->remove($property);
             $this->em->flush();
             $this->addFlash('success','Bien supprimer avec success');
         }

         return  $this->redirectToRoute('admin.property.index');//redirger vers lis des bien

     }
 }