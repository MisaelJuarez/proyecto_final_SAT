let tablaUsuariosAdministrar;
let btn_obtener_info_modificar_usuarios;
const tabla_de_admin_usuarios = document.getElementById('tabla-de-admin-usuarios');
const contenedor_modificar_usuario = document.getElementById('contenedor-modificar-usuario');

const obtener_datos_usuarios_administrar = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_usuarios');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        if (tablaUsuariosAdministrar) {
            tablaUsuariosAdministrar.clear().rows.add(respuesta).draw(); 
        } else {
            tablaUsuariosAdministrar = $('#tablaUsuariosAdministrar').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'rfc_corto', className: "border border-dark" }, 
                    { data: 'nombre', className: "border border-dark" }, 
                    { data: 'apellidos', className: "border border-dark" }, 
                    { data: 'n_empleado', className: "border border-dark" }, 
                    { data: 'nombre_puesto', className: "border border-dark" }, 
                    { data: 'nombre_area', className: "border border-dark"}, 
                    { data: 'nombre_departamento', className: "border border-dark"}, 
                    { data: 'n_serie', className: "border border-dark",
                        render: function(data, type, row) {
                            return (row.n_serie == null) ? '<span class="badge bg-danger">Sin equipo</span>' : row.n_serie;
                        }
                    }, 
                    { data: 'activo', className: "border border-dark text-center",
                        render: function(data, type, row) {
                            return (data == 1) ? '<i class="bi bi-check2 fs-4 text-success"></i>' : '<i class="bi bi-x-lg fs-4 text-danger"></i>';
                        }
                    }, 
                    {
                        data: 'id_usuario',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-warning modificar-usuario"
                                    data-id="${data}"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            `;
                        }
                    },
                    {
                        data: 'id_usuario',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-danger eliminar-usuario"
                                    data-id="${data}"
                                >
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            `;
                        }
                    }
                ],
                "lengthChange": false,
                "pageLength": 6,
                language: { url: "./public/json/lenguaje.json" },
                dom: '<"custom-toolbar"lf>tip', 
            });
        }
    });
}

const obtener_datos_usuarios_modificar = (id) => {
    console.log(id);
}

tabla_de_admin_usuarios.addEventListener('click', (e) => {
    btn_obtener_info_modificar_usuarios = e.target.closest(".modificar-usuario");

    if (btn_obtener_info_modificar_usuarios) {
        tabla_de_admin_usuarios.style.display = 'none';
        contenedor_modificar_usuario.style.display = 'block';
        obtener_datos_usuarios_modificar(btn_obtener_info_modificar_usuarios.dataset.id);
    }
});

document.addEventListener('DOMContentLoaded', () => {
    contenedor_modificar_usuario.style.display = 'none';
    obtener_datos_usuarios_administrar();
});