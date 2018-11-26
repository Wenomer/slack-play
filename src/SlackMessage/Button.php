<?php

namespace App\SlackMessage;

class Button extends Action
{
    public function __construct() {
        $this->type = self::TYPE_BUTTON;
    }

    public static function create(): Button
    {
        return new self();
    }

}