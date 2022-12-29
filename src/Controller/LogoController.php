<?php

namespace App\Controller;

use App\Entity\Logo;
use App\Form\LogoType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class LogoController extends AbstractController
{
    /**
     * @Route("/logo", name="logo")
     */
    public function index(): Response
    {
        return $this->render('logo/liste.html.twig', [
            'controller_name' => 'LogoController',
        ]);
    }
    /**
     * @Route ("/addlogo", name ="addlogo")
     */

    function add (Request $request)
    {
        $logo =new Logo();
        $logo->setDatecreation(new \DateTime('now'));

        $form=$this->createForm( LogoType:: class,$logo);
        //$form->remove('client');
        $form->add('Ajouter', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file = $form->get('imglg')->getData();
$fileName= md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
             $fileName
                );
            }catch (FileException $e)
            {

            }
            $em=$this->getDoctrine()->getManager();
$logo->setImglg($fileName);
            $em->persist($logo);
            $em->flush();
            return $this->redirectToRoute('afficherlogo');
        }
        return $this->render('logo/ajouterLogo.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**
     * @Route ("/addlogoU/{id}", name ="addlogoU")
     */

    function addLgU (Request $request,$id)
    {
        $logo =new Logo();
        $logo->setDatecreation(new \DateTime('now'));
        $logo=$this->getDoctrine()->getRepository(Logo::class)->find($id);
        $form=$this->createForm( LogoType:: class,$logo);
        $form->remove('imglg');
        $form->add('Ajouter', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {




            $em=$this->getDoctrine()->getManager();
            $em->persist($logo);
            $em->flush();
            return $this->redirectToRoute('afficherlogo');
        }
        return $this->render('logo/ajouterLogoU.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**

     */

    function addL (Request $request)
    {
        $logo =new Logo();
        $logo->setDatecreation(new \DateTime('now'));

        $form=$this->createForm( LogoType:: class,$logo);
      //  $form->remove('client');
        $form->add('Ajouter', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file = $form->get('imglg')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            }catch (FileException $e)
            {

            }
            $em=$this->getDoctrine()->getManager();
            $logo->setImglg($fileName);
            $em->persist($logo);
            $em->flush();
            return $this->redirectToRoute('afficherlogoD');
        }
        return $this->render('logo/ajouterLogo.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherlogo", name="afficherlogo")
     */
    public function Afficher()
    {$logo=$this->getDoctrine()->getRepository(Logo::class)->findAll();
        return $this ->render('logo/afficherLg.html.twig',['logo'=>$logo]);
    }

    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherlogoD", name="afficherlogoD")
     */
    public function AfficherDetails()
    {$logo=$this->getDoctrine()->getRepository(Logo::class)->findAll();
        return $this ->render('logo/afficherDetailsLg.html.twig',['logo'=>$logo]);
    }
    /**
     * @Route ("/updatelogo/{id}", name ="updateLg")
     */

    function updatte (Request $request,$id)
    { $logo=$this->getDoctrine()->getRepository(Logo::class)->find($id);
        $logo->setDatecreation(new \DateTime('now'));

        $form=$this->createForm( LogoType:: class,$logo);
        $form->remove('client');
        $form->add('modifier', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file = $form->get('imglg')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            }catch (FileException $e)
            {

            }
            $logo->setImglg($fileName);

            $e = $this->getDoctrine()->getManager();

            $e->flush();
            return $this->redirectToRoute('afficherlogo');
        }
        return $this->render('logo/updateLg.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**
     * @Route ("/updateClogo/{id}", name ="updateLgC")
     */

    function updatteC (Request $request,$id)
    { $logo=$this->getDoctrine()->getRepository(Logo::class)->find($id);
        $logo->setDatecreation(new \DateTime('now'));

        $form=$this->createForm( LogoType:: class,$logo);
       // $form->remove($logo);
        $form->add('modifier', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file = $form->get('imglg')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            }catch (FileException $e)
            {

            }
            $logo->setImglg($fileName);

            $e = $this->getDoctrine()->getManager();

            $e->flush();
            return $this->redirectToRoute('afficherlogo');
        }
        return $this->render('logo/updateLg.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**
     * @Route("/supprimerLg/{id}", name="deleteLg")
     */
    public function supprimer ($id)
    {
        $logo=$this->getDoctrine()->getRepository(Logo::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($logo);//suprrimer lobjet dans le parametre
        $em->flush();
        return $this->redirectToRoute('afficherlogo');

    }
}
