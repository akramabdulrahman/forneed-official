var CompleteRegistration = function () {

    var handleCompleteRegistration = function () {

        jQuery('#citizen-btn').click(function () {
            jQuery('.service-provider-form').hide();
            jQuery('.citizen-form').show();
        });

        jQuery('#service-provider-btn').click(function () {
            jQuery('.service-provider-form').show();
            jQuery('.citizen-form').hide();
        });
    }

    return {
        //main function to initiate the module
        init: function () {

           handleCompleteRegistration();
            jQuery('.service-provider-form').hide();

        }

    };

}();

jQuery(document).ready(function () {
    CompleteRegistration.init();
});