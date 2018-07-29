<?php

namespace BorySaintVincentBundle\Controller;

use BorySaintVincentBundle\Entity\SchoolClass;
use BorySaintVincentBundle\Form\SchoolClassType;
use BorySaintVincentBundle\Service\StringService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

/**
 * Class AdminController
 * @package BorySaintVincentBundle\Controller
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/create/user", name="admin_create_user")
     * @Method({"GET", "POST"})
     */
    public function createUserAction(Request $request)
    {
        $user = new User();
        /** @var \Symfony\Component\Form\Form $form */
        $form = $this->get('form.factory')->create(UserType::class, $user);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Utilisateur créé');

            return $this->redirectToRoute('default_index');
        }

        return $this->render('@BorySaintVincent/Admin/create.user.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/create/class", name="admin_create_class")
     * @Method({"GET", "POST"})
     */
    public function createClassAction(Request $request)
    {
        $schoolClass = new SchoolClass();
        /** @var \Symfony\Component\Form\Form $form */
        $form = $this->get('form.factory')->create(SchoolClassType::class, $schoolClass);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            /** @var StringService $stringService */
            $stringService = $this->get(StringService::class);

            $schoolClass->setSlug($stringService->slugify($schoolClass->getName()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($schoolClass);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Classe créée');

            return $this->redirectToRoute('default_index');
        }

        return $this->render('@BorySaintVincent/Admin/create.class.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/create/article", name="admin_create_article")
     * @Method({"GET", "POST"})
     */
    public function createArticleAction(Request $request)
    {

    }
}
