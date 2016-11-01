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
        self::$palette['torch'] = [
            50 | 5 << 8,
            'facing' => [
                50 | 5 << 8,
                'east'  => 50 | 1 << 8,
                'west'  => 50 | 2 << 8,
                'south' => 50 | 3 << 8,
                'north' => 50 | 4 << 8,
                'up'    => 50 | 5 << 8
            ]
        ];
        self::$palette['fire'] = [51];
        self::$palette['mob_spawner'] = [52];//not in my list
        self::$palette['oak_stairs'] = [
            53,
            'half' => [
                53,
                'top'    => [
                    53 | 4 << 8,
                    'facing' => [
                        53 | 4 << 8,
                        'east'  => 53 | 4 << 8,
                        'west'  => 53 | 5 << 8,
                        'south' => 53 | 6 << 8,
                        'north' => 53 | 7 << 8
                    ]
                ],
                'bottom' => [
                    53,
                    'facing' => [
                        53,
                        'east'  => 53,
                        'west'  => 53 | 1 << 8,
                        'south' => 53 | 2 << 8,
                        'north' => 53 | 3 << 8
                    ]
                ]
            ]
        ];
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
        self::$palette['ladder'] = [
            65 | 2 << 8,
            'facing' => [
                'north' => 65 | 2 << 8,
                'south' => 65 | 3 << 8,
                'west'  => 65 | 4 << 8,
                'east'  => 65 | 5 << 8
            ]
        ];
        self::$palette['rail'] = [66];
        self::$palette['stone_stairs'] = [
            67,
            'half' => [
                67,
                'top'    => [
                    67 | 4 << 8,
                    'facing' => [
                        67 | 4 << 8,
                        'east'  => 67 | 4 << 8,
                        'west'  => 67 | 5 << 8,
                        'south' => 67 | 6 << 8,
                        'north' => 67 | 7 << 8
                    ]
                ],
                'bottom' => [
                    67,
                    'facing' => [
                        67,
                        'east'  => 67,
                        'west'  => 67 | 1 << 8,
                        'south' => 67 | 2 << 8,
                        'north' => 67 | 3 << 8
                    ]
                ]
            ]
        ];
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
        self::$palette['pumpkin'] = [
            86,
            'facing' => [
                86,
                'south' => 86,
                'west'  => 86 | 1 << 8,
                'north' => 86 | 2 << 8,
                'east'  => 86 | 3 << 8,
            ]
        ];
        self::$palette['netherrack'] = [87];
        self::$palette['soul_sand'] = [88];
        self::$palette['glowstone'] = [89];
        self::$palette['portal'] = [90];//not in my list
        self::$palette['lit_pumpkin'] = [
            91,
            'facing' => [
                91,
                'south' => 91,
                'west'  => 91 | 1 << 8,
                'north' => 91 | 2 << 8,
                'east'  => 91 | 3 << 8,
            ]
        ];
        self::$palette['cake'] = [92];
        self::$palette['unpowered_repeater'] = [93];
        self::$palette['powered_repeater'] = [94];//not in my list
        self::$palette['stained_glass'] = [
            95,
            'color' => [
                95,
                'white'      => 95,
                'orange'     => 95 | 1 << 8,
                'magenta'    => 95 | 2 << 8,
                'light_blue' => 95 | 3 << 8,
                'yellow'     => 95 | 4 << 8,
                'lime'       => 95 | 5 << 8,
                'pink'       => 95 | 6 << 8,
                'gray'       => 95 | 7 << 8,
                'silver'     => 95 | 8 << 8,
                'cyan'       => 95 | 9 << 8,
                'purple'     => 95 | 10 << 8,
                'blue'       => 95 | 11 << 8,
                'brown'      => 95 | 12 << 8,
                'green'      => 95 | 13 << 8,
                'red'        => 95 | 14 << 8,
                'black'      => 95 | 15 << 8,
            ]
        ];
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
        self::$palette['vine'] = [
            106 | 2 << 8,
            'facing' => [
                'south' => 106 | 1 << 8,
                'west'  => 106 | 2 << 8,
                'north' => 106 | 4 << 8,
                'east'  => 106 | 8 << 8
            ]
        ];
        self::$palette['fence_gate'] = [107];
        self::$palette['brick_stairs'] = [
            108,
            'half' => [
                108,
                'top'    => [
                    108 | 4 << 8,
                    'facing' => [
                        108 | 4 << 8,
                        'east'  => 108 | 4 << 8,
                        'west'  => 108 | 5 << 8,
                        'south' => 108 | 6 << 8,
                        'north' => 108 | 7 << 8
                    ]
                ],
                'bottom' => [
                    108,
                    'facing' => [
                        108,
                        'east'  => 108,
                        'west'  => 108 | 1 << 8,
                        'south' => 108 | 2 << 8,
                        'north' => 108 | 3 << 8
                    ]
                ]
            ]
        ];
        self::$palette['stone_brick_stairs'] = [
            109,
            'half' => [
                109,
                'top'    => [
                    109 | 4 << 8,
                    'facing' => [
                        109 | 4 << 8,
                        'east'  => 109 | 4 << 8,
                        'west'  => 109 | 5 << 8,
                        'south' => 109 | 6 << 8,
                        'north' => 109 | 7 << 8
                    ]
                ],
                'bottom' => [
                    109,
                    'facing' => [
                        109,
                        'east'  => 109,
                        'west'  => 109 | 1 << 8,
                        'south' => 109 | 2 << 8,
                        'north' => 109 | 3 << 8
                    ]
                ]
            ]
        ];
        self::$palette['mycelium'] = [110];
        self::$palette['waterlily'] = [111];
        self::$palette['nether_brick'] = [112];
        self::$palette['nether_brick_fence'] = [113];
        self::$palette['nether_brick_stairs'] = [
            114,
            'half' => [
                114,
                'top'    => [
                    114 | 4 << 8,
                    'facing' => [
                        114 | 4 << 8,
                        'east'  => 114 | 4 << 8,
                        'west'  => 114 | 5 << 8,
                        'south' => 114 | 6 << 8,
                        'north' => 114 | 7 << 8
                    ]
                ],
                'bottom' => [
                    114,
                    'facing' => [
                        114,
                        'east'  => 114,
                        'west'  => 114 | 1 << 8,
                        'south' => 114 | 2 << 8,
                        'north' => 114 | 3 << 8
                    ]
                ]
            ]
        ];
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
        self::$palette['sandstone_stairs'] = [
            128,
            'half' => [
                128,
                'top'    => [
                    128 | 4 << 8,
                    'facing' => [
                        128 | 4 << 8,
                        'east'  => 128 | 4 << 8,
                        'west'  => 128 | 5 << 8,
                        'south' => 128 | 6 << 8,
                        'north' => 128 | 7 << 8
                    ]
                ],
                'bottom' => [
                    128,
                    'facing' => [
                        128,
                        'east'  => 128,
                        'west'  => 128 | 1 << 8,
                        'south' => 128 | 2 << 8,
                        'north' => 128 | 3 << 8
                    ]
                ]
            ]
        ];
        self::$palette['emerald_ore'] = [129];
        self::$palette['ender_chest'] = [130];
        self::$palette['tripwire_hook'] = [131];
        self::$palette['tripwire'] = [132];//not in my list
        self::$palette['emerald_block'] = [133];
        self::$palette['spruce_stairs'] = [
            134,
            'half' => [
                134,
                'top'    => [
                    134 | 4 << 8,
                    'facing' => [
                        134 | 4 << 8,
                        'east'  => 134 | 4 << 8,
                        'west'  => 134 | 5 << 8,
                        'south' => 134 | 6 << 8,
                        'north' => 134 | 7 << 8
                    ]
                ],
                'bottom' => [
                    134,
                    'facing' => [
                        134,
                        'east'  => 134,
                        'west'  => 134 | 1 << 8,
                        'south' => 134 | 2 << 8,
                        'north' => 134 | 3 << 8
                    ]
                ]
            ]
        ];
        self::$palette['birch_stairs'] = [
            135,
            'half' => [
                135,
                'top'    => [
                    135 | 4 << 8,
                    'facing' => [
                        135 | 4 << 8,
                        'east'  => 135 | 4 << 8,
                        'west'  => 135 | 5 << 8,
                        'south' => 135 | 6 << 8,
                        'north' => 135 | 7 << 8
                    ]
                ],
                'bottom' => [
                    135,
                    'facing' => [
                        135,
                        'east'  => 135,
                        'west'  => 135 | 1 << 8,
                        'south' => 135 | 2 << 8,
                        'north' => 135 | 3 << 8
                    ]
                ]
            ]
        ];
        self::$palette['jungle_stairs'] = [
            136,
            'half' => [
                136,
                'top'    => [
                    136 | 4 << 8,
                    'facing' => [
                        136 | 4 << 8,
                        'east'  => 136 | 4 << 8,
                        'west'  => 136 | 5 << 8,
                        'south' => 136 | 6 << 8,
                        'north' => 136 | 7 << 8
                    ]
                ],
                'bottom' => [
                    136,
                    'facing' => [
                        136,
                        'east'  => 136,
                        'west'  => 136 | 1 << 8,
                        'south' => 136 | 2 << 8,
                        'north' => 136 | 3 << 8
                    ]
                ]
            ]
        ];
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
        self::$palette['quartz_stairs'] = [
            156,
            'half' => [
                156,
                'top'    => [
                    156 | 4 << 8,
                    'facing' => [
                        156 | 4 << 8,
                        'east'  => 156 | 4 << 8,
                        'west'  => 156 | 5 << 8,
                        'south' => 156 | 6 << 8,
                        'north' => 156 | 7 << 8
                    ]
                ],
                'bottom' => [
                    156,
                    'facing' => [
                        156,
                        'east'  => 156,
                        'west'  => 156 | 1 << 8,
                        'south' => 156 | 2 << 8,
                        'north' => 156 | 3 << 8
                    ]
                ]
            ]
        ];
        self::$palette['activator_rail'] = [157];
        self::$palette['dropper'] = [158];
        self::$palette['stained_hardened_clay'] = [
            159,
            'color' => [
                159,
                'white'      => 159,
                'orange'     => 159 | 1 << 8,
                'magenta'    => 159 | 2 << 8,
                'light_blue' => 159 | 3 << 8,
                'yellow'     => 159 | 4 << 8,
                'lime'       => 159 | 5 << 8,
                'pink'       => 159 | 6 << 8,
                'gray'       => 159 | 7 << 8,
                'silver'     => 159 | 8 << 8,
                'cyan'       => 159 | 9 << 8,
                'purple'     => 159 | 10 << 8,
                'blue'       => 159 | 11 << 8,
                'brown'      => 159 | 12 << 8,
                'green'      => 159 | 13 << 8,
                'red'        => 159 | 14 << 8,
                'black'      => 159 | 15 << 8,
            ]
        ];
        self::$palette['stained_glass_pane'] = [
            160,
            'color' => [
                160,
                'white'      => 160,
                'orange'     => 160 | 1 << 8,
                'magenta'    => 160 | 2 << 8,
                'light_blue' => 160 | 3 << 8,
                'yellow'     => 160 | 4 << 8,
                'lime'       => 160 | 5 << 8,
                'pink'       => 160 | 6 << 8,
                'gray'       => 160 | 7 << 8,
                'silver'     => 160 | 8 << 8,
                'cyan'       => 160 | 9 << 8,
                'purple'     => 160 | 10 << 8,
                'blue'       => 160 | 11 << 8,
                'brown'      => 160 | 12 << 8,
                'green'      => 160 | 13 << 8,
                'red'        => 160 | 14 << 8,
                'black'      => 160 | 15 << 8,
            ]
        ];
        self::$palette['leaves2'] = [161];
        self::$palette['log2'] = [162];
        self::$palette['acacia_stairs'] = [
            163,
            'half' => [
                163,
                'top'    => [
                    163 | 4 << 8,
                    'facing' => [
                        163 | 4 << 8,
                        'east'  => 163 | 4 << 8,
                        'west'  => 163 | 5 << 8,
                        'south' => 163 | 6 << 8,
                        'north' => 163 | 7 << 8
                    ]
                ],
                'bottom' => [
                    163,
                    'facing' => [
                        163,
                        'east'  => 163,
                        'west'  => 163 | 1 << 8,
                        'south' => 163 | 2 << 8,
                        'north' => 163 | 3 << 8
                    ]
                ]
            ]
        ];
        self::$palette['dark_oak_stairs'] = [
            164,
            'half' => [
                164,
                'top'    => [
                    164 | 4 << 8,
                    'facing' => [
                        164 | 4 << 8,
                        'east'  => 164 | 4 << 8,
                        'west'  => 164 | 5 << 8,
                        'south' => 164 | 6 << 8,
                        'north' => 164 | 7 << 8
                    ]
                ],
                'bottom' => [
                    164,
                    'facing' => [
                        164,
                        'east'  => 164,
                        'west'  => 164 | 1 << 8,
                        'south' => 164 | 2 << 8,
                        'north' => 164 | 3 << 8
                    ]
                ]
            ]
        ];
        self::$palette['slime'] = [165];
        self::$palette['barrier'] = [166];
        self::$palette['iron_trapdoor'] = [167];
        self::$palette['prismarine'] = [168];
        self::$palette['sea_lantern'] = [169];
        self::$palette['hay_block'] = [170];
        self::$palette['carpet'] = [
            171,
            'color' => [
                171,
                'white'      => 171,
                'orange'     => 171 | 1 << 8,
                'magenta'    => 171 | 2 << 8,
                'light_blue' => 171 | 3 << 8,
                'yellow'     => 171 | 4 << 8,
                'lime'       => 171 | 5 << 8,
                'pink'       => 171 | 6 << 8,
                'gray'       => 171 | 7 << 8,
                'silver'     => 171 | 8 << 8,
                'cyan'       => 171 | 9 << 8,
                'purple'     => 171 | 10 << 8,
                'blue'       => 171 | 11 << 8,
                'brown'      => 171 | 12 << 8,
                'green'      => 171 | 13 << 8,
                'red'        => 171 | 14 << 8,
                'black'      => 171 | 15 << 8,
            ]
        ];
        self::$palette['hardened_clay'] = [172];
        self::$palette['coal_block'] = [173];
        self::$palette['packed_ice'] = [174];
        self::$palette['double_plant'] = [175];
        self::$palette['standing_banner'] = [176];
        self::$palette['wall_banner'] = [177];
        self::$palette['daylight_detector_inverted'] = [178];
        self::$palette['red_sandstone'] = [179];
        self::$palette['red_sandstone_stairs'] = [
            180,
            'half' => [
                180,
                'top'    => [
                    180 | 4 << 8,
                    'facing' => [
                        180 | 4 << 8,
                        'east'  => 180 | 4 << 8,
                        'west'  => 180 | 5 << 8,
                        'south' => 180 | 6 << 8,
                        'north' => 180 | 7 << 8
                    ]
                ],
                'bottom' => [
                    180,
                    'facing' => [
                        180,
                        'east'  => 180,
                        'west'  => 180 | 1 << 8,
                        'south' => 180 | 2 << 8,
                        'north' => 180 | 3 << 8
                    ]
                ]
            ]
        ];
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
        self::$palette['purpur_stairs'] = [
            203,
            'half' => [
                203,
                'top'    => [
                    203 | 4 << 8,
                    'facing' => [
                        203 | 4 << 8,
                        'east'  => 203 | 4 << 8,
                        'west'  => 203 | 5 << 8,
                        'south' => 203 | 6 << 8,
                        'north' => 203 | 7 << 8
                    ]
                ],
                'bottom' => [
                    203,
                    'facing' => [
                        203,
                        'east'  => 203,
                        'west'  => 203 | 1 << 8,
                        'south' => 203 | 2 << 8,
                        'north' => 203 | 3 << 8
                    ]
                ]
            ]
        ];
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