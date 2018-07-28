<?php

namespace BorySaintVincentBundle\Controller;

use BorySaintVincentBundle\Entity\Absence;
use BorySaintVincentBundle\Form\AbsenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AbsenceController
 * @package BorySaintVincentBundle\Controller
 * @Route("/absence")
 */
class AbsenceController extends Controller
{
    /**
     * @param Request $request
     * @return string
     * @Route("/add", name="absence_add")
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $absence = new Absence();
        $form    = $this->createForm(AbsenceType::class, $absence, [
            'action' => $this->generateUrl('absence_add'),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($absence);
            $em->flush();

            return $this->redirectToRoute('professor_calendar');
        }

        return $this->render('@BorySaintVincent/Absence/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
