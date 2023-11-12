$(document).ready(function () {
    function deleteDoctor(e) {
        $("#DoctorSuccessHelp").text("");
        $("#DoctorErrorHelp").text("");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var id = e.target.id;
        let imgedit = $("#imgedit" + id).attr("src");
        let imgdelete = $("#imgdelete" + id).attr("src");
        var ajaxurl =
            "http://localhost/clinic/public/index.php/admin/delete_doctor/" +
            id;
        $.ajax({
            type: "GET",
            url: ajaxurl,
            success: function (data) {
                $("#DocTable").empty();
                data.doctors.forEach((el) => {

                    //TODO
                    
                    let tr = $("<tr>");
                    let td1 = $("<td>").append(
                        $("<input>", {
                            id: "input-" + el.id,
                            type: "text",
                            class: "form-control",
                            value: el.speciality,
                        })
                    );

                    let td2 = $("<td>").append(
                        $("<button>", {
                            id: "edit-" + el.id,
                            class: "btn btn-secondary SpecEdit",
                        })
                            .click(editSpeciality)
                            .append(
                                $("<img>", {
                                    src: imgedit,
                                    id: "imgedit" + el.id,
                                })
                            )
                    );
                    let td3 = $("<td>").append(
                        $("<button>", {
                            id: el.id,
                            class: "btn btn-danger SpecDelete",
                        })
                            .click(deleteSpeciality)
                            .append(
                                $("<img>", {
                                    src: imgdelete,
                                    id: "imgdelete" + el.id,
                                })
                            )
                    );
                    tr.append(td1, td2, td3);
                    $("#SpecTable").append(tr);
                });
            },
        });
    }

    function editSpeciality(e) {
        $("#SpecialitySuccessHelp").text("");
        $("#SpecialityErrorHelp").text("");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var id = e.target.id.includes("imgedit")
            ? e.target.id.replace("imgedit", "")
            : e.target.id.substring(e.target.id.indexOf("-") + 1);
        var spec = $("#input-" + id).val();

        if (spec.length > 0) {
            let imgedit = $("#imgedit" + id).attr("src");
            let imgdelete = $("#imgdelete" + id).attr("src");
            var ajaxurl =
                "http://localhost/clinic/public/index.php/admin/update_speciality/" +
                id;
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: { speciality: spec },
                success: function (data) {
                    $("#SpecTable").empty();
                    data.specialities.forEach((el) => {
                        let tr = $("<tr>");
                        let td1 = $("<td>").append(
                            $("<input>", {
                                id: "input-" + el.id,
                                type: "text",
                                class: "form-control",
                                value: el.speciality,
                            })
                        );
                        let td2 = $("<td>").append(
                            $("<button>", {
                                id: "edit-" + el.id,
                                class: "btn btn-secondary SpecEdit",
                            })
                                .click(editSpeciality)
                                .append(
                                    $("<img>", {
                                        src: imgedit,
                                        id: "imgedit" + el.id,
                                    })
                                )
                        );
                        let td3 = $("<td>").append(
                            $("<button>", {
                                id: el.id,
                                class: "btn btn-danger SpecDelete",
                            })
                                .click(deleteSpeciality)
                                .append(
                                    $("<img>", {
                                        src: imgdelete,
                                        id: "imgdelete" + el.id,
                                    })
                                )
                        );
                        tr.append(td1, td2, td3);
                        $("#SpecTable").append(tr);
                    });
                },
            });
        } else {
            $("#input-" + id).css("border-color", "red");
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
