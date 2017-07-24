/**
 * Created by blackthrone on 12/08/2016.
 */
$(function ($) {
    $('#area-drop-down option').first().attr('disabled','disabled')
    $('#sectors-drop-down option').first().attr('disabled','disabled')
    $('#area-drop-down').change(function () {
        $.get(document.location.origin + "/location/cities/" + $(this).val(),
            null,
            function (data) {
                var model = $('#city-drop-down');
                model.empty();
                model.append("<option value='' selected='selected' disabled='disabled'>Please select the City</option>");
                $.each(data, function (index, element) {
                    model.append("<option value='" + element.id + "'>" + element.name + "</option>");
                });
            });
    });
    $('#city-drop-down').change(function () {
        $.get(document.location.origin + "/location/districts/" + $(this).val(),
            null,
            function (data) {
                var model = $('#district-drop-down');
                model.empty();

                model.append("<option value='' selected='selected' disabled='disabled'>Please select the District</option>");
                $.each(data, function (index, element) {
                    model.append("<option value='" + element.id + "'>" + element.name + "</option>");
                });
            });
    });
    $('#district-drop-down').change(function () {
        $.get(document.location.origin + "/location/streets/" + $(this).val(),
            null,
            function (data) {
                var model = $('#street-drop-down');
                model.empty();
                model.append("<option value='' selected='selected' disabled='disabled'>Please select the street</option>");
                $.each(data, function (index, element) {
                    model.append("<option value='" + element.id + "'>" + element.name + "</option>");
                });
            });
    });
    $('#sectors-drop-down').change(function () {
        $.get(document.location.origin + "/listings/service_types/" + $(this).val(),
            null,
            function (data) {
                var model = $('#service-type-drop-down');
                model.empty();
                model.append("<option value='' selected='selected' disabled='disabled'>Please select the service Type</option>");
                $.each(data, function (index, element) {
                    model.append("<option value='" + element.id + "'>" + element.name + "</option>");
                });
            });
    });
    $('#service-providers-drop-down').change(function () {
        $.get(document.location.origin + "/listings/projects/" + $(this).val(),
            null,
            function (data) {
                var model = $('#projects-drop-down');
                model.empty();
                model.append("<option value='' selected='selected' disabled='disabled'>Please select a project</option>");
                $.each(data, function (index, element) {
                    model.append("<option value='" + element.id + "'>" + element.name + "</option>");
                });
            });
    });
    $('#projects-drop-down').change(function () {
        $.get(document.location.origin + "/listings/surveys/" + $(this).val(),
            null,
            function (data) {
                var model = $('#surveys-drop-down');
                model.empty();
                model.append("<option value='' selected='selected' disabled='disabled'>Please select a survey</option>");
                $.each(data, function (index, element) {
                    model.append("<option value='" + element.id + "'>" + element.subject + "</option>");
                });
            });
    });$('#surveys-drop-down').change(function () {
        $.get(document.location.origin + "/listings/questions/" + $(this).val(),
            null,
            function (data) {
                var model = $('#questions-drop-down');
                model.empty();
                model.append("<option value='' selected='selected' disabled='disabled'>Please select a question</option>");
                $.each(data, function (index, element) {
                    model.append("<option value='" + element.id + "'>" + element.body + "</option>");
                });
            });
    });
});