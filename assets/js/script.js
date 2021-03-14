$('#filtro').change(function() {
    window.location = $(this).val();
});

function exibirModalConfirm () {
    $(".mask").show();

    $(".modal-confirmacao").slideDown("fast");
    //$(".modal-confirmacao").show("fast");

}

function fecharModal () {

    $(".modal-confirmacao").slideUp("fast");
    //$(".modal-confirmacao").hide("fast");
    $(".mask").hide();

}

$("#show-menu").click( function () {
    if ( $(this).attr("data-clique") == "false" ) {
        $(this).attr("data-clique", "true");
        $(".sidebar").addClass("show");
    } else {
        $(this).attr("data-clique", "false");
        $(".sidebar").removeClass("show");
    }
} );

function sizeOfThings (){
    var windowWidth = window.innerWidth;

    if (windowWidth > 991) {
        $("#show-menu").attr("data-clique", "false");
        $(".sidebar").removeClass("show");
    }
    

};

sizeOfThings();

window.addEventListener ('resize', function (){
    sizeOfThings();
});