<?php
/**
 * Created by PhpStorm.
 * User: Delphine
 * Date: 20/05/2015
 * Time: 15:22
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
 * @DataTable\Table(id="subscriptionTable")
 * */
class SubscriptionTable extends AbstractQueryBuilderDataTable implements QueryBuilderDataTableInterface {

    /**
     * @var int
     * @DataTable\Column(source="subscription.id", name="ID", class="")
     */
    public $id;

    /**
     * @var int
     * @DataTable\Column(source="subscription.user", name="Membre", class="")
     */
    public $user;


    /**
     * @var int
     * @DataTable\Column(source="subscription.formation", name="Formation", class="")
     */
    public $formation;

    /**
     * @var int
     * @DataTable\Column(source="subscription.session", name="Session", class="")
     */
    public $session;


    /**
     * @var int
     * @DataTable\Column(source="subscription.status", name="Etat", class="")
     */
    public $status;


    /**
     * @var \DateTime
     * @DataTable\Column(source="subscription.created", name="Date de création",  class="")
     * @DataTable\Format(dataFields={"created":"subscription.created"}, template="FormationAdminBundle::_date_template.html.twig")
     */
    public $created;

    /**
     * @DataTable\Column(source="", name="Actions",  class="")
     * @DataTable\Format(dataFields={"id":"level.id"}, template="FormationAdminBundle:Technology:_dataTables_action.html.twig")
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

        $levelRepository = $this->em->getRepository('FormationFrontBundle:Subscription');
        $qb = $levelRepository->createQueryBuilder('subscription');

        return $qb;
    }

}