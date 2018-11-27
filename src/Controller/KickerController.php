<?php
namespace App\Controller;

use App\Entity\Game;
use App\SlackMessage\Attachment;
use App\SlackMessage\Button;
use App\SlackMessage\Message;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/kicker")
 */
class KickerController extends Controller
{
    /**
     * @Route("/command")
     */
    public function CommandAction(Request $request, Connection $connection)
    {
        $match = new Game();
        $this->getDoctrine()->getManager()->persist($match);
        $this->getDoctrine()->getManager()->flush();



        return $this->jsonResponse($this->getMessage($match));
    }

    /**
     * @Route("/interaction")
     */
    public function InteractionAction(Request $request)
    {
        return $this->response((string) $request->getContent());
    }

    public function getMessage(Game $match)
    {
        $message = Message::create('')
            ->withAttachment(
                Attachment::create('       
       :-------|-----|-------:
       |                     |
####-- + ---------X--------- +
       |                     |
####-- + ------X-----X------ +
       |                     |
       + ----X----X----X---- + --####
       |                     |
####-- + -X----X-----X----X- + 
       |                     |
       + -X----X-----X----X- + --####
       |                     |
####-- + ----X----X----X---- +
       |                     |
       + ------X-----X------ + --####
       |                     |
       + ---------X--------- + --####
       |                     |
       :-------|-----|-------:
       ')

                    ->withCallbackId($match->getId())
                    ->withAction(
                        Button::create()
                            ->withName("imIn")
                            ->withText("I'm in!")
                            ->withPrimaryStyle()
                    )
            );

        return $message;
    }
}