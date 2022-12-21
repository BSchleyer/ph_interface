<?php



namespace Composer\Autoload;

class ComposerStaticInit728f96e67824ff0c88d9b31fcd5c7681
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PayPal' => 
            array (
                0 => __DIR__ . '/..' . '/paypal/rest-api-sdk-php/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit728f96e67824ff0c88d9b31fcd5c7681::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit728f96e67824ff0c88d9b31fcd5c7681::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit728f96e67824ff0c88d9b31fcd5c7681::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
