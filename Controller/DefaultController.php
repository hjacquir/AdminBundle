<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\AdminBundle\Controller;

use Doctrine\ORM\EntityManager;
use Hj\AdminBundle\Entity\User;
use Hj\AdminBundle\Form\Type\UserType;
use Hj\AdminBundle\Form\Type\WrappedUserType;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

/**
 * Class DefaultController
 * @package Hj\AdminBundle\Controller
 *
 * @todo add unit and functional test
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
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @param Response $response
     * @param EntityManager $entityManager
     * @param FormFactory $formFactory
     * @param UserType $userType
     * @param Twig_Environment $twig
     */
    public function __construct(
        Response $response,
        EntityManager $entityManager,
        FormFactory $formFactory,
        UserType $userType,
        Twig_Environment $twig
    ) {
        $this->response      = $response;
        $this->entityManager = $entityManager;
        $this->formFactory   = $formFactory;
        $this->userType      = $userType;
        $this->twig          = $twig;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $users = $this->entityManager->getRepository(User::CLASS_NAME)->findAll();
        $forms = array();

        foreach ($users as $user) {
            $userType = new WrappedUserType($this->userType, $user);
            $form = $this->formFactory->create($userType, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                if ($form->isValid()) {
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();
                }
            }
            $forms[] = $form->createView();
        }

        $content = $this->twig->render(
            'HjAdminBundle:Default:index.html.twig',
            array(
                'forms' => $forms,
            )
        );

        $this->response->setContent($content);

        return $this->response;
    }
}