@extends('layout')
@section('contenido')
    <div class="card shadow-none border border-300 mb-3">
      <div class="card-header p-4 border-bottom border-300 bg-soft">
        <div class="row g-3 justify-content-between align-items-center">
          <div class="col-12 col-md">
            <h4 class="text-900 mb-0" data-anchor="data-anchor">Registro de Cuentas</h4>
          </div>
          <div class="col col-md-auto">
          
          </div>
        </div>
      </div>

      <div class="card-body p-0">
        <div class="p-4">
          <form name="guardarregistrocuenta" id="guardarregistrocuenta" class="row g-3" novalidate method="POST" action="cuenta">
            @csrf
            <div class="row pt-5">
              <div class="col-md-10"></div>
              <div class="col-md-2">
                <div class="d-flex justify-content-between">
                  <div>
                    <h5 class="mb-1">SALDO<span class="badge badge-phoenix badge-phoenix-warning rounded-pill fs--1 ms-2"></span></h5>
                    <input type="hidden" name="saldo" value="{{$saldo}}">
                    <h6 class="text-700"></h6>
                  </div>
                  <h4>S/.{{number_format($saldo,2)}}</h4>
                </div>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-2 control">
                <label class="form-label" for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-select">
                  <option value="" id="opcion-seleccione">Seleccione</option>
                  <option value="INGRESO">INGRESO</option>
                  <option value="GASTO DE OBRA">GASTO DE OBRA</option>
                </select>
              </div>
              <div class="col-md-2 control poringreso" style="display:none;">
                <label class="form-label" for="origen_id">Origen</label>
                <select name="origen_id" id="origen_id" name="origen_id" class="form-select">
                  <option value="Caja">Caja</option>
                  <option value="Prestamo">Prestamo</option>
                  <option value="Otros">Otros</option>
                </select>
              </div>
              <div class="col-md-2 control">
                <label class="form-label" for="obra">Obra</label>
                <select name="obra" id="obra" class="form-select">
                  @foreach ($consorcios as $item)
                      <option value="Consorcio {{$item->razonsocial}}">Consorcio {{$item->razonsocial}}</option>
                  @endforeach
                  @foreach ($empresas as $item)
                      <option value="{{$item->razonsocial}}">{{$item->razonsocial}}</option>
                  @endforeach
                  @foreach ($obras as $item)
                      <option value="Obra : {{$item->nombre}}">Obra : {{$item->nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2 control">
                <label class="form-label" for="medioentrega">Medio de Entrega</label>
                <select name="medioentrega" id="medioentrega" name="medioentrega" class="form-select">
                  <option value="EFECTIVO">EFECTIVO</option>
                  <option value="DEPOSITO">DEPOSITO</option>
                </select>
              </div>
              <div class="col-md-4 control">
                <label class="form-label" for="concepto">Concepto</label>
                <input class="form-control" id="concepto" name="concepto" type="text">
              </div>
              <div class="col-md-2 control">
                <label class="form-label" for="nro_operacion">Nro. de Operación</label>
                <input class="form-control" id="nro_operacion" name="nro_operacion" type="text">
              </div>
              <div class="col-md-2 control">
                <label class="form-label" for="fecha_hora">FECHA HORA</label>
                <input class="form-control" id="fecha_hora_seleccionado" type="datetime-local" value="{{date('Y-m-d h:i:s')}}" required="">
                <input type="hidden" class="form-control" id="fecha_hora" name="fecha_hora" value="{{date('Y-m-d h:i:s')}}">

              </div>              
              <div class="col-md-2 control">
                <label class="form-label" for="factura_id">NRO COMPROBANTE</label>
                <input class="form-control" id="factura_id" name="factura_id" type="text" required="">
              </div>
              <div class="col-md-2 control">
                <label class="form-label" for="tiene_igv">TIENE IGV</label><br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" id="flexRadioDefault1" value="1" type="radio" name="tiene_igv">
                  <label class="form-check-label" for="flexRadioDefault1">SI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" id="flexRadioDefault2" value="0" type="radio" name="tiene_igv" checked="">
                  <label class="form-check-label" for="flexRadioDefault2">NO</label>
                </div>
              </div>              
              <div class="col-md-2 control">
                <label class="form-label" for="ruc_dni">RUC/DNI</label>
                <input class="form-control" id="ruc_dni" name="ruc_dni" type="text" required="">
              </div>
              <div class="col-md-2 control">
                <label class="form-label" for="usuario_id">Usuario ID</label>
                <input class="form-control" id="usuario" type="text" value="{{Auth::user()->email}}" required="" readonly>
                <input id="usuario_id" name="usuario_id" type="hidden" value="{{Auth::user()->id}}" required="">
              </div>
              <div class="col-md-2">
                <label class="form-label" for="monto">Monto</label>
                <div class="input-group control">
                  <span class="input-group-text" id="validationTooltipUsernamePrepend">S/.</span>
                  <input class="form-control" id="monto" name="monto" type="number" step="0.01" placeholder="0.00" required="">
                </div>
              </div>
              <div class="col-md-2 control">
                <label class="form-label" for="detraccion">DETRACCION</label>
                <input class="form-control" id="detraccion" name="detraccion" type="text" required="">
              </div>
              <div class="col-md-2 control">
                <label class="form-label" for="moneda">Moneda</label>
                <select name="moneda" id="moneda" class="form-control">
                  <option value="Soles">Soles</option>
                  <option value="Dolares">Dolares</option>
                </select>
              </div>
              <div class="col-md-2 control">
                <label class="form-label" for="uso">Uso</label>
                <select name="uso" id="uso" name="uso" class="form-select">
                  @foreach ($usos as $item)
                    <option value="{{$item->nombre}}">{{$item->nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label" for="observacion">Observación</label>
                <input class="form-control" id="observacion" name="observacion" type="text" value="NINGUNO" required="">
              </div>
              <div class="col-md-2 control">
                <label class="form-label" for="banco">Banco</label>
                <select name="banco" id="banco" class="form-select">
                  <option value="" id="opcion-seleccione2">Seleccione</option>
                  @foreach ($bancos as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <label class="form-label" for="estado">Estado</label>
                <select name="estado" id="estado" class="form-select">
                  <option value="Cerrado">Cerrado</option>
                  <option value="Falta Detraccion">Falta Detraccion</option>
                </select>
              </div>
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Guardar</button>
              </div>
            </div>
          </form>
          
        </div>
      </div>
    </div>
    <x-toast></x-toast>
    <div class="card shadow-none border border-300 my-4">
      <div class="card-header p-4 border-bottom border-300 bg-soft">
        <div class="row g-3 justify-content-between align-items-center">
          <div class="col-12 col-md">
            <h4 class="text-900 mb-0" data-anchor="data-anchor" id="card-with-list">Registros</h4>
          </div>
          <div class="col col-md-auto"></div>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="p-4">
          @include('paginas.cuentas.tabla')
        </div>
      </div>
    </div>



@endsection
@section('miscript')

<script>
$('#tipo').on('change', function() {
    var tipo =  $(this).val();
    var divs = document.getElementsByClassName("poringreso");
    $('#opcion-seleccione').remove();
    for (var i = 0; i < divs.length; i++) {
      if(tipo == 'INGRESO'){
        divs[i].style.display = "block";
      }else{
        divs[i].style.display = "none";
      }
    }
});
$('#banco').on('change', function() {
    $('#opcion-seleccione2').remove();
});
document.getElementById('guardarregistrocuenta').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita que el formulario se envíe normalmente
    var form = document.getElementById('guardarregistrocuenta');
    $('.invalid-feedback').remove();
    $("input, select").removeClass("is-invalid");
    const toast = new bootstrap.Toast(document.getElementById('liveToast'));
    $.ajax({
      type:'POST',
      url: this.action,
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function(data) {
        form.reset();
        $("#toastmensaje").text(data.mensaje);
        toast.show();
        //cargar_datatable()
      },
      error: function(xhr) {
        let res = xhr.responseJSON
        if($.isEmptyObject(res) === false) {
          $.each(res.errors,function (key, value){
            $("input[name='" + key + "'], select[name='" + key + "']").each(function() {
              $(this).addClass("is-invalid");
              $(this).closest('.control').append('<div class="invalid-feedback">' + value + '</div>');
            });
          });
        }
      }
    });
});
document.getElementById('fecha_hora_seleccionado').addEventListener('change', function() {
  const inputDate = this.value;
  const formattedDate = inputDate.replace('T', ' ') + ':00';
  this.value = formattedDate;
  $('#fecha_hora').val(formattedDate);
});



</script>
    
@endsection