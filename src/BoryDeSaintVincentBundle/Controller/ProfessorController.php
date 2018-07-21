<?php

namespace BoryDeSaintVincentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/professor")
 */
class ProfessorController extends Controller
{
    /**
     * @Route("/calendar", name="professor_calendar")
     * @Method({"GET"})
     */
    public function displayAction()
    {
        return $this->render('@BoryDeSaintVincent/Professor/calendar.html.twig');
    }
}
