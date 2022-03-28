<?php

namespace App\Form;

use App\Entity\Asks;
use App\Entity\FormationLibelles;
use App\Entity\FormationSessions;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AsksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $departmentsNames = [];

        foreach ($options['departments'] as $department) {
            $departmentsNames[$department->getName()] = $department->getCode();
        }

        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Chef d\'entreprise' => 1,
                    'Artisan' => 2,
                    'Autoentrepreneur' => 3,
                    'Demandeur d\'emploi' => 4,
                    'Autre' => 5,
                ],
                'label' => 'Statut',
                'attr' => [
                    'class' => 'buttons-group',
                    'role' => 'group',
                ],
                'expanded' => true
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
            ->add('goal', ChoiceType::class, [
                'choices' => [
                    'Reconversion professionnelle' => 1,
                    'Création d\'une entreprise' => 2,
                    'Création d\'un département LAGOON® dans votre entreprise' => 3,
                    'Simplement acquérir les compétences liées à cette formation' => 4,
                    'Autre' => 5,
                ],
                'label' => 'Quel est votre objectif :',
                'expanded' => true
            ])
            ->add('formationLibelle', EntityType::class, [
                'class' => FormationLibelles::class,
                'choice_label' => 'libelle',
                'label' => 'Formation demandée : ',
            ])
            ->add('companyName', TextType::class, [
                'label' => 'Nom de l\'entreprise'
            ])
            ->add('sirenOrRm', TextType::class, [
                'label' => 'SIREN ou RM'
            ])
            ->add('siret', TextType::class, [
                'label' => 'SIRET'
            ])
            ->add('idPoleEmploi', TextType::class, [
                'label' => 'Identifiant Pole Emploi'
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Numéro de téléphone'
            ])
            ->add('address',  TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('postalCode',  NumberType::class, [
                'label' => 'Code Postal'
            ])
            ->add('city',  TextType::class, [
                'label' => 'Ville'
            ])
            ->add('department',  ChoiceType::class, [
                'label' => 'Département',
                'choices' => $departmentsNames
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'invalid_message' => 'Le pays sélectionné n\'est pas valide.',
            ])
            ->add('handicap', CheckboxType::class, [
                'label' => 'Je suis en situation de handicap, je souhaite que vous étudiiez les solutions possibles pour que j\'accède à cette formation.',
            ])
            ->add('stagiaires', CollectionType::class, [
                'entry_type' => StagiairesType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
            ])
            ->add('knowsUs', ChoiceType::class, [
                'label' => 'Comment avez-vous connu notre centre de formation ?',
                'choices' => [
                    'Recommandation par un proche/collègue' => 1,
                    'Article ou Publicité dans un magazine' => 2,
                    'Lors d’un salon' => 3,
                    'Par un site internet' => 4,
                    'Dans une boutique' => 5,
                    'Autre' => 6,
                ],
                'multiple' => true,
                'expanded' => true
            ])
            ->add('consents', ChoiceType::class, [
                'label' => 'Consentements',
                'choices' => [
                    'En soumettant ce formulaire, j’accepte que mes informations soient utilisées exclusivement dans 
                    le cadre de ma demande et de la relation commerciale éthique et personnalisée qui pourrait en découler 
                    si je le souhaite et je reconnais avoir pris connaissance de la politique de traitement et d\'utilisation 
                    des données relative à la RGPD disponible en cliquant ici.' => 1,
                    'J\'ai lu et j’accepte les Conditions Générales de Vente de LAGOON® DISTRIBUTION CORPORATION.' => 2,
                    'J\'ai été informé que si ma candidature est retenue, 30% du montant total de la formation est 
                    nécessaire pour valider définitivement mon inscription ; le solde total devant être réglé avant 
                    le début de la formation. ' => 3
                ],
                'mapped' => false,
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ])
        ;

        $addSession = function (FormInterface $form, FormationLibelles $formation = null) {
            $sessions = null === $formation ? [] : $formation->getFormationSessions();

            $form->add('formationSession', EntityType::class, [
                'class' => FormationSessions::class,
                'placeholder' => '',
                'label' => 'Date de formation souhaitée : ',
                'choices' => $sessions,
                'expanded' => true
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($addSession) {
                $data = $event->getData();

                $addSession($event->getForm(), $data->getFormationLibelle());
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asks::class,
            'departments' => null,
        ]);
    }
}
