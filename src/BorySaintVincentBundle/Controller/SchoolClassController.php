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
     * @Route(
     *     "/menu/{routeName}/{routeParameters}",
     *     name="school_class_menu",
     *     defaults={"routeName": "", "routeParameters": "{}"}
     * )
     *
     * @param string $routeName
     * @param string $routeParameters
     * @return Response
     */
    public function menuAction($routeName, $routeParameters)
    {
        $classes = $this->getDoctrine()->getRepository('BorySaintVincentBundle:SchoolClass')->findAll();

        return $this->render('BorySaintVincentBundle:Nav:partial.classes.html.twig', [
            'classes'         => $classes,
            'routeName'       => $routeName,
            'routeParameters' => json_decode($routeParameters),
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
        $class    = $this->getDoctrine()->getRepository('BorySaintVincentBundle:SchoolClass')->findOneBy(['slug' => $class]);
        $articles = $this->getDoctrine()->getRepository('BorySaintVincentBundle:Article')->findBy(['schoolClass' => $class]);

        return $this->render('@BorySaintVincent/SchoolClass/article.html.twig', [
            'schoolClass' => $class,
            'articles'    => $articles,
        ]);
    }
}
