<div class="modal fade" id="modalusuario" tabindex="-1" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo-modal">Usuario</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
        </div>
        <form id="usuarioform" name="usuarioform" action="usuarios" method="POST">            
        <div class="modal-body">
          @csrf
            <div class="mb-3">
              <label class="form-label" for="basic-form-name">UserName</label>
              <input class="form-control" id="basic-form-name" name="name" type="text" placeholder="Name" />
              <input name="id" type="hidden" placeholder="Name" />
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
            <div id="grupocontrasenha">
              <div class="mb-3">
                <label class="form-label" for="basic-form-password">Password</label>
                <input class="form-control" id="basic-form-password" type="password" name="password" placeholder="Password" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-form-confirm-password">Confirmar Password</label>
                <input class="form-control" id="basic-form-confirm-password" type="password" name="password_confirmation" placeholder="Password" />
              </div>   
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