// On cible les éléments à modifier
const hamburger = document.querySelector(".menuBurger");
const menu = document.querySelector(".menu");
const page = document.documentElement;

// La fonction permettant de basculer l'affichage en ajoutant/supprimant des classes
function doToggle() {
    this.classList.toggle('-open');
    menu.classList.toggle('-open');
    page.classList.toggle('noscroll');
}

// La fonction doToggle() est appelé lorsqu'on clique sur l'icone de menu
hamburger.addEventListener('click', doToggle);

// Ancrage header
const navBar = document.querySelector(".headroom");
const headroom = new Headroom(navBar, {
    offset: 205
});
headroom.init();

// Parallaxe
const rellax = new Rellax('.rellax', {
    speed: -2,
    center: true
});

// Carousel
var carousel = document.querySelector('.carousel');
var flkty = new Flickity(carousel, {
    // options
    wrapAround: true,
    lazyLoad: 3,
    cellAlign: 'left',
    arrowShape: 'M44.314 64.142L31.586 51.414a2 2 0 010-2.828l12.728-12.728a2 2 0 112.828 2.828L37.828 48H73v4H37.828l9.314 9.314a2 2 0 11-2.828 2.828z'
});

// Animation des curveLines
anime({
    targets: '.curveLines path',
    strokeDashoffset: [anime.setDashoffset, 0],
    easing: 'easeInOutCubic',
    duration: 1000,
    delay: function(el, i) {
        return i * 100
    },
    // direction: 'alternate',
    // loop: true
});