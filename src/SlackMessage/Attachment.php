<?php

namespace App\SlackMessage;

class Attachment
{
    private $title;
    private $fallback;
    private $callbackId;
    private $color;
    
    private $actions;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public static function create($title)
    {
        return new self($title);
    }

    public function addAction(Action $action)
    {
        $this->actions[] = $action;

        return $this;
    }
}