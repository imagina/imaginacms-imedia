<?php

namespace Modules\Imedia\Events;

//use Modules\Imedia\Entities\File;

class FileIsDeleting
{
    public mixed $params;

    public function __construct($params = null)
    {
        // $this->file = $file;
        $this->params = $params;
    }
}
