<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\PortfolioStock;
use AppBundle\Form\PortfolioStockType;

/**
 * PortfolioStock controller.
 *
 * @Route("/portfoliostock")
 */
class PortfolioStockController extends Controller
{

    /**
     * Lists all PortfolioStock entities.
     *
     * @Route("/", name="portfoliostock")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:PortfolioStock')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new PortfolioStock entity.
     *
     * @Route("/", name="portfoliostock_create")
     * @Method("POST")
     * @Template("AppBundle:PortfolioStock:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PortfolioStock();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('portfoliostock_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PortfolioStock entity.
     *
     * @param PortfolioStock $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PortfolioStock $entity)
    {
        $form = $this->createForm(new PortfolioStockType(), $entity, array(
            'action' => $this->generateUrl('portfoliostock_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PortfolioStock entity.
     *
     * @Route("/new", name="portfoliostock_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PortfolioStock();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PortfolioStock entity.
     *
     * @Route("/{id}", name="portfoliostock_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:PortfolioStock')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PortfolioStock entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PortfolioStock entity.
     *
     * @Route("/{id}/edit", name="portfoliostock_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:PortfolioStock')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PortfolioStock entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a PortfolioStock entity.
    *
    * @param PortfolioStock $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PortfolioStock $entity)
    {
        $form = $this->createForm(new PortfolioStockType(), $entity, array(
            'action' => $this->generateUrl('portfoliostock_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PortfolioStock entity.
     *
     * @Route("/{id}", name="portfoliostock_update")
     * @Method("PUT")
     * @Template("AppBundle:PortfolioStock:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:PortfolioStock')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PortfolioStock entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('portfoliostock_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PortfolioStock entity.
     *
     * @Route("/{id}", name="portfoliostock_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:PortfolioStock')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PortfolioStock entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('portfoliostock'));
    }

    /**
     * Creates a form to delete a PortfolioStock entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('portfoliostock_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
