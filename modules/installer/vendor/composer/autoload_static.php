<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit700768c99d2c45b9338270be33092f5c
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Remotelywork\\Installer\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Remotelywork\\Installer\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit700768c99d2c45b9338270be33092f5c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit700768c99d2c45b9338270be33092f5c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit700768c99d2c45b9338270be33092f5c::$classMap;

        }, null, ClassLoader::class);
    }
}
