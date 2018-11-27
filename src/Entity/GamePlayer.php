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
     * @ORM\Column(name="player", type="string", length=255, nullable=false)
     */
    private $player;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="smallint", nullable=false)
     */
    private $position;

    /**
     * @var Game
     *
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     * })
     */
    private $game;


}
