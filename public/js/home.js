const contenedorNav = document.getElementById('contenedorNav');
const mostrar_ocultar_nav = document.getElementById('mostrar-ocultar-nav');

mostrar_ocultar_nav.addEventListener('click', () => {
    contenedorNav.classList.toggle('ocultar');
});