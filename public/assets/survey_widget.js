/**
 * Created by ThinkPad on 8/20/2016.
 */
$(function initformwiz() {
    FN_App = {
        rawFormWiz: $("#form_wizard_1").clone(),
        answerWrapper: $(".answer-wrapper").clone(),
        questionWrapper: $(".question-wrapper").clone(),
        configWrapper: $(".config-wrapper").clone(),
        currentSurveyId: -1
    };

    $('#question-handler').on('click', '#add_answer', function ($event) {
        $event.preventDefault();

        FN_App.answerWrapper.clone().insertBefore($(this).parent());
    });
    $('#question-handler').on('click', '#add_question', function ($event) {
        $event.preventDefault();
        FN_App.questionWrapper.clone().appendTo($(this).parent().parent().siblings('.question-wrapper').children('form'));
    });
    $('#config-handler').on('click', '#add_config', function ($event) {
        $event.preventDefault();
        FN_App.configWrapper.clone().appendTo($(this).parent().parent().siblings('.row'));
        $('.config_form').ajaxForm(ConfigAjaxForm);
    });

    $('form.currSurvey').ajaxForm(function (data) {
        FN_App.currentSurveyId = data.id;
        $('.question-wrapper .curr-survey').val(FN_App.currentSurveyId);
        FN_App.questionWrapper = $(".question-wrapper").clone();
        $('.config-wrapper .curr-survey').val(FN_App.currentSurveyId);
        FN_App.configWrapper = $(".config-wrapper").clone();
        $('#form_wizard_1').bootstrapWizard('next');
    });

    $('.question_form').ajaxForm(function (data) {
        $('#form_wizard_1').bootstrapWizard('next');

        console.log($(this), data.id);

        $(this).find('.answer-wrapper').each(
            function (i, v) {
                console.log($(v).children('input[name=question_id]').val(data.id))
            });


    });
    $('.question_form').ajaxForm(ConfigAjaxForm);


    function ConfigAjaxForm(data) {
        $('#form_wizard_1').replaceWith(FN_App.rawFormWiz);
        $.get(document.location.origin + "/listings/projects/" + $("#sp_id").val(),
            null,
            function (data) {
                var model = $('#projects-drop-down');
                model.empty();
                model.append("<option value='' selected='selected' disabled='disabled'>Please select a project</option>");
                $.each(data, function (index, element) {
                    model.append("<option value='" + element.id + "'>" + element.name + "</option>");
                });
            });
        console.log(FN_App.rawFormWiz);
        console.log($('#form_wizard_1'));
        console.log(initformwiz);
        initformwiz();
    }


    $('#form_wizard_1').on('click', '.questions-submit', function () {
        $(".question_form").submit();

    });
    $('#form_wizard_1').on('click', '.configs-submit', function () {
        $(".config_form").submit();
    });
});