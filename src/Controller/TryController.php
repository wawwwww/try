<?php

namespace App\Controller;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Contact;





class TryController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('try/index.html.twig', [
            'controller_name' => 'TryController',
        ]);
    }



    /**
     * @Route("services", name="services")
     */
    public function ervices()
    {
        return $this->render('try/services.html.twig', [
            'controller_name' => 'TryController',
        ]);
    }



    /**
     * @Route("contact", name="contact")
     */
    public function contact(Request $request, ObjectManager $manager)
    {


    $contact = new Contact();
    $form =$this->createFormBuilder($contact)
                ->add('nom')
                ->add('mail', EmailType::class)
                ->add('message', TextareaType::class )

        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $contact->setCreatedAt(new \DateTime());

            $manager->persist($contact);
            $manager->flush();

            return $this->redirectToRoute('home');
    }
dump($contact);

        return $this->render('try/contacts.html.twig', [
            'formContact' => $form->createView()
        ]);
    }


    /**
     * @Route("candidater", name="candidater")
     */
    public function candidatures()
    {
        return $this->render('try/candidatures.html.twig', [
            'controller_name' => 'TryController',
        ]);
    }


    /**
     * @Route("comments", name="comments")
     */
    public function commentaires()
    {
        return $this->render('try/commentaires.html.twig', [
            'controller_name' => 'TryController',
        ]);
    }




}
