<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/***
 * Controller called to display documentation for each formation in a pdf reader
 *
 * @author Léane Barbotin <barbotinleane@gmail.com>
 */
class DocController extends AbstractController
{
    #[Route('/documentation/rgpd', name: 'app_doc_rgpd')]
    public function rgpd(): Response
    {
        return $this->render('doc/index.html.twig', [
            'fileName' => 'RGPD',
            'name' => 'Règlement Général pour la Protection des Données',
        ]);
    }

    #[Route('/documentation/cgv', name: 'app_doc_cgv')]
    public function cgv(): Response
    {
        return $this->render('doc/index.html.twig', [
            'fileName' => 'conditions_generales_vente',
            'name' => 'Conditions Générales de Vente',
        ]);
    }

    #[Route('/documentation/charte-qualite', name: 'app_doc_quality')]
    public function quality(): Response
    {
        return $this->render('doc/index.html.twig', [
            'fileName' => 'charte_qualite',
            'name' => 'Charte de qualité'
        ]);
    }

    #[Route('/documentation/installation-bassin-paysager', name: 'app_doc_bassin')]
    public function bassin(): Response
    {
        return $this->render('doc/index.html.twig', [
            'fileName' => 'bassin',
            'name' => 'Programme de la formation Installation de Bassin Paysager de type Lagoon'
        ]);
    }

    #[Route('/documentation/gestes-postures-travail', name: 'app_doc_gestes')]
    public function gestes(): Response
    {
        return $this->render('doc/index.html.twig', [
            'fileName' => 'gestes',
            'name' => 'Programme de la formation Gestes et Postures de Travail'
        ]);
    }

    #[Route('/documentation/livret-accueil', name: 'app_doc_livret')]
    public function livret(): Response
    {
        return $this->render('doc/index.html.twig', [
            'fileName' => 'livret_accueil',
            'name' => 'Livret d\'accueil'
        ]);
    }

    #[Route('/documentation/domotique-traitement-eau-ecologique-environnemental', name: 'app_doc_domotique')]
    public function domotique(): Response
    {
        return $this->render('doc/index.html.twig', [
            'fileName' => 'pompe_filtration',
            'name' => 'Programme de la formation Domotique et Traitement de l\'eau écologique et environnemental'
        ]);
    }

    #[Route('/documentation/reglement-interieur', name: 'app_doc_reglement')]
    public function reglement(): Response
    {
        return $this->render('doc/index.html.twig', [
            'fileName' => 'reglement_interieur',
            'name' => 'Règlement intérieur de LAGOON Formations'
        ]);
    }

    #[Route('/documentation/sauveteur-secouriste-travail', name: 'app_doc_sst')]
    public function sst(): Response
    {
        return $this->render('doc/index.html.twig', [
            'fileName' => 'sst',
            'name' => 'Programme de la formation Sauveteur Secouriste du Travail'
        ]);
    }
}
