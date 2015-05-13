<?php

namespace Formation\FrontBundle\Entity;

use Brown298\DataTablesBundle\MetaData as DataTable;
use Brown298\DataTablesBundle\Model\DataTable\QueryBuilderDataTableInterface;
use Brown298\DataTablesBundle\Test\DataTable\QueryBuilderDataTable;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package Formation\AdminBundle\Datatable
 * @DataTable\Table(id="levelTable")
 * */

class LevelTable extends QueryBuilderDataTable implements QueryBuilderDataTableInterface{

    /**
     * @var int
     * @DataTable\Column(source="level.id", name="ID")
     */
    public $id;

    /**
     * @var string
     * @DataTable\Column(source="level.name", name="Nom")

     */
    public $name;

    /**
     * @var bool hydrate results to doctrine objects
     */
    public $hydrateObjects = true;

    /**
     * getQueryBuilder
     *
     * @param Request $request
     *
     * @return null
     */
    public function getQueryBuilder(Request $request = null)
    {
        $levelRepository = $this->container->get('doctrine.orm.entity_manager')
            ->getRepository('FormationFrontBundle:Level');
        $qb = $levelRepository->createQueryBuilder('level');

        return $qb;
    }

}