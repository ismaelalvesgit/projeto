<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit184fcf0f2d7ea3023673770cb4241a51
{
    public static $prefixLengthsPsr4 = array (
        'i' => 
        array (
            'ismael\\' => 7,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ismael\\' => 
        array (
            0 => __DIR__ . '/..' . '/ismael/php-classes/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
        'R' => 
        array (
            'Rain' => 
            array (
                0 => __DIR__ . '/..' . '/rain/raintpl/library',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit184fcf0f2d7ea3023673770cb4241a51::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit184fcf0f2d7ea3023673770cb4241a51::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit184fcf0f2d7ea3023673770cb4241a51::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
