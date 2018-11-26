<?php

namespace App\SlackMessage;

class Attachment implements \JsonSerializable
{
    use JsonSerializeTrait;

    private $title;
    private $fallback;
    private $callbackId;
    private $color;
    private $actions;

    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * @param $title
     * @return Attachment
     */
    public static function create($title): Attachment
    {
        return new self($title);
    }

    /**
     * @param Action $action
     * @return Attachment
     */
    public function withAction(Action $action): Attachment
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * @param $callbackId
     * @return Attachment
     */
    public function withCallbackId($callbackId): Attachment
    {
        $this->callbackId = $callbackId;

        return $this;
    }
}