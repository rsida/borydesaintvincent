<?php

namespace BoryDeSaintVincentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

/**
 * Class AdminController
 * @package BoryDeSaintVincentBundle\Controller
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

        return $this->render('@BoryDeSaintVincent/Admin/create.user.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
