<?php
/**
 * Created by PhpStorm.
 * User: Delphine
 * Date: 21/05/2015
 * Time: 16:17
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
 * @DataTable\Table(id="formationTable")
 * */

class FormationTable extends AbstractQueryBuilderDataTable implements QueryBuilderDataTableInterface{

    /**
     * @var int
     * @DataTable\Column(source="formation.id", name="ID", class="")
     */
    public $id;

    /**
     * @var string
     * @DataTable\Column(source="formation.name", name="Nom",  class="")
     * @DataTable\DefaultSort()
     */
    public $name;

    /**
     * @var string
     * @DataTable\Column(source="formation.shortDescription", name="Description",  class="")
     * @DataTable\DefaultSort()
     */
    public $shortDescription;

    /**
     * @var string
     * @DataTable\Column(source="formation.price", name="Prix",  class="")
     * @DataTable\DefaultSort()
     */
    public $price;

    /**
     * @var string
     * @DataTable\Column(source="formation.published", name="Statut",  class="")
     * @DataTable\Format(dataFields={"published":"formation.published"}, template="FormationAdminBundle:Formation:_published.html.twig")
     * @DataTable\DefaultSort()
     */
    public $published;

    /**
     * @var string
     * @DataTable\Column(source="formation.teacher", name="Formateur",  class="")
     * @DataTable\DefaultSort()
     */
    public $teacher;

    /**
     * @var string
     * @DataTable\Column(source="formation.level.name", name="Niveau",  class="")
     * @DataTable\DefaultSort()
     */
    public $level;

    /**
     * @DataTable\Column(source="formation.subscriptions", name="Inscriptions",  class="")
     * @DataTable\Format(dataFields={"subscriptions":"formation.subscriptions"}, template="FormationAdminBundle:Formation:_subscriptions.html.twig")
     */
    public $subscriptions;


    /**
     * @DataTable\Column(source="formation.technologies", name="Technologies",  class="")
     * @DataTable\Format(dataFields={"technologies":"formation.technologies"}, template="FormationAdminBundle:Formation:_technologies.html.twig")
     */
    public $technologies;


    /**
     * @DataTable\Column(source="", name="Actions",  class="")
     * @DataTable\Format(dataFields={"id":"formation.id"}, template="FormationAdminBundle:Formation:_dataTables_action.html.twig")
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

        $formationRepository = $this->em->getRepository('FormationFrontBundle:Formation');
        $qb = $formationRepository->createQueryBuilder('formation');

        return $qb;
    }


}