<?php

namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [

            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    /**
     * @Route("/recup", name="pass_recup")
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function recupAction(Request $req ,\Swift_Mailer $mailer, SessionInterface $session){
        if ($req->isMethod("post")){

            $orm = $this->getDoctrine()->getManager();
            $repo = $orm->getRepository(Client::class);
            $email = $req->request->get('email');
            $user= $repo->findOneBy(array("email"=>$email));
            $session->start();

            // $email = $req->get("email");

            if ($user != null){
                $code  = rand();
                $user->setCode($code);
                $orm->flush();

                $email = (new \Swift_Message('Service bolbrands'))

                    ->setFrom('beinsmart44@gmail.com')
                    ->setTo($user->getEmail())
                    ->setSubject('Recuperation mot de passe')

                    ->setBody($this->renderView(

                        'Security/MailPw.html.twig',
                        ['code' => $code]
                    ),
                        'text/html');

                $mailer->send($email);
                $idu=$user->getIdcl();
                $session->set('user',$idu);
                $code=$user->getCode();
                echo $code;
                return $this->render("Security/CodeConf.html.twig",['user'=>$user]);
            }//si l email n est pas valide
            echo 'email invalide veuillez saisir l email de votre compte';
            return $this->render("Security/ForgotPw.html.twig", ["errors"=>"user not found"]);
        }

        return $this->render("Security/ForgotPw.html.twig", ["errors"=>""]);
    }


    /**
     * @Route("/Code", name="CodeConf")
     */
    public function CodeConfirmation(Request $req,SessionInterface $session){
        $occ=3;
        $session->start();
        $id=$session->get("user");

        if ($req->isMethod("post") ){
            if ($occ==0) {
                return $this->redirectToRoute('pass_recup');
            }
            $orm = $this->getDoctrine()->getManager();
            $repo = $orm->getRepository(Client::class);
            $user = $repo->find($id);

            $code = $req->request->get('code');
            if ($code==$user->getCode()){
echo $code;
                return $this->render("Security/newpw.html.twig",['user'=>$user]);
            }
            $occ=$occ - 1 ;

            return $this->render("Security/CodeConf.html.twig", ["errors"=>"Code incorrecte"]);
        }
        return $this->render("Security/CodeConf.html.twig", ["errors"=>""]);
    }



    /**
     * @Route("/NewPw/{idcl}", name="NewPw")
     */
    public function NewPw(Request $req ,$idcl,UserPasswordEncoderInterface $encoder){
        if ($req->isMethod("post")){
            $orm = $this->getDoctrine()->getManager();
            $repo = $orm->getRepository(Client::class);
         $user = $repo->find($idcl);

            $user = $repo->find($idcl);

            $newpw = $req->request->get('newpw');
            $confirmed = $req->request->get('confirmed_pw');

            if ($newpw == $confirmed){
                $user->setPassword($newpw);
                $hash=$encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($hash);
                $orm->flush();

 return $this->redirectToRoute('app_login');


            }
            return $this->render("Security/newpw.html.twig", ["errors"=>"Veuillez saisir le meme mot de passe"]);
        }
        return $this->render("Security/newpw.html.twig", ["errors"=>""]);
    }
}
