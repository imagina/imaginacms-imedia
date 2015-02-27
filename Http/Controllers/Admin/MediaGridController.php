<?php namespace Modules\Media\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Media\Repositories\FileRepository;

class MediaGridController extends AdminBaseController
{
    /**
     * @var FileRepository
     */
    private $file;

    public function __construct(FileRepository $file)
    {
        parent::__construct();

        $this->file = $file;
    }

    /**
     * A grid view for the upload button
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $files = $this->file->all();

        return view('media::admin.grid.general', compact('files'));
    }

    /**
     * A grid view of uploaded files used for the wysiwyg editor
     * @return \Illuminate\View\View
     */
    public function ckIndex()
    {
        $files = $this->file->all();

        return view('media::admin.grid.ckeditor', compact('files'));
    }
}