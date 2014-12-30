<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\AdminBundle\Form\Type;

use Hj\AdminBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class WrappedUserType
 * @package Hj\AdminBundle\Form\Type
 *
 * @todo add unit and functional test
 */
class WrappedUserType extends AbstractType
{
    /**
     * @var UserType
     */
    private $userType;

    /**
     * @var User
     */
    private $user;

    /**
     * @param UserType $userType
     * @param User $user
     */
    public function __construct(UserType $userType, User $user)
    {
        $this->userType = $userType;
        $this->user = $user;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->userType->buildForm($builder, $options);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->userType->setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'attr' => array('name' => $this->getName()),
        ));
    }

    /**
     * @return string|void
     */
    public function getName()
    {
        return $this->user->getId() . '_' . $this->userType->getName();
    }
}