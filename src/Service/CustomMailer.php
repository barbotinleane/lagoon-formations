<?php

namespace App\Service;

use App\Entity\FormationAsks;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

/***
 * Service used to send custom emails
 *
 * @author Léane Barbotin <barbotinleane@gmail.com>
 */
class CustomMailer
{
    private $mailer;
    private $router;
    private $twig;

    public function __construct(MailerInterface $mailer, RouterInterface $router, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->router = $router;
        $this->twig = $twig;
    }

    /***
     * Send an email which displays the informations of a formation ask made
     *
     * @param FormationAsks $ask
     * @param $status
     * @return RedirectResponse|void
     */
    public function sendAskMail(FormationAsks $ask, $status = null) {
        $stagiaires = [];
        if($ask->getStatus()->getId() == 1) {
            $stagiaires = $ask->getStagiaires();
        }

        $prerequisites = [];
        if($ask->getFormationLibelle()->getId() == 1) {
            $prerequisites = json_decode($ask->getPrerequisites(), true);
        }

        $to = 'barbotinleane@gmail.com';
        //$to = 'formation@lagoon-piscines.com';
        $subject = 'Nouvelle demande de formation !';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $content = $this->twig->render('email/email_ask.html.twig', [
            'ask' => $ask,
            'stagiaires' => $stagiaires,
            'prerequisites' => $prerequisites,
            'status' => $status,
        ]);

        mail($to, $subject, $content, implode("\r\n", $headers));
    }
}