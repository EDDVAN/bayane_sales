<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8edb88dbe28f7c649e888eae10de32e3
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'mikehaertl\\tmp\\' => 15,
            'mikehaertl\\shellcommand\\' => 24,
            'mikehaertl\\pdftk\\' => 17,
        ),
        'C' => 
        array (
            'Classes\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'mikehaertl\\tmp\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-tmpfile/src',
        ),
        'mikehaertl\\shellcommand\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-shellcommand/src',
        ),
        'mikehaertl\\pdftk\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-pdftk/src',
        ),
        'Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8edb88dbe28f7c649e888eae10de32e3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8edb88dbe28f7c649e888eae10de32e3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8edb88dbe28f7c649e888eae10de32e3::$classMap;

        }, null, ClassLoader::class);
    }
}
