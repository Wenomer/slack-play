<?php

namespace App\SlackMessage;

abstract class Action
{
    const TYPE_BUTTON = 'button';
    const TYPE_SELECT = 'select';

    const STYLE_DEFAULT = 'default';
    const STYLE_PRIMARY = 'primary';
    const STYLE_DANGER = 'danger';

    protected $name;
    protected $text;
    protected $value;
    protected $type;
}
