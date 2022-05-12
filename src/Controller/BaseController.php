<?php

namespace App\Controller;

use App\Repository\FormationLibellesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/***
 * Controller used to manage the basic pages of a website (homepage, error 404, politics...)
 *
 * @author Léane Barbotin <barbotinleane@gmail.com>
 */
class BaseController extends AbstractController
{
    /***
     * Displays home page
     *
     * @param FormationLibellesRepository $libellesRepository
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function home(FormationLibellesRepository $libellesRepository): Response
    {
        $libelles = $libellesRepository->findAll();

        return $this->render('base/home.html.twig', [
            'formations' => $libelles
        ]);
    }

    /***
     * Displays page 'A propos'
     *
     * @param FormationLibellesRepository $libellesRepository
     * @return Response
     */
    #[Route('/a_propos', name: 'app_about_us')]
    public function aboutUs(FormationLibellesRepository $libellesRepository) : Response
    {
        return $this->render('base/about.html.twig');
    }

    /***
     * Displays 'Politique de confidentialité'
     *
     * @return Response
     */
    #[Route('/politique_de_confidentialite', name: 'app_politic')]
    public function politic()
    {
        return $this->render('base/politic.html.twig');
    }

    /***
     * Called when an error 404 is returned
     *
     * @return Response
     */
    #[Route('/404', name: 'app_404_error')]
    public function error()
    {
        return $this->render('base/404.html.twig');
    }
}
