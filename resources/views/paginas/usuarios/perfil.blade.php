@extends('layout')
@section('contenido')
<div class="row">
    <div class="col-4">
        <div class="card card-info">
            <div class="card-header">
            <h3 class="card-title">Sobre Mi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <strong><i class="fas fa-check"></i> Name</strong>
                        <p class="text-muted" id="name">
                        </p>
                        <hr>
                        <strong><i class="fas fa-check"></i> Nombres</strong>
                        <p class="text-muted" id="nombres"></p>
                        <hr>
                        <strong><i class="fas fa-check"></i> Apellidos</strong>
                        <p class="text-muted" id="apellidos"></p>
                        <hr>
                        <strong><i class="fas fa-check"></i> Email</strong>
                        <p class="text-muted" id="email"></p>
                        <hr>
                        <strong><i class="fas fa-check"></i> Rol</strong>
                        <p class="text-muted" id="rol"></p>                          
                    </div>
                    <div class="col-md-4">
                        <button type="button" id="btn_modificar_usuario" data-id="{{Auth::user()->id}}" title="Modificar" class="btn btn-warninf"><i class="fa fa-edit"></i></button>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-3">
        <form action="cambiarclave" id="formcambioclave" method="POST">
            <div class="card card-info">
                <div class="card-header">
                <h3 class="card-title">Cambiar Clave</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="password">Clave</label>
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="newpassword">Nueva Clave</label>
                        <input class="form-control" id="newpassword" name="newpassword" type="password" placeholder="Nueva Clave" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirm">Repite Nueva Clave</label>
                        <input class="form-control" id="password_confirm" name="password_confirm" type="password" placeholder="Repite Nueva Clave" />
                    </div>                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-dark">Guardar</button>
                </div>
            </div>   
        </form>
    </div>
</div>
@include('paginas.usuarios.modificarperfilmodal')
@endsection
@section('script')
<script>
    cargardatos();
document.getElementById('formcambioclave').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita que el formulario se envíe normalmente
    var form = document.getElementById('formcambioclave');
    $('.alert-danger').remove();
    $.ajax({
        type:'POST',
        url: this.action,
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(data) {

          form.reset();
          toastr.success(data.mensaje)
        },
        error: function(xhr) {
          let res = xhr.responseJSON

          if($.isEmptyObject(res) === false) {
              $.each(res.errors,function (key, value){
                  $("input[name='"+key+"']").closest('.form-group')
                  .append('<div class="alert alert-danger" role="alert">'+ value+ '</div>')
              });
          }
        if (res.error) {
            $("input[name='password']").closest('.form-group')
                  .append('<div class="alert alert-danger" role="alert">'+ res.error + '</div>')
        }
      }
    });
});

$("#btn_modificar_usuario").on('click', function() { 
  $('.alert-danger').remove();
  $("#titulo-modal").text('Modificar Usuario');
  var usuario_id = $(this).data('id');
  $.ajax({
    url: '/usuarios/obtener',
    method: 'GET',
    data: {id : usuario_id},
    dataType: 'json', 
    success: function(respuesta) {
      $('input[name=id]').val(respuesta.id)
      $('input[name=name]').val(respuesta.name)
      $('input[name=nombres]').val(respuesta.nombres)
      $('input[name=apellidos]').val(respuesta.apellidos)
      $('input[name=email]').val(respuesta.email)
      $('select[name=role_id]').val(respuesta.role_id)
    },
    error: function(xhr, status, error) {
      var mensajeDetallado = "Error: " + error + ", Estado: " + status + ", Descripción: " + xhr.statusText;
      console.log(mensajeDetallado);
    }
  })
  $("#modalusuario").modal('show');
});


document.getElementById('usuarioform').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita que el formulario se envíe normalmente
    var form = document.getElementById('usuarioform');
    $('.alert-danger').remove();
    $.ajax({
        type:'POST',
        // datatype: 'json',
        url: this.action,
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(data) {
        form.reset();
        $("#modalusuario").modal('hide');
        cargardatos();
        toastr.success(data.mensaje)
        },
        error: function(xhr) {
        let res = xhr.responseJSON
        if($.isEmptyObject(res) === false) {
            $.each(res.errors,function (key, value){
                $("input[name='"+key+"']").closest('.form-group')
                .append('<div class="alert alert-danger" role="alert">'+ value+ '</div>')
            });
        }

    }
    });
});
function cargardatos(){
    let usuario_id = {{Auth::user()->id}}
    $.ajax({
        url: '/usuarios/obtener',
        method: 'GET',
        data: {id : usuario_id},
        dataType: 'json', 
        success: function(respuesta) {
            $('#name').text(respuesta.name)
            $('#nombres').text(respuesta.nombres)
            $('#apellidos').text(respuesta.apellidos)
            $('#email').text(respuesta.email)
            $('#rol').text(respuesta.rol.nombre)
        },
        error: function(xhr, status, error) {
        var mensajeDetallado = "Error: " + error + ", Estado: " + status + ", Descripción: " + xhr.statusText;
        console.log(mensajeDetallado);
        }
    })
    
}

</script>
@endsection





