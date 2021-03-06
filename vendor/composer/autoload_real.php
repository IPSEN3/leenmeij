<?php

// autoload_real.php generated by Composer

class ComposerAutoloaderInit404b24b78d5b75d0523969b0da096a26
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit404b24b78d5b75d0523969b0da096a26', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit404b24b78d5b75d0523969b0da096a26', 'loadClassLoader'));

        $vendorDir = dirname(__DIR__);
        $baseDir = dirname($vendorDir);

        $includePaths = require __DIR__ . '/include_paths.php';
        array_push($includePaths, get_include_path());
        set_include_path(join(PATH_SEPARATOR, $includePaths));

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->add($namespace, $path);
        }

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        require $vendorDir . '/ircmaxell/password-compat/lib/password.php';
        require $vendorDir . '/kriswallsmith/assetic/src/functions.php';
        require $vendorDir . '/phpseclib/phpseclib/phpseclib/Crypt/Random.php';
        require $vendorDir . '/swiftmailer/swiftmailer/lib/swift_required.php';
        require $vendorDir . '/laravel/framework/src/Illuminate/Support/helpers.php';
        require $vendorDir . '/jasonlewis/basset/src/helpers.php';

        return $loader;
    }
}
