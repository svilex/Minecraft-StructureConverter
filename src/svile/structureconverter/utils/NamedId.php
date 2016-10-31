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

namespace svile\cuboidconverter\utils;

abstract class NamedId
{
    private static $palette = null;
    private static $idPalette = null;


    public final static function init()
    {
        self::initPalette();
        self::initIdPalette();
    }


    private final static function initPalette()
    {
        self::$palette = [];

        //sources:
        //- http://minecraft.gamepedia.com/Data_values/Block_IDs
        //- Parsed json palette (by me) of a structure file (saves/levelFolder/structures/*.nbt) who should contain all the block names/states
        //- My list can be found here: https://gist.github.com/svilex/f0c28f852a90fe12a3c8a8e0211603c9

        self::$palette['air'] = [0];
        self::$palette['stone'] = [
            1,
            'variant' => [
                1,
                'stone'           => 1,
                'granite'         => 1 | 1 << 8,
                'smooth_granite'  => 1 | 2 << 8,
                'diorite'         => 1 | 3 << 8,
                'smooth_diorite'  => 1 | 4 << 8,
                'andesite'        => 1 | 5 << 8,
                'smooth_andesite' => 1 | 6 << 8
            ]
        ];
        self::$palette['grass'] = [
            2,
            'snowy' => [
                2,
                'true'  => 2,
                'false' => 2
            ]
        ];
        self::$palette['dirt'] = [
            3,
            'snowy' => [
                3,
                'true'  => [
                    3,
                    'variant' => [
                        3,
                        'dirt'        => 3,
                        'coarse_dirt' => 3 | 1 << 8,
                        'podzol'      => 3 | 2 << 8
                    ]
                ],
                'false' => [
                    3,
                    'variant' => [
                        3,
                        'dirt'        => 3,
                        'coarse_dirt' => 3 | 1 << 8,
                        'podzol'      => 3 | 2 << 8
                    ]
                ]
            ]
        ];
        self::$palette['cobblestone'] = [4];
        self::$palette['planks'] = [
            5,
            'variant' => [
                5,
                'oak'      => 5,
                'spruce'   => 5 | 1 << 8,
                'birch'    => 5 | 2 << 8,
                'jungle'   => 5 | 3 << 8,
                'acacia'   => 5 | 4 << 8,
                'dark_oak' => 5 | 5 << 8
            ]
        ];
        self::$palette['sapling'] = [
            6,
            'stage' => [
                6,
                '0' => [
                    6,
                    'type' => [
                        6,
                        'oak'      => 6,
                        'spruce'   => 6 | 1 << 8,
                        'birch'    => 6 | 2 << 8,
                        'jungle'   => 6 | 3 << 8,
                        'acacia'   => 6 | 4 << 8,
                        'dark_oak' => 6 | 5 << 8
                    ]
                ],
                '1' => [
                    6 | 8 << 8,
                    'type' => [
                        6 | 8 << 8,
                        'oak'      => 6 | 8 << 8,
                        'spruce'   => 6 | 9 << 8,
                        'birch'    => 6 | 10 << 8,
                        'jungle'   => 6 | 11 << 8,
                        'acacia'   => 6 | 12 << 8,
                        'dark_oak' => 6 | 13 << 8
                    ]
                ]
            ]
        ];
        self::$palette['bedrock'] = [7];
        self::$palette['flowing_water'] = [//not in my list
            8,
            'level' => [
                8,
                '0'  => 8,
                '1'  => 8 | 1 << 8,
                '2'  => 8 | 2 << 8,
                '3'  => 8 | 3 << 8,
                '4'  => 8 | 4 << 8,
                '5'  => 8 | 5 << 8,
                '6'  => 8 | 6 << 8,
                '7'  => 8 | 7 << 8,
                '8'  => 8 | 8 << 8,
                '9'  => 8 | 9 << 8,
                '10' => 8 | 10 << 8,
                '11' => 8 | 11 << 8,
                '12' => 8 | 12 << 8,
                '13' => 8 | 13 << 8,
                '14' => 8 | 14 << 8,
                '15' => 8 | 15 << 8
            ]
        ];
        self::$palette['water'] = [
            9,
            'level' => [
                9,
                '0'  => 9,
                '1'  => 9 | 1 << 8,
                '2'  => 9 | 2 << 8,
                '3'  => 9 | 3 << 8,
                '4'  => 9 | 4 << 8,
                '5'  => 9 | 5 << 8,
                '6'  => 9 | 6 << 8,
                '7'  => 9 | 7 << 8,
                '8'  => 9 | 8 << 8,
                '9'  => 9 | 9 << 8,
                '10' => 9 | 10 << 8,
                '11' => 9 | 11 << 8,
                '12' => 9 | 12 << 8,
                '13' => 9 | 13 << 8,
                '14' => 9 | 14 << 8,
                '15' => 9 | 15 << 8
            ]
        ];
        self::$palette['flowing_lava'] = [//not in my list
            10,
            'level' => [
                10,
                '0'  => 10,
                '1'  => 10 | 1 << 8,
                '2'  => 10 | 2 << 8,
                '3'  => 10 | 3 << 8,
                '4'  => 10 | 4 << 8,
                '5'  => 10 | 5 << 8,
                '6'  => 10 | 6 << 8,
                '7'  => 10 | 7 << 8,
                '8'  => 10 | 8 << 8,
                '9'  => 10 | 9 << 8,
                '10' => 10 | 10 << 8,
                '11' => 10 | 11 << 8,
                '12' => 10 | 12 << 8,
                '13' => 10 | 13 << 8,
                '14' => 10 | 14 << 8,
                '15' => 10 | 15 << 8
            ]
        ];
        self::$palette['lava'] = [
            11,
            'level' => [
                11,
                '0'  => 11,
                '1'  => 11 | 1 << 8,
                '2'  => 11 | 2 << 8,
                '3'  => 11 | 3 << 8,
                '4'  => 11 | 4 << 8,
                '5'  => 11 | 5 << 8,
                '6'  => 11 | 6 << 8,
                '7'  => 11 | 7 << 8,
                '8'  => 11 | 8 << 8,
                '9'  => 11 | 9 << 8,
                '10' => 11 | 10 << 8,
                '11' => 11 | 11 << 8,
                '12' => 11 | 12 << 8,
                '13' => 11 | 13 << 8,
                '14' => 11 | 14 << 8,
                '15' => 11 | 15 << 8
            ]
        ];
        self::$palette['sand'] = [
            12,
            'variant' => [
                12,
                'sand'     => 12,
                'red_sand' => 12 | 1 << 8
            ]
        ];
        self::$palette['gravel'] = [13];
        self::$palette['gold_ore'] = [14];
        self::$palette['iron_ore'] = [15];
        self::$palette['coal_ore'] = [16];
        self::$palette['log'] = [
            17,
            'variant' => [
                17,
                'oak'    => [
                    17,
                    'axis' => [
                        17,
                        'none' => 17 | 12 << 8,//Only bark
                        'x'    => 17 | 4 << 8,//E-W
                        'y'    => 17,//UP-DOWN
                        'z'    => 17 | 8 << 8//N-S
                    ]
                ],
                'spruce' => [
                    17 | 1 << 8,
                    'axis' => [
                        17 | 1 << 8,
                        'none' => 17 | 13 << 8,//Only bark
                        'x'    => 17 | 5 << 8,//E-W
                        'y'    => 17 | 1 << 8,//UP-DOWN
                        'z'    => 17 | 9 << 8//N-S
                    ]
                ],
                'birch'  => [
                    17 | 2 << 8,
                    'axis' => [
                        17 | 2 << 8,
                        'none' => 17 | 14 << 8,//Only bark
                        'x'    => 17 | 6 << 8,//E-W
                        'y'    => 17 | 2 << 8,//UP-DOWN
                        'z'    => 17 | 10 << 8//N-S
                    ]
                ],
                'jungle' => [
                    17 | 3 << 8,
                    'axis' => [
                        17 | 3 << 8,
                        'none' => 17 | 15 << 8,//Only bark
                        'x'    => 17 | 7 << 8,//E-W
                        'y'    => 17 | 3 << 8,//UP-DOWN
                        'z'    => 17 | 11 << 8//N-S
                    ]
                ]
            ]
        ];
        self::$palette['leaves'] = [18];
        self::$palette['sponge'] = [19];
        self::$palette['glass'] = [20];
        self::$palette['lapis_ore'] = [21];
        self::$palette['lapis_block'] = [22];
        self::$palette['dispenser'] = [23];
        self::$palette['sandstone'] = [24];
        self::$palette['noteblock'] = [25];
        self::$palette['bed'] = [26];
        self::$palette['golden_rail'] = [27];
        self::$palette['detector_rail'] = [28];
        self::$palette['sticky_piston'] = [29];
        self::$palette['web'] = [30];
        self::$palette['tallgrass'] = [31];
        self::$palette['deadbush'] = [32];
        self::$palette['piston'] = [33];
        self::$palette['piston_head'] = [34];//not in my list
        self::$palette['wool'] = [
            35,
            'color' => [
                35,
                'white'      => 35,
                'orange'     => 35 | 1 << 8,
                'magenta'    => 35 | 2 << 8,
                'light_blue' => 35 | 3 << 8,
                'yellow'     => 35 | 4 << 8,
                'lime'       => 35 | 5 << 8,
                'pink'       => 35 | 6 << 8,
                'gray'       => 35 | 7 << 8,
                'silver'     => 35 | 8 << 8,
                'cyan'       => 35 | 9 << 8,
                'purple'     => 35 | 10 << 8,
                'blue'       => 35 | 11 << 8,
                'brown'      => 35 | 12 << 8,
                'green'      => 35 | 13 << 8,
                'red'        => 35 | 14 << 8,
                'black'      => 35 | 15 << 8,
            ]
        ];
        self::$palette['piston_extension'] = [36];//not in my list
        self::$palette['yellow_flower'] = [37];
        self::$palette['red_flower'] = [38];
        self::$palette['brown_mushroom'] = [39];
        self::$palette['red_mushroom'] = [40];
        self::$palette['gold_block'] = [41];
        self::$palette['iron_block'] = [42];
        self::$palette['double_stone_slab'] = [43];
        self::$palette['stone_slab'] = [44];
        self::$palette['brick_block'] = [45];
        self::$palette['tnt'] = [46];
        self::$palette['bookshelf'] = [47];
        self::$palette['mossy_cobblestone'] = [48];
        self::$palette['obsidian'] = [49];
        self::$palette['torch'] = [50];
        self::$palette['fire'] = [51];
        self::$palette['mob_spawner'] = [52];//not in my list
        self::$palette['oak_stairs'] = [53];
        self::$palette['chest'] = [54];
        self::$palette['redstone_wire'] = [55];
        self::$palette['diamond_ore'] = [56];
        self::$palette['diamond_block'] = [57];
        self::$palette['crafting_table'] = [58];
        self::$palette['wheat'] = [59];
        self::$palette['farmland'] = [60];
        self::$palette['furnace'] = [61];
        self::$palette['lit_furnace'] = [62];//not in my list
        self::$palette['standing_sign'] = [63];
        self::$palette['wooden_door'] = [64];
        self::$palette['ladder'] = [65];
        self::$palette['rail'] = [66];
        self::$palette['stone_stairs'] = [67];
        self::$palette['wall_sign'] = [68];
        self::$palette['lever'] = [69];
        self::$palette['stone_pressure_plate'] = [70];
        self::$palette['iron_door'] = [71];
        self::$palette['wooden_pressure_plate'] = [72];
        self::$palette['redstone_ore'] = [73];
        self::$palette['lit_redstone_ore'] = [74];//not in my list
        self::$palette['unlit_redstone_torch'] = [75];
        self::$palette['redstone_torch'] = [76];
        self::$palette['stone_button'] = [77];
        self::$palette['snow_layer'] = [78];
        self::$palette['ice'] = [79];
        self::$palette['snow'] = [80];
        self::$palette['cactus'] = [81];
        self::$palette['clay'] = [82];
        self::$palette['reeds'] = [83];
        self::$palette['jukebox'] = [84];
        self::$palette['fence'] = [85];
        self::$palette['pumpkin'] = [86];
        self::$palette['netherrack'] = [87];
        self::$palette['soul_sand'] = [88];
        self::$palette['glowstone'] = [89];
        self::$palette['portal'] = [90];//not in my list
        self::$palette['lit_pumpkin'] = [91];
        self::$palette['cake'] = [92];
        self::$palette['unpowered_repeater'] = [93];
        self::$palette['powered_repeater'] = [94];//not in my list
        self::$palette['stained_glass'] = [95];
        self::$palette['trapdoor'] = [96];
        self::$palette['monster_egg'] = [97];
        self::$palette['stonebrick'] = [98];
        self::$palette['brown_mushroom_block'] = [99];
        self::$palette['red_mushroom_block'] = [100];
        self::$palette['iron_bars'] = [101];
        self::$palette['glass_pane'] = [102];
        self::$palette['melon_block'] = [103];
        self::$palette['pumpkin_stem'] = [104];
        self::$palette['melon_stem'] = [105];
        self::$palette['vine'] = [106];
        self::$palette['fence_gate'] = [107];
        self::$palette['brick_stairs'] = [108];
        self::$palette['stone_brick_stairs'] = [109];
        self::$palette['mycelium'] = [110];
        self::$palette['waterlily'] = [111];
        self::$palette['nether_brick'] = [112];
        self::$palette['nether_brick_fence'] = [113];
        self::$palette['nether_brick_stairs'] = [114];
        self::$palette['nether_wart'] = [115];
        self::$palette['enchanting_table'] = [116];
        self::$palette['brewing_stand'] = [117];
        self::$palette['cauldron'] = [118];
        self::$palette['end_portal'] = [119];//not in my list
        self::$palette['end_portal_frame'] = [120];
        self::$palette['end_stone'] = [121];
        self::$palette['dragon_egg'] = [122];//not in my list
        self::$palette['redstone_lamp'] = [123];
        self::$palette['lit_redstone_lamp'] = [124];
        self::$palette['double_wooden_slab'] = [125];
        self::$palette['wooden_slab'] = [126];
        self::$palette['cocoa'] = [127];
        self::$palette['sandstone_stairs'] = [128];
        self::$palette['emerald_ore'] = [129];
        self::$palette['ender_chest'] = [130];
        self::$palette['tripwire_hook'] = [131];
        self::$palette['tripwire'] = [132];//not in my list
        self::$palette['emerald_block'] = [133];
        self::$palette['spruce_stairs'] = [134];
        self::$palette['birch_stairs'] = [135];
        self::$palette['jungle_stairs'] = [136];
        self::$palette['command_block'] = [137];
        self::$palette['beacon'] = [138];
        self::$palette['cobblestone_wall'] = [139];
        self::$palette['flower_pot'] = [140];
        self::$palette['carrots'] = [141];
        self::$palette['potatoes'] = [142];
        self::$palette['wooden_button'] = [143];
        self::$palette['skull'] = [144];
        self::$palette['anvil'] = [145];
        self::$palette['trapped_chest'] = [146];
        self::$palette['light_weighted_pressure_plate'] = [147];
        self::$palette['heavy_weighted_pressure_plate'] = [148];
        self::$palette['unpowered_comparator'] = [149];
        self::$palette['powered_comparator'] = [150];//not in my list
        self::$palette['daylight_detector'] = [151];
        self::$palette['redstone_block'] = [152];
        self::$palette['quartz_ore'] = [153];
        self::$palette['hopper'] = [154];
        self::$palette['quartz_block'] = [155];
        self::$palette['quartz_stairs'] = [156];
        self::$palette['activator_rail'] = [157];
        self::$palette['dropper'] = [158];
        self::$palette['stained_hardened_clay'] = [159];
        self::$palette['stained_glass_pane'] = [160];
        self::$palette['leaves2'] = [161];
        self::$palette['log2'] = [162];
        self::$palette['acacia_stairs'] = [163];
        self::$palette['dark_oak_stairs'] = [164];
        self::$palette['slime'] = [165];
        self::$palette['barrier'] = [166];
        self::$palette['iron_trapdoor'] = [167];
        self::$palette['prismarine'] = [168];
        self::$palette['sea_lantern'] = [169];
        self::$palette['hay_block'] = [170];
        self::$palette['carpet'] = [171];
        self::$palette['hardened_clay'] = [172];
        self::$palette['coal_block'] = [173];
        self::$palette['packed_ice'] = [174];
        self::$palette['double_plant'] = [175];
        self::$palette['standing_banner'] = [176];
        self::$palette['wall_banner'] = [177];
        self::$palette['daylight_detector_inverted'] = [178];
        self::$palette['red_sandstone'] = [179];
        self::$palette['red_sandstone_stairs'] = [180];
        self::$palette['double_stone_slab2'] = [181];
        self::$palette['stone_slab2'] = [182];
        self::$palette['spruce_fence_gate'] = [183];
        self::$palette['birch_fence_gate'] = [184];
        self::$palette['jungle_fence_gate'] = [185];
        self::$palette['dark_oak_fence_gate'] = [186];
        self::$palette['acacia_fence_gate'] = [187];
        self::$palette['spruce_fence'] = [188];
        self::$palette['birch_fence'] = [189];
        self::$palette['jungle_fence'] = [190];
        self::$palette['dark_oak_fence'] = [191];
        self::$palette['acacia_fence'] = [192];
        self::$palette['spruce_door'] = [193];
        self::$palette['birch_door'] = [194];
        self::$palette['jungle_door'] = [195];
        self::$palette['acacia_door'] = [196];
        self::$palette['dark_oak_door'] = [197];
        self::$palette['end_rod'] = [198];
        self::$palette['chorus_plant'] = [199];
        self::$palette['chorus_flower'] = [200];
        self::$palette['purpur_block'] = [201];
        self::$palette['purpur_pillar'] = [202];
        self::$palette['purpur_stairs'] = [203];
        self::$palette['purpur_double_slab'] = [204];
        self::$palette['purpur_slab'] = [205];
        self::$palette['end_bricks'] = [206];
        self::$palette['beetroots'] = [207];
        self::$palette['grass_path'] = [208];
        self::$palette['end_gateway'] = [209];//not in my list
        self::$palette['repeating_command_block'] = [210];//not in my list
        self::$palette['chain_command_block'] = [211];//not in my list
        self::$palette['frosted_ice'] = [212];//not in my list
        self::$palette['magma'] = [213];
        self::$palette['nether_wart_block'] = [214];
        self::$palette['red_nether_brick'] = [215];//not in my list
        self::$palette['bone_block'] = [216];
        self::$palette['structure_void'] = [217];//not in my list
        self::$palette['observer'] = [218];//not in my list
        self::$palette['white_shulker_box'] = [219];//not in my list
        self::$palette['orange_shulker_box'] = [220];//not in my list
        self::$palette['magenta_shulker_box'] = [221];//not in my list
        self::$palette['light_blue_shulker_box'] = [222];//not in my list
        self::$palette['yellow_shulker_box'] = [223];//not in my list
        self::$palette['lime_shulker_box'] = [224];//not in my list
        self::$palette['pink_shulker_box'] = [225];//not in my list
        self::$palette['gray_shulker_box'] = [226];//not in my list
        self::$palette['light_gray_shulker_box'] = [227];//not in my list
        self::$palette['cyan_shulker_box'] = [228];//not in my list
        self::$palette['purple_shulker_box'] = [229];//not in my list
        self::$palette['blue_shulker_box'] = [230];//not in my list
        self::$palette['brown_shulker_box'] = [231];//not in my list
        self::$palette['green_shulker_box'] = [232];//not in my list
        self::$palette['red_shulker_box'] = [233];//not in my list
        self::$palette['black_shulker_box'] = [234];//not in my list
        self::$palette['structure_block'] = [255];//not in my list
    }


    private final static function initIdPalette()
    {
        self::$idPalette = new \SplFixedArray(256);

        self::$idPalette[0] = ['air'];
        //self::$idPalette[1] = [];
    }


    /**
     * @param string $name
     * @param array $prop
     * @param $idmeta
     * @return bool
     */
    public final static function getNum(string $name, array $prop, &$idmeta)
    {
        if (self::$palette === null)
            self::initPalette();

        $name = str_replace('minecraft:', '', strtolower($name));

        if (!array_key_exists($name, self::$palette)) {
            $idmeta = 0;
            return false;
        }

        $arr = self::$palette[$name];

        $idmeta = $arr[0];

        //MESS starts here, now it's your problem :)
        if (count($prop) > 0 && count($arr) > 1) {
            $test = false;
            while (is_array($arr) || !is_numeric($arr)) {
                foreach (array_keys($arr) as $key) {
                    $test = false;
                    if (is_numeric($key))
                        continue;
                    if (array_key_exists($key, $prop)) {
                        $arr = $arr[$key];
                        if (array_key_exists($prop[$key], $arr)) {
                            $arr = $arr[$prop[$key]];
                            $test = true;
                        }
                        break;
                    }
                }
                if ($test == false) {
                    $idmeta = $arr[0];
                    return false;
                    break;
                }
            }
            $idmeta = $arr;
            return true;
        } else {
            return true;
        }
    }


    /**
     * @param int $id
     * @param int $meta
     * @param $name
     * @param $prop
     * @return bool
     */
    public final static function get(int $id, int $meta, &$name, &$prop)
    {
        if (self::$idPalette === null)
            self::initIdPalette();

        return false;
    }
}