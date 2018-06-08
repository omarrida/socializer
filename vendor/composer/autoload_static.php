<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcd2a0fc3ff3c0dbef3d5df0a1b1efd41
{
    public static $files = array (
        '925e325b89201e840218339d59df1393' => __DIR__ . '/../..' . '/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Audiogram\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Audiogram\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcd2a0fc3ff3c0dbef3d5df0a1b1efd41::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcd2a0fc3ff3c0dbef3d5df0a1b1efd41::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}