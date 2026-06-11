![alt text](https://marshmallow.dev/cdn/media/logo-red-237x46.png "marshmallow.")

# Laravel Folder Cleaner

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marshmallow/laravel-folder-cleaner.svg?style=flat-square)](https://packagist.org/packages/marshmallow/laravel-folder-cleaner)
[![Tests](https://img.shields.io/github/actions/workflow/status/marshmallow-packages/laravel-folder-cleaner/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/marshmallow-packages/laravel-folder-cleaner/actions/workflows/run-tests.yml)
[![Check & fix styling](https://img.shields.io/github/actions/workflow/status/marshmallow-packages/laravel-folder-cleaner/php-cs-fixer.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/marshmallow-packages/laravel-folder-cleaner/actions/workflows/php-cs-fixer.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/marshmallow/laravel-folder-cleaner.svg?style=flat-square)](https://packagist.org/packages/marshmallow/laravel-folder-cleaner)

Clean folders using a command. This can be helpful if you have temporary files in your projects that need to be cleaned for saving storage.

## Installation

You can install the package via composer:

```bash
composer require marshmallow/laravel-folder-cleaner
```

You can install the package by running the command below. This installation command will publish a config file where you can let the package know what you wish to delete.

```bash
php artisan folder-cleaner:install
```

The following config file will now be published.

```php
return [

    /**
     * You can specify the folders that should be cleaned in
     * this config array. We will search for these folders
     * in the root directory of you project.
     */
    'folders' => [
        // '/storage/logs',
        // '/storage' => [
        //     'older_than' => '3 months',
        //     'except' => [
        //         'important.log',
        //     ],
        // ],
        // '/storage/app' => [
        //     'older_than' => '1 day',
        //     'match' => '/^export_\d+\.xlsx$/',
        // ],
    ],
];
```

## Usage

```bash
php artisan folder-cleaner:clean {--dry-run}
```

Run with `--dry-run` to print the files that would be deleted without actually removing them.

### Options

In the config file you can specify a couple of settings to let the package know what should be cleaned.

If you just provide a string for a folder, all the files in this folder will be deleted when the command is run. Please not, this doesn't work recursively, folders will not be deleted.

```php
return [
    'folders' => [
        // '/storage/logs',
    ]
];
```

You can also specify some settings as an array after the path of the folder. The example below will delete all files that are older then 3 months, match a patern of export\_{number}.xlsx except for export_1.xlsx.

```php
return [
    'folders' => [
        '/storage' => [
            'older_than' => '3 months',
            'match' => '/^export_\d+\.xlsx$/',
            'except' => [
                'export_1.xlsx',
            ],
        ],
    ]
];
```

If you have a directory which holds temporary directories that can deleted with all its content, you can use the `delete_folders` options. In the example below, all files in the download directory AND all sub directories in the download directory will be deleted once they are 7 days old.
```php
return [
    'folders' => [
         '/storage/app/public/download' => [
            'delete_folders' => true,
            'older_than' => '7 days',
        ],
    ]
];
```

If you need more options, please let us know. This was enough for our use case at the moment of creating this package.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please report security vulnerabilities by email to [stef@marshmallow.dev](mailto:stef@marshmallow.dev) rather than via the public issue tracker.

## Credits

-   [Stef van Esch](https://github.com/marshmallow-packages)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
