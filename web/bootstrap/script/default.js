$(document).ready(function () {
    $('[data-toggle="offcanvas"]').click(function(){
        $('#side-menu').toggleClass('hidden-xs');
    });
});

$(document).ready(function() {
    $('#list').DataTable();
} );