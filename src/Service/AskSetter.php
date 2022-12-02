<?php

namespace App\Service;

use App\Entity\FormationAsks;
use App\Entity\Stagiaires;
use App\Repository\DepartmentsRepository;
use App\Repository\FormationPricesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/***
 * Service used to set the form to ask for a formation
 *
 * @author Léane Barbotin <barbotinleane@gmail.com>
 */
class AskSetter
{
    private $em;
    private $fpRepo;
    private $dRepo;

    public function __construct(EntityManagerInterface $em, FormationPricesRepository $fpRepo, DepartmentsRepository $dRepo)
    {
        $this->em = $em;
        $this->fpRepo = $fpRepo;
        $this->dRepo = $dRepo;
    }

    public function setForm(FormationAskFlow $flow, FormationAsks $ask, $formationId) {
        $departments = $this->dRepo->findAll();
        $flow->setGenericFormOptions(['departments' => $departments, 'formationId' => $formationId]);
        $flow->bind($ask);
        $form = $flow->createForm();

        return $form;
    }

    public function getPrices(FormationAskFlow $flow, Request $request, $form) {
        $prices = $this->fpRepo->findAll();
        $pricesArray = [];

        foreach($prices as $price) {
            $pricesArray[$price->getNumberOfPeople()] = $price->getPrice();
        }

        return $pricesArray;
    }

    public function createCompanyDirectorLearner($flow) {
        if ($flow->getFormData()->getStagiaires()->isEmpty()) {
            $companyDirectorStagiaire = new Stagiaires();
            $companyDirectorStagiaire->setFirstName($flow->getFormData()->getFirstName());
            $companyDirectorStagiaire->setLastName($flow->getFormData()->getLastName());

            $flow->getFormData()->addStagiaire($companyDirectorStagiaire);
        }
    }

    public function getPricesWhenNumberOfLearnersChange($flow, $priceToShow) {
        $numberOfLearners = $flow->getFormData()->getStagiaires()->count();
        $prices = $this->fpRepo->findAll();
        $priceWhenNumberOfLearnersBigger = 0;
        foreach ($prices as $price) {
            if ($price->getNumberOfPeople() == $numberOfLearners) {
                $priceToShow = $price->getPrice();
            } elseif ($price->getNumberOfPeople() == 0) {
                $priceWhenNumberOfLearnersBigger = $price->getPrice();
            }
        }
        if ($priceToShow == 0) {
            $priceToShow = $priceWhenNumberOfLearnersBigger * $numberOfLearners;
        }

        return $priceToShow;
    }
}