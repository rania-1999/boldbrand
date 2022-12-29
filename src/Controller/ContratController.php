<?php

namespace App\Controller;

use App\Entity\Chart;
use App\Entity\Contrat;
use App\Form\ChartType;
use App\Form\ContratType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContratController extends AbstractController
{
    /**
     * @Route("/contrat", name="contrat")
     */
    public function index(): Response
    {
        return $this->render('contrat/liste.html.twig', [
            'controller_name' => 'ContratController',
        ]);
    }

    /**
     * @Route ("/addContrat", name ="addContrat")
     */

    function add (Request $request)
    {
        $contrat =new Contrat();
        $contrat->setDatepost(new \DateTime('now'));

        $form=$this->createForm( ContratType:: class,$contrat);
        $form->remove('docbonliv');
        $form->add('Ajouter', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file1 = $form->get('docctr')->getData();
            $fileName1= md5(uniqid()).'.'.$file1->guessExtension();
            try {
                $file1->move(
                    $this->getParameter('contracts_directory'),
                    $fileName1
                );
            }catch (FileException $e)
            {

            }
            if($contrat->getDocbonliv()!=null)
            {
                $contrat->setDocbonliv($contrat->getDocbonliv());

            }
            $contrat->setDocctr($fileName1);
            $em=$this->getDoctrine()->getManager();
            $em->persist($contrat);
            $em->flush();
            return $this->redirectToRoute('afficherContrat');
        }
        return $this->render('contrat/ajouterContrat.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**
     * @Route ("/addContratBN", name ="addContratBN")
     */

    function addBN (Request $request)
    {
        $contrat =new Contrat();
        $contrat->setDatepost(new \DateTime('now'));

        $form=$this->createForm( ContratType:: class,$contrat);
        $form->remove('docctr');
        $form->add('Ajouter', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file2 = $form->get('docbonliv')->getData();
            $fileName2= md5(uniqid()).'.'.$file2->guessExtension();
            try {
                $file2->move(
                    $this->getParameter('contracts_directory'),
                    $fileName2
                );
            }catch (FileException $e)
            {

            }
            if($contrat->getDocctr()!=null)
            {
                $contrat->setDocctr($contrat->getDocctr());

            }
            $contrat->setDocbonliv($fileName2);
            $em=$this->getDoctrine()->getManager();
            $em->persist($contrat);
            $em->flush();
            return $this->redirectToRoute('afficherContrat');
        }
        return $this->render('contrat/ajouterContratBN.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherContrat", name="afficherContrat")
     */
    public function Afficher( )
    {$contrat=$this->getDoctrine()->getRepository(Contrat::class)->findAll();
        return $this ->render('contrat/afficherContrat.html.twig',['contrat'=>$contrat]);
    }


    /**
     * @Route ("/updateContrat/{id}", name ="updateContrat")
     */
//update chaque document a part
    function updatte (Request $request,$id)
    { $contrat=$this->getDoctrine()->getRepository(Contrat::class)->find($id);
        $contrat->setDatepost(new \DateTime('now'));

        $form=$this->createForm( ContratType:: class,$contrat);
        $form->remove('docbonliv');
        $form->add('modifier', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file1 = $form->get('docctr')->getData();
            $fileName1= md5(uniqid()).'.'.$file1->guessExtension();
            try {
                $file1->move(
                    $this->getParameter('contracts_directory'),
                    $fileName1
                );
            }catch (FileException $e)
            {

            }

            $contrat->setDocctr($fileName1);
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('afficherContrat');
        }
        return $this->render('contrat/updateContrat.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }

    /**
     * @Route ("/updateContratBn/{id}", name ="updateContratBn")
     */
//update chaque document a part
    function updatteBn (Request $request,$id)
    { $contrat=$this->getDoctrine()->getRepository(Contrat::class)->find($id);
        $contrat->setDatepost(new \DateTime('now'));

        $form=$this->createForm( ContratType:: class,$contrat);
        $form->remove('docctr');
        $form->add('modifier', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file2 = $form->get('docbonliv')->getData();
            $fileName2= md5(uniqid()).'.'.$file2->guessExtension();
            try {
                $file2->move(
                    $this->getParameter('contracts_directory'),
                    $fileName2
                );
            }catch (FileException $e)
            {

            }

            $contrat->setDocbonliv($fileName2);
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('afficherContrat');
        }
        return $this->render('contrat/updateContratBn.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**
     * @Route("/supprimerContrat/{id}", name="deleteContrat")
     */
    public function supprimer ($id)
    {
        $contrat=$this->getDoctrine()->getRepository(Contrat::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($contrat);//suprrimer lobjet dans le parametre
        $em->flush();
        return $this->redirectToRoute('afficherContrat');

    }

}
