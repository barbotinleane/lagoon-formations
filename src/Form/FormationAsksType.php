<?php

namespace App\Form;

use App\Entity\FormationAsks;
use App\Entity\FormationLibelles;
use App\Entity\FormationSessions;
use App\Repository\DepartmentsRepository;
use Doctrine\DBAL\Types\JsonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationAsksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $builder


            ->add('companyName', TextType::class, [
                'label' => 'Nom de l\'entreprise',
            ])
            ->add('sirenOrRm', TextType::class, [
                'label' => 'SIREN ou RM',
            ])
            ->add('siret', TextType::class, [
                'label' => 'SIRET',
            ])
            ->add('idPoleEmploi', TextType::class, [
                'label' => 'Identifiant Pôle Emploi',
            ])

            ->add('activityCategory', ChoiceType::class, [
                'label' => 'Catégorie d\'Activité',
                'choices' => [
                    'Aménagement Paysager' => 1,
                    'Application de résine' => 2,
                    'Terrassement' => 3,
                    'Construction' => 4,
                    'Piscine' => 5,
                    'Autre' => 6,
                ],
                'expanded' => true
            ])
            ->add('handicap', CheckboxType::class, [
                'label' => 'Je suis en situation de handicap, je souhaite que vous étudiiez les solutions possibles pour que j\'accède à cette formation.',
            ])
            ->add('workers', null, [
                'label' => 'Combien de stagiaires souhaitez vous inscrire ?',
                'attr' => [
                    'id' => 'workers',
                ]
            ])

            ->add('save', SubmitType::class, [
                'label' => 'Valider',
                'attr' => ['id' => 'valider']
            ])
        ;


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormationAsks::class,
            'departments' => null
        ]);
    }
}
