<?php

namespace App\Controller;

use App\Entity\FormationAsks;
use App\Entity\Stagiaires;
use App\Form\AsksType;
use App\Repository\DepartmentsRepository;
use App\Repository\FormationLibellesRepository;
use App\Repository\FormationPricesRepository;
use App\Service\AsanaManager;
use App\Service\AskSaver;
use App\Service\AskSetter;
use App\Service\CustomMailer;
use App\Service\FormationAskFlow;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

/***
 * Controller used to manage the ask for a formation
 *
 * @author Léane Barbotin <barbotinleane@gmail.com>
 */
class AskController extends AbstractController
{
    /***
     * Displays the form to ask for a formation, save the ask and send email
     *
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @param DepartmentsRepository $departmentsRepository
     * @param CustomMailer $mailer
     * @param AskSaver $askSaver
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    #[Route('/demande-de-formation/{formationId}', name: 'app_ask')]
    public function ask($formationId, EntityManagerInterface $em, FormationAskFlow $flow, FormationLibellesRepository $flRepo, CustomMailer $mailer, AsanaManager $asanaManager, AskSaver $askSaver)
    {
        $formation = $flRepo->find($formationId);

        $ask = new FormationAsks($formation);
        $flow->setGenericFormOptions(['formationId' => $formationId]);
        $flow->bind($ask);
        $form = $flow->createForm();
        $instance = $flow->getInstanceId();

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                if ($flow->getCurrentStepLabel() === '3') {
                    $ask = $askSaver->saveUnMappedFormFieldsToAsk($_POST, $ask);
                }
                $form = $flow->createForm();
            } else {
                $ask->setFormationLibelle($formation);
                $em->persist($ask);
                $em->flush();

                $asanaManager->addFormationTask($ask);
                $mailer->sendAskMail($ask, $ask->getStatus());

                if($ask->getStatus()->getId() == 1) {
                    $this->addFlash('professional', 'Votre demande de formation a bien été envoyée.');
                } else {
                    $this->addFlash('individual', 'Votre demande de formation a bien été envoyée.');
                }
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('ask/index.html.twig', [
            "form" => $form->createView(),
            "flow" => $flow,
            "ask" => $ask,
            "instance" => $instance,
            "formation" => $formation,
        ]);
    }
}
