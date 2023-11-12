$(document).ready(function () {
    var buttons = document.querySelectorAll('button[id^="but"]');
    for (let i = 0; i < buttons.length; i++){
        let date = buttons[i].id.substring(3);
        var appDate = Date.parse(date);
        console.log(appDate,Date.now());
        if(appDate < Date.now()){
            buttons[i].disabled = true;
            buttons[i].href = '';
        }
    }
});
