<?php

namespace AppBundle\Handler;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractHandler
{
    /**
     * @var string
     */
    protected $entityClass;

    /**
     * @var string
     */
    protected $formTypeClass;

    /**
     * @var ObjectManager
     */
    protected $om;

    /**
     * @var ObjectRepository
     */
    protected $repository;

    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    protected function createEntity()
    {
        return new $this->entityClass;
    }

    protected function createFormType()
    {
        return new $this->formTypeClass;
    }

    protected function processForm($entity, \Symfony\Component\HttpFoundation\Request $request)
    {
        $form = $this->createForm(null, ['method' => $request->getMethod()]);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $entity = $form->getData();
            $this->om->persist($entity);
            $this->om->flush($entity);
            return $entity;
        }

        throw new InvalidArgumentException('Invalid submitted data');
    }

    public function __construct($entityClass, $formTypeClass, ObjectManager $om, FormFactoryInterface $formFactory)
    {
        $this->entityClass = $entityClass;
        $this->formTypeClass = $formTypeClass;
        $this->om = $om;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    public function createForm($data = null, array $options = array())
    {
        return $this->formFactory->create($this->createFormType(), $data, $options);
    }

    public function get($id)
    {
        return $this->repository->find($id);
    }

    public function post(Request $request)
    {
        return $this->processForm($this->createEntity(), $request, 'POST');
    }


}