<?php

namespace Modules\Imedia\Events;


class DeleteMedia
{
    public mixed $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
