var myVar = {
    idTree: 0,
    ligh: function () {
        $('a[data-rel^=lightcase]').lightcase({
            forceHeight: true,
            maxWidth: 1200,
            maxHeight: 900,
            swipe: true,
        });
    },
    ajax: function (functionName, url, data = null) {
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            success: functionName,
            error: function (data, textError, one) {
                myModal.error.show(data.responseText, one, 0);
            },
        });
    },
    ajaxForm: function (element, functionName) {
        let data = new FormData(element);
        $.ajax({
            url: element.action,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            success: functionName,
            error: function (data, textError, one) {
                myModal.error.show(data.responseText, one, 0);
            },
        });
    },
    ajaxA: function (element, functionName) {
        $.ajax({
            url: element.href,
            type: 'post',
            processData: false,
            contentType: false,
            success: functionName,
            error: function (data, textError, one) {
                myModal.error.show(data.responseText, one, 0);
            }
        });
    },
    lenghtChar: function (element) {
        $("span[data-count-lenght='" + element.id + "']").text(element.value.length)
    },
    keyDownLength: function (element) {
        $(element).each(function (index, e) {
            $(e).on('keydown', myVar.lenghtChar(e));
        });

    },
    save: function (form) {
        console.info(form);
        $("'" + form + "'").trigger('submit')
    }
};

myVar.ligh();