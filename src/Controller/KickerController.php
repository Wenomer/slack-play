<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/kicker")
 */
class KickerController extends Controller
{
    /**
     * @Route("/command")
     */
    public function CommandAction()
    {

        return $this->response('click!');
    }
}