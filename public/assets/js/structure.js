document.addEventListener('DOMContentLoaded', () => {
    const game = document.querySelector('select[name*="game"]');
    const area = document.querySelector('select[name*="areas"]');

    const sets = {
        'Hollow Knight': [
        
            { label: 'Howling Cliffs', value: 'Howling Cliffs' },
            { label: 'Dirtmouth', value: 'Dirtmouth' },
            { label: 'Forgotten Crossroad', value: 'Forgotten Crossroad' },
            { label: 'Greenpath', value: 'Greenpath' },
            { label: 'Fungal Wastes', value: 'Fungal Wastes' },
            { label: 'City of Tears', value: 'City of Tears' },
            { label: 'Soul Sanctum', value: 'Soul Sanctum' },
            { label: 'Pleasure Home', value: 'Pleasure Home' },
            { label: 'Watcher\'s Spire', value: 'Watcher\'s Spire' },
            { label: 'Cristal Peak', value: 'Cristal Peak' },
            { label: 'Royal Waterways', value: 'Royal Waterways' },
            { label: 'Kingdom\'s Edge', value: 'Kingdom\'s Edge' },
            { label: 'Colosseum of Fool', value: 'Colosseum of Fool' },
            { label: 'Resting Grounds', value: 'Resting Grounds' },
            { label: 'Fog Canyon', value: 'Fog Canyon' },
            { label: 'Queen\'s Gardens', value: 'Queen\'s Gardens' },
            { label: 'Deepnest', value: 'Deepnest' },
            { label: 'The Hive', value: 'The Hive' },
            { label: 'Ancient Bassin', value: 'Ancient Bassin' },
            { label: 'Palace Ground\'s', value: 'Palace Ground\'s' },
            { label: 'The Abyss', value: 'The Abyss' },
        ],
        'SilkSong': [
            { label: 'Moss Grotto ', value: 'Moss Grotto ' },
            { label: 'The Marrow', value: 'The Marrow' },
            { label: 'Hunter\'s March', value: 'Hunter\'s March' },
            { label: 'Deep Dock\'s', value: 'Deep Dock\'s' },
            { label: 'Far Fields', value: 'Far Fields' },
            { label: 'Greymoor', value: 'Greymoor' },
            { label: 'Wisp Thicket', value: 'Wisp Thicket' },
            { label: 'Verdiana', value: 'Verdiana' },
            { label: 'Bellhart', value: 'Bellhart' },
            { label: 'Shellwood', value: 'Shellwood' },
            { label: 'Wormways', value: 'Wormways' },
            { label: 'Blasted Steps', value: 'Blasted Steps' },
            { label: 'Sand of Karak', value: 'Sand of Karak' },
            { label: 'Sinner\'s Road', value: 'Sinner\'s Road' },
            { label: 'Bilewater', value: 'Bilewater' },
            { label: 'Putrified Ducts', value: 'Putrified Ducts' },
            { label: 'Grand Gate', value: 'Grand Gate' },
            { label: 'Underworks', value: 'Underworks' },
            { label: 'Citadel-Choral Chambers', value: 'Citadel-Choral Chambers' },
            { label: 'Citadel-Whiteward', value: 'Citadel-Whiteward' },
            { label: 'Citadel-Cogwork Core', value: 'Citadel-Cogwork Core' },
            { label: 'Citadel-Whispering Vaults', value: 'Citadel-Whispering Vaults' },
            { label: 'Citadel-High Halls', value: 'Citadel-High Halls' },
            { label: 'Citadel-Memorium', value: 'Citadel-Memorium' },
            { label: 'The Slab', value: 'The Slab' },
            { label: 'Mount Fay', value: 'Mount Fay' },
            { label: 'The Cradle', value: 'The Cradle' },
            { label: 'The Abyss', value: 'The Abyss' },
   
        ]
    };

    function updateAreas() {
        const value = game.value;
        area.innerHTML = '';

        (sets[value] || []).forEach(opt => {
            const o = document.createElement('option');
            o.value = opt.value;
            o.textContent = opt.label;
            area.appendChild(o);
        });
    }

    game.addEventListener('change', updateAreas);

    updateAreas();
});
