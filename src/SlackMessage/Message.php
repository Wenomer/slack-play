<?php

namespace App\SlackMessage;

class Message implements \JsonSerializable
{
    use JsonSerializeTrait;

    private $text;
    private $attachments = [];

    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * @param $text
     * @return Message
     */
    public static function create($text) : Message
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

    public function jsonSerialize()
    {
        return [
            'text' => $this->text,
            'attachments' => $this->attachments,
        ];
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return json_encode($this);
    }
}