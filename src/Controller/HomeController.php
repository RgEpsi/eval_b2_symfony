<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EventRepository $eventRepository, Request $request): Response
    {   
        $category = $request->query->get('category');
        $evenements = $eventRepository->findAll();
        return $this->render('home/index.html.twig', [
            'evenements' => $evenements,
            'category' => $category,
        ]);
    }

    
}
