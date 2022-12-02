<?php

namespace App\Service;

use App\Form\AsksType;
use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class FormationAskFlow extends FormFlow {
    protected $allowRedirectAfterSubmit = true;
    protected $allowDynamicStepNavigation = false;

    protected function loadStepsConfig() {
        return [
            [
                'label' => 'S',
                'form_type' => AsksType::class,
                'form_options' => [
                    'status' => $this->getFormData()->getStatus(),
                ],
            ],
            [
                'label' => 'F',
                'form_type' => AsksType::class,
                'skip' => false,
            ],
            [
                'label' => 'C',
                'form_type' => AsksType::class,
                'skip' => false,
                'form_options' => [
                    'status' => $this->getFormData()->getStatus(),
                ],
            ],
            [
                'label' => 'S',
                'form_type' => AsksType::class,
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    if ($flow->getFormData()->getStatus() === null) {
                        return true;
                    } else {
                        return $flow->getFormData()->getStatus()->getId() !== 1;
                    }
                },
                'form_options' => [
                    'status' => $this->getFormData()->getStatus(),
                ],
            ],
            [
                'label' => 'CS',
                'form_type' => AsksType::class,
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    if ($flow->getFormData()->isIsStagiaireMultiple() === true) {
                        return false;
                    } else {
                        return true;
                    }
                },
            ],
            [
                'label' => 'AR',
                'form_type' => AsksType::class,
            ],
            [
                'label' => 'R',
                'form_type' => AsksType::class,
            ],
        ];
    }

}