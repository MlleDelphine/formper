<?php
/**
 * Created by PhpStorm.
 * User: Delphine
 * Date: 19/05/2015
 * Time: 17:13
 */

namespace Formation\FrontBundle\Entity;

use Brown298\DataTablesBundle\MetaData as DataTable;
use Brown298\DataTablesBundle\Model\DataTable\AbstractQueryBuilderDataTable;
use Brown298\DataTablesBundle\Model\DataTable\QueryBuilderDataTableInterface;
use Brown298\DataTablesBundle\Test\DataTable\QueryBuilderDataTable;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package Formation\AdminBundle\Datatable
 * @DataTable\Table(id="technologyTable")
 * */
class TechnologyTable extends AbstractQueryBuilderDataTable implements QueryBuilderDataTableInterface {

    /**
     * @var int
     * @DataTable\Column(source="technology.id", name="ID", class="")
     */
    public $id;

    /**
     * @var string
     * @DataTable\Column(source="technology.name", name="Nom",  class="")
     * @DataTable\DefaultSort()
     */
    public $name;

    /**
     * @var \DateTime
     * @DataTable\Column(source="technology.created", name="Date de création",  class="")
     * @DataTable\Format(dataFields={"created":"technology.created"}, template="FormationAdminBundle::_date_template.html.twig")
     */
    public $created;

    /**
     * @DataTable\Column(source="", name="Actions",  class="")
     * @DataTable\Format(dataFields={"id":"level.id"}, template="FormationAdminBundle:Level:_dataTables_action.html.twig")
     */
    public $action;


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

        $levelRepository = $this->em->getRepository('FormationFrontBundle:Technology');
        $qb = $levelRepository->createQueryBuilder('technology');

        return $qb;
    }

}