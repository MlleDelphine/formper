<?php

namespace Formation\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Formation\FrontBundle\Entity\SessionDate;
use Formation\AdminBundle\Form\SessionDateType;

/**
 * SessionDate controller.
 *
 */
class SessionDateController extends Controller
{

    /**
     * Lists all SessionDate entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FormationFrontBundle:SessionDate')->findAll();

        return $this->render('FormationAdminBundle:SessionDate:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SessionDate entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SessionDate();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sessiondate_show', array('id' => $entity->getId())));
        }

        return $this->render('FormationAdminBundle:SessionDate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SessionDate entity.
     *
     * @param SessionDate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SessionDate $entity)
    {
        $form = $this->createForm(new SessionDateType(), $entity, array(
            'action' => $this->generateUrl('sessiondate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SessionDate entity.
     *
     */
    public function newAction()
    {
        $entity = new SessionDate();
        $form   = $this->createCreateForm($entity);

        return $this->render('FormationAdminBundle:SessionDate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SessionDate entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:SessionDate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SessionDate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:SessionDate:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SessionDate entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:SessionDate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SessionDate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:SessionDate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SessionDate entity.
    *
    * @param SessionDate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SessionDate $entity)
    {
        $form = $this->createForm(new SessionDateType(), $entity, array(
            'action' => $this->generateUrl('sessiondate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SessionDate entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:SessionDate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SessionDate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sessiondate_edit', array('id' => $id)));
        }

        return $this->render('FormationAdminBundle:SessionDate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SessionDate entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FormationFrontBundle:SessionDate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SessionDate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sessiondate'));
    }

    /**
     * Creates a form to delete a SessionDate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sessiondate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
