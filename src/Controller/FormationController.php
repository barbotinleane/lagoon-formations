<?php

namespace App\Controller;

use App\Repository\FormationCategoriesRepository;
use App\Repository\FormationLibellesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/***
 * Controller used to display the formation's list and the details of each of them
 *
 * @author Léane Barbotin <barbotinleane@gmail.com>
 */
class FormationController extends AbstractController
{
    /***
     * Displays the list of all formations
     *
     * @param FormationLibellesRepository $libellesRepository
     * @return Response
     */
    #[Route('/formations', name: 'app_formation')]
    public function index(FormationLibellesRepository $libellesRepository, FormationCategoriesRepository $formationCategoriesRepository): Response
    {
        $formations = $libellesRepository->findAll();

        return $this->render('formation/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    /***
     * Display details of formation 'Installation de Bassin paysager de type Lagoon'
     *
     * @return Response
     */
    #[Route('/formations/installation-bassin-paysager', name: 'app_formation_bassin')]
    public function bassin(): Response
    {
        return $this->render('formation/bassin.html.twig', [
            'program' => 'bassin',
            'formationName' => 'Installation de Bassin Paysager de type LAGOON',
        ]);
    }

    /***
     * Display details of formation 'Sauveteur Secouriste du Travail'
     *
     * @return Response
     */
    #[Route('/formations/sauveteur-secouriste-travail', name: 'app_formation_sst')]
    public function sst(): Response
    {
        return $this->render('formation/sst.html.twig', [
            'program' => 'sst',
            'formationName' => 'Sauveteur Secouriste du Travail'
        ]);
    }

    /***
     * Display details of formation 'Domotique et traitement de l'eau écologique et environnemental'
     *
     * @return Response
     */
    #[Route('/formations/domotique-traitement-eau-ecologique', name: 'app_formation_traitement')]
    public function treatment(): Response
    {
        return $this->render('formation/treatment.html.twig', [
            'program' => 'domotique',
            'formationName' => 'Domotique et traitement de l\'eau écologique et environnemental'
        ]);
    }

    /***
     * Display details of formation 'Gestes et Postures au travail'
     *
     * @return Response
     */
    #[Route('/formations/gestes-postures', name: 'app_formation_gestes')]
    public function gestes(): Response
    {
        return $this->render('formation/gestes.html.twig', [
            'program' => 'gestes',
            'formationName' => 'Gestes et Postures au travail'
        ]);
    }
}