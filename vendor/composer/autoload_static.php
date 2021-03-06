<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd1f2919efae8bd1b3338bdeb8bd9440b
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Vis\\Rating\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Vis\\Rating\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'CreateRatingTable' => __DIR__ . '/../..' . '/src/Migrations/2015_07_31_114538_create_rating_table.php',
        'Vis\\Rating\\RatingController' => __DIR__ . '/../..' . '/src/Http/Controllers/RatingController.php',
        'Vis\\Ratings\\Facades\\Rating' => __DIR__ . '/../..' . '/src/Facades/Rating.php',
        'Vis\\Ratings\\Rating' => __DIR__ . '/../..' . '/src/Models/Rating.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd1f2919efae8bd1b3338bdeb8bd9440b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd1f2919efae8bd1b3338bdeb8bd9440b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd1f2919efae8bd1b3338bdeb8bd9440b::$classMap;

        }, null, ClassLoader::class);
    }
}
