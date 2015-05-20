<?php

namespace Formation\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Formation\FrontBundle\Entity\SubscriptionStatus;
use Formation\AdminBundle\Form\SubscriptionStatusType;

/**
 * SubscriptionStatus controller.
 *
 */
class SubscriptionStatusController extends Controller
{

    /**
     * Lists all SubscriptionStatus entities.
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @package Formation\AdminBundle\Controller
     * @return array
     */
    public function indexAction(Request $request)
    {
        $dataTable = $this->get('data_tables.manager')->getTable('subscriptionStatusTable');

        if ($response = $dataTable->ProcessRequest($request)) {
            return $response;
        }

        return $this->render('FormationAdminBundle:SubscriptionStatus:index.html.twig', array(
            'dataTable' => $dataTable,
        ));
    }
    /**
     * Creates a new SubscriptionStatus entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SubscriptionStatus();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('subscriptionstatus_show', array('id' => $entity->getId())));
        }

        return $this->render('FormationAdminBundle:SubscriptionStatus:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SubscriptionStatus entity.
     *
     * @param SubscriptionStatus $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SubscriptionStatus $entity)
    {
        $form = $this->createForm(new SubscriptionStatusType(), $entity, array(
            'action' => $this->generateUrl('subscriptionstatus_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer', 'attr' => array('class' => 'btn btn-sm btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new SubscriptionStatus entity.
     *
     */
    public function newAction()
    {
        $entity = new SubscriptionStatus();
        $form   = $this->createCreateForm($entity);

        return $this->render('FormationAdminBundle:SubscriptionStatus:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SubscriptionStatus entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:SubscriptionStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubscriptionStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:SubscriptionStatus:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SubscriptionStatus entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:SubscriptionStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubscriptionStatus entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:SubscriptionStatus:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SubscriptionStatus entity.
    *
    * @param SubscriptionStatus $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SubscriptionStatus $entity)
    {
        $form = $this->createForm(new SubscriptionStatusType(), $entity, array(
            'action' => $this->generateUrl('subscriptionstatus_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Valider', 'attr' => array('class' => 'btn btn-sm btn-primary')));

        return $form;
    }
    /**
     * Edits an existing SubscriptionStatus entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:SubscriptionStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubscriptionStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('subscriptionstatus_edit', array('id' => $id)));
        }

        return $this->render('FormationAdminBundle:SubscriptionStatus:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SubscriptionStatus entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FormationFrontBundle:SubscriptionStatus')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SubscriptionStatus entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('subscriptionstatus'));
    }

    /**
     * Creates a form to delete a SubscriptionStatus entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subscriptionstatus_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', 'attr' => array('class' => 'btn btn-sm btn-danger')))
            ->getForm()
        ;
    }
}
