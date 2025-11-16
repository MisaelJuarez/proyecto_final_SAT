const btn_agregar_colaborador = document.getElementById('btn-agregar-colaborador');
const area = document.getElementById('area');
let areas = '<option selected>Ingrese el area que pertenece</option>';

const obtener_areas = () => {
    let data = new FormData();
    data.append('condicion',2);
    data.append('tabla','areas');
    data.append('metodo','obtener_informacion_tabla');
    fetch("app/controller/home.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        respuesta.map(area => {
            areas += `
                <option value="${area['id_area']}">${area['nombre_area']}</option>
            `;
        });
        area.innerHTML = areas;
    });
}

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

document.addEventListener('DOMContentLoaded', () => obtener_areas());