<?php

namespace Modules\Media\Image\Intervention\Manipulations;

use Intervention\Image\Image;
use Modules\Media\Image\ImageHandlerInterface;

class Quality implements ImageHandlerInterface
{
    /**
     * Handle the image manipulation request
     */
    public function handle(Image $image, $options): Image
    {
        return $image;
    }
}
