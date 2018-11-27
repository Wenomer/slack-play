<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GamePlayer
 *
 * @ORM\Table(name="game_player", uniqueConstraints={@ORM\UniqueConstraint(name="game_player_position", columns={"match_id", "position"})}, indexes={@ORM\Index(name="IDX_397683642ABEACD6", columns={"match_id"})})
 * @ORM\Entity
 */
class GamePlayer
{
    /**
     * GamePlayer constructor.
     * @param Game $game
     * @param string $player
     */
    public function __construct(Game $game, string $player)
    {
        $this->game = $game;
        $this->player = $player;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var Game
     *
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     * })
     */
    private $game;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
