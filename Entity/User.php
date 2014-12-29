<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package Hj\AdminBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id",type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="label", length=255)
     */
    private $label;

    /**
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     *      )
     **/
    private $groups;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param Group $group
     *
     * @return bool
     */
    public function hasGroup(Group $group)
    {
        return $this->groups->contains($group);
    }


    /**
     * @param Group $group
     *
     * @return $this
     */
    public function addGroup(Group $group)
    {
        if (false === $this->hasGroup($group)) {
            $this->groups->add($group);
        }

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getLabel();
    }
}