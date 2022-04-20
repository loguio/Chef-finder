<?php

namespace App\Controller;

use App\Repository\BoxRepository;
use App\Repository\UserChiefRepository;
use App\Repository\MealRepository;
use App\Repository\FoodCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MealRepository $mealRepository, FoodCategoryRepository $foodCategoryRepository, BoxRepository $boxRepository, UserChiefRepository $chiefRepository): Response
    {
        $food_categories = $foodCategoryRepository->findAllOrderedBy("id");
        $chiefs = $chiefRepository->findAllOrderedBy("id");
        $meals = $mealRepository->findAllOrderedBy("id");
        $boxes = $boxRepository->findAllOrderedBy("id");


        foreach ($meals as $meal) {
            $mealBoxes = array_filter($boxes, function ($var) use ($meal) {
                return ($var->meal->id == $meal->id);
            });
            $meal->meal_boxes = $mealBoxes;
        }

        return $this->render('home/index.html.twig', [
            'food_categories' => $food_categories,
            'meals' => $meals,
            'chiefs' => $chiefs,
        ]);
    }
}
