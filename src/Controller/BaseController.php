<?php

namespace App\Controller;

use App\Repository\FormationLibellesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FormationLibellesRepository $libellesRepository): Response
    {
        $libelles = $libellesRepository->findAll();

        return $this->render('base/index.html.twig', [
            'formations' => $libelles
        ]);
    }

    #[Route('/a_propos', name: 'app_about_us')]
    public function aboutUs(FormationLibellesRepository $libellesRepository) : Response
    {
        $libelles = $libellesRepository->findAll();

        return $this->render('base/about.html.twig', [
            'formations' => $libelles
        ]);
    }

    #[Route('/politique_de_confidentialite', name: 'app_politic')]
    public function politic()
    {
        return $this->render('base/politic.html.twig');
    }

    #[Route('/404', name: 'app_404_error')]
    public function error()
    {
        return $this->render('base/404.html.twig');
    }
}
