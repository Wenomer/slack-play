<?php
namespace App\Controller;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller extends \Symfony\Bundle\FrameworkBundle\Controller\Controller implements ContainerAwareInterface
{
    public function jsonResponse($data)
    {
        return $this->response(json_encode($data), 200 , ['Content-type' => 'application/json']);
    }

    public function response($data, $status = 200, $headers = [])
    {
        return new Response($data, $status, $headers);
    }

    public function getJson(Request $request, $key)
    {
        $data = $request->get($key, null);

        if (!$data) {
            return null;
        }

        return json_decode($data, true);
    }
}