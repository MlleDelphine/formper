<?php

namespace Formation\FrontBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * LevelRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LevelRepository extends EntityRepository
{
    /**
     * getQueryBuilder
     *
     * @param Request $request
     *
     * @return null
     */
    public function getQueryBuilder(Request $request = null)
    {
        $userRepository = $this->container->get('doctrine.orm.entity_manager')
            ->getRepository('FormationFrontBundle:Level');
        $qb = $userRepository->createQueryBuilder('level');

        return $qb;
    }
}
