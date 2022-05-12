<?php

namespace App\Controller;

use App\Entity\Artisan;
use App\Entity\Asks;
use App\Entity\AutoEntrepreneur;
use App\Entity\CompanyDirector;
use App\Entity\FormationAsk;
use App\Entity\FormationAsks;
use App\Entity\FormationSessions;
use App\Entity\OtherStatus;
use App\Entity\SearchingJob;
use App\Entity\Stagiaires;
use App\Form\ArtisanType;
use App\Form\AsksType;
use App\Form\AutoEntrepreneurType;
use App\Form\CompanyDirectorType;
use App\Form\FormationAsksType;
use App\Form\FormationAskType;
use App\Form\OtherStatusType;
use App\Form\SearchingJobType;
use App\Form\StatusType;
use App\Repository\DepartmentsRepository;
use App\Repository\FormationLibellesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

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
    public function index(FormationLibellesRepository $libellesRepository): Response
    {
        $libelles = $libellesRepository->findAll();

        return $this->render('formation/index.html.twig', [
            'formations' => $libelles
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