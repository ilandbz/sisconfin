@extends('layout')

@section('contenido')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lista General de Usuarios</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
          @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          <div class="input-group">
              <div class="input-group-append pull-right">
                  <button class="btn btn-lg btn-info" id="btn-nuevo-usuario">
                      Nuevo Registro <i class="fas fa-user-plus"></i>
                  </button>
              </div>
          </div>
        <br>
        @include('paginas.usuarios.tabla')
      </div>
      <!-- /.card-body -->
    </div>
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

@include('paginas.usuarios.modalusuario')
@endsection

@section('script')

<script>
  let csrf_token = $('meta[name="csrf-token"]').attr('content');
  carga_inicial();
  function carga_inicial(){ 
    $("#tablausuarios").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#tablausuarios_wrapper .col-md-6:eq(0)');
    cargar_datatable();
  }
  function cargar_datatable(){
    var table = $('#tablausuarios').DataTable();
    table.clear();
    $.ajax({
        dataType:'json',
        url: 'usuarios/todos',
        success: function(data) {
          let numero_orden = 1;
            (data.usuarios).forEach(function(repo) {
                table.row.add([
                numero_orden,
                repo.name,
                repo.apellidos + ', ' + repo.nombres,
                repo.email,
                repo.rol.nombre,
                repo.es_activo==1 ? '<a id="'+repo.id+'" href="" class="actordes"><i class="nav-icon far fa-circle text-success"></i>&nbsp;'+
                '<label class="text-success">Activo</label></a>' : '<a id="'+repo.id+'" href="" class="actordes"><i class="nav-icon far fa-circle text-muted"></i>&nbsp;'+
                '<label class="text-muted">Inactivo</label></a>',
                '<div class="btn-group" role="group" aria-label="Basic mixed styles example">'+
                  '<a id="'+repo.id+'" class="btn btn-danger btn_eliminar_usuario mr-1"><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                  '<a id="'+repo.id+'" class="btn btn-warning btn_modificar_usuario mr-1"><i class="fa fa-edit" aria-hidden="true"></i></a>' +
                  '<a id="'+repo.id+'" class="btn btn-primary btn_resetearclave" title="Resetear Clave"><i class="fas fa-sync-alt"></i></a>'+
                '</div>'
                ]).draw();
                numero_orden++;
            });
        }
    })
  }
  $("#tablausuarios").on('click', '.actordes', function() {
    var usuario_id = $(this).attr('id');  
    event.preventDefault();
      $.ajax({
          dataType:'json',
          url: 'usuarios/cambiar-estado',
          data: {
                id: usuario_id,
                _token: csrf_token
              },
          success: function(data) {
            cargar_datatable();
            toastr.success(data.mensaje)
          },
          error: function(xhr) {


          }
      });
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
            cargar_datatable();
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
  $("#tablausuarios").on('click', '.btn_resetearclave', function() {    
    var usuario_id = $(this).attr('id');         
    Swal.fire({
          icon: 'question',
          title: 'USUARIOS',
          text: 'Esta Seguro de Resetear al Usuario?',
          toast: true,
          position: 'center',
          showConfirmButton: true,
          confirmButtonText: 'Si',
          showCancelButton: true,
          cancelButtonText: 'No',
          cancelButtonColor: '#bd2130'
        }).then(respuesta=>{
          if(respuesta.isConfirmed){
            $.ajax({
                type:'POST',
                dataType:'json',
                url: 'usuarios/resetear',
                data: {
                  id: usuario_id,
                  _token: csrf_token
                },
                success: function(data) {
                  toastr.success(data.mensaje)
                },
                error: function(xhr) {
                  let res = xhr.responseJSON
                  if($.isEmptyObject(res) === false) {
                      $.each(res.errors,function (key, value){
                          $("input[name='"+key+"']").closest('.mb-3')
                          .append('<div class="alert alert-outline-danger d-flex align-items-center p-0" role="alert"><span class="fas fa-times-circle text-danger fs-3 me-3"></span><p class="m-0 flex-1">'+ value+ '</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button></div>')
                          
                      });
                  }
              }
            });
            
          }
        });
  }); 
  $('#btn-nuevo-usuario').click(function (){
    limpiarformusuario();
    $("#titulo-modal").text('Nuevo Usuario');
    $("#modalusuario").modal('show');
  });
  $("#tablausuarios").on('click', '.btn_eliminar_usuario', function() {            
      var usuario_id = $(this).attr('id');       
      Swal.fire({
        icon: 'question',
        title: 'Usuario',
        text: 'Esta Seguro de Eliminar el usuario?',
        toast: true,
        position: 'center',
        showConfirmButton: true,
        confirmButtonText: 'Si',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#bd2130'
      }).then(respuesta=>{
        if(respuesta.isConfirmed){
          $.ajax({
              type:'POST',
              dataType:'json',
              url: 'usuarios/eliminar',
              data: {
                id: usuario_id,
                _token: csrf_token
              },
              success: function(data) {
                  if(data.ok==1)
                  {
                    toastr.success(data.mensaje)
                    cargar_datatable();
                  }
              }
          })
          
        }
      });
  });
 
function limpiarformusuario(){
  $('input[name=id]').val('');  
  $('input[name=name]').val('')
  $('input[name=nombres]').val('')
  $('input[name=apellidos]').val('')
  $('input[name=email]').val('')
}
$("#tablausuarios").on('click', '.btn_modificar_usuario', function() { 
  $('.alert-danger').remove();
  $("#titulo-modal").text('Modificar Usuario');
  var usuario_id = $(this).attr('id'); 
  $.ajax({
    url: 'usuarios/obtener',
    method: 'GET', // o GET, PUT, DELETE, según tus necesidades
    data: {id : usuario_id},
    dataType: 'json', // o 'text', 'html', según el tipo de respuesta esperada
    success: function(respuesta) {
      $('input[name=id]').val(respuesta.id)
      $('input[name=name]').val(respuesta.name)
      $('input[name=nombres]').val(respuesta.nombres)
      $('input[name=apellidos]').val(respuesta.apellidos)
      $('input[name=email]').val(respuesta.email)
    },
    error: function(xhr, status, error) {
      var mensajeDetallado = "Error: " + error + ", Estado: " + status + ", Descripción: " + xhr.statusText;
      console.log(mensajeDetallado);
    }
  })
  $("#modalusuario").modal('show');
});
</script>
@endsection





