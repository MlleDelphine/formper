<?php
/**
 * Created by PhpStorm.
 * User: Delphine
 * Date: 29/05/2015
 * Time: 16:55
 */

namespace Formation\FrontBundle\Entity;


use Brown298\DataTablesBundle\MetaData as DataTable;
use Brown298\DataTablesBundle\Model\DataTable\AbstractQueryBuilderDataTable;
use Brown298\DataTablesBundle\Model\DataTable\QueryBuilderDataTableInterface;

use Symfony\Component\HttpFoundation\Request;


use Doctrine\ORM\Mapping as ORM;

/**
* @package Formation\AdminBundle\Datatable
* @DataTable\Table(id="sessionTable")
* */
class SessionTable extends AbstractQueryBuilderDataTable implements QueryBuilderDataTableInterface{

    /**
     * @var int
     * @DataTable\Column(source="session.id", name="ID", class="text-center")
     */
    public $id;

    /**
     * @var string
     * @DataTable\Column(source="session.name", name="Nom",  class="text-center")
     * @DataTable\DefaultSort()
     */
    public $name;

    /**
     * @var string
     * @DataTable\Column(source="session.places", name="Nombre de places",  class="text-center")
     * @DataTable\DefaultSort()
     */
    public $places;

    /**
     * @var string
     * @DataTable\Column(source="session.formation.name", name="Formation rattachée",  class="text-center")
     * @DataTable\DefaultSort()
     */
    public $formation;

    /**
     * @DataTable\Column(source="session.sessionDates", name="Dates",  class="")
     * @DataTable\Format(dataFields={"sessionDates":"session.sessionDates"}, template="FormationAdminBundle:Session:_session_dates.html.twig")
     */
    public $sessionDates;

    /**
     * @var \DateTime
     * @DataTable\Column(source="session.created", name="Date de création",  class="text-center")
     * @DataTable\Format(dataFields={"created":"session.created"}, template="FormationAdminBundle::_date_template.html.twig")
     */
    public $created;

    /**
     * @DataTable\Column(source="", name="Actions",  class="")
     * @DataTable\Format(dataFields={"id":"session.formation.id"}, template="FormationAdminBundle:Session:_dataTables_action.html.twig")
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

        $sessionRepository = $this->em->getRepository('FormationFrontBundle:Session');
        $qb = $sessionRepository->createQueryBuilder('session');

        return $qb;
    }

}