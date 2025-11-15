let tablaUsuariosAdministrar;

const obtener_datos_usuarios_admin = () => {
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
                    { data: 'n_serie', className: "border border-dark"}, 
                    { 
                        data: 'activo', className: "border border-dark text-center",
                        render: function(data, type, row) {
                            return (data == 1) ? '<i class="bi bi-check2 fs-4 text-success"></i>' : '<i class="bi bi-x-lg fs-4 text-danger"></i>';
                        }
                    }, 
                    {
                        data: 'id_usuario',
                        className: "text-center border border-dark",
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-warning info-usuario"
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
                                <button class="btn btn-danger info-usuario"
                                    data-id="${data}"
                                >
                                    <i class="bi bi-trash-fill"></i>
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
}

document.addEventListener('DOMContentLoaded', () => {
    obtener_datos_usuarios_admin();
});