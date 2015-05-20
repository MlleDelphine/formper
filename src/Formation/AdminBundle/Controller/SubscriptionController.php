<?php

namespace Formation\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Formation\FrontBundle\Entity\Subscription;
use Formation\AdminBundle\Form\SubscriptionType;

/**
 * Subscription controller.
 *
 */
class SubscriptionController extends Controller
{

    /**
     * Lists all Subscription entities.
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @package Formation\AdminBundle\Controller
     * @return array
     */
    public function indexAction(Request $request)
    {
        $dataTable = $this->get('data_tables.manager')->getTable('subscriptionTable');

        if ($response = $dataTable->ProcessRequest($request)) {
            return $response;
        }

        return $this->render('FormationAdminBundle:Subscription:index.html.twig', array(
            'dataTable' => $dataTable,
        ));
    }
    /**
     * Creates a new Subscription entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Subscription();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('subscription_show', array('id' => $entity->getId())));
        }

        return $this->render('FormationAdminBundle:Subscription:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Subscription entity.
     *
     * @param Subscription $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Subscription $entity)
    {
        $form = $this->createForm(new SubscriptionType(), $entity, array(
            'action' => $this->generateUrl('subscription_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer', 'attr' => array('class' => 'btn btn-sm btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new Subscription entity.
     *
     */
    public function newAction()
    {
        $entity = new Subscription();
        $form   = $this->createCreateForm($entity);

        return $this->render('FormationAdminBundle:Subscription:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Subscription entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Subscription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subscription entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:Subscription:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Subscription entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Subscription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subscription entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:Subscription:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Subscription entity.
    *
    * @param Subscription $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Subscription $entity)
    {
        $form = $this->createForm(new SubscriptionType(), $entity, array(
            'action' => $this->generateUrl('subscription_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Valider', 'attr' => array('class' => 'btn btn-sm btn-primary')));

        return $form;
    }
    /**
     * Edits an existing Subscription entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Subscription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subscription entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('subscription_edit', array('id' => $id)));
        }

        return $this->render('FormationFrontBundle:Subscription:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Subscription entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FormationFrontBundle:Subscription')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Subscription entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('subscription'));
    }

    /**
     * Creates a form to delete a Subscription entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subscription_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', 'attr' => array('class' => 'btn btn-sm btn-danger')))
            ->getForm()
        ;
    }
}
