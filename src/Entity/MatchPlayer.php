<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MatchPlayer
 *
 * @ORM\Table(name="match_player", uniqueConstraints={@ORM\UniqueConstraint(name="match_player_position", columns={"match_id", "position"})}, indexes={@ORM\Index(name="IDX_397683642ABEACD6", columns={"match_id"})})
 * @ORM\Entity
 */
class MatchPlayer
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
     * @var Match
     *
     * @ORM\ManyToOne(targetEntity="Match")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="match_id", referencedColumnName="id")
     * })
     */
    private $match;


}
