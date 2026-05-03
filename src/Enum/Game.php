<?php


namespace App\Enum;

enum Game: string
{
    case HOLLOW_KNIGHT = 'hollow_knight';
    case SILKSONG = 'silksong';

    public function areas(): array
    {
        return match ($this) {
            self::HOLLOW_KNIGHT => [
                "Howling Cliffs",
                "Dirtmouth",
                "Forgotten Crossroad",
                "Fungal Wastes",
                "City of Tears",
                "Soul Sanctum",
                "Pleasure House",
                "Watcher's Spire",
                "Royal Waterways",
                "Cristal Peak",
                "Kingdom's Edge",
                "Colosseum of Fool",
                "Resting Grounds",
                "Fog Canyon",
                "Queen's Gardens",
                "Deepnest",
                "The Hive",
                "Ancient Bassin",
                "Palace Ground's",
                "The Abyss",
            ],
            self::SILKSONG => [
                "Moss Grotto",
                "The Marrow",
                "Hunter's March",
                "Deep Dock's",
                "Far Fields",
                "Greymoor",
                "Wisp Thicket",
                "Verdiana",
                "Bellhart",
                "Shellwood",
                "Wormways",
                "Blasted Steps",
                "Sand of Karak",
                "Sinner's Road",
                "Bilewater",
                "Putrified Ducts",
                "Grand Gate",
                "Underworks",
                "Citadel-Choral Chambers",
                "Citadel-Whiteward",
                "Citadel-Cogwork Core",
                "Citadel-Whispering Vaults",
                "Citadel-High Halls",
                "Citadel-Memorium",
                "The Slab",
                "Mount Fay",
                "The Cradle",
                "The Abyss",
            ],
        };
    }

    public static function choices(): array
    {
        return [
            'Hollow Knight' => self::HOLLOW_KNIGHT->value,
            'Silksong' => self::SILKSONG->value,
        ];
    }
}
