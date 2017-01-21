<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Correo;
use AppBundle\Form\EmailFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EmailController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        // 1) build the form
        $correo = new Correo();
        $form = $this->createForm(EmailFormType::class, $correo);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject($correo->getAsunto())
                ->setFrom($correo->getDesde())
                ->setTo($correo->getPara())
                ->setBody(
                    $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                        'email/emailConsulta.html.twig',
                        array('text' => $correo->getDescripcion())
                    ),
                    'text/html'
                )
                /*
                 * If you also want to include a plaintext version of the message
                ->addPart(
                    $this->renderView(
                        'Emails/registration.txt.twig',
                        array('name' => $name)
                    ),
                    'text/plain'
                )
                */
            ;
            $this->get('mailer')->send($message);
            // 3) Encode the password (you could also do this via Doctrine listener)
            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($correo);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->render(
                'email/contact.html.twig',
                array('form' => $form->createView(),'Message'=>'Email enviado correctamente')
            );
        }

        return $this->render(
            'email/contact.html.twig',
            array('form' => $form->createView())
        );
    }
}
