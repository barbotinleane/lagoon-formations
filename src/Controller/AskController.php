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
    #[Route('/demande-de-formation/{formationId}', name: 'app_ask')]
    public function ask($formationId, EntityManagerInterface $em, FormationAskFlow $flow, Request $request, FormationLibellesRepository $flRepo, FormationPricesRepository $fpRepo, DepartmentsRepository $dRepo, AskSetter $askSetter, AskSaver $askSaver)
    {
        /*$formation = $flRepo->find($formationId);
        $ask = new FormationAsks($formation);
        $form = $askSetter->setForm($flow, $ask, $formationId);

        $instance = $flow->getInstanceId();
        $prerequisites = null;
        $priceToShow = 0;

        $pricesArray = $askSetter->getPrices($flow, $request, $form);

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($request->isXmlHttpRequest()) {
                $form = $flow->createForm();
            } else {
                if ($flow->nextStep()) {
                    if ($flow->getCurrentStepLabel() === 'CS') {
                        $askSetter->createCompanyDirectorLearner($flow);
                        $priceToShow = $askSetter->getPricesWhenNumberOfLearnersChange($flow, $priceToShow);
                    } else if ($flow->getCurrentStepLabel() === 'AR') {
                        if($flow->getFormData()->isIsStagiaireMultiple() === true) {
                            $isStagiaireMultiple = true;
                        } else {
                            $isStagiaireMultiple = false;
                        }
                    } else if ($flow->getCurrentStepLabel() === 'R') {
                        $ask = $askSaver->saveUnMappedFormFieldsToAsk($_POST, $ask);
                        $prerequisites = json_decode($ask->getPrerequisites());
                    }

                    // form for the next step
                    $form = $flow->createForm();
                } else {
                    $ask->setPrerequisites($_POST['prerequisites']);
                    $askSaver->persistAndFlush($ask, $formation);

                    $this->addFlash('success', 'Votre demande de formation a bien été envoyée.');
                    return $this->redirectToRoute('app_home');
                }
            }
        }
        $prerequisites = json_decode($ask->getPrerequisites());
        $prerequisites = (array) $prerequisites;

        return $this->render('ask/index.html.twig', [
            "form" => $form->createView(),
            "flow" => $flow,
            "prices" => $pricesArray,
            "priceForStagiairesSaved" => $priceToShow,
            "ask" => $ask,
            "instance" => $instance,
            "prerequisites" => $prerequisites,
            "formation" => $formation,
            "formationId" => $formationId,
            "isStagiaireMultiple" => $isStagiaireMultiple,
        ]);*/
        return $this->redirect('https://lagoon-piscines.com');
    }
}
