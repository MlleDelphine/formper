<?php

namespace Formation\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Formation\FrontBundle\Entity\Formation;
use Formation\AdminBundle\Form\FormationType;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Formation controller.
 *
 */
class FormationController extends Controller
{

    /**
     * Lists all Formation entities.
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @package Formation\AdminBundle\Controller
     * @return array
     */
    public function indexAction(Request $request)
    {
        $dataTable = $this->get('data_tables.manager')->getTable('formationTable');

        if ($response = $dataTable->ProcessRequest($request)) {
            return $response;
        }

        return $this->render('FormationAdminBundle:Formation:index.html.twig', array(
            'dataTable' => $dataTable,
        ));
    }
    /**
     * Creates a new Formation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Formation();
        $form = $this->createCreateForm($entity);

        $form->handleRequest($request);
        dump($form->getData());
        die;

        //Gestion des prérequis / sessions /sessionDate supprimés
        $originalRequirements = new ArrayCollection();
        $originalSessions = new ArrayCollection();
        $originalSessionDates = new ArrayCollection();

        // Crée un tableau contenant les objets Requirement courants de la
        // base de données
        foreach ($entity->getRequirements() as $requirement) {
            $originalRequirements->add($requirement);
        }
        // Crée un tableau contenant les objets Session courants de la
        // base de données
        foreach ($entity->getSessions() as $session) {
            $originalSessions->add($session);
            foreach($session->getSessionDates() as $date){
                $originalSessionDates->add($date);
            }
        }

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            // supprime la relation entre le requirement et la « Formation »
            foreach ($originalRequirements as $requirement) {
                if ($entity->getRequirements()->contains($requirement) == false) {
                    // supprime la « Formation » du Requirement
                    $requirement->setFormation(null);
                    $em->remove($requirement);
                }
            }
            // supprime la relation entre la Session et la « Formation »
            foreach ($originalSessions as $session) {
                if ($entity->getSessions()->contains($session) == false) {
                    // supprime la « Session » de la SessionDate
                    $session->setFormation(null);
                    $em->remove($session);
                }
                else{
                    foreach ($originalSessionDates as $date) {
                        if ($session->getSessionDates()->contains($date) == false) {
                            // supprime la « SessionDate » de la Session
                            $date->setSession(null);
                            $em->remove($date);
                        }
                    }
                }
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formation_edit', array('id' => $entity->getId())));
        }

        return $this->render('FormationAdminBundle:Formation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Formation entity.
     *
     * @param Formation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Formation $entity)
    {
        $form = $this->createForm(new FormationType(), $entity, array(
            'action' => $this->generateUrl('formation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer', 'attr' => array('class' => 'btn btn-sm btn-primary')));
        $form->add('save', 'submit', array('label' => 'Valider', 'attr' => array('class' => 'btn btn-sm btn-primary')));
        $form->add('saveagain', 'submit', array('label' => 'Valider', 'attr' => array('class' => 'btn btn-sm btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new Formation entity.
     *
     */
    public function newAction()
    {
        $entity = new Formation();
        $form   = $this->createCreateForm($entity);

        return $this->render('FormationAdminBundle:Formation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Formation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Formation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:Formation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Formation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Formation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:Formation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Formation entity.
     *
     * @param Formation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Formation $entity)
    {
        $form = $this->createForm(new FormationType(), $entity, array(
            'action' => $this->generateUrl('formation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Valider', 'attr' => array('class' => 'btn btn-sm btn-primary')));
        $form->add('save', 'submit', array('label' => 'Valider', 'attr' => array('class' => 'btn btn-sm btn-primary')));
        $form->add('saveagain', 'submit', array('label' => 'Valider', 'attr' => array('class' => 'btn btn-sm btn-primary')));

        return $form;
    }

    /**
     * Edits an existing Formation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Formation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formation entity.');
        }

        //Gestion des prérequis / sessions /sessionDate supprimés
        $originalRequirements = new ArrayCollection();
        $originalSessions = new ArrayCollection();
        $originalSessionDates = new ArrayCollection();

        // Crée un tableau contenant les objets Requirement courants de la
        // base de données
        foreach ($entity->getRequirements() as $requirement) {
            $originalRequirements->add($requirement);
        }
        // Crée un tableau contenant les objets Session courants de la
        // base de données
        foreach ($entity->getSessions() as $session) {
            $originalSessions->add($session);
            foreach($session->getSessionDates() as $date){
                $originalSessionDates->add($date);
            }
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);

        // $editForm->handleRequest($request);
        if ($request->isMethod('POST')) {
            $editForm->submit($request->request->get($editForm->getName()));
            if ($editForm->isValid()) {
                // supprime la relation entre le requirement et la « Formation »
                foreach ($originalRequirements as $requirement) {
                    if ($entity->getRequirements()->contains($requirement) == false) {
                        // supprime la « Formation » du Requirement
                        $requirement->setFormation(null);
                        $em->remove($requirement);
                    }
                }
                // supprime la relation entre la Session et la « Formation »
                foreach ($originalSessions as $session) {
                    if ($entity->getSessions()->contains($session) == false) {
                        // supprime la « Session » de la SessionDate
                        $session->setFormation(null);
                        $em->remove($session);
                    }
                    else{
                        foreach ($originalSessionDates as $date) {
                            if ($session->getSessionDates()->contains($date) == false) {
                                // supprime la « SessionDate » de la Session
                                $date->setSession(null);
                                $em->remove($date);
                            }
                        }
                    }
                }
                $em->persist($entity);
                $em->flush();
            }
        }

        return $this->render('FormationAdminBundle:Formation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Formation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FormationFrontBundle:Formation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Formation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }


        return $this->redirect($this->generateUrl('formation'));
    }

    /**
     * Render delete form in modal
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteFormAction($id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormationFrontBundle:Formation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormationAdminBundle:Formation:delete.html.twig', array(
            'entity'      => $entity,
            'form'   => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a Formation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', 'attr' => array('class' => 'btn btn-sm btn-danger')))
            ->getForm()
            ;
    }
}
