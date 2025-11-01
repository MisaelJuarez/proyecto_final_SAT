const contenedorNav = document.getElementById('contenedorNav');
const mostrar_ocultar_nav = document.getElementById('mostrar-ocultar-nav');
const btn_cerrar_sesion = document.getElementById('cerrar_sesion');
const btn_ir_agregar_usuario = document.getElementById('btn-ir-agregar-usuario');
const btn_ir_actualizar_informacion = document.getElementById('btn-ir-actualizar-informacion');

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

if (btn_ir_agregar_usuario) {
    btn_ir_agregar_usuario.addEventListener('click', () => window.location = 'agregar_usuario');
}

if (btn_ir_actualizar_informacion) {
    btn_ir_actualizar_informacion.addEventListener('click', () => window.location = 'actualizar_informacion');
}