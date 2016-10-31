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

namespace svile\structureconverter\utils;

abstract class Utils
{
    /**
     * Returns the current Operating System
     * Windows => win
     * MacOS => mac
     * iOS => ios
     * Android => android
     * Linux => Linux
     * BSD => bsd
     * Other => other
     *
     * @return string
     */
    public static function getOS()
    {
        $uname = php_uname('s');
        if (stripos($uname, 'Darwin') !== false) {
            if (strpos(php_uname('m'), 'iP') === 0) {
                $os = 'ios';
            } else {
                $os = 'mac';
            }
        } elseif (stripos($uname, 'Win') !== false or $uname === 'Msys') {
            $os = 'win';
        } elseif (stripos($uname, 'Linux') !== false) {
            if (@file_exists('/system/build.prop')) {
                $os = 'android';
            } else {
                $os = 'linux';
            }
        } elseif (stripos($uname, 'BSD') !== false or $uname === 'DragonFly') {
            $os = 'bsd';
        } else {
            $os = 'other';
        }
        return $os;
    }


    public static function getURL($page, $timeout = 10, array $extraHeaders = [])
    {
        $ch = curl_init($page);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge(['User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'], $extraHeaders));
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, (int)$timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, (int)$timeout);
        $ret = curl_exec($ch);
        curl_close($ch);

        return $ret;
    }


    public static function postURL($page, $args, $timeout = 10, array $extraHeaders = [])
    {
        $ch = curl_init($page);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge(['User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36'], $extraHeaders));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, (int)$timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, (int)$timeout);
        $ret = curl_exec($ch);
        curl_close($ch);

        return $ret;
    }


    /**
     * Gets the External IP using an external service
     *
     * @return string|false
     */
    public static function getIP()
    {
        $ip = trim(strip_tags(Utils::getURL('http://checkip.dyndns.org/')));
        if (preg_match('#Current IP Address\: ([0-9a-fA-F\:\.]*)#', $ip, $matches) > 0) {
            return $matches[1];
        } else {
            $ip = Utils::getURL('http://www.checkip.org/');
            if (preg_match('#">([0-9a-fA-F\:\.]*)</span>#', $ip, $matches) > 0) {
                return $matches[1];
            } else {
                $ip = Utils::getURL('http://checkmyip.org/');
                if (preg_match('#Your IP address is ([0-9a-fA-F\:\.]*)#', $ip, $matches) > 0) {
                    return $matches[1];
                } else {
                    $ip = trim(Utils::getURL('http://ifconfig.me/ip'));
                    if ($ip != '') {
                        return $ip;
                    } else {
                        return false;
                    }
                }
            }
        }
    }


    /**
     * http://stackoverflow.com/questions/1057572/how-can-i-get-a-hex-dump-of-a-string-in-php
     *
     * @param string $string
     * @param array $options
     * @return array|string
     */
    public static function HexDump(string $string = '', array $options = [])
    {
        $eol = isset($options['eol']) ? $options['eol'] : PHP_EOL;
        $bytes_per_line = @$options['bytes_per_line'] ? $options['bytes_per_line'] : 16;
        $pad_char = isset($options['pad_char']) ? $options['pad_char'] : '.';

        $text_lines = str_split($string, $bytes_per_line);
        $hex_lines = str_split(bin2hex($string), $bytes_per_line * 2);

        $offset = 0;
        $output = [];
        $bytes_per_line_div_2 = (int)($bytes_per_line / 2);
        foreach ($hex_lines as $i => $hex_line) {
            $text_line = $text_lines[$i];
            $output [] =
                '§b' . sprintf('%08X', $offset) . '  §f§r' .
                str_pad(
                    strlen($text_line) > $bytes_per_line_div_2
                        ?
                        implode(' ', str_split(substr($hex_line, 0, $bytes_per_line), 2)) . '  ' .
                        implode(' ', str_split(substr($hex_line, $bytes_per_line), 2))
                        :
                        implode(' ', str_split($hex_line, 2))
                    , $bytes_per_line * 3) .
                '  §a|' . preg_replace('/[^\x20-\x7E]/', $pad_char, $text_line) . '|§f§r';
            $offset += $bytes_per_line;
        }
        $output [] = sprintf('%08X', strlen($string));
        return @$options['want_array'] ? $output : join($eol, $output) . $eol . $eol;
    }
}