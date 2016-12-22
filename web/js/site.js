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