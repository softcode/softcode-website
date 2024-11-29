$(document).ready(function() {
    $('#menu-icon').click(function() {
        $('body').toggleClass('menu-active');
        $(this).toggleClass('active');
    });

    $('#overlay').click(function() {
        $('body').removeClass('menu-active');
        $('#menu-icon').removeClass('active');
    });

    $('#file-upload').on('change', function() {
        const fileName = $(this).val().split('\\').pop() || 'No file chosen';
        $('#file-name').text(fileName);
    });
});
