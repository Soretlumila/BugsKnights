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

document.querySelectorAll(".filters button").forEach((button) => {
    button.addEventListener("click", () => {
        const game = button.dataset.game;
        fetch(`/product/filter/${game}`)
            .then((response) => response.json())
            .then((data) => {
                const container = document.querySelector(".cards");
                container.innerHTML = "";
                data.forEach((card) => {
                    const imgSrc = card.picture.startsWith("http") 
                        ? card.picture 
                        : `/assets/img/${card.picture}`;
                    
                    container.innerHTML += `
                        <a href="/product/${card.id}" class="card" data-game="${card.game}">
                            <img src="${imgSrc}" alt="${card.name}">
                            <div class="card-bottom">
                                <div class="card-info">
                                    <span class="card-area">${card.areas}</span>
                                    <span class="card-price">${card.price} €</span>
                                </div>
                                <button class="add-to-cart" 
                                    data-id="${card.id}" 
                                    data-name="${card.name}" 
                                    data-price="${card.price}"
                                    onclick="event.preventDefault(); event.stopPropagation();">
                                    <img style="height: 50px;" src="/assets/imguti/cart.png">
                                </button>
                            </div>
                        </a>
                    `;
                });
            });
    });
});

const div = document.querySelector(".sucess");
const textmess = document.getElementById("mess");

document.addEventListener("click", (e) => {
    if (e.target.classList.contains("add-to-cart")) {
        const button = e.target;

        const id = button.dataset.id;
        const name = button.dataset.name;
        const price = parseFloat(button.dataset.price);

        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        const existing = cart.find((item) => item.id === id);
        if (existing) {
            existing.quantity += 1;
        } else {
            cart.push({ id, name, price, quantity: 1 });
        }

        localStorage.setItem("cart", JSON.stringify(cart));

        // affichage du message
        const div = document.querySelector(".sucess");
        const textmess = document.getElementById("mess");

        div.style.display = "block";
        textmess.textContent =" ajouté au panier !";

        setTimeout(() => {
            div.style.display = "none";
            textmess.textContent = "";
        }, 2000);
    }
});


const bg = document.querySelector(".productcontainer");
let interval = null;

const allImages = [
    "/assets/imguti/hornetcraddle.webp",
    "/assets/imguti/knightlifeblood.jpeg"
];


function setBackground(image) {
    bg.style.setProperty("--next-bg", `url("${image}")`);
    bg.classList.add("fade");
    setTimeout(() => {
        bg.style.background = `url("${image}") center/cover no-repeat fixed`;
        bg.classList.remove("fade");
    }, 1000);
}

function startSlideshow() {
    
    let index = 0;
    if (interval) return;
    interval = setInterval(() => {
        setBackground(allImages[index]);
        index = (index + 1) % allImages.length;
    }, 5000);
}

function stopSlideshow() {
    if (interval) {
        clearInterval(interval);
        interval = null;
    }
}



// 🎯 boutons filtre
document.querySelectorAll(".filters button").forEach(button => {
    button.addEventListener("click", () => {
        const game = button.dataset.game;

        stopSlideshow();

        if (game === "all") {
            startSlideshow();
        } 
        else if (game === "Silksong") {
            setBackground("/assets/imguti/hornetcraddle.webp");
        } 
        else if (game === "Hollow_Knight") {
            setBackground("/assets/imguti/knightlifeblood.jpeg");
        }
    });
});

// 🚀 au chargement
startSlideshow();



let imagedetailsmap = document.querySelector(".detail-game-img img");
let modal = document.getElementById("modaldetailprodgame");
let modalImg = document.querySelector("#modaldetailprodgame img");
let btnclose = document.getElementById("btnstopblock");
let container = document.querySelector(".detail-container")

imagedetailsmap.addEventListener("click", () =>{
 modal.style.display="flex";
 modalImg.src=imagedetailsmap.src;
    bg.style.opacity = "0.7";
}
);
btnclose.addEventListener("click", () => {
    modal.style.display="none";
        bg.style.opacity = "1";

}

);



function toggleMenu() {
  document.getElementById("menuburger").classList.toggle("active");
}