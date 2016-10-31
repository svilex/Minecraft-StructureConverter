<?php

/*
 *                _   _
 *  ___  __   __ (_) | |   ___
 * / __| \ \ / / | | | |  / _ \
 * \__ \  \ / /  | | | | |  __/
 * |___/   \_/   |_| |_|  \___|
 *
 * @Author: svile
 * @Kik: _svile_
 * @Telegram_Group: https://telegram.me/svile
 * @E-mail: thesville@gmail.com
 * @Github: https://github.com/svilex
 *
 */

namespace svile\structureconverter\utils\console;

use svile\structureconverter\utils\Utils;

abstract class Console
{
    const ESCAPE = "\xc2\xa7"; //§


    const BLACK = self::ESCAPE . '0';
    const DARK_BLUE = self::ESCAPE . '1';
    const DARK_GREEN = self::ESCAPE . '2';
    const DARK_AQUA = self::ESCAPE . '3';
    const DARK_RED = self::ESCAPE . '4';
    const DARK_PURPLE = self::ESCAPE . '5';
    const GOLD = self::ESCAPE . '6';
    const GRAY = self::ESCAPE . '7';
    const DARK_GRAY = self::ESCAPE . '8';
    const BLUE = self::ESCAPE . '9';
    const GREEN = self::ESCAPE . 'a';
    const AQUA = self::ESCAPE . 'b';
    const RED = self::ESCAPE . 'c';
    const LIGHT_PURPLE = self::ESCAPE . 'd';
    const YELLOW = self::ESCAPE . 'e';
    const WHITE = self::ESCAPE . 'f';

    const OBFUSCATED = self::ESCAPE . 'k';
    const BOLD = self::ESCAPE . 'l';
    const STRIKETHROUGH = self::ESCAPE . 'm';
    const UNDERLINE = self::ESCAPE . 'n';
    const ITALIC = self::ESCAPE . 'o';
    const RESET = self::ESCAPE . 'r';


    public static $COLOR_BLACK = '';
    public static $COLOR_DARK_BLUE = '';
    public static $COLOR_DARK_GREEN = '';
    public static $COLOR_DARK_AQUA = '';
    public static $COLOR_DARK_RED = '';
    public static $COLOR_PURPLE = '';
    public static $COLOR_GOLD = '';
    public static $COLOR_GRAY = '';
    public static $COLOR_DARK_GRAY = '';
    public static $COLOR_BLUE = '';
    public static $COLOR_GREEN = '';
    public static $COLOR_AQUA = '';
    public static $COLOR_RED = '';
    public static $COLOR_LIGHT_PURPLE = '';
    public static $COLOR_YELLOW = '';
    public static $COLOR_WHITE = '';

    public static $FORMAT_OBFUSCATED = '';
    public static $FORMAT_BOLD = '';
    public static $FORMAT_STRIKETHROUGH = '';
    public static $FORMAT_UNDERLINE = '';
    public static $FORMAT_ITALIC = '';
    public static $FORMAT_RESET = '';


    public static function tokenize($string)
    {
        return preg_split('/(' . self::ESCAPE . '[0123456789abcdefklmnor])/', $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    }


    public static function clean($string, $removeFormat = true)
    {
        if ($removeFormat)
            return str_replace(self::ESCAPE, '', preg_replace(['/' . self::ESCAPE . '[0123456789abcdefklmnor]/', "/\x1b[\\(\\][[0-9;\\[\\(]+[Bm]/"], '', $string));
        return str_replace("\x1b", '', preg_replace("/\x1b[\\(\\][[0-9;\\[\\(]+[Bm]/", '', $string));
    }


    public static function toANSI($string)
    {
        if (!is_array($string))
            $string = self::tokenize($string);

        $newString = '';
        foreach ($string as $token) {
            switch ($token) {
                case self::BLACK:
                    $newString .= self::$COLOR_BLACK;
                    break;
                case self::DARK_BLUE:
                    $newString .= self::$COLOR_DARK_BLUE;
                    break;
                case self::DARK_GREEN:
                    $newString .= self::$COLOR_DARK_GREEN;
                    break;
                case self::DARK_AQUA:
                    $newString .= self::$COLOR_DARK_AQUA;
                    break;
                case self::DARK_RED:
                    $newString .= self::$COLOR_DARK_RED;
                    break;
                case self::DARK_PURPLE:
                    $newString .= self::$COLOR_PURPLE;
                    break;
                case self::GOLD:
                    $newString .= self::$COLOR_GOLD;
                    break;
                case self::GRAY:
                    $newString .= self::$COLOR_GRAY;
                    break;
                case self::DARK_GRAY:
                    $newString .= self::$COLOR_DARK_GRAY;
                    break;
                case self::BLUE:
                    $newString .= self::$COLOR_BLUE;
                    break;
                case self::GREEN:
                    $newString .= self::$COLOR_GREEN;
                    break;
                case self::AQUA:
                    $newString .= self::$COLOR_AQUA;
                    break;
                case self::RED:
                    $newString .= self::$COLOR_RED;
                    break;
                case self::LIGHT_PURPLE:
                    $newString .= self::$COLOR_LIGHT_PURPLE;
                    break;
                case self::YELLOW:
                    $newString .= self::$COLOR_YELLOW;
                    break;
                case self::WHITE:
                    $newString .= self::$COLOR_WHITE;
                    break;

                case self::OBFUSCATED:
                    $newString .= self::$FORMAT_OBFUSCATED;
                    break;
                case self::BOLD:
                    $newString .= self::$FORMAT_BOLD;
                    break;
                case self::ITALIC:
                    $newString .= self::$FORMAT_ITALIC;
                    break;
                case self::UNDERLINE:
                    $newString .= self::$FORMAT_UNDERLINE;
                    break;
                case self::STRIKETHROUGH:
                    $newString .= self::$FORMAT_STRIKETHROUGH;
                    break;
                case self::RESET:
                    $newString .= self::$FORMAT_RESET;
                    break;

                default:
                    $newString .= $token;
                    break;
            }
        }
        return $newString;
    }


    private static function setFallbackEscapeCodes()
    {
        self::$COLOR_BLACK = "\x1b[38;5;16m";
        self::$COLOR_DARK_BLUE = "\x1b[38;5;19m";
        self::$COLOR_DARK_GREEN = "\x1b[38;5;34m";
        self::$COLOR_DARK_AQUA = "\x1b[38;5;37m";
        self::$COLOR_DARK_RED = "\x1b[38;5;124m";
        self::$COLOR_PURPLE = "\x1b[38;5;127m";
        self::$COLOR_GOLD = "\x1b[38;5;214m";
        self::$COLOR_GRAY = "\x1b[38;5;145m";
        self::$COLOR_DARK_GRAY = "\x1b[38;5;59m";
        self::$COLOR_BLUE = "\x1b[38;5;63m";
        self::$COLOR_GREEN = "\x1b[38;5;83m";
        self::$COLOR_AQUA = "\x1b[38;5;87m";
        self::$COLOR_RED = "\x1b[38;5;203m";
        self::$COLOR_LIGHT_PURPLE = "\x1b[38;5;207m";
        self::$COLOR_YELLOW = "\x1b[38;5;227m";
        self::$COLOR_WHITE = "\x1b[38;5;231m";

        self::$FORMAT_OBFUSCATED = "";
        self::$FORMAT_BOLD = "\x1b[1m";
        self::$FORMAT_ITALIC = "\x1b[3m";
        self::$FORMAT_UNDERLINE = "\x1b[4m";
        self::$FORMAT_STRIKETHROUGH = "\x1b[9m";
        self::$FORMAT_RESET = "\x1b[m";
    }


    private static function setEscapeCodes()
    {
        if (function_exists('posix_isatty') && defined('STDOUT') && posix_isatty(STDOUT)) {
            $colors = (int)`tput colors`;
            if ($colors > 8) {
                self::$COLOR_BLACK = $colors >= 256 ? `tput setaf 16` : `tput setaf 0`;
                self::$COLOR_DARK_BLUE = $colors >= 256 ? `tput setaf 19` : `tput setaf 4`;
                self::$COLOR_DARK_GREEN = $colors >= 256 ? `tput setaf 34` : `tput setaf 2`;
                self::$COLOR_DARK_AQUA = $colors >= 256 ? `tput setaf 37` : `tput setaf 6`;
                self::$COLOR_DARK_RED = $colors >= 256 ? `tput setaf 124` : `tput setaf 1`;
                self::$COLOR_PURPLE = $colors >= 256 ? `tput setaf 127` : `tput setaf 5`;
                self::$COLOR_GOLD = $colors >= 256 ? `tput setaf 214` : `tput setaf 3`;
                self::$COLOR_GRAY = $colors >= 256 ? `tput setaf 145` : `tput setaf 7`;
                self::$COLOR_DARK_GRAY = $colors >= 256 ? `tput setaf 59` : `tput setaf 8`;
                self::$COLOR_BLUE = $colors >= 256 ? `tput setaf 63` : `tput setaf 12`;
                self::$COLOR_GREEN = $colors >= 256 ? `tput setaf 83` : `tput setaf 10`;
                self::$COLOR_AQUA = $colors >= 256 ? `tput setaf 87` : `tput setaf 14`;
                self::$COLOR_RED = $colors >= 256 ? `tput setaf 203` : `tput setaf 9`;
                self::$COLOR_LIGHT_PURPLE = $colors >= 256 ? `tput setaf 207` : `tput setaf 13`;
                self::$COLOR_YELLOW = $colors >= 256 ? `tput setaf 227` : `tput setaf 11`;
                self::$COLOR_WHITE = $colors >= 256 ? `tput setaf 231` : `tput setaf 15`;
            } else {
                self::$COLOR_BLACK = self::$COLOR_DARK_GRAY = `tput setaf 0`;
                self::$COLOR_RED = self::$COLOR_DARK_RED = `tput setaf 1`;
                self::$COLOR_GREEN = self::$COLOR_DARK_GREEN = `tput setaf 2`;
                self::$COLOR_YELLOW = self::$COLOR_GOLD = `tput setaf 3`;
                self::$COLOR_BLUE = self::$COLOR_DARK_BLUE = `tput setaf 4`;
                self::$COLOR_LIGHT_PURPLE = self::$COLOR_PURPLE = `tput setaf 5`;
                self::$COLOR_AQUA = self::$COLOR_DARK_AQUA = `tput setaf 6`;
                self::$COLOR_GRAY = self::$COLOR_WHITE = `tput setaf 7`;
            }
            self::$FORMAT_OBFUSCATED = `tput smacs`;
            self::$FORMAT_BOLD = `tput bold`;
            self::$FORMAT_ITALIC = `tput sitm`;
            self::$FORMAT_UNDERLINE = `tput smul`;
            self::$FORMAT_STRIKETHROUGH = "\x1b[9m"; //`tput `;
            self::$FORMAT_RESET = `tput sgr0`;
        } else {
            self::$COLOR_BLACK = self::$COLOR_DARK_GRAY = '';
            self::$COLOR_RED = self::$COLOR_DARK_RED = '';
            self::$COLOR_GREEN = self::$COLOR_DARK_GREEN = '';
            self::$COLOR_YELLOW = self::$COLOR_GOLD = '';
            self::$COLOR_BLUE = self::$COLOR_DARK_BLUE = '';
            self::$COLOR_LIGHT_PURPLE = self::$COLOR_PURPLE = '';
            self::$COLOR_AQUA = self::$COLOR_DARK_AQUA = '';
            self::$COLOR_GRAY = self::$COLOR_WHITE = '';
            self::$FORMAT_OBFUSCATED = '';
            self::$FORMAT_BOLD = '';
            self::$FORMAT_ITALIC = '';
            self::$FORMAT_UNDERLINE = '';
            self::$FORMAT_STRIKETHROUGH = '';
            self::$FORMAT_RESET = '';
        }
    }


    public static function init()
    {
        switch (Utils::getOS()) {
            case 'linux':
            case 'mac':
            case 'bsd':
                self::setEscapeCodes();
                break;

            case 'win':
                self::setFallbackEscapeCodes();
                break;
            case 'android':
                self::setFallbackEscapeCodes();
                self::$FORMAT_ITALIC = '';//I can't see this on android
                break;
        }
    }


    public static function getInput($default = null)
    {
        $input = trim(fgets(STDIN));
        return $input === '' ? $default : $input;
    }


    public static function log($msg = '')
    {
        echo self::toANSI('§f§r' . $msg . '§f§r' . PHP_EOL);
    }


    public static function info($msg = '', $cr = false)
    {
        if ($cr)
            $str = self::toANSI("\r" . '§b§l[' . date('H:i:s') . '] §f§r' . $msg . '§f§r');
        else
            $str = self::toANSI('§b§l[' . date('H:i:s') . '] §f§r' . $msg . '§f§r' . PHP_EOL);

        echo $str;
    }


    public static function error($msg = '')
    {
        echo self::toANSI('§c§l[ERROR] §f§r' . $msg . '§f§r' . PHP_EOL);
    }


    public static function notice($msg = '')
    {
        echo self::toANSI('§d§l[NOTICE] §f§r' . $msg . '§f§r' . PHP_EOL);
    }


    public static function usage($msg = '')
    {
        echo self::toANSI('§c§l[USAGE] ' . '§f§r' . $msg . '§f§r' . PHP_EOL);
    }


    public static function input($msg = '', $eol = false)
    {
        $msg = self::toANSI('§e§l[INPUT] ' . '§f§r' . $msg . '§f§r');
        echo $eol ? $msg . PHP_EOL : $msg;
    }
}