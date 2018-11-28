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
        $payload = json_decode($request->get('payload'), true);
        $player = $payload['user']['name'];

        /** @var Game $game */
        $game = $this->getDoctrine()->getManager()->getRepository(Game::class)->find($payload['callback_id']);

        if (!$game->alreadyIn($player)) {
            $gamePlayer = new GamePlayer($game, $payload['user']['name']);
            $this->getDoctrine()->getManager()->persist($gamePlayer);
            $this->getDoctrine()->getManager()->flush();
            $this->getDoctrine()->getManager()->refresh($game);
        }

        return $this->jsonResponse($this->getMessage($game));
    }

    public function getMessage(Game $game)
    {
        $text = "Let's play!";
        $players = [];
        $gameIsFull = false;

        foreach ($game->getPlayers() as $player) {
            $players[] = '<@' . $player->getName() . '>';
        }

        if (count($players) == 1) {
            $gameIsFull = true;
        }

        $players = implode(PHP_EOL, $players);

        if ($players) {
            $text .= PHP_EOL . $players;
        }

        $attachment = Attachment::create($text)
            ->withCallbackId($game->getId())
        ;

        if (!$gameIsFull) {
            $attachment->withAction(
                Button::create()
                    ->withName("imIn")
                    ->withText("I'm in!")
                    ->withPrimaryStyle()
            );
        }

        $message = Message::create('')
            ->withAttachment($attachment)
        ;

        return $message;
    }
}