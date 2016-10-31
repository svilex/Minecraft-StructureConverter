<?php

namespace svile {


    use svile\cuboidconverter\StructureBlock;
    use svile\cuboidconverter\utils\console\Console;


    set_time_limit(0);
    error_reporting(E_ALL);
    ini_set('allow_url_fopen', 1);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('memory_limit', -1);
    date_default_timezone_set('UTC');
    ini_set('date.timezone', 'UTC');

    if (php_sapi_name() !== 'cli') {
        echo 'You must use the CLI.' . PHP_EOL;
        exit(1);
    }
    if (version_compare('7.0', PHP_VERSION) > 0) {
        echo 'You must use PHP >= 7.0' . PHP_EOL;
        exit(1);
    }

    @define('PATH', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR);

    spl_autoload_register(function ($class) {
        require_once PATH . 'src' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    });

    Console::init();
    Console::input('File absolute path (can be an §a*.nbt§f§r or a §a*.schematic§f§r) : ');
    $inputPath = Console::getInput();
    $path = realpath($inputPath);

    if (!is_file($path)) {
        Console::error('§cCouldn\'t find the file at: §f§r' . $inputPath);
        goto pause;
    }

    if (substr($path, -4) == '.nbt') {
        StructureBlock::toSchematic($path);
    } elseif (substr($path, -4) != '.schematic') {
        Console::error('§f*.schematic §cto §f.*nbt §cisn\'t avaible yet');
    } else {
        Console::error('§cThe file must be an §f*.nbt§c or a §f*.schematic');
        goto pause;
    }

    pause:
    Console::log(PHP_EOL . '§f§rPress §lEnter§f§r §fto exit');
    Console::getInput();
    exit(0);
}