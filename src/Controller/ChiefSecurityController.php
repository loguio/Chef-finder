<?php

namespace App\Controller;

use App\Entity\UserChief;
use App\Form\UserChiefRegisterType;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class ChiefSecurityController extends AbstractController
{
    /**
     * @Route("/pro/login", name="chief_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/chief/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/pro/register", name="chief_register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $userChief = new UserChief();
        $form = $this->createForm(UserChiefRegisterType::class, $userChief);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userChief->setFirstName($form->get('firstName')->getData());
            $userChief->setLastName($form->get('lastName')->getData());
            $userChief->setEmail($form->get('email')->getData());
            $userChief->setPhoneNumber($form->get('phoneNumber')->getData());
            $userChief->setCompany($form->get('company')->getData());
            $userChief->setPassword($form->get('password')->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userChief);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }
        return $this->render('security/chief/register.html.twig', [
            'userChiefAddForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/pro/logout", name="app_chief_logout")
     */
    public function logout()
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
