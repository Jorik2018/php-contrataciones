var urlBase = getAbsolutePath();
var obtenerRutaBase=urlBase.split("views");
var rutaBase=obtenerRutaBase[0];
var mostraMensajeBusqueda=true;

var colBusqueda = [
    { "title": 'NRO',               "data": 'numero',       "className": "dt-center", "targets": "_all" },
        
    { "title": "NRO DE PROCESO",    "data": "nuProceso",    "className": "dt-center", "targets": "_all"},
    { "title": "PUESTO",            "data": "dePuesto",     "className": "dt-center", "targets": "_all"},
    { "title": "NRO VACANTES",      "data": "nuVacantes",   "className": "dt-center", "targets": "_all"},
    
    { "title": "AÑO",               "data": "nuAno",        "visible": false},
    { "title": "FECHA PUBLICACION", "data": "fePublicacion","visible": false}    
];

function loadTable(data){
    
    let table = new DataTable('#tResultConvocatoria'); 

    if (table) {
	    table.destroy();
	    $('#tResultConvocatoria > tbody').empty();
    }
	
    table = $('#tResultConvocatoria').DataTable( {
    	scrollX: true,
        searching: false,
        iDisplayLength: 5,
        //dom: "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6 text-right'B>><'row be-datatable-body'<'col-sm-12'tr>><'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
        bLengthChange: false,        
        language: {
                    "lengthMenu": '_MENU_ items por página',
                    "search": '<i class="fa fa-search"></i>',
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Total de registros: _TOTAL_",
                    "sInfoEmpty":      "",
                    "sInfoFilteminT":   "(filtrado de un total de _MAX_ registros)",
                    "sLoadingRecords": "Cargando...",
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>'
                    }
                },
        bSort: false,
        paging: true,
        data: data,
        select: true,
        columns: colBusqueda
    });
};
function limpiar(){    
    $("#num_proceso, #puesto, #vacantes").val("");
    $('#formConvocatoria').removeClass('was-validated');
};
function limpiarBusqueda(){
    $("#puestoBus, #nuProcesoBus, #nuVacantesBus").val("");
    tablaInical();
};
function tablaInical(){
    var miJson=[];
    loadTable(miJson);
};
function cargarTablaData(json){
    var miJson=[];
    $.each(json, function(key,reg) {
                        
        var fecha=reg.fePublica.split(" ");
        var fech=fecha[0];
        var fechaTexto=fech.split("/");
                        
        reg.fePublicacion=fechaTexto[2]+"/"+fechaTexto[1]+"/"+fechaTexto[0];
                        
        miJson.push(reg);
    });
    loadTable(miJson);
};

function busquedaConvocatoia(){
    
    tablaInical();
    if(mostraMensajeBusqueda){
        mostrarModalBarraCarga("modalBarraProgreso", "Se esta procesando su busqueda, por favor esperar...");
    }    
    var puestoBus = $.trim($("#puestoBus").val());
    var nuProcesoBus = $.trim($("#nuProcesoBus").val());
    var nuVacantesBus = $.trim($("#nuVacantesBus").val());
    
    if( puestoBus=="" && nuProcesoBus=="" && nuVacantesBus=="" ){
        
        $.ajax({
            url: rutaBase+'controllers/convocatorias.php?op=getCovocatoria',
            type: 'GET',
            dataType: "json",
            success: function (response) {
                
                if(mostraMensajeBusqueda){
                    ocultarModalBarraCarga("modalBarraProgreso");
                }
                if(response.nrofila>0){
                    cargarTablaData(response.json);
                }else{
                    tablaInical();
                }
            },
            error: function () {
                if(mostraMensajeBusqueda){
                    ocultarModalBarraCarga("modalBarraProgreso");
                }
                mostrarModalMensaje("modalMensaje", "Error al procesar la busqueda, invocar la funcion getCovocatoria", true);
            }
        });

    }else{
        
        if( puestoBus=="" ){ puestoBus="NO"; } 
        if( nuProcesoBus=="" ){ nuProcesoBus="NO"; } 
        if( nuVacantesBus=="" ){ nuVacantesBus=0; } 
        
        $.ajax({
            url: rutaBase+'controllers/convocatorias.php?op=getCovocatoriaData',
            type: 'GET',
            data: {
                puesto:puestoBus,
                nuProceso:nuProcesoBus,
                nuVacantes:nuVacantesBus
            },
            dataType: "json",
            success: function (response) {
                
                ocultarModalBarraCarga("modalBarraProgreso");
                if(response.nrofila>0){
                    cargarTablaData(response.json);
                }else{
                    tablaInical();
                }
                
            },
            error: function () {
                ocultarModalBarraCarga("modalBarraProgreso");
                mostrarModalMensaje("modalMensaje", "Error al procesar la busqueda, invocar la funcion getCovocatoriaData", true);
            }
        });
    }
};

$(document).ready(function () {
    
    tablaInical();

    $('#btoLimpiarBus').unbind("click").click(function(){
        limpiarBusqueda();
    });

    $('#btoLimpiar').unbind("click").click(function(){
        limpiar();
    });

    $('#btoBuscar').unbind("click").click(function(){
        busquedaConvocatoia();
    });

    $('#btoGrabar').unbind("click").click(function(){
        if( document.getElementById("formConvocatoria").checkValidity() ){ //$('#formConvocatoria')[0].checkValidity()
            mostrarModalMensaje("modalMensaje", "¿Está seguro de guardar, este nuevo registro de convocatoria?", false);
        }else{
            $('#formConvocatoria').addClass('was-validated');
        }
    });

    $('#btoGrabarFinal').unbind("click").click(function(){
        $("#modalCovocatoria").modal('hide');
        $("#btoGrabar").attr("disabled","disabled");
        $("#formConvocatoria").submit();        
    });
    
    $('#formConvocatoria').on('submit', function (e) {    
        e.preventDefault();
        if (this.checkValidity()) {
            $.ajax({
                url: rutaBase+'controllers/convocatorias.php?op=guardaryeditar',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    
                    mostraMensajeBusqueda=false;
                    limpiar();
                    limpiarBusqueda();
                    busquedaConvocatoia();
                    $("#btoGrabar").removeAttr("disabled");
                    
                    mostrarModalMensaje("modalMensaje", "Convocatoria guardada exitosamente.", true);
                    mostraMensajeBusqueda=true;
                },
                error: function () {                    
                    $("#btoGrabar").removeAttr("disabled");
                    mostrarModalMensaje("modalMensaje", "Error en el proceso de guardar nueva convocatoria.", true);
                }
            });
        }else{            
            $("#btoGrabar").removeAttr("disabled");
            $(this).addClass('was-validated');            
        }
    });
     
});