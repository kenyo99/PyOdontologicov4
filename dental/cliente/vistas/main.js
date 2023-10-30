$(document).ready(function(){
    /*alert('hola');*/
    $('.secciones article').hide();
    $('.secciones article:first').show();

    $('li a').click(function(){
        $('.secciones article').hide();
        var activeTab = $(this).attr('href');
        $(activeTab).show();
        return false;
    });
});