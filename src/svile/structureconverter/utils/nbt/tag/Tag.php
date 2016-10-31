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

namespace svile\cuboidconverter\utils\nbt\tag;


use svile\cuboidconverter\utils\nbt\NBT;


abstract class Tag extends \stdClass
{
    protected $value;


    public function &getValue()
    {
        return $this->value;
    }


    public abstract function getType();


    public function setValue($value)
    {
        $this->value = $value;
    }


    abstract public function write(NBT $nbt);


    abstract public function read(NBT $nbt);


    public function __toString()
    {
        return (string)$this->value;
    }
}