<?php

namespace AppBundle\Controller;

use AppBundle\Entity\NumeroLoteria;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $numeroLoteria=new NumeroLoteria();
        $form = $this->createFormBuilder($numeroLoteria)
            ->add('numero1',IntegerType::class)
            ->add('numero2',IntegerType::class)
            ->add('numero3',IntegerType::class)
            ->add('numero4',IntegerType::class)
            ->add('numero5',IntegerType::class)
            ->add('estrella1',IntegerType::class)
            ->add('estrella2',IntegerType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $numeroLoteria = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $em = $this->getDoctrine()->getManager();
             $em->persist($numeroLoteria);
             $em->flush();

            return $this->json('ok');
        }

        $repository = $this->getDoctrine()->getRepository('AppBundle:NumeroLoteria');
        $query=$repository->createQueryBuilder('NL')->orderBy('NL.id', 'DESC')->getQuery();
        $c = count($query->getResult());
        $resultados = $query->setFirstResult(0)->setMaxResults($this->container->getParameter('items_pagina'))->getResult();

        // replace this example code with whatever you need
        return $this->render('loteria/nuevaCombinacion.html.twig', array( 'form' => $form->createView(),'resultados' => $resultados,'cantidadResultados' => $c,'numPagina' => 1)
         );
    }
    /**
     * @Route("/refrescarResultados", name="refrescarResultados")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function refrescarResultados(Request $request)
    {
        $logger = $this->get('logger');
        $logger->info('I just got the logger');
//        $logger->error('An error occurred');
//
//        $logger->critical('I left the oven on!', array(
//            // include extra "context" info in your logs
//            'cause' => 'in_hurry',
//        ));
        $numPagina=1;
    if($request->request->has('numPagina')){
        $numPagina=$request->request->get('numPagina');
    }
    $firstResult=($numPagina-1)* $this->container->getParameter('items_pagina');
        $repository = $this->getDoctrine()->getRepository('AppBundle:NumeroLoteria');
        $query=$repository->createQueryBuilder('NL')->orderBy('NL.id', 'DESC')->getQuery();
        $c = count($query->getResult());
        $products = $query->setFirstResult($firstResult)->setMaxResults($this->container->getParameter('items_pagina'))->getResult();

        // replace this example code with wha
        // replace this example code with whatever you need
        return $this->render('loteria/refrescarResultados.html.twig', array( 'listaProducts' => $products,'cantidadResultados' => $c,'numPagina' => $numPagina)
        );
    }
    /**
     * @Route("/consultaLoteria", name="consultaLoteria")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function consultaLoteriaAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('loteria/consultarResultados.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

}
