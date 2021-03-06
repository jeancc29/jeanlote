@extends('header')

@section('content')



          
    


            <div class="main-panel" ng-init="load('{{ session('idUsuario')}}')">
              <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
	<div class="container-fluid">
    <div class="navbar-wrapper">

    </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
          <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
      </button>
	</div>
</nav>
<!-- End Navbar -->


              

                  <div class="content">
                      













<div class="container-fluid">
  
  <div class="col-md-12 col-12 mr-auto ml-auto">


   <!--      Wizard container        -->
    <div class="wizard-container">
    <div class="card card-wizard" data-color="blue" id="wizardProfile">
        <form novalidate>
          <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
          <div class="card-header">
            <div class="row">
      

             <div class="col-12 text-center">
              <h3 class="card-title">
                Bloqueos
              </h3>
            </div> <!-- END COL-12 -->
            </div> <!-- END ROW -->
           
          </div><!-- END CARD HEADER -->
          <div class="wizard-navigation">
            <ul class="nav nav-pills">
              <li ng-init="tabActiva = 1" class="nav-item">
                <a class="nav-link" href="#buscar" data-toggle="tab" role="tab">
                  Buscar
                </a>
              </li>
              <li class="nav-item">
                <a ng-click="tabActiva = 2" class="nav-link" href="#loterias" data-toggle="tab" role="tab">
                  Loterias
                </a>
              </li>
              <li class="nav-item">
                <a ng-click="tabActiva = 3" class="nav-link" href="#jugadas" data-toggle="tab" role="tab">
                  Jugadas
                </a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">
              
              <div class="tab-pane active" id="buscar">
                <!-- <h5 class="info-text"> What are you doing? (checkboxes) </h5> -->
                <div class="row justify-content-center">
                  <div class="col-lg-12">
                    <div class="row justify-content-center">

                   
                    
                    
                   

                      <div class="col-12">
                        <form novalidate>

                        

                      <div class="row">
                      

                          

                            
                            <div class="col-12 text-center">
                            <div class="input-group">
                              
                              <label class="d-none d-sm-block text-right col-sm-3 col-form-label  font-weight-bold " style="color: black;">Tipo regla</label>                              

                                <div  class=" col-sm-8 col-10">
                                <select 
                                    ng-change="cbxTipoBloqueosChanged()"
                                    ng-model="datos.selectedTipoBloqueos"
                                    ng-options="o.descripcion for o in datos.optionsTipoBloqueos"
                                    class="selectpicker col-12" 
                                    data-style="select-with-transition" 
                                    title="Select tipo regla">
                              </select>
                              </div>
                            </div> <!-- END INPUT GROUP -->
                          </div>
                          

                          <div ng-show="datos.selectedTipoBloqueos.idTipoBloqueo == 2" class="col-12 text-center">
                            <div class="input-group">
                              
                              <label class="d-none d-sm-block text-right col-sm-3 col-form-label  font-weight-bold " style="color: black;">Bancas</label>                              

                                <div  class=" col-sm-8 col-10">
                                  <select 
                                  id="multiselect"
                                      ng-model="datos.bancas"
                                      ng-options="o.descripcion for o in datos.optionsBancas track by o.id"
                                      class="selectpicker col-12" 
                                      data-style="select-with-transition" 
                                      multiple title="Seleccionar bancas"
                                      data-size="7" aria-setsize="2">
                                  </select>
                              </div>
                            </div> <!-- END INPUT GROUP -->
                          </div>

                        <div class="col-12 col-md-2 ">
                          <div class="row justify-content-center">

                            <div class="col-12 ">
                              <h3>Dias</h3>
                            </div>

                            <div class="col-sm-12 checkbox-radios">

                              
                              <div ng-repeat="d in datos.ckbDias" class="form-check form-check-inline">
                                <label class="form-check-label">
                                  <input ng-model="d.existe" ng-change="ckbDias_changed(ckbDias, d)" class="form-check-input" type="checkbox" value=""> @{{d.descripcion}}
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>



                            </div>
                          </div> <!-- END ROW -->
                        </div> <!-- END COL-4 -->
                        
                        <div class="col-8">

                        <div class="row justify-content-center">
                        
                              <h3>Monto</h3>
                            
                        </div>

                          <div ng-repeat="d in datos.sorteos" class="row my-0 justify-content-center">
                            <div class="col-8">
                                <div class="row my-0">
                                  <label class="d-none d-sm-block text-right col-sm-3 col-form-label font-weight-bold mt-2" style="color: black;">@{{d.descripcion}}</label>
                                  <div class="col-sm-5">
                                    <div class="form-group">
                                    <input ng-model="datos.sorteos[$index].monto" type="text"  name="@{{d.descripcion}}" id="@{{d.descripcion}}" type="text" class="form-control" >
                                    </div>
                                  </div>
                                </div>
                              </div> <!-- END COL-6 -->
                          </div> <!-- END ROW -->

                          
                        
                        </div> <!-- END COL-8 SORTEOS -->

                        

                      </div> <!-- END ROW -->

                      <div class="row justify-content-center">
                          <div class="col-12 text-center">
                            <h3>Loterias</h3>
                          </div>
                          <div class="col-12 text-center">
                                <style>
                                  .btn-outline-info.active2{
                                    background-color: #00bcd4!important;
                                    color: #fff!important;
                                  }

                                  .btn-group-toggle > .btn,
                                    .btn-group-toggle2 > .btn-group > .btn {
                                    margin-bottom: 0;
                                    }

                                    .btn-group-toggle2 > .btn input[type="radio"],
                                    .btn-group-toggle2 > .btn input[type="checkbox"],
                                    .btn-group-toggle2 > .btn-group > .btn input[type="radio"],
                                    .btn-group-toggle2 > .btn-group > .btn input[type="checkbox"] {
                                    position: absolute;
                                    clip: rect(0, 0, 0, 0);
                                    pointer-events: none;
                                    }

                                </style>
                                <div class="btn-group btn-group-sm">
                                    <button 
                                    ng-repeat="l in datos.loterias"
                                    ng-class="{'active2': l.seleccionada == 'true'}"
                                    ng-click="rbxLoteriasChanged(l, $index)"
                                    id="btnLoteria@{{$index}}"
                                    type="button" 
                                    class="btn btn-outline-info">@{{l.descripcion}}</button>
                                    <!-- <button type="button" class="btn btn-outline-info">6</button>
                                    <button type="button" class="btn btn-outline-info">7</button> -->
                                </div>
                                      <!-- ng-init="rbxLoteriasChanged(l, $first)" -->
                                
                              </div><!-- END COL-12 -->
                        </div> <!-- END ROW LOTERIAS -->


                        </form>

                      </div> <!-- END DIV FORMULARIO -->


                      
                    </div> <!-- END ROW SECUNDARIO PRINCIPAL -->
                  </div> <!-- END COL PRINCIPAL -->
                </div> <!-- END ROW PRINCIPAL -->
              </div> <!-- END TAB 3 -->

              <div class="tab-pane " id="loterias">
                <!-- <h5 class="info-text"> What are you doing? (checkboxes) </h5> -->
                <div class="row justify-content-center">
                  <div class="col-lg-12">
                    <div class="row justify-content-center">

                   
                    
                    
                   

                      <div class="col-12">
                        <form novalidate>

                        

                      <div class="row">
                      

                          

                            
                            <div class="col-12 text-center">
                            <div class="input-group">
                              
                              <label class="d-none d-sm-block text-right col-sm-3 col-form-label  font-weight-bold " style="color: black;">Tipo regla</label>                              

                                <div  class=" col-sm-8 col-10">
                                <select 
                                    ng-change="cbxTipoBloqueosChanged()"
                                    ng-model="datos.selectedTipoBloqueos"
                                    ng-options="o.descripcion for o in datos.optionsTipoBloqueos"
                                    class="selectpicker col-12" 
                                    data-style="select-with-transition" 
                                    title="Select tipo regla">
                              </select>
                              </div>
                            </div> <!-- END INPUT GROUP -->
                          </div>
                          

                          <div ng-show="datos.selectedTipoBloqueos.idTipoBloqueo == 2" class="col-12 text-center">
                            <div class="input-group">
                              
                              <label class="d-none d-sm-block text-right col-sm-3 col-form-label  font-weight-bold " style="color: black;">Bancas</label>                              

                                <div  class=" col-sm-8 col-10">
                                  <select 
                                  id="multiselect"
                                      ng-model="datos.bancas"
                                      ng-options="o.descripcion for o in datos.optionsBancas track by o.id"
                                      class="selectpicker col-12" 
                                      data-style="select-with-transition" 
                                      multiple title="Seleccionar bancas"
                                      data-size="7" aria-setsize="2">
                                  </select>
                              </div>
                            </div> <!-- END INPUT GROUP -->
                          </div>

                        <div class="col-12 col-md-2 ">
                          <div class="row justify-content-center">

                            <div class="col-12 ">
                              <h3>Dias</h3>
                            </div>

                            <div class="col-sm-12 checkbox-radios">

                              
                              <div ng-repeat="d in datos.ckbDias" class="form-check form-check-inline">
                                <label class="form-check-label">
                                  <input ng-model="d.existe" ng-change="ckbDias_changed(ckbDias, d)" class="form-check-input" type="checkbox" value=""> @{{d.descripcion}}
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>



                            </div>
                          </div> <!-- END ROW -->
                        </div> <!-- END COL-4 -->
                        
                        <div class="col-8">

                        <div class="row justify-content-center">
                        
                              <h3>Monto</h3>
                            
                        </div>

                          <div ng-repeat="d in datos.sorteos" class="row my-0 justify-content-center">
                            <div class="col-8">
                                <div class="row my-0">
                                  <label class="d-none d-sm-block text-right col-sm-3 col-form-label font-weight-bold mt-2" style="color: black;">@{{d.descripcion}}</label>
                                  <div class="col-sm-5">
                                    <div class="form-group">
                                    <input ng-model="datos.sorteos[$index].monto" type="text"  name="@{{d.descripcion}}" id="@{{d.descripcion}}" type="text" class="form-control" >
                                    </div>
                                  </div>
                                </div>
                              </div> <!-- END COL-6 -->
                          </div> <!-- END ROW -->

                          
                        
                        </div> <!-- END COL-8 SORTEOS -->

                        

                      </div> <!-- END ROW -->

                      <div class="row justify-content-center">
                          <div class="col-12 text-center">
                            <h3>Loterias</h3>
                          </div>
                          <div class="col-12 text-center">
                                <style>
                                  .btn-outline-info.active2{
                                    background-color: #00bcd4!important;
                                    color: #fff!important;
                                  }

                                  .btn-group-toggle > .btn,
                                    .btn-group-toggle2 > .btn-group > .btn {
                                    margin-bottom: 0;
                                    }

                                    .btn-group-toggle2 > .btn input[type="radio"],
                                    .btn-group-toggle2 > .btn input[type="checkbox"],
                                    .btn-group-toggle2 > .btn-group > .btn input[type="radio"],
                                    .btn-group-toggle2 > .btn-group > .btn input[type="checkbox"] {
                                    position: absolute;
                                    clip: rect(0, 0, 0, 0);
                                    pointer-events: none;
                                    }

                                </style>
                                <div class="btn-group btn-group-sm">
                                    <button 
                                    ng-repeat="l in datos.loterias"
                                    ng-class="{'active2': l.seleccionada == 'true'}"
                                    ng-click="rbxLoteriasChanged(l, $index)"
                                    id="btnLoteria@{{$index}}"
                                    type="button" 
                                    class="btn btn-outline-info">@{{l.descripcion}}</button>
                                    <!-- <button type="button" class="btn btn-outline-info">6</button>
                                    <button type="button" class="btn btn-outline-info">7</button> -->
                                </div>
                                      <!-- ng-init="rbxLoteriasChanged(l, $first)" -->
                                
                              </div><!-- END COL-12 -->
                        </div> <!-- END ROW LOTERIAS -->


                        </form>

                      </div> <!-- END DIV FORMULARIO -->


                      
                    </div> <!-- END ROW SECUNDARIO PRINCIPAL -->
                  </div> <!-- END COL PRINCIPAL -->
                </div> <!-- END ROW PRINCIPAL -->
              </div> <!-- END TAB 3 -->
              
          
              <div class="tab-pane " id="jugadas">
                <!-- <h5 class="info-text"> What are you doing? (checkboxes) </h5> -->
                <div class="row justify-content-center">
                  <div class="col-lg-12">
                    <div class="row justify-content-center">

                   
                    
                    
                   

                      <div class="col-12">
                        <form novalidate>

                        

                      <div class="row justify-content-center">
                      

                          

                            
                            <div class="col-12 text-center">
                            <div class="input-group">
                              
                              <label class="d-none d-sm-block text-right col-sm-3 col-form-label  font-weight-bold " style="color: black;">Tipo regla</label>                              

                                <div  class=" col-sm-8 col-10">
                                <select 
                                    ng-change="cbxTipoBloqueosJugadaChanged()"
                                    ng-model="datos.bloqueoJugada.selectedTipoBloqueos"
                                    ng-options="o.descripcion for o in datos.bloqueoJugada.optionsTipoBloqueos"
                                    class="selectpicker col-12" 
                                    data-style="select-with-transition" 
                                    title="Select tipo regla">
                              </select>
                              </div>
                            </div> <!-- END INPUT GROUP -->
                          </div>
                          

                          <div ng-show="datos.bloqueoJugada.selectedTipoBloqueos.idTipoBloqueo == 2" class="col-12 text-center">
                            <div class="input-group">
                              
                              <label class="d-none d-sm-block text-right col-sm-3 col-form-label  font-weight-bold " style="color: black;">Bancas</label>                              

                                <div  class=" col-sm-8 col-10">
                                  <select 
                                  id="multiselect"
                                      ng-model="datos.bancas"
                                      ng-options="o.descripcion for o in datos.bloqueoJugada.optionsBancas track by o.id"
                                      class="selectpicker col-12" 
                                      data-style="select-with-transition" 
                                      multiple title="Seleccionar bancas"
                                      data-size="7" aria-setsize="2">
                                  </select>
                              </div>
                            </div> <!-- END INPUT GROUP -->
                          </div>

                          

                          <div class="col-6">

                          <div class="col-12 text-center">
                            <h3>Datos</h3>
                          </div>

                            <div class="row justify-content-center">
                              <div class="col-6">
                                  <div id="divInputFechaDesde" class="form-group">
                                      <label  for="jugada" class="bmd-label-floating">Fecha inicio</label>
                                      <input ng-model="datos.bloqueoJugada.fechaDesde" id="fechaDesde" type="date" class="form-control" value="10/06/2018" required>
                                  </div>
                              </div>

                              <div class="col-6">
                                  <div id="divInputFechaHasta" class="form-group">
                                      <label for="jugada" class="bmd-label-floating">Fecha fin</label>
                                      <input ng-model="datos.bloqueoJugada.fechaHasta"  id="fechaHasta" type="date" class="form-control" value="10/06/2018" required>
                                  </div>
                              </div>

                              

                              <div class="col-12 col-md-12">
                                  <div id="divInputJugada" class="form-group">
                                                <label  for="jugada" class="bmd-label-floating">Jugada</label>
                                                <input 
                                                    ng-model="datos.bloqueoJugada.jugada"
                                                    autocomplete="off"
                                                    class="form-control h4" 
                                                    id="inputJugada" 
                                                    type="text" name="text" 
                                                    minLength="2" maxLength="6"  />
                                            </div>
                              </div>

                              <div class="col-12 col-md-12">
                                  <div id="divInputJugada" class="form-group">
                                                <label  for="jugada" class="bmd-label-floating">Monto</label>
                                                <input 
                                                    ng-model="datos.bloqueoJugada.monto"
                                                    autocomplete="off"
                                                    class="form-control h4" 
                                                    type="text" name="text" 
                                                />
                                            </div>
                              </div>

                              

                            </div> <!-- END ROW JUGADAS -->
                          
                          
                          </div> <!-- END COL-8 JUGADAS -->
                                
                         

                        

                      </div> <!-- END ROW -->

                      <div class="row justify-content-center">
                          <div class="col-12 text-center">
                            <h3>Loterias</h3>
                          </div>
                          <div class="col-12 text-center">
                                <style>
                                  .btn-outline-info.active2{
                                    background-color: #00bcd4!important;
                                    color: #fff!important;
                                  }

                                  .btn-group-toggle > .btn,
                                    .btn-group-toggle2 > .btn-group > .btn {
                                    margin-bottom: 0;
                                    }

                                    .btn-group-toggle2 > .btn input[type="radio"],
                                    .btn-group-toggle2 > .btn input[type="checkbox"],
                                    .btn-group-toggle2 > .btn-group > .btn input[type="radio"],
                                    .btn-group-toggle2 > .btn-group > .btn input[type="checkbox"] {
                                    position: absolute;
                                    clip: rect(0, 0, 0, 0);
                                    pointer-events: none;
                                    }

                                </style>
                                <div class="btn-group btn-group-sm">
                                    <button 
                                    ng-repeat="l in datos.bloqueoJugada.loterias"
                                    ng-class="{'active2': l.seleccionada == 'true'}"
                                    ng-click="rbxLoteriasJugadasChanged(l, $index)"
                                    id="btnLoteriaJugada@{{$index}}"
                                    type="button" 
                                    class="btn btn-outline-info">@{{l.descripcion}}</button>
                                    <!-- <button type="button" class="btn btn-outline-info">6</button>
                                    <button type="button" class="btn btn-outline-info">7</button> -->
                                </div>
                                      <!-- ng-init="rbxLoteriasChanged(l, $first)" -->
                                
                              </div><!-- END COL-12 -->
                        </div> <!-- END ROW LOTERIAS -->


                        </form>

                      </div> <!-- END DIV FORMULARIO -->


                      
                    </div> <!-- END ROW SECUNDARIO PRINCIPAL -->
                  </div> <!-- END COL PRINCIPAL -->
                </div> <!-- END ROW PRINCIPAL -->
              </div> <!-- END TAB 3 -->

            


            </div>
          </div>
          <div class="card-footer">
            <div ng-show="tabActiva == 2" class="row justify-content-end w-100">
              <input ng-click="actualizar()" type="button" class="btn btn-info " name="guardar" value="Guardar">
            </div>

            <div ng-show="tabActiva == 3" class="row justify-content-end w-100">
              <input ng-click="actualizarJugadas()" type="button" class="btn btn-success " name="guardar" value="Guardar">
            </div>
            
          </div>
        </form>
      </div>
    </div>
    <!-- wizard container -->










                  </div>

               
             </div>
          
        </div>


        
        






<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}" ></script>


<!-- Plugin for the momentJs  -->
<script src="{{asset('assets/js/plugins/moment.min.js')}}"></script>

<!--  Plugin for Sweet Alert -->
<script src="{{asset('assets/js/plugins/sweetalert2.js')}}"></script>

<!-- Forms Validations Plugin -->
<script src="{{asset('assets/js/plugins/jquery.validate.min.js')}}"></script>

<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{asset('assets/js/plugins/bootstrap-selectpicker.js')}}" ></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>

<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{asset('assets/js/plugins/bootstrap-tagsinput.js')}}"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{asset('assets/js/plugins/fullcalendar.min.js')}}"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{asset('assets/js/plugins/jquery-jvectormap.js')}}"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{asset('assets/js/plugins/nouislider.min.js')}}" ></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<!-- Library for adding dinamically elements -->
<script src="{{asset('assets/js/plugins/arrive.min.js')}}"></script>


<!--  Google Maps Plugin    -->

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<!-- Chartist JS -->
<script src="{{asset('assets/js/plugins/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>





<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc --><script src="{{asset('assets/js/material-dashboard.js')}}" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/demo/demo.js')}}"></script>
































  <script>
  $(document).ready(function(){
    // Initialise the wizard
    demo.initMaterialWizard();
    setTimeout(function() {
      $('.card.card-wizard').addClass('active');
    }, 600);


     // initialise Datetimepicker and Sliders
     md.initFormExtendedDatetimepickers();
    if($('.slider').length != 0){
      md.initSliders();
    }
  });
</script>





    </body>

</html>




@endsection