<?php

namespace AppBundle\Handler;


use AppBundle\Entity\Doge;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method Doge get($id)
 * @method Doge post(Request $request)
 */
class DogeHandler extends AbstractHandler
{
    function all($limit = null, $offset = null)
    {
        return $this->repository->findBy([], ['id' => 'DESC'], $limit, $offset);
    }


}