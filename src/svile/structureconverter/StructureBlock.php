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

namespace svile\structureconverter;


use svile\structureconverter\utils\console\Console;

use svile\structureconverter\utils\NamedId;

use svile\structureconverter\utils\nbt\NBT;
use svile\structureconverter\utils\nbt\tag\CompoundTag;
use svile\structureconverter\utils\nbt\tag\ListTag;
use svile\structureconverter\utils\nbt\tag\NamedTag;
use svile\structureconverter\utils\nbt\tag\IntTag;
use svile\structureconverter\utils\nbt\tag\ShortTag;
use svile\structureconverter\utils\nbt\tag\StringTag;
use svile\structureconverter\utils\nbt\tag\ByteArrayTag;


abstract class StructureBlock
{
    public final static function toSchematic(string $structurePath) : bool
    {
        $structurePath = realpath($structurePath);
        if (!is_file($structurePath)) {
            Console::error('§cCouldn\'t find the *.nbt file');
            return false;
        } elseif (substr($structurePath, -4) != '.nbt') {
            Console::error('§cThe file must be an *.nbt');
            return false;
        }

        $nbt = new NBT(NBT::BIG_ENDIAN);
        $nbt->readCompressed(file_get_contents($structurePath));
        $nbt = $nbt->getData();

        if (!(isset($nbt->author, $nbt->blocks, $nbt->entities, $nbt->palette, $nbt->size, $nbt->version) &&
            $nbt->author instanceof StringTag && $nbt->blocks instanceof ListTag && $nbt->entities instanceof ListTag &&
            $nbt->palette instanceof ListTag && $nbt->size instanceof ListTag && $nbt->version instanceof IntTag)
        ) {
            Console::error('§cUnsupported structure');
            return false;
        }

        if ($nbt['version'] != 1) {
            Console::error('§cUnsupported structure version: §f' . $nbt['version']);
            return false;
        }

        $w = (int)$nbt['size'][0];
        $h = (int)$nbt['size'][1];
        $l = (int)$nbt['size'][2];
        $whl = $w * $h * $l;

        if ($whl < 1) {
            Console::error('§cSize = 0');
            return false;
        }

        Console::log(PHP_EOL . '§l§bAuthor: §r§f' . $nbt['author'] . PHP_EOL . '§l§bSize: §r§f W:' . $w . ' H:' . $h . ' L:' . $l . PHP_EOL);

        Console::info('Loading "palette" ...');
        $palette = self::parsePalette($nbt['palette']);

        Console::info('Creating schematic ...');
        $blocks = str_repeat("\x00", $whl);
        $data = str_repeat("\x00", $whl);

        foreach ($nbt->blocks as $block) {
            $x = (int)$block['pos'][0];
            $y = (int)$block['pos'][1];
            $z = (int)$block['pos'][2];
            $i = $w * $l * $y + $w * $z + $x;
            if ($i >= $whl) {
                Console::error('§cBlock outside the cuboid, skipping');
                //Should not happen if the StructureBlock's file wasn't modified using an nbt explorer, changing block coords
                continue;
            }
            $state = (int)$block['state'];
            $id = $palette[$state] & 0xff;
            $meta = $palette[$state] >> 8;
            $blocks{$i} = chr($id);
            $data{$i} = chr($meta);
        }

        $nbt = new NBT(NBT::BIG_ENDIAN);
        $nbt->setData(new CompoundTag
        ('Schematic', [
            new ByteArrayTag('Biomes', str_repeat("\x01", $w * $l)),
            new ByteArrayTag('Blocks', $blocks),
            new ByteArrayTag('Data', $data),
            (new ListTag('Entities', []))->setTagType(NBT::TAG_Byte),
            new ShortTag('Height', $h),
            new ShortTag('Length', $l),
            new StringTag('Materials', 'Alpha'),
            (new ListTag('TileEntities', []))->setTagType(NBT::TAG_Byte),
            (new ListTag('TileTicks', []))->setTagType(NBT::TAG_Byte),
            new ShortTag('Width', $w)
        ]));
        $schpath = dirname($structurePath) . '/' . pathinfo($structurePath, PATHINFO_FILENAME) . '.schematic';
        if (file_put_contents($schpath, $nbt->writeCompressed())) {
            Console::info('Done, file saved at: §a' . $schpath);
            return true;
        } else {
            Console::error('§cCould not save the file at: §f' . $schpath);
            return false;
        }
    }


    private static final function parsePalette(ListTag $palette) : \SplFixedArray
    {
        $cnt = count($palette);
        $tmp = array_fill(0, $cnt, 0);
        foreach ($palette as $i => $cpt) {
            if ($cpt instanceof CompoundTag && is_numeric($i) && is_int(($i += 0)) && $i < $cnt) {
                NamedId::getNum($cpt['Name'], array_key_exists('Properties', $cpt) ? self::parseProp($cpt['Properties']) : [], $idmeta);
                $tmp[$i] = $idmeta;
            } else {
                Console::error('§cCorrupted palette');
            }
        }
        return \SplFixedArray::fromArray($tmp);
    }


    private static final function parseProp(CompoundTag $prop) : array
    {
        $tmp = [];
        foreach ($prop as $p) {
            if ($p instanceof NamedTag && !($p instanceof \ArrayAccess))
                $tmp[$p->getName()] = $p->getValue();
            else
                Console::error('§cWrong state: §f' . print_r($p, true));
        }
        return $tmp;
    }


    public final static function fromSchematic(string $schematicPath)
    {
    }
}