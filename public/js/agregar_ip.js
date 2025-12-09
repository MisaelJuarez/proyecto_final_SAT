let tablaResguaros;
let tablaimpresoras;
let id_resguardo = null;
let id_impresora = null;
let btn_seleccionar_resguardo;
let btn_seleccionar_impresora;
let modalObtenerResguardo;
let modalObtenerImpresora;
let chekedInput = '';

const asignar_resguardo_contenedor = document.getElementById('asignar-resguardo-contenedor');
const asignar_impresoras_contenedor = document.getElementById('asignar-impresoras-contenedor');

const tabla_Resguardos = document.getElementById('tablaResguardos');
const tabla_impresoras = document.getElementById('tablaImpresoras');
const btn_obtener_resguardos = document.getElementById('btn-obtener-resguardos');
const btn_obtener_impresoras = document.getElementById('btn-obtener-impresoras');
const modal = document.getElementById('buscar-resguardo');
const modalImpresora = document.getElementById('buscar-impresoras');
const btn_agregar_ip = document.getElementById('btn-agregar-ip');
const formulario_agregar_ip = document.getElementById('formulario-agregar-ip');
const contenedor_aux = document.getElementById('contenedor-aux');
const radios = document.querySelectorAll('input[name="asignar"]');

const obtener_resguaros_para_asignar_ip = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_resguaros_para_asignar_ip');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        if (tablaResguaros) {
            tablaResguaros.clear().rows.add(respuesta).draw(); 
        } else {
            tablaResguaros = $('#tablaResguardos').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'n_serie' }, 
                    { data: 'hostname' }, 
                    { data: 'mac' }, 
                    {
                        data: 'id_resguardo',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-info seleccionar-resguardo" 
                                    data-id="${data}"  
                                    data-nserie="${row.n_serie}" 
                                >
                                    Seleccionar
                                </button>
                            `;
                        }
                    }
                ],
                "lengthChange": false,
                "pageLength": 5,
                "info": false,
                language: { url: "./public/json/lenguaje.json" },
                dom: '<"custom-toolbar"lf>tip', 
                initComplete: () => {
                    $("div.custom-toolbar .dataTables_filter").prependTo(".custom-toolbar").addClass("left-section");
                }
            });
        }
    });
};

const obtener_impresoras_para_asignar_ip = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_impresoras_para_asignar_ip');
    fetch("app/controller/home.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        if (tablaimpresoras) {
            tablaimpresoras.clear().rows.add(respuesta).draw(); 
        } else {
            tablaimpresoras = $('#tablaImpresoras').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'modelo' }, 
                    { data: 'n_serie' }, 
                    { data: 'nombre_area' }, 
                    { data: 'nombre_departamento' }, 
                    {
                        data: 'id_impresora',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-info seleccionar-impresoras" 
                                    data-id="${data}"  
                                    data-nserie="${row.n_serie}" 
                                >
                                    Seleccionar
                                </button>
                            `;
                        }
                    }
                ],
                "lengthChange": false,
                "pageLength": 5,
                "info": false,
                language: { url: "./public/json/lenguaje.json" },
                dom: '<"custom-toolbar"lf>tip', 
                initComplete: () => {
                    $("div.custom-toolbar .dataTables_filter").prependTo(".custom-toolbar").addClass("left-section");
                }
            });
        }
    });
};

const agregar_nueva_ip = () => {
    console.log(id_resguardo);
    
    let data = new FormData(document.getElementById('formulario-agregar-ip'));
    data.append('id_resguaro',(chekedInput == 'equipos') ? id_resguardo : id_impresora);
    data.append('asignar',chekedInput);
    data.append('metodo','agregar_nueva_ip');
    fetch("app/controller/home.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({title: `${respuesta[1]}`,icon: "success"});
            formulario_agregar_ip.reset();
            asignar_resguardo_contenedor.style.display = 'none';
            asignar_impresoras_contenedor.style.display = 'none';
            contenedor_aux.style.display = 'none';
            btn_obtener_resguardos.textContent = 'Equipos de computo';
            btn_obtener_impresoras.textContent = 'Impresoras';
            id_resguardo = null;
            id_impresora = null;
        }else {
            Swal.fire({title: `${respuesta[1]}`,icon: "error"});
        }
    })
}

radios.forEach(radio => {
    radio.addEventListener('change', function() {
        contenedor_aux.style.display = 'block';
        if (this.value == 'equipos') {
            chekedInput = 'equipos';
            asignar_impresoras_contenedor.style.display = 'none';
            asignar_resguardo_contenedor.style.display = 'block';
        }else if(this.value == 'impresoras'){
            chekedInput = 'impresoras';
            asignar_resguardo_contenedor.style.display = 'none';
            asignar_impresoras_contenedor.style.display = 'block';
        }
    });
});

tabla_Resguardos.addEventListener('click', (e) => {
    btn_seleccionar_resguardo = e.target.closest(".seleccionar-resguardo"); 
    
    if (btn_seleccionar_resguardo) {
        id_resguardo = btn_seleccionar_resguardo.dataset.id;
        btn_obtener_resguardos.textContent = `${btn_seleccionar_resguardo.dataset.nserie}`;
        modalObtenerResguardo = bootstrap.Modal.getInstance(modal);
        if (modalObtenerResguardo) modalObtenerResguardo.hide();
    }
});

tabla_impresoras.addEventListener('click', (e) => {
    btn_seleccionar_impresora = e.target.closest(".seleccionar-impresoras"); 
    
    if (btn_seleccionar_impresora) {
        id_impresora = btn_seleccionar_impresora.dataset.id;
        modalObtenerImpresora = bootstrap.Modal.getInstance(modalImpresora);
        if (modalObtenerImpresora) modalObtenerImpresora.hide();
        btn_obtener_impresoras.textContent = `${btn_seleccionar_impresora.dataset.nserie}`;
    }
});

btn_agregar_ip.addEventListener('click', () => agregar_nueva_ip());

document.addEventListener('DOMContentLoaded', () => {
    contenedor_aux.style.display = 'none';
    asignar_resguardo_contenedor.style.display = 'none';
    asignar_impresoras_contenedor.style.display = 'none';
     obtener_resguaros_para_asignar_ip();
     obtener_impresoras_para_asignar_ip();
});
