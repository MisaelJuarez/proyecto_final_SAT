let tablaColaboradores;

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
                    { data: 'area' }, 
                    { data: 'administrador' }, 
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-warning me-2 editar-usuario"
                                    data-bs-toggle="modal" data-bs-target="#modal-editar"
                                    data-id="${data}" 
                                    data-nombre="${row.nombre}" 
                                    data-apellidos="${row.apellidos}" 
                                    data-usuario="${row.area}"   
                                    data-permisos='${row.administrador}'   
                                >
                                    Editar
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-danger eliminar-usuario"
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


document.addEventListener('DOMContentLoaded', () => {
    obtener_datos_colaboradores();
});