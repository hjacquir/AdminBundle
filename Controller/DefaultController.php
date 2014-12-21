<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\AdminBundle\Controller;

use Doctrine\ORM\EntityManager;
use Hj\AdminBundle\Entity\User;
use Hj\AdminBundle\Form\Type\UserType;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

/**
 * Class DefaultController
 * @package Hj\AdminBundle\Controller
 */
class DefaultController extends ContainerAware
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var UserType
     */
    private $userType;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @param Response $response
     * @param EntityManager $entityManager
     * @param FormFactory $formFactory
     * @param UserType $userType
     * @param User $user
     * @param Twig_Environment $twig
     */
    public function __construct(
        Response $response,
        EntityManager $entityManager,
        FormFactory $formFactory,
        UserType $userType,
        User $user,
        Twig_Environment $twig
    ) {
        $this->response      = $response;
        $this->entityManager = $entityManager;
        $this->formFactory   = $formFactory;
        $this->userType      = $userType;
        $this->user          = $user;
        $this->twig          = $twig;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->formFactory->create($this->userType, $this->user);
        $form->handleRequest($request);

        $content = $this->twig->render(
            'HjAdminBundle:Default:index.html.twig',
            array(
                'form' => $form->createView()
            )
        );

        if ($request->isMethod('POST')) {
            if ($form->isValid()) {
                $this->entityManager->persist($this->user);
                $this->entityManager->flush();

                $content = $this->twig->render(
                    'HjAdminBundle:Default:success.html.twig'
                );
            }
        }

        $this->response->setContent($content);

        return $this->response;
    }
}