[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

# Clean folders using a command. This can be helpful if you have temporary files in your projects that need to be cleaned for saving storage.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marshmallow/laravel-folder-cleaner.svg?style=flat-square)](https://packagist.org/packages/marshmallow/laravel-folder-cleaner)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/marshmallow/laravel-folder-cleaner/run-tests?label=tests)](https://github.com/marshmallow/laravel-folder-cleaner/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/marshmallow/laravel-folder-cleaner/Check%20&%20fix%20styling?label=code%20style)](https://github.com/marshmallow/laravel-folder-cleaner/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/marshmallow/laravel-folder-cleaner.svg?style=flat-square)](https://packagist.org/packages/marshmallow/laravel-folder-cleaner)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require marshmallow/laravel-folder-cleaner
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-folder-cleaner-config"
```

This is the contents of the published config file:

```php
return [

    /**
     * You can specify the folders that should be cleaned in
     * this config array. We will search for these folders
     * in the root directory of you project.
     */
    'folders' => [
        // 'storage/app/livewire-tmp',
    ],

];
```

## Usage

```bash
php artisan folder-cleaner:clean
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Stef van Esch](https://github.com/marshmallow-packages)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
