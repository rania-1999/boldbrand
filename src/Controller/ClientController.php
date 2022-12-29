<?php

namespace App\Controller;

use App\Entity\Chart;
use App\Entity\Client;
use App\Entity\Commentaire;
use App\Entity\Contrat;
use App\Entity\Facture;
use App\Entity\Logo;
use App\Entity\Reclamation;
use App\Form\ClientType;
use App\Form\LogoType;
use App\Repository\ClientRepository;
use App\Repository\LogoRepository;
use Doctrine\Common\Collections\Collection;
use MercurySeries\FlashyBundle\FlashyNotifier;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
//use Symfony\Component\Messenger\Middleware\MiddlewareInterface;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(): Response
    {
        return $this->render('client/liste.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    /**
     * @Route ("/addClient", name ="addClient")
     */

    function add(Request $request, UserPasswordEncoderInterface $encoder,\Swift_Mailer $mailer)
    {
        $client = new Client();
        $client->setDatecreation(new \DateTime('now'));

        $form = $this->createForm(ClientType:: class, $client);
        $form->remove('password');
$form->remove('image');
        $form->add('Ajouter', SubmitType::class, [
            'attr' => ['class' => ' btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $client->setUsername($client->getNom() . '.' . $client->getPrenom() . '.' . rand(1, 999));
            $client->setPassword($client->getNum());
$pass=$client->getPassword();
$username=$client->getUsername();

            $email = (new \Swift_Message('Service bolbrands'))

                ->setFrom('beinsmart44@gmail.com')
                ->setTo($client->getEmail())
                ->setSubject('information profil')

                ->setBody($this->renderView(

                    'Security/mail.html.twig',
                    ['username' => $username,'password'=>$pass]
                ),
                    'text/html');

            $mailer->send($email);
            $client = $form->getData();

            //$image = $form->get('image')->getData();$uploads_directory = $this->getParameter('images_directory');

            //   $filename = md5(uniqid()) . '.' . $image->guessExtension();
            //$image->move(
            //    $uploads_directory,
            //  $filename

            //  );
            //   $client->setImage($filename);

            $em = $this->getDoctrine()->getManager();

            $hash = $encoder->encodePassword($client, $client->getPassword());
            $client->setPassword($hash);
            $em->persist($client);
            $em->flush();
            return $this->redirectToRoute('afficherCL');
        }
        return $this->render('client/ajouterCL.html.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherCL", name="afficherCL")
     */
    public function AfficherCL()
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->findAll();
        return $this->render('client/AfficherCL.html.twig', ['client' => $client]);
    }

    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherCL/{id}", name="afficherCLD")
     */
    public function AfficherCLD($id)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        return $this->render('client/profilplus.html.twig', ['client' => $client]);
    }


    /**
     * @Route("/supprimer/{id}", name="deleteCL")
     */
    public function supprimer($id)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($client);//suprrimer lobjet dans le parametre
        $em->flush();
        return $this->redirectToRoute('afficherCL');

    }

    /**
     * @return Response
     * @route ("/client/Request $request/{id}", name="updateCl")
     */
    function UpdateCL(Request $request, $id, UserPasswordEncoderInterface $encoder)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        $form = $this->createForm(ClientType::class, $client);
        $form->remove('password');
        $form->remove('image');

        $form->add('modifier', SubmitType::class, [
                'attr' => ['class' => 'btn-primary'],
            ]

        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $client->setDatecreation(new \DateTime('now'));

            $client->setUsername($client->getNom() . '.' . $client->getPrenom() . '.' . rand(1, 999));
            $client->setPassword($client->getNum());
            $em = $this->getDoctrine()->getManager();
            $hash = $encoder->encodePassword($client, $client->getPassword());
            $client->setPassword($hash);

            $em->flush();
            return $this->redirectToRoute('afficherCL');
        }
        return $this->render('client/updateCL.html.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @return Response
     * @route ("/client/Editmdp/{id}", name="mdp")
     */
    function modifiermdp(Request $request, $id, UserPasswordEncoderInterface $encoder)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        $form = $this->createForm(ClientType::class, $client);
        $form->remove('nom');
        $form->remove('prenom');
        $form->remove('email');
        $form->remove('num');
        $form->remove('paye');
        $form->remove('image');

        $form->add('modifier', SubmitType::class, [
                'attr' => ['class' => 'btn-primary'],
            ]

        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $hash = $encoder->encodePassword($client, $client->getPassword());
            $client->setPassword($hash);


            $em->flush();
            return $this->redirectToRoute('afficherPrCl');
        }
        return $this->render('client/updateMdp.html.twig', ['client'=>$client,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/home", name="home")
     */
    public function AfficherCLde()
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->findAll();
        return $this->render('client/AfficherCL.html.twig', ['client' => $client]);
    }

    /**
     *       \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherPrCl", name="afficherPrCl")
     *
     */
    public function afficherClient(Request $req, SessionInterface $session)
    {

        return $this->render("client/profil.html.twig");

    }

    /**
     * @Route ("/afficherClLogo/{id}", name="afficherClLogo")
     */
    function afficherPrLg($id, Request $request, NormalizerInterface $normalizer, LogoRepository $repo, ClientRepository $repository)
    {


        $logo = $this->getDoctrine()->getRepository(Logo::class)->findOneBy(array("client" => $id));

        if ($logo != null) {

            return $this->render("client/profilLg.html.twig", ['logo' => $logo]);

        }        return $this->render("front/noLogo.html.twig", ["errors" => "aucun logo trouvé"]);

    }


    /**
     * @Route ("/afficherCljson", name="afficherCljson")
     */
    function affichercljson($id, Request $request, NormalizerInterface $normalizer, LogoRepository $repo, ClientRepository $repository)
    {

        $logo = $this->getDoctrine()->getRepository(Client::class)->findAll();

        return $this->render("client/profilCh.html.twig", ['chart' => $logo]);

    }

    /**
     * @Route ("/afficherClCh/{id}", name="afficherClCh")
     */
    function afficherPrCh($id,FlashyNotifier $flashy, Request $request, NormalizerInterface $normalizer, LogoRepository $repo, ClientRepository $repository)
    {

        $logo = $this->getDoctrine()->getRepository(Chart::class)->findOneBy(array("client" => $id));
        if ($logo != null) {
            $flashy->success('Event created!', 'http://your-awesome-link.com');

            return $this->render("client/profilCh.html.twig", ['chart' => $logo]);
          //  $flashy->success('Event created!', 'http://your-awesome-link.com');

        }
        return $this->render("front/noChart.html.twig", ["errors" => "aucune chart trouvée"]);
    }
  /**
     * @Route ("/afficherClContrat/{id}", name="afficherClContrat")
     */
    function afficherPrContrat($id, Request $request, LogoRepository $repo,NormalizerInterface $normalizer,ClientRepository $repository)
    {

        $logo=$this->getDoctrine()->getRepository(Contrat::class)->findOneBy(array("client"=>$id));

        if ($logo==null) {
            return $this->render("front/noCtr.html.twig",["errors"=>"aucun contrat trouvé"]);
}    return $this->render("client/profilContrat.html.twig", ['contrat' => $logo]);
//aamel fonction okhra mtaa  affichage
    }
    /**
     * @Route ("/afficherClFacture/{id}", name="afficherClfacture")
     */
    function afficherPrFacture($id, Request $request, LogoRepository $repo,NormalizerInterface $normalizer,ClientRepository $repository)
    {

        $logo=$this->getDoctrine()->getRepository(Facture::class)->findOneBy(array("client"=>$id));
        if ($logo !=null) {
            return $this->render("client/profilfacture.html.twig", ['facture' => $logo]);
        }return $this->render("front/noFacture.html.twig",["errors"=>"aucune facture trouvée"]);
    }
    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherrecCl/{id}", name="afficherrecCl")
     */
    public function AfficherClRec($id )
    {$rec=$this->getDoctrine()->getRepository(Reclamation::class)->findOneBy(array("client" => $id));

        return $this ->render('client/profilRec.html.twig',['rec'=>$rec]);

    }
    /**
     * @Route ("/afficherProfilCl/{id}", name="afficherProfilCl")
     */
    function afficherPrDetails($id, Request $request, NormalizerInterface $normalizer, LogoRepository $repo, ClientRepository $repository)
    {


        $clieny = $this->getDoctrine()->getRepository(Client::class)->find($id);


        $form=$this->createForm( ClientType:: class,$clieny);
        //$form->remove('client');
        $form->remove('nom');
        $form->remove('prenom');
        $form->remove('email');
        $form->remove('num');
        $form->remove('paye');
        $form->remove('password');



        $form->add('modifier', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file = $form->get('image')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            }catch (FileException $e)
            {

            }
            $clieny->setImage($fileName);

            $e = $this->getDoctrine()->getManager();

            $e->flush();

            return $this->redirectToRoute('afficherPrCl');


    }              return $this->render("client/profilDetailCL.html.twig", ['client' => $clieny,    'form'=>$form->createView()]);
    }
}