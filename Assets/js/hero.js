document.getElementById('btn-warhammer').addEventListener('click', function() {
    updateHeroSection(
        "../Assets/images/JPG/Backgound_Warhammer_Header.jpg",
        "../Assets/images/PNG/DarkAngles_noBackground.png",
        "Nuestra tienda de pasatiempos ofrece kits de modelos, juegos de mesa, productos de Games Workshop, coleccionables, herramientas de modelismo, rompecabezas, juegos de cartas y más.",
        "../Assets/images/JPG/freak_wars_warhammer-1000x600.jpg"
    );
    setActiveButton(this);
});

document.getElementById('btn-starwars').addEventListener('click', function() {
    updateHeroSection(
        "../Assets/images/JPG/d32eca36396d48a4d4e6f79388d7f27a.jpg",
        "../Assets/images/WEBP/Grievous_SWCEUE.webp",
        "Explora la galaxia con nuestros productos de Star Wars, desde figuras coleccionables hasta juegos de mesa épicos.",
        "../Assets/images/JPG/3505daec-e6d5-43e8-8708-bfa5cbefd97d.jpg"
    );
    setActiveButton(this);
});

document.getElementById('btn-marvel').addEventListener('click', function() {
    updateHeroSection(
        "../Assets/images/WEBP/Marvel_fondo.webp",
        "../Assets/images/PNG/captain.png",
        "Descubre el universo Marvel con nuestra colección de cómics, figuras de acción y juegos de mesa.",
        "../Assets/images/JPG/34837057-20220219_180012-999.jpg"
    );
    setActiveButton(this);
});

document.getElementById('btn-hielofuego').addEventListener('click', function() {
    updateHeroSection(
        "../Assets/images/JPG/683048.jpg",
        "../Assets/images/WEBP/Casa_Stark_escudo.webp",
        "Sumérgete en el mundo de Canción de Hielo y Fuego con nuestras figuras, juegos y productos exclusivos.",
        "../Assets/images/JPG/IMG_4726.JPEG"
    );
    setActiveButton(this);
});

function updateHeroSection(backgroundImage, heroImage, heroText, additionalImage) {
    document.getElementById('hero-section').style.backgroundImage = `url(${backgroundImage})`;
    document.getElementById('hero-image').src = heroImage;
    document.getElementById('hero-text').textContent = heroText;
    document.getElementById('additional-image').src = additionalImage;
}

function setActiveButton(activeButton) {
    document.querySelectorAll('.hero-buttons a').forEach(button => button.classList.remove('active'));
    activeButton.classList.add('active');
}
