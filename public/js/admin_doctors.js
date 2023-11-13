$(document).ready(function () {
    function deleteDoctor(e) {
        $("#DoctorSuccessHelp").text("");
        $("#DoctorErrorHelp").text("");
        $("#PhotoErrorHelp").text("");
        $("#AjaxHelp").text("");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var id = e.target.id.includes("imgdelete")
            ? e.target.id.replace("imgdelete", "")
            : e.target.id;
        var ajaxurl =
            "http://localhost/clinic/public/index.php/admin/delete_doctor/" +
            id;
        $.ajax({
            type: "GET",
            url: ajaxurl,
            success: function (data) {
                $("#tr" + id).remove();
                alert("Врач с ID: " + id + " успешно удален");
            },
        });
    }

    function editDoctor(e) {
        $("#DoctorSuccessHelp").text("");
        $("#DoctorErrorHelp").text("");
        $("#PhotoErrorHelp").text("");
        $("#AjaxHelp").text("");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var id = e.target.id.includes("imgedit")
            ? e.target.id.replace("imgedit", "")
            : e.target.id.substring(e.target.id.indexOf("-") + 1);
        var name = $("#inputdoc-" + id).val();
        var photo = $("#photodoc-" + id)[0].files[0];
        var spec = $("#specdoc-" + id).val();
        var formData = new FormData();

        formData.append("name", name);
        if (photo) {
            formData.append("photo", photo);
        }
        formData.append("speciality_id", spec);

        if (name.length > 0) {
            var ajaxurl =
                "http://localhost/clinic/public/index.php/admin/update_doctor/" +
                id;
            $.ajax({
                type: "POST",
                url: ajaxurl,
                contentType: false,
                processData: false,
                data: formData,
                cache: false,
                dataType: "json",
                success: function (data) {
                    if (data.message) {
                        $("#AjaxHelp").text(data.message);
                    } else {
                        alert("Врач с ID: " + id + " успешно отредактирован");
                    }
                    $("#photodoc-" + id).val("");
                },
            });
        } else {
            $("#inputdoc-" + id).css("border-color", "red");
        }
    }

    var all_docdeletes = document.querySelectorAll(".DocDelete");
    all_docdeletes.forEach((el) => {
        el.addEventListener("click", deleteDoctor);
    });

    var all_docedits = document.querySelectorAll(".DocEdit");
    all_docedits.forEach((el) => {
        el.addEventListener("click", editDoctor);
    });
});
