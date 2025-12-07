$(document).ready(function () {
    $('#eye').click(function () {

        $(this).toggleClass('fa-eye fa-eye-slash');

        let input = $(this).siblings('input');

        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });
});
