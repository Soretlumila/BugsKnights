document.addEventListener("DOMContentLoaded", () => {
    const gameSelect = document.querySelector('select[name="Cards[game]"]');
    const areaSelect = document.querySelector('select[name="Cards[areas]"]');

    if (!gameSelect || !areaSelect) {
        return;
    }

    const areasByGame = {
        hollow_knight: [
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
        silksong: [
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

    function updateAreas() {
        const game = gameSelect.value;

        areaSelect.innerHTML = "";

        if (!areasByGame[game]) {
            return;
        }

        areasByGame[game].forEach((area) => {
            const option = document.createElement("option");
            option.value = area;
            option.textContent = area;
            areaSelect.appendChild(option);
        });
    }

    gameSelect.addEventListener("change", updateAreas);

    // Initialisation (édition)
    updateAreas();
});
