<?php

namespace Icap\LessonBundle\Repository;

use Icap\LessonBundle\Entity\Done;
use Doctrine\ORM\EntityRepository;
use Claroline\CoreBundle\Entity\User;
use Icap\LessonBundle\Entity\Lesson;
use Claroline\CoreBundle\Entity\Workspace\AbstractWorkspace;

class DoneRepository extends EntityRepository {

	public function getUserProgression(User $user, AbstractWorkspace $workspace) {
		
		$dql = "SELECT (CASE WHEN COUNT(c) = 0 THEN (0) ELSE (COUNT(d) / COUNT(c)) * 100 END) AS progression
				FROM Icap\LessonBundle\Entity\Chapter c
				LEFT JOIN Icap\LessonBundle\Entity\Done d
					WITH d.user = :user
					AND d.done = 1
					AND d.lesson = c
				JOIN c.lesson l
				JOIN l.resourceNode rn
				JOIN Claroline\CoreBundle\Entity\Mooc\Mooc m
					WITH m.lesson = rn
				JOIN m.workspace w
				WHERE w = :workspace
				AND c.level > 1";
		
		$query = $this->_em->createQuery($dql);
		$query->setParameter("user", $user);
		$query->setParameter("workspace", $workspace);
		
		return $query->getSingleScalarResult();
	}
}