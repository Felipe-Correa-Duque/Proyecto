$(document).ready(function() {
    $('#registro_login').validate({
        rules: {
            correo: {
                required: true,
                email: true
            },
            clave: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            correo: {
                required: "Se Requiere Un Correo",
                email: "El Correo No Es Valido"
            },
            clave: {
                required: "Se Requiere La Contraseña Del Correo",
                minlength: "Es Necesario Minimo De 6 Caracteres"
            }
        }
    });

    $('#registro_votos').validate({
        rules: {
            year: {
                required: true,
                number: true,
                min: 2000,
                max: 2023
            },
            political: {
                required: true,
            },
            contry: {
                required: true,
            },
            votos: {
                required: true,
                number: true,
            },
        },
        messages: {
            year: {
                required: "Se Requiere Un Año Valido",
            },
            political: {
                required: "Se Requiere Un Partido",
            },
            contry: {
                required: "Se Requiere Un Country",
            },
            votos: {
                required: "Se Requiere Un Voto",
            }
        }
    });
});


jQuery(document).on('submit','#registro_login', function (event){
    event.preventDefault();

    jQuery.ajax({
        url:'./Functions/login.php',
        type:'POST',
        dataType:'json',
        data: $(this).serialize(),
        beforeSend: function(){
            $('.login').val('Validando....');
        }
    })
    .done(function(respuesta){
    
        if(!respuesta.error){
            location.href='./form.php';
        }else{
            $('.errores').slideDown('slow');
            setTimeout(function(){
                $('.errores').slideUp('Slow');
            },3000);
            $('.login').val('Sign in');
        }
    })
    .fail(function(resp){
        console.log(resp);
    })
    .always(function(resp){
        console.log("complete");
    })
})

jQuery(document).on('submit','#registro_votos', function (event){
    event.preventDefault();

    jQuery.ajax({
        url:'./Functions/insert.php',
        type:'POST',
        dataType:'json',
        data: $(this).serialize(),
        beforeSend: function(){

        }
    })
    .done(function(respuesta){
        console.log(respuesta);
        if(!respuesta.error){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Datos Guardados Correctamente',
                showConfirmButton: false,
                timer: 1500
              })
        }else{
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'No se guardaron los datos',
                showConfirmButton: false,
                timer: 1500
              })
        }
    })
    .fail(function(resp){
        console.log(resp);
    })
    .always(function(resp){
        console.log("complete");
    })
})
