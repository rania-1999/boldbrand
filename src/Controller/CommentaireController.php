<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Logo;
use App\Entity\News;
use App\Form\CommentaireFormType;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\LogoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="commentaire")
     */
    public function index(): Response
    {
        return $this->render('commentaire/liste.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }


}
