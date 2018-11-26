<?php

namespace App\SlackMessage;

abstract class Action implements \JsonSerializable
{
    use JsonSerializeTrait;
    
    const TYPE_BUTTON = 'button';
    const TYPE_SELECT = 'select';

    const STYLE_DEFAULT = 'default';
    const STYLE_PRIMARY = 'primary';
    const STYLE_DANGER = 'danger';

    protected $name;
    protected $text;
    protected $value;
    protected $type;

    abstract public static function create();

    /**
     * @param $name
     * @return Action
     */
    public function withName($name): Action
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param $text
     * @return Action
     */
    public function withText($text): Action
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param $value
     * @return Action
     */
    public function withValue($value): Action
    {
        $this->value = $value;

        return $this;
    }
}
