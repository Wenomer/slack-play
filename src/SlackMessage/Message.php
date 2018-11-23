<?php

namespace App\SlackMessage;

class Message
{
    private $text;

    private $attachments = [];

    public function __construct($text)
    {
        $this->text = $text;
    }

    public static function create($text)
    {
        return new self($text);
    }

    public function addAttachment(Attachment $attachment)
    {
        $this->attachments[] = $attachment;

        return $this;
    }
}