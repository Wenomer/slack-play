<?php
namespace App\Controller;

use App\Entity\Game;
use App\Entity\GamePlayer;
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
     * @Route("/debug")
     */
    public function DebugAction(Request $request, Connection $connection)
    {
        /** @var Game $game */
        $game = $this->getDoctrine()->getManager()->getRepository(Game::class)->find(11);

foreach ($game->getPlayers() as $player) {
    var_dump($player->getPlayer());
}
die;
//        return $this->jsonResponse($this->getMessage($game));
    }

    /**
     * @Route("/command")
     */
    public function CommandAction(Request $request, Connection $connection)
    {
        $game = new Game();
        $this->getDoctrine()->getManager()->persist($game);
        $this->getDoctrine()->getManager()->flush();

        return $this->jsonResponse($this->getMessage($game));
    }

    /**
     * @Route("/interaction")
     */
    public function InteractionAction(Request $request)
    {
        $payload = $request->get('payload');
        error_log(gettype($payload));
        /** @var Game $game */
//        $game = $this->getDoctrine()->getManager()->getRepository(Game::class)->find($payload['callback_id']);
//        $gamePlayer = new GamePlayer($game, $payload['user']['name']);
//
//        $this->getDoctrine()->getManager()->persist($gamePlayer);
//        $this->getDoctrine()->getManager()->flush();

        return $this->jsonResponse($this->getMessage($game));
    }

    public function getMessage(Game $game)
    {
        $text = "Let's play!";
        $players = [];

        foreach ($game->getPlayers() as $player) {
            $players[] = '<@' . $player->getName() . '>';
        }

        $players = implode(PHP_EOL, $players);

        if ($players) {
            $text .= PHP_EOL . $players;
        }

        $message = Message::create('')
            ->withAttachment(
                Attachment::create($text)
                    ->withCallbackId($game->getId())
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