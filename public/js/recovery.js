const correo_enviado = document.getElementById('correo-enviado');
const btn_recuperar_pass = document.getElementById('btn_recuperar_pass');
const btn_verificar_token = document.getElementById('btn-verificar-token');

const recuperar_pass = () => {
    let data = new FormData(document.getElementById('form-recuperar-pass'));
    data.append('metodo','recuperar_pass');
    fetch("../app/controller/usuario.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            correo_enviado.textContent = respuesta[2];
        }else {
            console.log(respuesta[0]);
        }
        console.log(respuesta);
    })
}

const verificar_token = () => {
    let data = new FormData(document.getElementById('form-verificar-token'));
    data.append('metodo','verificar_token');
    fetch("../app/controller/usuario.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        console.log(respuesta);
        if (respuesta[0] == 1) {
            window.location = 'restablecer_pass.php';
        }else {
            await Swal.fire({title: `${respuesta[1]}`,icon: "error"});
        }
    });
}

btn_recuperar_pass.addEventListener('click', () => {
    recuperar_pass();
});

btn_verificar_token.addEventListener('click', () => {
    verificar_token();
});