<?php

namespace App\Controller;

use App\Entity\UserCustomer;
use App\Form\UserCustomerRegisterType;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CustomerSecurityController extends AbstractController
{
    /**
     * @Route("/login", name="customer_login")
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

        return $this->render('security/customer/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/register", name="customer_register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $userCustomer = new UserCustomer();
        $form = $this->createForm(UserCustomerRegisterType::class, $userCustomer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('password')->getData() != $form->get('confirmPassword')->getData()) {
                return $this->render('security/customer/register.html.twig', [
                    'userCustomerAddForm' => $form->createView(),
                    'errors' => ['pwd_confirm' => "Mots de passe différents"]
                ]);
            } else {
                $userCustomer->setFirstName($form->get('firstName')->getData());
                $userCustomer->setLastName($form->get('lastName')->getData());
                $userCustomer->setEmail($form->get('email')->getData());
                $userCustomer->setPhoneNumber($form->get('phoneNumber')->getData());
                $userCustomer->setLiveViewer(NULL);
                $userCustomer->setPassword($form->get('password')->getData());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($userCustomer);
                $entityManager->flush();

                return $this->redirectToRoute('app_customer_login');
            }
        }
        return $this->render('security/customer/register.html.twig', [
            'userCustomerAddForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="app_customer_logout")
     */
    public function logout()
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
