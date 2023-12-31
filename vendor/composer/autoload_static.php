<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit14e8d7fa7493be918b50648dca0a47a6
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Admin\\Inovatech\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Admin\\Inovatech\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit14e8d7fa7493be918b50648dca0a47a6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit14e8d7fa7493be918b50648dca0a47a6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit14e8d7fa7493be918b50648dca0a47a6::$classMap;

        }, null, ClassLoader::class);
    }
}
