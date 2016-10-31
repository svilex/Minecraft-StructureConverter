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

namespace svile\structureconverter\utils\nbt\tag;

abstract class NamedTag extends Tag
{
    protected $__name;


    /**
     * @param string $name
     * @param bool|float|double|int|byte|short|array|CompoundTag|ListTag|string $value
     */
    public function __construct($name = "", $value = null)
    {
        $this->__name = ($name === null or $name === false) ? "" : $name;
        if ($value !== null) {
            $this->value = $value;
        }
    }


    public function getName()
    {
        return $this->__name;
    }


    public function setName($name)
    {
        $this->__name = $name;
    }
}