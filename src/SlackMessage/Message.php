<?php

namespace App\SlackMessage;

class Message implements \JsonSerializable
{
    use JsonSerializeTrait;

    private $text;
    private $attachments = [];

    /**
     * Message constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @param string $text
     * @return Message
     */
    public static function create(string $text) : Message
    {
        return new self($text);
    }

    /**
     * @param Attachment $attachment
     * @return Message
     */
    public function withAttachment(Attachment $attachment) : Message
    {
        $this->attachments[] = $attachment;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return json_encode($this);
    }
}