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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;


class FormationController extends AbstractController
{
    #[Route('/formations', name: 'app_formation')]
    public function index(FormationLibellesRepository $libellesRepository): Response
    {
        $libelles = $libellesRepository->findAll();

        dump($libelles[0]->getFormationSessions());

        return $this->render('formation/index.html.twig', [
            'formations' => $libelles
        ]);
    }

    #[Route('/formations/bassin', name: 'app_formation_bassin')]
    public function bassin(): Response
    {
        return $this->render('formation/bassin.html.twig', [
            'program' => './documentation/bassin.pdf',
            'formationName' => 'Installation de Bassin Paysager de type LAGOON'
        ]);
    }

    #[Route('/formations/sst', name: 'app_formation_sst')]
    public function sst(): Response
    {
        return $this->render('formation/sst.html.twig', [
            'program' => './documentation/sst.pdf',
            'formationName' => 'Sauveteur Secouriste du Travail'
        ]);
    }

    #[Route('/formations/traitement-eau', name: 'app_formation_traitement')]
    public function treatment(): Response
    {
        return $this->render('formation/treatment.html.twig', [
            'program' => './documentation/traitement.pdf',
            'formationName' => 'Domotique et traitement de l\'eau écologique et environnemental'
        ]);
    }

    #[Route('/formations/gestes-postures', name: 'app_formation_gestes')]
    public function gestes(): Response
    {
        return $this->render('formation/gestes.html.twig', [
            'program' => './documentation/gestes.pdf',
            'formationName' => 'Gestes et Postures au travail'
        ]);
    }

    #[Route('/formations/demande', name: 'app_ask')]
    public function ask(EntityManagerInterface $entityManager, Request $request, DepartmentsRepository $departmentsRepository)
    {
        $ask = new Asks();

        $departments = $departmentsRepository->findAll();
        $form = $this->createForm(AsksType::class, $ask, ['departments' => $departments]);
        $form->handleRequest($request);

        if (!$request->isXmlHttpRequest()) {
            if ($form->isSubmitted() && $form->isValid()) {
                if($_POST['asks']['prerequisites'] === "true") {
                    $prerequisites = [
                      'visseuse' => $_POST['visseuse'],
                      'perceuse' => $_POST['perceuse'],
                      'taloche' => $_POST['taloche'],
                      'malaxeur' => $_POST['malaxeur'],
                      'malaxeurv' => $_POST['malaxeurv'],
                      'commentaires-outils' => $_POST['commentaires-outils']
                    ];
                    $ask->setPrerequisites(json_encode($prerequisites));
                } else {
                    $ask->setPrerequisites(null);
                }

                foreach ($_POST['other'] as $key => $value) {
                    if($value !== "") {
                        switch($key) {
                            case 'status':
                                $ask->setStatus($value);
                                break;
                            case 'goal':
                                $ask->setGoal($value);
                                break;
                            case 'activityCategory':
                                $ask->setActivityCategory($value);
                                break;
                            case 'knowsUs':
                                $knowsUs = $ask->getKnowsUs();
                                $knowsUs[] = $value;
                                $ask->setKnowsUs($knowsUs);
                                break;
                            default:
                                break;
                        }
                    }
                }

                if($ask->getStagiaires() !== null) {
                    foreach ($ask->getStagiaires() as $stagiaire) {
                        $entityManager->persist($stagiaire);
                    }
                }

                $entityManager->persist($ask);
                $entityManager->flush();

                $this->addFlash('success', 'Votre demande de formation a bien été envoyée.');
                return $this->redirectToRoute('app_ask');
            }
        }

        return $this->renderForm('formation/ask.html.twig', [
            "form" => $form,
        ]);
    }
}
