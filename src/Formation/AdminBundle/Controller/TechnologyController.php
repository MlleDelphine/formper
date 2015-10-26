<?php

namespace Formation\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Formation\FrontBundle\Entity\Technology;
use Formation\AdminBundle\Form\TechnologyType;

/**
 * Technology controller.
 *
 */
class TechnologyController extends Controller
{

    /**
     * Lists all Technology entities.
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @package Formation\AdminBundle\Controller
     * @return array
     */
    public function indexAction(Request $request)
    {
        $dataTable = $this->get('data_tables.manager')->getTable('technologyTable');

        if ($response = $dataTable->ProcessRequest($request)) {
            return $response;
        }

        return $this->render('FormationAdminBundle:Technology:index.html.twig', array(
            'dataTable' => $dataTable,
        ));
    }
    /**
     * Creates a new Technology entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Technology();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('technology_edit', array('id' => $entity->getId())));
        }

        return $this->render('FormationAdminBundle:Technology:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Technology entity.
     *
     * @param Technology $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Technology $entity)
    {
        $form = $this->createForm(new TechnologyType(), $entity, array(
            'action' => $this->generateUrl('technology_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer', 'attr' => array('class' => 'btn btn-sm btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new Technology entity.
     *
     */
    public function newAction()
    {
        $entity = new Technology();
        $form   = $this->createCreateForm($entity);

        return $this->render('FormationAdminBundle:Technology:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Technology entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Technology')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Technology entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:Technology:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Technology entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Technology')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Technology entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:Technology:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Technology entity.
    *
    * @param Technology $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Technology $entity)
    {
        $form = $this->createForm(new TechnologyType(), $entity, array(
            'action' => $this->generateUrl('technology_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Valider', 'attr' => array('class' => 'btn btn-sm btn-primary')));

        return $form;
    }
    /**
     * Edits an existing Technology entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Technology')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Technology entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->submit($request->request->get($editForm->getName()));

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('technology_edit', array('id' => $id)));
        }

        return $this->render('FormationAdminBundle:Technology:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Technology entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FormationFrontBundle:Technology')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Technology entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('technology'));
    }

    /**
     * Render delete form in modal
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteFormAction($id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Technology')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:Technology:delete.html.twig', array(
            'entity'      => $entity,
            'form'   => $deleteForm->createView(),
        ));
    }
    /**
     * Creates a form to delete a Technology entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('technology_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', 'attr' => array('class' => 'btn btn-sm btn-danger')))
            ->getForm()
        ;
    }
}
