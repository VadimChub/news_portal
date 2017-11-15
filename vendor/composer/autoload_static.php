<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4ea85a20d343472f56a63632d4ac8067
{
    public static $classMap = array (
        'db\\db' => __DIR__ . '/../..' . '/db/db.php',
        'db\\db_categories' => __DIR__ . '/../..' . '/db/db_categories.php',
        'db\\db_news' => __DIR__ . '/../..' . '/db/db_news.php',
        'helpers\\category_builder' => __DIR__ . '/../..' . '/helpers/category_builder.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit4ea85a20d343472f56a63632d4ac8067::$classMap;

        }, null, ClassLoader::class);
    }
}
