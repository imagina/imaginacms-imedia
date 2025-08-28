<?php

namespace Modules\Imedia\Events;


class CreateMedia
{
    public mixed $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
