<?php

namespace Icap\LessonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Icap\LessonBundle\Entity\Chapter;
use Claroline\CoreBundle\Entity\User;

/**
 * Done
 *
 * @ORM\Table("orange_done")
 * @ORM\Entity(repositoryClass="Icap\LessonBundle\Repository\DoneRepository")
 */
class Done
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Icap\LessonBundle\Entity\Chapter")
     * @ORM\JoinColumn(name="Lesson_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $lesson;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Claroline\CoreBundle\Entity\User")
     * @ORM\JoinColumn(name="User_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @var boolean
     *
     * @ORM\Column(name="done", type="boolean")
     */
    private $done;


    /**
     * Set lesson
     *
     * @param Chapter $done
     * @return Done
     */
    public function setLesson($lesson)
    {
        $this->lesson = $lesson;

        return $this;
    }

    /**
     * Get lesson
     *
     * @return Chapter
     */
    public function getLesson()
    {
        return $this->lesson;
    }
    /**
     * Set user
     *
     * @param User $done
     * @return Done
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Set done
     *
     * @param boolean $done
     * @return Done
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return boolean
     */
    public function getDone()
    {
        return $this->done;
    }
}
