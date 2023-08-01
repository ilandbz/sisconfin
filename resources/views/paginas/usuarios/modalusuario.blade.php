<form name="usuarioform" id="usuarioform" action="/usuarios" method="POST">
  <div class="modal fade" id="modalusuario">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title tex-dark" id="titulo-modal">Nuevo Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @csrf
            <div class="card-body">
              @csrf
              <div class="form-group">
                <label class="form-label" for="basic-form-name">UserName</label>
                <input class="form-control" id="basic-form-name" name="name" type="text" placeholder="Name" />
                <input name="id" type="hidden" placeholder="Name" />
              </div>
              <div class="form-group">
                <label class="form-label" for="nombres">Nombres</label>
                <input class="form-control" id="nombres" name="nombres" type="text" placeholder="Nombres" />
              </div>
              <div class="form-group">
                <label class="form-label" for="apellidos">Apellidos</label>
                <input class="form-control" id="apellidos" name="apellidos" type="text" placeholder="Apellidos" />
              </div>
              <div class="form-group">
                <label class="form-label" for="basic-form-email">Email</label>
                <input class="form-control" id="basic-form-email" type="email" name="email" placeholder="name@example.com" />
              </div>
   
              <div class="form-group">
                <label class="form-label" for="basic-form-role_id" name="role_id">Rol</label>
                <select class="form-control" id="basic-form-role_id" name="role_id" aria-label="Default select example">
                  @foreach ($roles as $item)
                      <option value="{{$item->id}}">{{$item->nombre}}</option>
                  @endforeach
                </select>
              </div>
              
            </div>
            <!-- /.card-body -->
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-dark">Guardar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->    
</form>  