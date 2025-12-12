const nombre = document.getElementById('nombre');
const apellidos = document.getElementById('apellidos');
const rfc = document.getElementById('rfc');
const rfc_corto = document.getElementById('rfc_corto');
const usuario = document.getElementById('usuario');
const area = document.getElementById('area');
const correo = document.getElementById('correo');

const btn_actualizar_informacion = document.getElementById('btn-actualizar-informacion');
let areas = '<option selected>Ingrese el area que pertenece</option>';
let optionsAreas = '<option value="" selected>Seleccione el area</option>';

const obtener_info_tabla = (tabla,options,id_campo,nombre_campo,etiqueta,condicion,area) => {
    let data = new FormData();
    data.append('condicion',condicion);
    data.append('area',area) 
    data.append('tabla',tabla);
    data.append('metodo','obtener_informacion_tabla');
    fetch("app/controller/home.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {        
        respuesta.map(campo => {
            options += `
                <option value="${campo[id_campo]}">${campo[nombre_campo]}</option>
            `;
        });
        etiqueta.innerHTML = options;
    });
}

const obtener_informacion_actualizar = () => {
    let data = new FormData();
    data.append('metodo','obtener_informacion_actualizar');
    fetch("app/controller/usuario.php",{
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        nombre.value = respuesta['nombre'];
        apellidos.value = respuesta['apellidos'];
        rfc.value = respuesta['rfc'];
        rfc_corto.value = respuesta['rfc_corto'];
        usuario.value = respuesta['usuario'];
        correo.value = respuesta['correo'];
        setTimeout(() => area.value = respuesta['area'], 10);
    });
}

const actualizar_informacion = () => {
    let data = new FormData(document.getElementById('formulario-actualizar-informacion'));
    data.append('metodo','actualizar_informacion');
    fetch("app/controller/usuario.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`, text: `${respuesta[2]}`});
            cerrar_session();
        } else {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    });
}

btn_actualizar_informacion.addEventListener('click', () => actualizar_informacion());

document.addEventListener('DOMContentLoaded', () =>{
    obtener_info_tabla('areas',optionsAreas,'id_area','nombre_area',area,2,'');
    obtener_informacion_actualizar();
});