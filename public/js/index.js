const contenedorNav = document.getElementById('contenedorNav');
const mostrar_ocultar_nav = document.getElementById('mostrar-ocultar-nav');
const btn_cerrar_sesion = document.getElementById('cerrar_sesion');
const btn_agregar_usuario = document.getElementById('agregar_usuario');

const cerrar_session = () => {
    fetch("app/controller/cerrar_sesion.php")
    .then(respuesta => respuesta.json())
    .then(async (respuesta) => {
        await await Swal.fire({
            position: "top-end",
            icon: "success",
            title: `${respuesta[1]}`,
            showConfirmButton: false,
            timer: 1500
          });
        window.location = "login";
    });
}

mostrar_ocultar_nav.addEventListener('click', () => contenedorNav.classList.toggle('ocultar'));

btn_cerrar_sesion.addEventListener('click', () => cerrar_session());

if (btn_agregar_usuario) {
    btn_agregar_usuario.addEventListener('click', () => {
        window.location = 'agregar';
    });
}

