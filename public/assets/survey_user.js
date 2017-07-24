$(function () {
    console.log('loaded');
    FN_App.forms = $('.stepform');
    console.log($.ajaxForm)
    $(FN_App.forms).each(function (i, v) {
        $(v).ajaxForm({
            success: function (data) {
                $.get(document.location.origin + "/listings/projects/" + data.sp_id,
                    null,
                    function (data) {
                        var model = $('#projects-drop-down');
                        model.empty();
                        model.append("<option value='' selected='selected' disabled='disabled'>Please select a project</option>");
                        $.each(data, function (index, element) {
                            model.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });
                    });
                $('#form_wizard_1').bootstrapWizard('next');
            }, beforeSubmit: function () {
                console.log("in ajax")
            },
            target: v
        });
    });
});
