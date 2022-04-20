# Laravel Stubs

This repo contains opionated versions of the Laravel default stubs, feel free to ammend after publishing.

These are aimed at being as strict as the framework will allow, and they are not for everyone.

## Installation

You can install this package using composer:

```bash
composer require --dev juststeveking/laravel-stubs
```

If you want to make sure these stubs stay up to date with every update, add this composer hok to your `composer.json` file:

```json
"scripts": {
    "post-update-cmd": [
        "@php artisan publish:stubs --force"
    ]
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

If you've found a bug regarding security please mail [juststevemcd@gmail.com](mailto:juststevemcd@gmail.com) instead of using the issue tracker.

## Credits

- [Steve McDougall](https://github.com/juststeveking)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see License File for more information.
