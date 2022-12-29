<?php

namespace App\Controller;

use App\Entity\Chart;
use App\Entity\Facture;
use App\Form\ChartType;
use App\Form\FactureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FactureController extends AbstractController
{
    /**
     * @Route("/facture", name="facture")
     */
    public function index(): Response
    {
        return $this->render('facture/liste.html.twig', [
            'controller_name' => 'FactureController',
        ]);
    }
    /**
     * @Route ("/addFacture", name ="addFacture")
     */

    function add (Request $request)
    {
        $facture =new Facture();
        $facture->setDatepost(new \DateTime('now'));

        $form=$this->createForm( FactureType:: class,$facture);
        $form->add('Ajouter', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file = $form->get('facture')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('factures_directory'),
                    $fileName
                );
            }catch (FileException $e)
            {

            }
            $em=$this->getDoctrine()->getManager();
            $facture->setFacture($fileName);
            $em->persist($facture);
            $em->flush();
            return $this->redirectToRoute('afficherFacture');
        }
        return $this->render('Facture/ajouterFacture.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherFacture", name="afficherFacture")
     */
    public function Afficher( )
    {$facture=$this->getDoctrine()->getRepository(Facture::class)->findAll();
        return $this ->render('facture/afficherfac.html.twig',['Facture'=>$facture]);
    }
    /**
     * @Route ("/updateFacture/{id}", name ="updatefac")
     */

    function updatte (Request $request,$id)
    { $facture=$this->getDoctrine()->getRepository(Facture::class)->find($id);
        $facture->setDatepost(new \DateTime('now'));

        $form=$this->createForm( FactureType:: class,$facture);
        $form->add('modifier', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file = $form->get('facture')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('factures_directory'),
                    $fileName
                );
            }catch (FileException $e)
            {

            }
            $facture->setFacture($fileName);
            $e = $this->getDoctrine()->getManager();

            $e->flush();
            return $this->redirectToRoute('afficherFacture');
        }
        return $this->render('Facture/updatefac.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**
     * @Route("/supprimerFac/{id}", name="deleteFac")
     */
    public function supprimer ($id)
    {
        $facture=$this->getDoctrine()->getRepository(Facture::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($facture);//suprrimer lobjet dans le parametre
        $em->flush();
        return $this->redirectToRoute('afficherFacture');

    }
}
