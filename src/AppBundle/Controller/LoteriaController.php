<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class LoteriaController extends Controller
{
    /**
     * @Route("/nuevaCombinacion", name="nuevaCombinacion")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function nuevaCombinacionAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('loteria/nuevaCombinacion.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/consultaLoteria", name="consultaLoteria")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function consultaLoteriaAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('shared/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

}
