<?php

namespace BorySaintVincentBundle\Controller;

use BorySaintVincentBundle\Entity\Absence;
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
        /** @var \BorySaintVincentBundle\Repository\AbsenceRepository $repository */
        $repository = $this->getDoctrine()->getRepository('BorySaintVincentBundle:Absence');

        /** @var Absence[] $rawAbsences */
        $rawAbsences = $repository->findFromNow();

        // Delete older absences
        $repository->deleteOlderFromNow();

        return $this->render('@BorySaintVincent/Professor/calendar.html.twig', [
            'absences' => $this->convertAbsencesForView($rawAbsences),
            'user'     => $this->get('security.token_storage')->getToken()->getUser(),
        ]);
    }

    /**
     * @param Absence[] $rawAbsences
     * @return array
     */
    private function convertAbsencesForView($rawAbsences)
    {
        $absences = [];
        foreach ($rawAbsences as $rawAbsence) {
            $absences[] = [
                'title'   => $rawAbsence->getTitle(),
                'start'   => $rawAbsence->getStartDate()->format('Y-m-d'),
                'content' => $rawAbsence->getDescription(),
            ];
        }

        return $absences;
    }
}
