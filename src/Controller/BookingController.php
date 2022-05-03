<?php

namespace App\Controller;

use App\Entity\UserCustomer;
use App\Repository\BookingRepository;
use App\Repository\BoxRepository;
use App\Repository\MealRepository;
use App\Repository\UserChiefRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class BookingController extends AbstractController
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[Route('/reservations', name: 'orders')]
    public function index(BookingRepository $bookingRepository, UserChiefRepository $userChiefRepository, BoxRepository $boxRepository, MealRepository $mealRepository): Response
    {
        if( $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $orders = $bookingRepository->findAllUserOrders($user->id);
            foreach ($orders as $order) {
                $chief = $userChiefRepository->find($order->chiefId);
                $box = $boxRepository->find($order->box);
                $meal = $mealRepository->find($box->getMeal());
                $order->chiefId = $chief->getFirstName() . " " . $chief->getLastName();
                $order->meal = $meal->getName();
            }

            return $this->render('booking/index.html.twig', [
                'orders' => $orders,
            ]);
        } else {
            return $this->redirectToRoute('app_customer_login');
        }
    }
}
