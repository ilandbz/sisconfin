@extends('layout')
@section('contenido')
    <div class="card shadow-none border border-300 mb-3">
      <div class="card-header p-4 border-bottom border-300 bg-soft">
        <div class="row g-3 justify-content-between align-items-center">
          <div class="col-12 col-md">
            <h4 class="text-900 mb-0" data-anchor="data-anchor">Lista de Usuarios</h4>
          </div>
          <div class="col col-md-auto">
          
          </div>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="p-4 code-to-copy">
          <div class="d-flex align-items-center justify-content-end my-3">
            <div id="bulk-select-replace-element">
              <button class="btn btn-phoenix-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalusuario">
                <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                <span class="ms-1">New</span>
              </button>
            </div>
            <div class="d-none ms-3" id="bulk-select-actions">
              <div class="d-flex"><select class="form-select form-select-sm" aria-label="Bulk actions">
                  <option selected="selected">Bulk actions</option>
                  <option value="Delete">Delete</option>
                  <option value="Archive">Archive</option>
                </select><button class="btn btn-phoenix-danger btn-sm ms-2" type="button">Apply</button></div>
            </div>
          </div>
          <div id="tablausuarios" data-list='{"valueNames":["name","nombre","apellidos","email","age"],"page":10,"pagination":true}'>
            <div class="table-responsive mx-n1 px-1">
              <table class="table table-sm border-top border-200 fs--1 mb-0">
                <thead>
                  <tr>
                    <th class="sort align-middle ps-3" data-sort="name">Username</th>
                    <th class="sort align-middle ps-3" data-sort="nombres">Nombres</th>
                    <th class="sort align-middle ps-3" data-sort="apellidos">Apellidos</th>
                    <th class="sort align-middle" data-sort="email">Email</th>
                    <th class="sort text-end align-middle pe-0" scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody class="list" id="bulk-select-body">
                  @foreach ($usuarios as $item)
                  <tr>
                      <td class="align-middle ps-3 name">{{$item->name}}</td>
                      <td class="align-middle ps-3 name">{{$item->nombres}}</td>
                      <td class="align-middle ps-3 name">{{$item->apellidos}}</td>
                      <td class="align-middle ps-3 name">{{$item->email}}</td>
                      <td class="align-middle white-space-nowrap text-end pe-0">
                      <div class="font-sans-serif btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>
                          <div class="dropdown-menu dropdown-menu-end py-2">
                              <a class="dropdown-item" href="#!">Ver</a>
                              <div class="dropdown-divider"></div>
                              <a id="{{$item->id}}" class="dropdown-item text-danger btn_eliminar_usuario" href="#">Eliminar</a>
                          </div>
                      </div>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="d-flex flex-between-center pt-3 mb-3">
              <div class="pagination d-none"></div>
              <p class="mb-0 fs--1">
                <span class="d-none d-sm-inline-block" data-list-info="data-list-info"></span>
                <span class="d-none d-sm-inline-block"> &mdash; </span>
                <a class="fw-semi-bold" href="#!" data-list-view="*">
                  Ver Todos
                  <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                </a><a class="fw-semi-bold d-none" href="#!" data-list-view="less">
                  Ver Menos
                  <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                </a>
              </p>
              <div class="d-flex">
                <button class="btn btn-sm btn-primary" type="button" data-list-pagination="prev"><span>Previous</span></button>
                <button class="btn btn-sm btn-primary px-4 ms-2" type="button" data-list-pagination="next"><span>Next</span></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalusuario" tabindex="-1" aria-labelledby="modalusuarioModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalusuarioModalLabel">Usuario</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
          </div>
          <form id="usuarioform" name="usuarioform" action="usuarios" method="POST">            
          <div class="modal-body">
            @csrf
              <div class="mb-3">
                <label class="form-label" for="basic-form-name">UserName</label>
                <input class="form-control" id="basic-form-name" name="name" type="text" placeholder="Name" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="nombres">Nombres</label>
                <input class="form-control" id="nombres" name="nombres" type="text" placeholder="Nombres" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="apellidos">Apellidos</label>
                <input class="form-control" id="apellidos" name="apellidos" type="text" placeholder="Apellidos" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-form-email">Email</label>
                <input class="form-control" id="basic-form-email" type="email" name="email" placeholder="name@example.com" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-form-password">Password</label>
                <input class="form-control" id="basic-form-password" type="password" name="password" placeholder="Password" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-form-confirm-password">Confirmar Password</label>
                <input class="form-control" id="basic-form-confirm-password" type="password" name="password_confirmation" placeholder="Password" />
              </div>                
              <div class="mb-3">
                <label class="form-label" for="basic-form-role_id" name="role_id">Rol</label>
                <select class="form-select" id="basic-form-role_id" name="role_id" aria-label="Default select example">
                  @foreach ($roles as $item)
                      <option value="{{$item->id}}">{{$item->nombre}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="modal-footer"><button class="btn btn-primary" type="submit">Guardar</button><button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button></div>
          </form>
        </div>
      </div>
    </div>
@endsection
@section('miscript')
<script
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>
<script>
  let csrf_token = $('meta[name="csrf-token"]').attr('content');

  document.querySelectorAll('a.btn_eliminar_usuario').forEach(function(element) {
    element.addEventListener('click', function() {
      var usuario_id = this.getAttribute('id');
      Swal.fire({
          icon: 'question',
          title: 'SISCONFIN',
          text: 'Esta Seguro de Eliminar el docente?',
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
                url: 'usuario-eliminar',
                data: {
                  id: docente_id,
                  _token: csrf_token
                },
                success: function(data) {
                    if(data.ok==1){
                      toastr.success(data.mensaje)
                      cargar_datatable();
                    }
                }
            })
            
          }
        });
    });
  });
  document.getElementById('usuarioform').addEventListener('submit', function (event) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente
        var form = document.getElementById('usuarioform');
        $.ajax({
            type:'POST',
            url: this.action,
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
              form.reset();
              $("#modalusuario").modal('hide');
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
    });
</script>
    
@endsection