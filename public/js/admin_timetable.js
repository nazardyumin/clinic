$(document).ready(function () {
    function hoursFromHandler(e) {
        e.preventDefault();
        let hourFrom = parseInt($("#ChooseHoursFrom").val());
        let minuteFrom = parseInt($("#ChooseMinutesFrom").val());
        let hourTo = parseInt($("#ChooseHoursTo").val());
        let minuteTo = parseInt($("#ChooseMinutesTo").val());

        if (hourTo < hourFrom) {
            $("#ChooseHoursTo").val(
                hourFrom < 10 ? `0${hourFrom}` : `${hourFrom}`
            );
            if (minuteTo <= minuteFrom) {
                let newValue = minuteFrom + 1;
                $("#ChooseMinutesTo").val(
                    newValue < 10 ? `0${newValue}` : `${newValue}`
                );
            }
        }
        $("#TimetableErrorHelp").val("");
        $("#TimetableSuccessHelp").val("");
    }

    function minutesFromHandler(e) {
        e.preventDefault();
        let hourFrom = parseInt($("#ChooseHoursFrom").val());
        let minuteFrom = parseInt($("#ChooseMinutesFrom").val());
        let hourTo = parseInt($("#ChooseHoursTo").val());
        let minuteTo = parseInt($("#ChooseMinutesTo").val());

        if (minuteFrom == 59) {
            let newValue = hourFrom + 1;
            $("#ChooseHoursTo").val(
                newValue < 10 ? `0${newValue}` : `${newValue}`
            );
            $("#ChooseMinutesTo").val("00");
        } else if (hourFrom == hourTo && minuteTo <= minuteFrom) {
            let newValue = minuteFrom + 1;
            $("#ChooseMinutesTo").val(
                newValue < 10 ? `0${newValue}` : `${newValue}`
            );
        }
        $("#TimetableErrorHelp").val("");
        $("#TimetableSuccessHelp").val("");
    }

    function hoursToHandler(e) {
        e.preventDefault();
        let hourFrom = parseInt($("#ChooseHoursFrom").val());
        let minuteFrom = parseInt($("#ChooseMinutesFrom").val());
        let hourTo = parseInt($("#ChooseHoursTo").val());
        let minuteTo = parseInt($("#ChooseMinutesTo").val());

        if (hourFrom >= hourTo && minuteTo < minuteFrom) {
            let newValue = minuteFrom + 1;
            $("#ChooseHoursTo").val(
                hourFrom < 10 ? `0${hourFrom}` : `${hourFrom}`
            );
            $("#ChooseMinutesTo").val(
                newValue < 10 ? `0${newValue}` : `${newValue}`
            );
        }
        if (minuteFrom == 59) {
            let newValue = hourFrom + 1;
            $("#ChooseHoursTo").val(
                newValue < 10 ? `0${newValue}` : `${newValue}`
            );
            $("#ChooseMinutesTo").val("00");
        }
        if (hourTo == 20) {
            $("#ChooseMinutesTo").val("00");
        }
        $("#TimetableErrorHelp").val("");
        $("#TimetableSuccessHelp").val("");
    }

    function minutesToHandler(e) {
        e.preventDefault();
        let hourFrom = parseInt($("#ChooseHoursFrom").val());
        let minuteFrom = parseInt($("#ChooseMinutesFrom").val());
        let hourTo = parseInt($("#ChooseHoursTo").val());
        let minuteTo = parseInt($("#ChooseMinutesTo").val());

        if (hourFrom == hourTo && minuteTo < minuteFrom) {
            let newValue = minuteFrom + 1;
            $("#ChooseMinutesTo").val(
                newValue < 10 ? `0${newValue}` : `${newValue}`
            );
        } else if (hourTo == 20) {
            $("#ChooseMinutesTo").val("00");
        }
        $("#TimetableErrorHelp").val("");
        $("#TimetableSuccessHelp").val("");
    }

    $("#ChooseDoctor").change(function () {
        $("#TimetableErrorHelp").val("");
        $("#TimetableSuccessHelp").val("");
    });
    $("#ChooseDate").change(function () {
        $("#imetableErrorHelp").val("");
        $("#TimetableSuccessHelp").val("");
    });

    $("#ChooseDuration").change(function () {
        $("#TimetableErrorHelp").val("");
        $("#TimetableSuccessHelp").val("");
    });

    $("#ChooseHoursFrom").change(hoursFromHandler);
    $("#ChooseMinutesFrom").change(minutesFromHandler);
    $("#ChooseHoursTo").change(hoursToHandler);
    $("#ChooseMinutesTo").change(minutesToHandler);
});
