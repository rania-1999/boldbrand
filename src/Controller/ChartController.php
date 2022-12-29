<?php

namespace App\Controller;

use App\Entity\Chart;
use App\Entity\Client;
use App\Entity\Logo;
use App\Entity\Utilisateur;
use App\Form\ChartType;
use App\Form\LogoType;
use App\Repository\ChartRepository;
use Symfony\Component\Form\AbstractType;

use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ChartController extends AbstractController
{
    /**
     * @Route("/chart", name="chart")
     */
    public function index(): Response
    {
        return $this->render('chart/liste.html.twig', [
            'controller_name' => 'ChartController',
        ]);
    }
    /**
     * @Route ("/addChart", name ="addChart")
     */

    function add (Request $request,SessionInterface $session, \Swift_Mailer $mailer)
    {
        $chart =new Chart();
        $chart->setDatecreation(new \DateTime('now'));

        $form=$this->createForm( ChartType:: class,$chart);
        $form->add('Ajouter', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid())
        {


            $file = $form->get('docch')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('charts_directory'),
                    $fileName
                );
            }catch (FileException $e)
            {

            }
            $em=$this->getDoctrine()->getManager();
            $chart->setDocch($fileName);
            $em->persist($chart);
            $em->flush();


            return $this->redirectToRoute('afficherChartD');
            //$flashy->success('Event created!', 'http://your-awesome-link.com');

        }

        return $this->render('chart/ajouterChart.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherChart", name="afficherChart")
     */
    public function Afficher( )
    {$chart=$this->getDoctrine()->getRepository(Chart::class)->findAll();
        return $this ->render('chart/afficherCh.html.twig',['chart'=>$chart]);
    }
    /**
     * @Route ("/updateChart/{id}", name ="updateCh")
     */

    function updatte (Request $request,$id,\Swift_Mailer $mailer)
    { $chart=$this->getDoctrine()->getRepository(Chart::class)->find($id);
        $chart->setDatecreation(new \DateTime('now'));

        $form=$this->createForm( ChartType:: class,$chart);


        //$form->remove('client');
        $form->add('modifier', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file = $form->get('docch')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('charts_directory'),
                    $fileName
                );
            }catch (FileException $e)
            {

            }
            $chart->setDocch($fileName);
            $e = $this->getDoctrine()->getManager();

            $e->flush();

            return $this->redirectToRoute('afficherChartD');
        }
        return $this->render('chart/updateCh.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }
    /**
     * @Route("/supprimerCh/{id}", name="suppCh")
     */
    public function supprimer ($id)
    {
        $chart=$this->getDoctrine()->getRepository(Chart::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($chart);//suprrimer lobjet dans le parametre
        $em->flush();
        return $this->redirectToRoute('afficherChartD');

    }
    /**
     * @Route ("/addCHartU/{id}", name ="addCHartU")
     */

    function addChartU (Request $request,$id,\Swift_Mailer $mailer)
    {
        $logo =new Chart();
        $logo->setDatecreation(new \DateTime('now'));
        $logo=$this->getDoctrine()->getRepository(Chart::class)->find($id);
        $form=$this->createForm( ChartType:: class,$logo);
        $form->remove('docch');
        $form->add('Ajouter', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);
        $orm = $this->getDoctrine()->getManager();
        $repo = $orm->getRepository(Client::class);
        $email = $request->request->get('email');
        $user= $repo->findOneBy(array("email"=>$email));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {




            $em=$this->getDoctrine()->getManager();
            $em->persist($logo);
            $em->flush();


            return $this->redirectToRoute('afficherChartD');
        }
        return $this->render('chart/ajouterChartU.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }

    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route("/afficherChartD", name="afficherChartD")
     */
    public function AfficherDetails(Request $request,ChartRepository $chartRepository)
    {$logo=$this->getDoctrine()->getRepository(Chart::class)->findAll();


        return $this ->render('chart/afficherDetailsCh.html.twig',['chart'=>$logo     ]);
    }

    /**
     * \Symfony\Component\HttpFoundation\Response
     * @Route( "/notifier/{id}",name="notifier")
     */
    public function EnvoyerMail(Request $req ,$id,\Swift_Mailer $mailer)
    {
        $chart = $this->getDoctrine()->getRepository(Chart::class)->find($id);
//$username=$chart->getClient();
        // $chart=new Chart();
        if ($chart != null) {
            $orm = $this->getDoctrine()->getManager();
            $repo = $orm->getRepository(Client::class);
            $email = $chart->getClient()->getEmail();
            // $email = $request->request->get('email');
            $user = $repo->findOneBy(array("email" => $email));

            $email = (new \Swift_Message('Service bolbrands'))
                ->setFrom('beinsmart44@gmail.com')
                ->setTo($user->getEmail())
                ->setSubject('charte')
                ->setBody('votre charte a été ajoutée veuillez consulter notre site ');


            $mailer->send($email);
            return $this->redirectToRoute('afficherChartD');

        }
    }
    /**
     * @Route ("/updateChartU/{id}", name ="updateChU")
     */

    function updatteU (Request $request,$id)
    { $chart=$this->getDoctrine()->getRepository(Chart::class)->find($id);
        $chart->setDatecreation(new \DateTime('now'));

        $form=$this->createForm( ChartType:: class,$chart);

        //$form->remove('client');
        $form->add('modifier', SubmitType::class,[
            'attr' => ['class' => 'btn-primary'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $file = $form->get('docch')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('charts_directory'),
                    $fileName
                );
            }catch (FileException $e)
            {

            }
            $chart->setDocch($fileName);
            $e = $this->getDoctrine()->getManager();

            $e->flush();
            return $this->redirectToRoute('afficherChartD');
        }
        return $this->render('chart/updateChU.html.twig',[
                'form'=>$form->createView()
            ]
        );
    }


}
