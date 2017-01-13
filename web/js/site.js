/**
 * Created by santi on 22/12/2016.
 */
$('#nav-toogle-button').on('click',function () {

    if($('#sidebar').hasClass('bounceOutLeft') || $('#sidebar').closest('div').hasClass('hide-on-med-and-down') ){
        $('#sidebar').closest('div').removeClass('hide');
        $('#sidebar').closest('div').removeClass('hide-on-small-and-down');
        $('#sidebar').closest('div').addClass('s2');
        $('#sidebar').removeClass('bounceOutLeft');
        $('#sidebar').addClass('bounceInLeft');
        $('#container').addClass('m10').removeClass('m12').removeClass('s12').addClass('s10');
    }else{
        $('#sidebar').removeClass('bounceInLeft');
        $('#sidebar').addClass('bounceOutLeft');
        $('#sidebar').closest('div').addClass('hide-on-med-and-down');
        $('#sidebar').closest('div').addClass('hide');
        $('#container').removeClass('m10').addClass('m12').addClass('s12');

    }


   //$('#slide-out').toggleClass('bounceInRight');
});
$('body').on('click','.pagination > .pagination-page',function (e) {
    var $paginationConfig=$(this).closest('.pagination');
    var $href=$paginationConfig.attr('data-href');
    var $succesId=$paginationConfig.attr('data-success');
    var $dataForm=$paginationConfig.attr('data-form');
    var $inputPagina=$('#'+$succesId).find('#'+$dataForm).find('#numPagina');
    if($(this).hasClass('pagination-before')){
        $inputPagina.val($paginationConfig.find('.active').prev('li').find('a').html());

    }else if($(this).hasClass('pagination-next')){
        $inputPagina.val($paginationConfig.find('.active').next('li').find('a').html());

    }else{
        $inputPagina.val($(this).find('a').html());
    }
    e.preventDefault();
    var succes = function (data) {
        $paginationConfig.closest('#'+$succesId).html(data);
    };
    var error = function () {
        Materialize.toast('Error al obtener los datos', 4000,'card-panel deep-orange accent-3');

        //$('#actualizar-lista').trigger('click');
    };
    //noinspection JSUnresolvedFunction
    $.ajax({
        type: "POST",
        url: $href,
        data: $('#'+$dataForm).serialize(),
        success: succes,
        error: error
    });
});