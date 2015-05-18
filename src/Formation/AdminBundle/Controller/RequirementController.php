<?php

namespace Formation\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Formation\FrontBundle\Entity\Requirement;
use Formation\AdminBundle\Form\RequirementType;

/**
 * Requirement controller.
 *
 */
class RequirementController extends Controller
{

    /**
     * Lists all Requirement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FormationFrontBundle:Requirement')->findAll();

        return $this->render('FormationAdminBundle:Requirement:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Requirement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Requirement();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('requirement_show', array('id' => $entity->getId())));
        }

        return $this->render('FormationAdminBundle:Requirement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Requirement entity.
     *
     * @param Requirement $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Requirement $entity)
    {
        $form = $this->createForm(new RequirementType(), $entity, array(
            'action' => $this->generateUrl('requirement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Requirement entity.
     *
     */
    public function newAction()
    {
        $entity = new Requirement();
        $form   = $this->createCreateForm($entity);

        return $this->render('FormationAdminBundle:Requirement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Requirement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Requirement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Requirement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:Requirement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Requirement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Requirement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Requirement entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:Requirement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Requirement entity.
    *
    * @param Requirement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Requirement $entity)
    {
        $form = $this->createForm(new RequirementType(), $entity, array(
            'action' => $this->generateUrl('requirement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Requirement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Requirement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Requirement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('requirement_edit', array('id' => $id)));
        }

        return $this->render('FormationAdminBundle:Requirement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Requirement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FormationFrontBundle:Requirement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Requirement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('requirement'));
    }

    /**
     * Creates a form to delete a Requirement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('requirement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
