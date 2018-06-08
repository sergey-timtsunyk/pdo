    $('.modal-district').click(function() {

        var modalWindow = $(".district-modal");
        M1.modalShow(modalWindow);
        $("#overlay-popup-m1").show();
        return false;
    });

    $(window).click(function(e) {
        var target = $(event.target);
        if (target.is("#overlay-popup-m1")) {
            $("#overlay-popup-m1").hide();
            $(".district-modal").hide();

        }
    });

    $(window).click(function(e) {
        var target = $(event.target);
        if (target.is("#overlay-popup-m1")) {
            $("#overlay-popup-m1").hide();
            $(".edit-modal").hide();

        }
    });

    $('.add-district').click(function(event){
        var serializedData = $(this).parent().serialize();
        $.ajax({
            url: "/districts",
            method: "POST",
            data: serializedData,
            success(a){
                location.reload();
            }
        });

    });

    $('.edit-district').click(function(event){
        var form = $(this).parent();
        var serializedData = form.serialize();
        var id = form.find('.edit-id').val();
        $.ajax({
            url: "/districts/"+id,
            method: "POST",
            data: serializedData,
            success(a){
                location.reload();
            },
            error(a) {
                showErrorToForm(form, JSON.parse(a.responseText));
            }
        });
    });

    $('.edit').click(function () {
        var id = $(this).parent().parent().find('td.id').html();

        var modalWindow = $(".edit-modal");
        M1.modalShow(modalWindow);
        $("#overlay-popup-m1").show();
        $('.edit-id').val(id);

        $.ajax({
            url: "/districts/"+id,
            method: "GET",
            dataType: "json",
            success(a){
                $(".edit-modal [name='name']").val(a.name);
                $(".edit-modal [name='population']").val(a.population);
                $(".edit-modal [name='description']").val(a.description);
            }
        });
        return false;
    });

    $('.delete').click(function () {
        var id = $(this).parent().parent().find('td.id').html();
        request = $.ajax({
            url: "/districts/"+id,
            method: "DELETE",
            success(a){
                location.reload();
            }
        });
    });

    function showErrorToForm(element, validate) {
        var text = '';
        for (var i = 0; i < element[0].elements.length; i++) {
            var el = element[0].elements[i];
            if (validate[el.name]) {
                text += validate[el.name] + "</br>";
            }
        }

        if (text.length) {
            $('.validation').html(text);
            $('.validation').parent().show();

        }
    }