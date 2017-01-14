<?php

namespace AppBundle\Controller;

use AppBundle\Entity\NumeroLoteria;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        $repository = $this->getDoctrine()->getRepository('AppBundle:NumeroLoteria');
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $numeroLoteria = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $em = $this->getDoctrine()->getManager();
             $queryConsulta=$repository->createQueryBuilder('NL')
                 ->where("NL.numero1 = ?1 or NL.numero2 = ?1 or NL.numero3 = ?1 or NL.numero4 = ?1 or NL.numero5 = ?1")
                 ->andWhere("NL.numero1 = ?2 or NL.numero2 = ?2 or NL.numero3 = ?2 or NL.numero4 = ?2 or NL.numero5 = ?2")
                 ->andWhere("NL.numero1 = ?3 or NL.numero2 = ?3 or NL.numero3 = ?3 or NL.numero4 = ?3 or NL.numero5 = ?3")
                 ->andWhere("NL.numero1 = ?4 or NL.numero2 = ?4 or NL.numero3 = ?4 or NL.numero4 = ?4 or NL.numero5 = ?4")
                 ->andWhere("NL.numero1 = ?5 or NL.numero2 = ?5 or NL.numero3 = ?5 or NL.numero4 = ?5 or NL.numero5 = ?5")
                 ->andWhere("NL.numero1 = ?6 or NL.numero2 = ?6 or NL.numero3 = ?6 or NL.numero4 = ?6 or NL.numero5 = ?6")
                 ->andWhere("NL.numero1 = ?7 or NL.numero2 = ?7 or NL.numero3 = ?7 or NL.numero4 = ?7 or NL.numero5 = ?7")
                 ->setParameter(1, $numeroLoteria->getNumero1())
                 ->setParameter(2, $numeroLoteria->getNumero2())
                 ->setParameter(3, $numeroLoteria->getNumero3())
                 ->setParameter(4, $numeroLoteria->getNumero4())
                 ->setParameter(5, $numeroLoteria->getNumero5())
                 ->setParameter(6, $numeroLoteria->getEstrella1())
                 ->setParameter(7, $numeroLoteria->getEstrella2())
                 ->setMaxResults(1)
/*                 ->setParameter('consulta',array('NL.numero1','NL.numero2','NL.numero3','NL.numero4','Nl.numero5'))*/
                 ->getQuery();

            $combinacionExiste=$queryConsulta->getOneOrNullResult();
            $resultReturn=$this->json('ok');
            if($combinacionExiste ==null) {
                $em->persist($numeroLoteria);

            }else{
                $em->persist($numeroLoteria);
                $combinacion=$repository->find($combinacionExiste->getNumero1());
                $combinacion->setNumVeces($combinacion->getNumVeces()+1);
                $resultReturn=$this->json("La combinación se ha añadido y coincide con la combinacion: ".$combinacion->print());
            }
            $em->flush();
            return $resultReturn;
        }


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
        return $this->render('loteria/consultar.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/consultarCombinaciones", name="consultarCombinaciones")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function consultarCombinacionesAction(Request $request)
    {
        if($request->request->has('filtro')){
            $repository = $this->getDoctrine()->getRepository('AppBundle:NumeroLoteria');

            $filtro=$request->request->get('filtro');
            switch ($filtro){
                case "masVeces":
                    if($request->request->has('cantidadNumeros')){
                        $cantidadNumeros=$request->request->get('cantidadNumeros');
                        $result=$this->getNumerosMaxMen('DESC',$cantidadNumeros,$repository);
                    }
                    return $this->render('loteria/consulltarResultados.html.twig',array( 'listaProducts' => $result));
                    break;
                case "menosVeces":
                    if($request->request->has('cantidadNumeros')){
                        $cantidadNumeros=$request->request->get('cantidadNumeros');
                        $result=$this->getNumerosMaxMen('ASC',$cantidadNumeros,$repository);
                    }
                    return $this->render('loteria/consulltarResultados.html.twig',array( 'listaProducts' => $result));
                    break;
                case "numVeces":
                    $result=$this->getFrecuencia($repository);
                    return $this->render('loteria/frecuenciaResultados.html.twig',array( 'listaProducts' => $result));
                    break;
            }
        }
              // replace this example code with whatever you need

    }
    private function getFrecuencia($repository){
        $resultados=array();
        for($i=1;$i<=50;$i++) {
            $id=$repository->createQueryBuilder('c')
                ->select('c.id')
                ->where('c.numero1 = ?1')
                ->orWhere('c.numero2 = ?1')
                ->orWhere('c.numero3 = ?1')
                ->orWhere('c.numero4 = ?1')
                ->orWhere('c.numero5 = ?1')
                ->orderBy('c.id','DESC')
                ->setParameter(1,$i)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
            $frecuencia=$repository->createQueryBuilder('c')
                ->select('count(c.id) AS Frecuencia')
                ->where('c.numero1 = ?1')
                ->orWhere('c.numero2 = ?1')
                ->orWhere('c.numero3 = ?1')
                ->orWhere('c.numero4 = ?1')
                ->orWhere('c.numero5 = ?1')
                ->setParameter(1,$i)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
            if($id!=null) {
                $ultimoSorteo = $repository->createQueryBuilder('c')
                    ->select('count(c.id) AS Sorteo')
                    ->where('c.id > ?1')
                    ->setParameter(1, $id['id'])
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();
            }else{
                $ultimoSorteo=null;
            }
            if($i<13){
                $idEstrella=$repository->createQueryBuilder('c')
                    ->select('c.id')
                    ->where('c.estrella1 = ?1')
                    ->orWhere('c.estrella2 = ?1')
                    ->orderBy('c.id','DESC')
                    ->setParameter(1,$i)
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();
                $frecuenciaEstrella=$repository->createQueryBuilder('c')
                    ->select('count(c.id) AS Frecuencia')
                    ->where('c.estrella1 = ?1')
                    ->orWhere('c.estrella2 = ?1')
                    ->setParameter(1,$i)
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();
                if($idEstrella!=null) {
                    $ultimoSorteoEstrella = $repository->createQueryBuilder('c')
                        ->select('count(c.id) AS Sorteo')
                        ->where('c.id > ?1')
                        ->setParameter(1, $idEstrella['id'])
                        ->setMaxResults(1)
                        ->getQuery()
                        ->getOneOrNullResult();
                }else{
                    $ultimoSorteoEstrella=null;
                }
            }
            $numeroLoteria=new NumeroLoteria();
            $idGuardar=$i;
            $frecuenciaGuardar=$frecuencia!=null ? $frecuencia['Frecuencia']:'';
            $ultimoSorteoGuardar=$ultimoSorteo!=null ? $ultimoSorteo['Sorteo']+1:'0';
            if($i<13) {
                $idEstrellaGuardar = $i;
                $frecuenciaEstrellaGuardar = $frecuenciaEstrella != null ? $frecuenciaEstrella['Frecuencia'] : '';
                $ultimoSorteoEstrellaGuardar = $ultimoSorteoEstrella != null ? $ultimoSorteoEstrella['Sorteo'] + 1 : '0';
            }else{
                $idEstrellaGuardar='';
                $frecuenciaEstrellaGuardar='';
                $ultimoSorteoEstrellaGuardar='';
            }
            $numeroLoteria->crear($idGuardar,$frecuenciaGuardar,$ultimoSorteoGuardar,$idEstrellaGuardar,$frecuenciaEstrellaGuardar,$ultimoSorteoEstrellaGuardar,'');
            array_push($resultados,$numeroLoteria);
        }
        return $resultados;
    }
    private function getNumerosMaxMen($order,$cantidad,$repository){
        $numero1=$repository->createQueryBuilder('c')
            ->select('count(c.id) as Repeticiones, c.numero1')
            ->groupBy('c.numero1')
            ->orderBy('Repeticiones',$order)
            ->setMaxResults($cantidad)
            ->getQuery()
            ->getResult();
        $numero2=$repository->createQueryBuilder('c')
            ->select('count(c.id) as Repeticiones, c.numero2')
            ->groupBy('c.numero2')
            ->orderBy('Repeticiones',$order)
            ->setMaxResults($cantidad)
            ->getQuery()
            ->getResult();
        $numero3=$repository->createQueryBuilder('c')
            ->select('count(c.id) as Repeticiones, c.numero3')
            ->groupBy('c.numero3')
            ->orderBy('Repeticiones',$order)
            ->setMaxResults($cantidad)
            ->getQuery()
            ->getResult();
        $numero4=$repository->createQueryBuilder('c')
            ->select('count(c.id) as Repeticiones, c.numero4')
            ->groupBy('c.numero4')
            ->orderBy('Repeticiones',$order)
            ->setMaxResults($cantidad)
            ->getQuery()
            ->getResult();
        $numero5=$repository->createQueryBuilder('c')
            ->select('count(c.id) as Repeticiones, c.numero5')
            ->groupBy('c.numero5')
            ->orderBy('Repeticiones',$order)
            ->setMaxResults($cantidad)
            ->getQuery()
            ->getResult();
        $estrella1=$repository->createQueryBuilder('c')
            ->select('count(c.id) as Repeticiones, c.estrella1')
            ->groupBy('c.estrella1')
            ->orderBy('Repeticiones',$order)
            ->setMaxResults($cantidad)
            ->getQuery()
            ->getResult();
        $estrella2=$repository->createQueryBuilder('c')
            ->select('count(c.id) as Repeticiones, c.estrella2')
            ->groupBy('c.estrella2')
            ->orderBy('Repeticiones',$order)
            ->setMaxResults($cantidad)
            ->getQuery()
            ->getResult();
        $resultados=array();
        if(count($numero1)<=$cantidad){
            $cantidad=count($numero1);
        }
        for($i=0;$i<$cantidad;$i++){
            $numeroLoteria=new NumeroLoteria();
            $numero1Guardar=count($numero1) >$i ? $numero1[$i]['numero1'] : '';
            $numero2Guardar=count($numero2) >$i ? $numero2[$i]['numero2'] : '';
            $numero3Guardar=count($numero3) >$i ? $numero3[$i]['numero3'] : '';
            $numero4Guardar=count($numero4) >$i ? $numero4[$i]['numero4'] : '';
            $numero5Guardar=count($numero5) >$i ? $numero5[$i]['numero5'] : '';
            $estrella1Guardar=count($estrella1) >$i ? $estrella1[$i]['estrella1'] : '';
            $estrella2Guardar=count($estrella2) >$i ? $estrella2[$i]['estrella2'] : '';
            $numeroLoteria->crear($numero1Guardar,$numero2Guardar,$numero3Guardar,$numero4Guardar,$numero5Guardar,$estrella1Guardar,$estrella2Guardar);
            array_push($resultados,$numeroLoteria);
        }
        return $resultados;
    }
    /**
     * @Route("/eliminarCombinacion", name="eliminarCombinacion")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function eliminarCombinacionAction(Request $request)
    {
        if($request->request->has('idCombiacion')){
            $combinacionId=$request->request->get('idCombiacion');
            $em = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository('AppBundle:NumeroLoteria');

            $combiancion = $repository->find($combinacionId);
            $em->remove($combiancion);
            $em->flush();
            return $this->json('ok');
        }else{
            return $this->json('error');
        }

    }


}
