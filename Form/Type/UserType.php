<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\AdminBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Hj\AdminBundle\Entity\Group;
use Hj\AdminBundle\Entity\User;
use Hj\AdminBundle\HjAdminBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class UserType
 * @package Hj\AdminBundle\Form\Type
 */
class UserType extends AbstractType
{
    const NAME = 'userType';

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden');
        $builder->add('label', 'text');
        $builder->add('groups', 'entity', array(
            'class' => Group::CLASS_NAME,
        ));
        $builder->add('submit', 'submit');
//        $listener = function (FormEvent $event) {
//            $data = $event->getData();
//            var_dump($data);
//        };
//
//        $builder->addEventListener(FormEvents::POST_SET_DATA, $listener);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::CLASS_NAME
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return self::NAME;
    }
}