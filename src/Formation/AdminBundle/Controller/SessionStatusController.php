<?php

namespace Formation\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Formation\FrontBundle\Entity\SessionStatus;
use Formation\AdminBundle\Form\SessionStatusType;

/**
 * SessionStatus controller.
 *
 */
class SessionStatusController extends Controller
{

    /**
     * Lists all SessionStatus entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FormationFrontBundle:SessionStatus')->findAll();

        return $this->render('FormationAdminBundle:SessionStatus:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SessionStatus entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SessionStatus();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sessionstatus_show', array('id' => $entity->getId())));
        }

        return $this->render('FormationAdminBundle:SessionStatus:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SessionStatus entity.
     *
     * @param SessionStatus $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SessionStatus $entity)
    {
        $form = $this->createForm(new SessionStatusType(), $entity, array(
            'action' => $this->generateUrl('sessionstatus_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SessionStatus entity.
     *
     */
    public function newAction()
    {
        $entity = new SessionStatus();
        $form   = $this->createCreateForm($entity);

        return $this->render('FormationAdminBundle:SessionStatus:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SessionStatus entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:SessionStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SessionStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:SessionStatus:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SessionStatus entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:SessionStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SessionStatus entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:SessionStatus:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SessionStatus entity.
    *
    * @param SessionStatus $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SessionStatus $entity)
    {
        $form = $this->createForm(new SessionStatusType(), $entity, array(
            'action' => $this->generateUrl('sessionstatus_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SessionStatus entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:SessionStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SessionStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sessionstatus_edit', array('id' => $id)));
        }

        return $this->render('FormationAdminBundle:SessionStatus:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SessionStatus entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FormationFrontBundle:SessionStatus')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SessionStatus entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sessionstatus'));
    }

    /**
     * Creates a form to delete a SessionStatus entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sessionstatus_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
