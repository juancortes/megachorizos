var productosModule = angular.module("appProductos",[])

productosModule.controller("ProductosController",['$scope', '$filter','$http',
function($scope, $filter,$http)
{
  $scope.ultimaFila=1;
  // $scope.totalgeneral=0;
  $scope.solicitudes = [
  {
    fila:1,
    tipo:null, 
    loteInterno:null,
    cantidad:null
  }];
  $scope.total=function(fila){
    var total=0;
    var found=$filter('getByFila')($scope.solicitudes, fila);
    angular.forEach(found.estratos, function(item){  
      var cant=parseInt(item.cant);
      if(!cant)
        cant=0;
      total += cant;
    });
    return total;
  };
  
  $scope.sumarTotal = function(fila){
    console.log("fila="+fila);

  }
  
  $scope.addSolicitud = function(){
    $scope.ultimaFila++;
    $scope.solicitudes.push({
      fila:$scope.ultimaFila,
      tipo:null, 
      loteInterno:null,
      cantidad:null
    });

    var fila       = $scope.ultimaFila - 1;
    var productonc = angular.element('[id="productonc_'+fila+'"]').val();
    var lote       = angular.element('[id="lote_'+fila+'"]').val();
    var cantidad   = angular.element('[id="cantidadnc_'+fila+'"]').val();
    var conAjax    = $http.post("guardarSesion", {productonc: productonc, lote: lote, cantidad: cantidad});
    if(productonc != undefined)
    {
      var conAjax = $http.post("guardarSesion", {productonc: productonc, lote: lote, cantidad: cantidad});
      conAjax.success(function(respuesta){
           console.log(respuesta);
      });
    } 
  };
  $scope.delSolicitud = function ( fila ) {
    var solicitudes=[];
    // var $scope.solicitudes=[];
    angular.forEach($scope.solicitudes, function(solicitud){
      if(solicitud.fila!=fila){
        solicitudes.push(solicitud);
      }
    });
    $scope.solicitudes=solicitudes;
  };
}]);

var InsumosModule = angular.module("appInsumos",[])
InsumosModule.controller("InsumosController", ['$scope', '$filter','$http',
function($scope, $filter,$http)
{
  $scope.ultimaFila=1;
  // $scope.totalgeneral=0;
  $scope.solicitudess = [
  {
    fila:1,
    tipo:null, 
    loteInterno:null,
    cantidad:null
  }];
  $scope.total=function(fila){
    var total=0;
    var found=$filter('getByFila')($scope.solicitudess, fila);
    angular.forEach(found.estratos, function(item){  
      var cant=parseInt(item.cant);
      if(!cant)
        cant=0;
      total += cant;
    });
    return total;
  };
  
 
  
  $scope.addSolicitudInsumo = function(){
    $scope.ultimaFila++;
    $scope.solicitudess.push({
      fila:$scope.ultimaFila,
      tipo:null, 
      loteInterno:null,
      cantidad:null
    });


  };
  $scope.delSolicitudInsumo = function ( fila ) {
    var solicitudes=[];
    // var $scope.solicitudes=[];
    angular.forEach($scope.solicitudess, function(solicitud){
      if(solicitud.fila!=fila){
        solicitudes.push(solicitud);
      }
    });
    console.log(solicitud);
    $scope.solicitudess=solicitudes;
  };
}]);

var app = angular.module('appmegachorizos', []); 
var app2 = angular.module('appmegachorizos2', []); 

app2.controller('jCtrl2', ['$scope', '$filter','$http', function($scope, $filter,$http) 
{
  $scope.ultimaFila=1;
  // $scope.totalgeneral=0;
  $scope.solicitudess = [
  {
    fila:1,
    tipo:null, 
    loteInterno:null,
    cantidad:null
  }];
  $scope.total=function(fila){
    var total=0;
    var found=$filter('getByFila')($scope.solicitudess, fila);
    angular.forEach(found.estratos, function(item){  
      var cant=parseInt(item.cant);
      if(!cant)
        cant=0;
      total += cant;
    });
    return total;
  };
  
 
  
  $scope.addSolicitudInsumo = function(){
    $scope.ultimaFila++;
    $scope.solicitudess.push({
      fila:$scope.ultimaFila,
      tipo:null, 
      loteInterno:null,
      cantidad:null
    });


  };
  $scope.delSolicitudInsumo = function ( fila ) {
    var solicitudes=[];
    // var $scope.solicitudes=[];
    angular.forEach($scope.solicitudess, function(solicitud){
      if(solicitud.fila!=fila){
        solicitudes.push(solicitud);
      }
    });
    console.log(solicitud);
    $scope.solicitudess=solicitudes;
  };
}]);

app.controller('jCtrl', ['$scope', '$filter','$http', function($scope, $filter,$http) 
{
  $scope.ultimaFila=1;
  // $scope.totalgeneral=0;
  $scope.solicitudes = [
  {
    fila:1,
    tipo:null, 
    loteInterno:null,
    cantidad:null
  }];
  $scope.total=function(fila){
    var total=0;
    var found=$filter('getByFila')($scope.solicitudes, fila);
    angular.forEach(found.estratos, function(item){  
      var cant=parseInt(item.cant);
      if(!cant)
        cant=0;
      total += cant;
    });
    return total;
  };
  
 
  $scope.sumarTotal = function(fila){
    var total = 0.0;
    angular.forEach($scope.solicitudes, function(solicitud){
      total += parseFloat(solicitud.peso_total);
    });

    if(total != $("#peso_orden_produccion").val())
      $("#btn_ingresar").hide('slow');
    else
      $("#btn_ingresar").show('slow');

  }

  $scope.cargarDatos = function(fila){
    var fila     = $scope.ultimaFila;
    var producto = angular.element('[id="producto_'+fila+'"]').val();
    var insumo   = angular.element('[id="insumo_'+fila+'"]').val();

    if (insumo != undefined && insumo != '' && producto != undefined && producto != '') {
      var conAjax  = $http.post("getValores", {producto: producto, insumo: insumo});
        conAjax.success(function(respuesta){
          if(respuesta.peso != 0 && respuesta.longitud != 0)
          {
            angular.element('[id="peso_unidad_'+fila+'"]').val(respuesta.peso);
            angular.element('[id="longitud_'+fila+'"]').val(respuesta.longitud);
            $("#btn_ingresar").show('slow');
          }
          else
          {
            alertify.alert("Ningun dato (peso o longitud) puede ser cero ");            
            $("#btn_ingresar").hide('slow');
          }
        });
    }
  }
  
  $scope.addSolicitud = function(){
    $scope.ultimaFila++;
    $scope.solicitudes.push({
      fila:$scope.ultimaFila,
      tipo:null, 
      loteInterno:null,
      cantidad:null
    });

    var fila = $scope.ultimaFila - 1;
    var productonc = angular.element('[id="productonc_'+fila+'"]').val();
    var lote = angular.element('[id="lote_'+fila+'"]').val();
    var cantidad   = angular.element('[id="cantidadnc_'+fila+'"]').val();
    var conAjax    = $http.post("guardarSesion", {productonc: productonc, lote: lote, cantidad: cantidad});
    if(productonc != undefined)
    {
      var conAjax = $http.post("guardarSesion", {productonc: productonc, lote: lote});
      conAjax.success(function(respuesta){
           console.log(respuesta);
      });
    } 
  };
  $scope.delSolicitud = function ( fila ) {
    var solicitudes=[];
    // var $scope.solicitudes=[];
    angular.forEach($scope.solicitudes, function(solicitud){
      if(solicitud.fila!=fila){
        solicitudes.push(solicitud);
      }
    });
    $scope.solicitudes=solicitudes;
  };
}]);