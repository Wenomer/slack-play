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
    protected $style;
    protected $type;

    abstract public static function create();

    /**
     * @param string $name
     * @return Action
     */
    public function withName(string $name): Action
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $text
     * @return Action
     */
    public function withText(string $text): Action
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param string $value
     * @return Action
     */
    public function withValue(string $value): Action
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Action
     */
    public function withDefaultStyle(): Action
    {
        $this->style = self::STYLE_DEFAULT;

        return $this;
    }

    /**
     * @return Action
     */
    public function withPrimaryStyle(): Action
    {
        $this->style = self::STYLE_PRIMARY;

        return $this;
    }

    /**
     * @return Action
     */
    public function withDangerStyle(): Action
    {
        $this->style = self::STYLE_DANGER;

        return $this;
    }
}
