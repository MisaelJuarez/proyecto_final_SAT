let tablaImpresoras;

const obtener_datos_impresoras = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos_impresoras');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {     
        if (tablaImpresoras) {
            tablaImpresoras.clear().rows.add(respuesta).draw(); 
        } else {
            tablaImpresoras = $('#tablaImpresoras').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'marca', className: "border border-dark" }, 
                    { data: 'modelo', className: "border border-dark" }, 
                    { data: 'n_serie', className: "border border-dark" }, 
                    { data: 'nombre_area', className: "border border-dark" }, 
                    { data: 'nombre_departamento', className: "border border-dark" }, 
                    { data: 'ip', className: "border border-dark" }, 
                    { data: 'nodo', className: "border border-dark"}
                ],
                "lengthChange": false,
                "pageLength": 5,
                language: { url: "./public/json/lenguaje.json" },
                dom: '<"custom-toolbar"lf>tip', 
            });
        }
    });
}

document.addEventListener('DOMContentLoaded',() => {
    obtener_datos_impresoras();
});