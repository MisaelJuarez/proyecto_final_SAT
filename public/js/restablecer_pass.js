const btn_cambiar_pass = document.getElementById('btn_cambiar_pass');

const cambiar_pass = () => {
    let data = new FormData(document.getElementById('form-cambiar-pass'));
    data.append('metodo','cambiar_pass');
    fetch("../app/controller/usuario.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({title: `${respuesta[1]}`,icon: "success"});
            window.location = '../../administrador_usuarios/login.php';
        }else {
            await Swal.fire({title: `${respuesta[1]}`,icon: "success"});
        }
        console.log(respuesta);
    })
}

btn_cambiar_pass.addEventListener('click', () => {
    cambiar_pass();
});