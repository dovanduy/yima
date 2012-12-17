$(function () {

    // Notification Close Button
    $('.close-notification').click(
        function () {
            $(this).parent().fadeTo(350, 0, function () {
                $(this).slideUp(600);
            });
            return false;
        }
        );

    // IE7 doesn't support :disabled
    $('.ie7').find(':disabled').addClass('disabled');

});