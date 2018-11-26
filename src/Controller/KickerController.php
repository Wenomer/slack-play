<?php
namespace App\Controller;

use App\SlackMessage\Attachment;
use App\SlackMessage\Button;
use App\SlackMessage\Message;
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
    public function CommandAction(Request $request)
    {
        $message = Message::create('The kicker match')
            ->withAttachment(
                Attachment::create('Lets play')
                    ->withCallbackId(1)
                    ->withAction(
                        Button::create()
                            ->withName("imIn")
                            ->withText("I'm in!")
                    )
            );

        return $this->jsonResponse($message);
    }

    /**
     * @Route("/interaction")
     */
    public function InteractionAction(Request $request)
    {
        return $this->response((string) $request->getContent());
    }
}