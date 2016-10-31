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


class DoubleTag extends NamedTag
{
    public function getType()
    {
        return NBT::TAG_Double;
    }


    public function read(NBT $nbt)
    {
        $this->value = $nbt->getDouble();
    }


    public function write(NBT $nbt)
    {
        $nbt->putDouble($this->value);
    }
}