const btn_agregar_colaborador = document.getElementById('btn-agregar-colaborador');

const agregar_colaborador = () => {
    let data = new FormData(document.getElementById('formulario-agregar-colaborador'));
    data.append('metodo','agregar_colaborador');
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

btn_agregar_colaborador.addEventListener('click', () => agregar_colaborador());