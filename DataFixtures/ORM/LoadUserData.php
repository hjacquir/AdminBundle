<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Hj\AdminBundle\Entity\Group;
use Hj\AdminBundle\Entity\User;

/**
 * Class LoadUserData
 * @package Hj\AdminBundle\DataFixtures\ORM
 *
 * @todo add unit and functional test
 */
class LoadUserData implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $i = 0;

        while ($i < 5) {
            $group = $this->createGroup("Group {$i}");
            $user = $this->createUser("User {$i}");
            $user->addGroup($group);

            $manager->persist($group);
            $manager->persist($user);

            $i++;
        }

        $manager->flush();
    }

    /**
     * @param string $label
     *
     * @return Group
     */
    private function createGroup($label)
    {
        $group = new Group();
        $group->setLabel($label);

        return $group;
    }

    /**
     * @param string $label
     * @param Group $group
     *
     * @return User
     */
    private function createUser($label, Group $group = null)
    {
        $user = new User();
        $user->setLabel($label);

        if (null !== $group) {
            $user->addGroup($group);
        }

        return $user;
    }
}