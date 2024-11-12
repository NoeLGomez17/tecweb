<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc49b8e2bc7c9b6201a216b5c5d6fff75
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitc49b8e2bc7c9b6201a216b5c5d6fff75', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitc49b8e2bc7c9b6201a216b5c5d6fff75', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitc49b8e2bc7c9b6201a216b5c5d6fff75::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}