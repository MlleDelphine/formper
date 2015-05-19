<?php
/**
 * Created by PhpStorm.
 * User: Delphine
 * Date: 19/05/2015
 * Time: 17:01
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
 * @DataTable\Table(id="sessionStatusTable")
 * */

class SessionStatusTable extends AbstractQueryBuilderDataTable implements QueryBuilderDataTableInterface {

    /**
     * @var int
     * @DataTable\Column(source="sessionStatus.id", name="ID", class="")
     */
    public $id;

    /**
     * @var string
     * @DataTable\Column(source="sessionStatus.name", name="Nom",  class="")
     * @DataTable\DefaultSort()
     */
    public $name;

    /**
     * @DataTable\Column(source="", name="Actions",  class="")
     * @DataTable\Format(dataFields={"id":"sessionStatus.id"}, template="FormationAdminBundle:SessionStatus:_dataTables_action.html.twig")
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

        $sessionStatusRepository = $this->em->getRepository('FormationFrontBundle:SessionStatus');
        $qb = $sessionStatusRepository->createQueryBuilder('sessionStatus');

        return $qb;
    }


}