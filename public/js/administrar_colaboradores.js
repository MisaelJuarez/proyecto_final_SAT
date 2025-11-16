let tablaColaboradores;
const btn_editar_colaborador = document.getElementById('btn-editar-colaborador');
const contenedor_editar_colaborador = document.getElementById('contenedor-editar-colaborador');
const informacion_de_colaboradores = document.getElementById('informacion-de-colaboradores');
const nombre = document.getElementById('nombre');
const apellidos = document.getElementById('apellidos');
const rfc = document.getElementById('rfc');
const rfc_corto = document.getElementById('rfc_corto');
const usuario = document.getElementById('usuario');
const area = document.getElementById('area');
const administrador = document.getElementById('tipo');
let areas = '<option selected>Ingrese el area que pertenece</option>';
let id_colaborador_editar;

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

const obtener_datos_colaboradores = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_colaboradores');
    fetch("app/controller/usuario.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        if (tablaColaboradores) {
            tablaColaboradores.clear().rows.add(respuesta).draw(); 
        } else {
            tablaColaboradores = $('#tablaColaboradores').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'nombre' }, 
                    { data: 'apellidos' }, 
                    { data: 'nombre_area' }, 
                    { data: 'administrador',
                        render: function(data) {
                            return (data == 1) ? 'Administrador' : 'Usuario';
                        }
                    }, 
                    {
                        data: 'id_colaborador',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-warning me-2 editar-colaborador"
                                    data-id="${data}" 
                                    data-nombre="${row.nombre}" 
                                    data-apellidos="${row.apellidos}" 
                                    data-rfc="${row.rfc}" 
                                    data-rfccorto="${row.rfc_corto}" 
                                    data-usuario="${row.usuario}"   
                                    data-area='${row.area}'   
                                    data-administrador='${row.administrador}'   
                                >
                                    Editar
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-danger eliminar-colaborador"
                                    data-id="${data}"
                                >
                                    Eliminar
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            `;
                        }
                    } 
                ],
                "lengthChange": false,
                "pageLength": 8,
                language: { url: "./public/json/lenguaje.json" },
                dom: '<"custom-toolbar"lf>tip', 
            });
        }
    });
};

const editar_informacion_colaborador = (id) => {
    let data = new FormData(document.getElementById('formulario-editar-colaborador'));
    data.append('id',id);
    data.append('metodo','editar_informacion_colaborador');
    fetch("app/controller/usuario.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            contenedor_editar_colaborador.style.display = "none";
            informacion_de_colaboradores.style.display = "block";
            obtener_datos_colaboradores();
        } else {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    });
}

const eliminar_colaborador = (id) => {
    let data = new FormData();
    data.append('id',id);
    data.append('metodo','eliminar_colaborador');
    fetch("app/controller/usuario.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            Swal.fire({
                title: `${respuesta[1]}`,
                text: "Colaborador eliminado exitosamente",
                icon: "success"
            });
            contenedor_editar_colaborador.style.display = "none";
            informacion_de_colaboradores.style.display = "block";
            obtener_datos_colaboradores();
        } else {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    });
}

informacion_de_colaboradores.addEventListener('click', (e) => {
    if (e.target.classList.contains("editar-colaborador")) {
        informacion_de_colaboradores.style.display = "none";
        contenedor_editar_colaborador.style.display = "block";

        nombre.value = e.target.dataset.nombre;
        apellidos.value = e.target.dataset.apellidos;
        rfc.value = e.target.dataset.rfc;
        rfc_corto.value = e.target.dataset.rfccorto;
        usuario.value = e.target.dataset.usuario;
        area.value = e.target.dataset.area;
        administrador.value = e.target.dataset.administrador;
        id_colaborador_editar = e.target.dataset.id;
    }

    if (e.target.classList.contains("eliminar-colaborador")) {
        console.log(e.target.dataset.id);
        Swal.fire({
            title: "Eliminar colaborador",
            text: "Estas seguro de eliminar a este colaborador?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
        if (result.isConfirmed) {
            eliminar_colaborador(e.target.dataset.id);
        }
        });
    }
});

btn_editar_colaborador.addEventListener('click', () => editar_informacion_colaborador(id_colaborador_editar));

document.addEventListener('DOMContentLoaded', () => {
    contenedor_editar_colaborador.style.display = "none";
    obtener_areas();
    obtener_datos_colaboradores();
});