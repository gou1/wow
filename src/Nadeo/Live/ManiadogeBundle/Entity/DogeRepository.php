<?php

namespace Nadeo\Live\ManiadogeBundle\Entity;


class DogeRepository extends \Doctrine\ORM\EntityRepository
{
    function findAll()
    {
        return $this->findBy([], ['id' => 'DESC']);
    }
}
