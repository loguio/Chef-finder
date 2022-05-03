<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Order;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/new-order', name: 'new_order')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $order = new Order();
        $booking = new Booking();
        $data = [];
        foreach ($_POST as $name => $value) {
            $data[$name] = $value;
        }

        $box = $entityManager->find('App\Entity\Box', $data['box_id']);
        $data['date'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['date'])));

        $booking->setDate(new DateTime($data['date']));
        $booking->setStatus("1");
        $booking->setBox($box);
        $booking->setChiefId($data['chief_id']);
        $booking->setCustomerId($data['customer_id']);
        $booking->setBoxQuantity($data['box_quantity']);
        $booking->setTime(new DateTime($data['time']));
        $booking->setDeliveryAddress($data['delivery_address']);
        $booking->setAppointmentAddress($data['appointment_address']);

        $entityManager->persist($booking);
        $entityManager->flush();

        $order->setPrice($data['price']);
        $order->setStatus("1");
        $order->setBooking($booking);

        $entityManager->persist($order);
        $entityManager->flush();

        return $this->redirectToRoute('app_orders');
    }
}
