function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
};

function mostrarModalMensaje(idModalMensaje, textMensaje, ocultarGuardar){
    
    if(ocultarGuardar==true){ 
        $('#btoGrabarFinal').css('display', 'none'); 
    } else{
        $('#btoGrabarFinal').css('display', 'inline'); 
    }   
    $('#textoModalLabel').html('');
    $('#textoModalLabel').html(textMensaje);    
    $('#'+idModalMensaje).modal('show');
};
function ocultarModalMensaje(idModalMensaje){
    $('#'+idModalMensaje).modal('hide');
};
function mostrarModalBarraCarga(idBarraCarga, textMensaje){
    $("#textoBarProgresoLabel").html("");
    $("#textoBarProgresoLabel").html(textMensaje);
    $("#"+idBarraCarga).modal('show');
};
function ocultarModalBarraCarga(idBarraCarga){
    $("#"+idBarraCarga).modal('hide');
    //$(".cerrarBarra").trigger("click");
    /*$("#"+idBarraCarga).hide();*/  
};

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});