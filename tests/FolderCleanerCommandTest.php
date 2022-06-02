<?php

use Illuminate\Filesystem\Filesystem;
use Marshmallow\FolderCleaner\Facades\FolderCleaner;

$test_folder = 'test-folder';
$test_file_count = 2;

beforeEach(function () use ($test_folder, $test_file_count) {
    mkdir($test_folder);
    for ($i = 0; $i < $test_file_count; $i++) {
        fopen("test-folder/testfile-{$i}.txt", "w");
    }
});

afterEach(function () use ($test_folder) {
    rmdir($test_folder);
});

it('test it clears all the files in the folder', function () use ($test_folder, $test_file_count) {
    $file = new Filesystem();
    $this->assertCount($test_file_count, $file->files($test_folder));

    FolderCleaner::cleanFolders([
        $test_folder,
    ]);

    $this->assertCount(0, $file->files($test_folder));
});
