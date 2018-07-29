<?php

namespace BorySaintVincentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/classes")
 */
class SchoolClassController extends Controller
{
    /**
     * @Route("/menu", name="school_class_menu")
     *
     * @return Response
     */
    public function menuAction()
    {
        $classes = $this->getDoctrine()->getRepository('BorySaintVincentBundle:SchoolClass')->findAll();

        return $this->render('BorySaintVincentBundle:Nav:partial.classes.html.twig', [
            'classes' => $classes,
        ]);
    }

    /**
     * @Route("/{class}", name="school_class_display")
     *
     * @param string $class
     * @return Response
     */
    public function displayAction($class)
    {
        return new Response($class);
    }
}