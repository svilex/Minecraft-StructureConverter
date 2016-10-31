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


class IntArrayTag extends NamedTag
{
    public function getType()
    {
        return NBT::TAG_IntArray;
    }


    public function read(NBT $nbt)
    {
        $size = $nbt->getInt();
        $this->value = array_values(unpack($nbt->endianness === NBT::LITTLE_ENDIAN ? "V*" : "N*", $nbt->get($size * 4)));
    }


    public function write(NBT $nbt)
    {
        $nbt->putInt(count($this->value));
        $nbt->put(pack($nbt->endianness === NBT::LITTLE_ENDIAN ? "V*" : "N*", ...$this->value));
    }


    public function __toString()
    {
        $str = get_class($this) . "{\n";
        $str .= implode(", ", $this->value);
        return $str . "}";
    }
}