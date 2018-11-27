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

    /**
     * Attachment constructor.
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @param string $title
     * @return Attachment
     */
    public static function create(string $title): Attachment
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
     * @param int $callbackId
     * @return Attachment
     */
    public function withCallbackId(int $callbackId): Attachment
    {
        $this->callbackId = $callbackId;

        return $this;
    }
}