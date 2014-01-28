<?php

// autoload_real.php generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInitce5ff0510c13eeb1a584d7dadaeeea97
=======
class ComposerAutoloaderInitd7449e22732b4b481446a1ee4e483c8e
>>>>>>> 8f87b087f7cfe29a39205f96d0ca8bf402d6a4c5
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

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInitce5ff0510c13eeb1a584d7dadaeeea97', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInitce5ff0510c13eeb1a584d7dadaeeea97', 'loadClassLoader'));
=======
        spl_autoload_register(array('ComposerAutoloaderInitd7449e22732b4b481446a1ee4e483c8e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInitd7449e22732b4b481446a1ee4e483c8e', 'loadClassLoader'));
>>>>>>> 8f87b087f7cfe29a39205f96d0ca8bf402d6a4c5

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
        require $vendorDir . '/swiftmailer/swiftmailer/lib/swift_required.php';
        require $vendorDir . '/phpseclib/phpseclib/phpseclib/Crypt/Random.php';
        require $vendorDir . '/laravel/framework/src/Illuminate/Support/helpers.php';
        require $vendorDir . '/jasonlewis/basset/src/helpers.php';

        return $loader;
    }
}
