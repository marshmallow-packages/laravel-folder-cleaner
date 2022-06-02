<?php

namespace Marshmallow\FolderCleaner\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\FolderCleaner\FolderCleaner as BaseFolderCleaner;

/**
 * @see \Marshmallow\FolderCleaner\FolderCleaner
 */
class FolderCleaner extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BaseFolderCleaner::class;
    }
}
