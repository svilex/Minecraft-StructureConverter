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


use svile\structureconverter\utils\nbt\NBT;


class FloatTag extends NamedTag
{
    public function getType()
    {
        return NBT::TAG_Float;
    }


    public function read(NBT $nbt)
    {
        $this->value = $nbt->getFloat();
    }


    public function write(NBT $nbt)
    {
        $nbt->putFloat($this->value);
    }
}