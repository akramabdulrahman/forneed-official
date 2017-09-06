const bindDateRangeValidation = function (f, s, e) {
    if (!(f instanceof jQuery)) {
        console.log("Not passing a jQuery object");
    }

    var jqForm = f,
        startDateId = s,
        endDateId = e;

    var checkDateRange = function (startDate, endDate) {
        console.log(startDate,endDate)
        var isValid = (startDate != "" && endDate != "") ? new Date(startDate).getTime() <= new Date(endDate).getTime() : true;
        return isValid;
    }

    var bindValidator = function () {
        var bstpValidate = jqForm.data('bootstrapValidator');
        var validateFields = {
            startDate: {
                validators: {
                    notEmpty: {message: 'This field is required.'},
                    callback: {
                        message: 'Start Date must less than or equal to End Date.',
                        callback: function (startDate, validator, $field) {
                            return checkDateRange(startDate, $('#' + endDateId).val())
                        }
                    }
                }
            },
            endDate: {
                validators: {
                    notEmpty: {message: 'This field is required.'},
                    callback: {
                        message: 'End Date must greater than or equal to Start Date.',
                        callback: function (endDate, validator, $field) {
                            return checkDateRange($('#' + startDateId).val(), endDate);
                        }
                    }
                }
            },
            customize: {
                validators: {
                    customize: {message: 'customize.'}
                }
            }
        }
        if (!bstpValidate) {
            jqForm.bootstrapValidator({
                excluded: [':disabled'],
            })
        }

        jqForm.bootstrapValidator('addField', startDateId, validateFields.startDate);
        jqForm.bootstrapValidator('addField', endDateId, validateFields.endDate);

    };

    var hookValidatorEvt = function () {
        var dateBlur = function (e, bundleDateId, action) {
            jqForm.bootstrapValidator('revalidateField', e.target.id);
        };

        $('#' + startDateId).on("dp.change dp.update blur", function (e) {
            $('#' + endDateId).data("datepicker").setStartDate(e.date);
            dateBlur(e, endDateId);
        });

        $('#' + endDateId).on("dp.change dp.update blur", function (e) {
            $('#' + startDateId).data("datepicker").setEndDate(e.date);
            dateBlur(e, startDateId);
        });
    }

    bindValidator();
    hookValidatorEvt();
};


$(function () {
    var sd = new Date($('#starts_at').val()),
        ed = new Date($('#expires_at').val()),
        fallbackSd = new Date() < sd ? new Date() : sd;

    $('#starts_at').datepicker({
        pickTime: false,
        defaultDate: sd,
        startDate: fallbackSd,
        format :'yyyy-mm-d'
    });

    $('#expires_at').datepicker({
        pickTime: false,
        defaultDate: ed,
        startDate: fallbackSd,
        format :'yyyy-mm-d'
    });

    //passing 1.jquery form object, 2.start date dom Id, 3.end date dom Id
    bindDateRangeValidation($("#form"), 'starts_at', 'expires_at');
});
