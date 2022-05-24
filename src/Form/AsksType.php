<?php

namespace App\Form;

use App\Entity\Asks;
use App\Entity\FormationLibelles;
use App\Entity\FormationSessions;
use App\Repository\FormationLibellesRepository;
use App\Entity\Status;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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

/***
 * Form related to Asks entity to make a formation ask
 *
 * @author Léane Barbotin <barbotinleane@gmail.com>
 */
class AsksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $departmentsNames = [];

        foreach ($options['departments'] as $department) {
            $departmentsNames[$department->getName()] = $department->getCode();
        }

        $builder
            ->add('status', EntityType::class, [
                'class' => Status::class,
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
                    'Aménagement Paysager' => 'Aménagement Paysager',
                    'Application de résine' => 'Application de résine',
                    'Terrassement' => 'Terrassement',
                    'Construction' => 'Construction',
                    'Piscine' => 'Piscine',
                    'Autre' => 'Autre',
                ],
                'expanded' => true
            ])
            ->add('goal', ChoiceType::class, [
                'choices' => [
                    'Reconversion professionnelle' => 'Reconversion professionnelle',
                    'Création d\'une entreprise' => 'Création d\'une entreprise',
                    'Création d\'un département LAGOON® dans votre entreprise' => 'Création d\'un département LAGOON® dans votre entreprise',
                    'Simplement acquérir les compétences liées à cette formation' => 'Simplement acquérir les compétences liées à cette formation',
                    'Autre' => 'Autre',
                ],
                'label' => 'Quel est votre objectif :',
                'expanded' => true
            ])
            ->add('formationLibelle', EntityType::class, [
                'class' => FormationLibelles::class,
                'query_builder' => function (FormationLibellesRepository $flr) {
                    return $flr->createQueryBuilder('fl')
                        ->where('fl.agrement = 1');
                },
                'choice_label' => 'libelle',
                'label' => 'Formation demandée : ',
                'placeholder' => 'Choisissez une formation...'
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
            ->add('country', TextType::class, [
                'label' => 'Pays',
            ])
            ->add('handicap', CheckboxType::class, [
                'label' => 'Je suis en situation de handicap, je souhaite que vous étudiiez les solutions possibles pour que j\'accède à cette formation.',
                'attr' => [
                    'value' => 'null',
                ],
                'required' => false,
            ])
            ->add('knowsUs', ChoiceType::class, [
                'label' => 'Comment avez-vous connu notre centre de formation ?',
                'choices' => [
                    'Recommandation par un proche/collègue' => 'Recommandation par un proche/collègue',
                    'Article ou Publicité dans un magazine' => 'Article ou Publicité dans un magazine',
                    'Lors d’un salon' => 'Lors d’un salon',
                    'Par un site internet' => 'Par un site internet',
                    'Dans une boutique' => 'Dans une boutique',
                    'Autre' => 'Autre',
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


            ->add('companyName', TextType::class, [
                'label' => 'Nom de l\'entreprise',
                'attr' => [
                    'value' => 'null',
                ],
                'required' => false,
            ])
            ->add('sirenOrRm', TextType::class, [
                'label' => 'SIREN ou RM',
                'attr' => [
                    'value' => 'null',
                ],
                'required' => false,
            ])
            ->add('idPoleEmploi', TextType::class, [
                'label' => 'Identifiant Pole Emploi',
                'attr' => [
                    'value' => 'null',
                ],
                'required' => false,
            ])
            ->add('siret', TextType::class, [
                'label' => 'SIRET',
                'attr' => [
                    'value' => 'null',
                ],
                'required' => false,
            ])
            ->add('prerequisites', TextType::class, [
                'attr' => [
                    'value' => 'null',
                ],
                'required' => false,
            ])
            ->add('stagiaires', CollectionType::class, [
                'entry_type' => StagiairesType::class,
                'entry_options' => ['label' => 'Les stagiaires'],
                'allow_add' => true,
                'attr' => ['value' => 'null'],
                'required' => false,
            ])


            ->add('save', SubmitType::class, [
                'label' => 'Valider',
                'disabled' => true,
                'attr' => [
                    'class' => 'btn btn-lg btn-brand mt-5',
                ]
            ])
        ;

        //display each sessions depending formation's choice
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

        //get the sessions for the preselected formation
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($addSession) {
                $data = $event->getData();

                $addSession($event->getForm(), $data->getFormationLibelle());
            }
        );

        //get the sessions when selected formationLibelle change
        $builder->get('formationLibelle')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($addSession) {
                $formation = $event->getForm()->getData();

                $addSession($event->getForm()->getParent(), $formation);
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
