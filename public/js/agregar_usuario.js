const btn_agregar_usuario = document.getElementById('btn-agregar-usuario');

const agregar_usuario = () => {
    let data = new FormData(document.getElementById('formulario-agregar-usuario'));
    data.append('metodo','agregar_usuario');
    fetch("app/controller/usuario.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            Swal.fire({title: `${respuesta[1]}`,icon: "success"});
        }else {
            Swal.fire({title: `${respuesta[1]}`,icon: "error"});
        }
    })
}

btn_agregar_usuario.addEventListener('click', () => agregar_usuario());