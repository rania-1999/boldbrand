<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ReclamationController extends AbstractController
{
    /**
     * @Route("/reclamation", name="reclamation")
     */
    public function index(): Response
    {
        return $this->render('reclamation/liste.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }
    /**
     * @Route ("/addRec/{id}", name ="addRec")
     */

    function add (Request $request,UserInterface $user,$id, ClientRepository $repository)
    {


        $rec =new Reclamation();
        $rec->setDatecreation(new \DateTime('now'));
 $user=$repository->find($id);
        $rec->setClient($user);
        $form=$this->createForm( ReclamationType:: class,$rec);
        $form->remove('response');
        $form->add('Ajouter', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $rec= $form->getData();



            $em=$this->getDoctrine()->getManager();
            $em->persist($rec);
            $em->flush();
            return $this->redirectToRoute('afficherPrCl');
        }

        return $this->render('reclamation/ajouterrec.html.twig',[
                'form'=>$form->createView()
            ]
        );

    }
    /**
     * @Route ("/addRecRep/{id}", name ="addRecRep")
     */

    function reponse (Request $request,UserInterface $user,$id, ClientRepository $repository)
    {


        $rec =new Reclamation();
        $rec->setDatecreation(new \DateTime('now'));
        $rec=$this->getDoctrine()->getRepository(Reclamation::class)->find($id);

        $form=$this->createForm( ReclamationType:: class,$rec);
        $form->remove('obj');
        $form->remove('msg');
        $form->add('repondre', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $rec= $form->getData();



            $em=$this->getDoctrine()->getManager();
            $em->persist($rec);
            $em->flush();
            return $this->redirectToRoute('afficherrec');
        }

        return $this->render('reclamation/ajouterrecrep.html.twig',[
                'form'=>$form->createView()
            ]
        );

    }
    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherrec", name="afficherrec")
     */
    public function Afficher( )
    {$rec=$this->getDoctrine()->getRepository(Reclamation::class)->findAll();
        return $this ->render('reclamation/afficherRec.html.twig',['rec'=>$rec]);
    }
    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherrc/{id}", name="afficherrecD")
     */
    public function AfficherCLD($id)
    {
        $rec = $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        return $this->render('reclamation/afficherRecCl.html.twig', ['rec' => $rec]);
    }


    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/Consulter/{id}", name="consulterrecCl")
     */
    public function ConsulterClRec($id )
    {$rec=$this->getDoctrine()->getRepository(Reclamation::class)->findBy(array("client" => $id));

        return $this ->render('reclamation/ConsulterRec.html.twig',['rec'=>$rec]);

    }

    /**
     * @Route("/supprimerRec/{id}", name="deleteRec")
     */
    public function supprimer ($id)
    {
        $rec=$this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($rec);//suprrimer lobjet dans le parametre
        $em->flush();
        return $this->redirectToRoute('afficherrec');

    }
}
