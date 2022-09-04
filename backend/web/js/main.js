let needQuery = false;

function dropApple(id) {
    let unixDate = +new Date();
    $.ajax({
        url: 'index.php?r=apple%2Fdrop',
        method: 'post',
        dataType: 'json',
        data: {apple_number: id, date: unixDate},
        success: function(data){
            $(`[data-index=${id}] .apple-state`).html('Apple on the ground');
            $(`[data-index=${id}] .drop-btn`).addClass('disabled');
            $(`[data-index=${id}] .eat-btn`).removeClass('disabled');

            let curDate = new Date();
            let day = (curDate.getDate() < 10) ? ('0' + curDate.getDate()) : curDate.getDate();
            let month = (curDate.getMonth() < 10) ? ('0' + (curDate.getMonth() + 1)) : (curDate.getMonth() + 1);
            let hours = (curDate.getHours() < 10) ? ('0' + (curDate.getHours())) : curDate.getHours();
            let curDateForPrint = curDate.getFullYear() + '-' + month + '-' + day + ', ' +
                hours + ':' + curDate.getMinutes() + ':' + curDate.getSeconds();
            let dateValidate = curDateForPrint.replace(', ', 'T');
            customTimer(id, dateValidate);

            $(`[data-index=${id}] .card-data`).after(`<div class="fall-date">Fall date: ${curDateForPrint}</div>`);
        }
    });
}

function eatApple(id) {
    let percent = Number($(`[data-index=${id}] input`).val());
    let eatenPercent = Number($(`[data-index=${id}] .eaten-percent`).html());
    let sizePercent = Number($(`[data-index=${id}] .size-percent`).html());
    $.ajax({
        url: 'index.php?r=apple%2Feat',
        method: 'post',
        dataType: 'json',
        data: {apple_number: id, percent: percent},
        success: function(data){
            $(`[data-index=${id}] .eaten-percent`).html(eatenPercent += percent);
            $(`[data-index=${id}] .size-percent`).html(sizePercent -= percent);
            if (eatenPercent >= 100) {
                $(`[data-index=${id}]`).remove();
            }
        }
    });
}

function removeApple(id) {
    $.ajax({
        url: 'index.php?r=apple%2Fremove',
        method: 'post',
        dataType: 'json',
        data: {apple_number: id},
        success: function(data){
            $(`[data-index=${id}]`).remove();
        }
    });
}

function handleChange(input) {
    if (input.value < 0) input.value = 1;
    if (input.value > 100) input.value = 100;
}

function customTimer(id, fallDate) {
    // Set the date we're counting down to
    var countDownDate = new Date(fallDate);
    countDownDate.setHours(countDownDate.getHours() + 5);
    countDownDate.getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        if (distance >= 1) {
            $(`[data-index=${id}] .timer`).html("Spoil through: " + hours + ":"
                + minutes + ":" + seconds);
            needQuery = true;
        }

        // If the count down is finished, write some text
        if (distance < 0 && needQuery) {
            clearInterval(x);
            $.ajax({
                url: 'index.php?r=apple%2Frot',
                method: 'post',
                dataType: 'json',
                data: {apple_number: id},
                success: function(data){
                    $(`[data-index=${id}] .timer`).html("Worms eat this apple...");
                    $(`[data-index=${id}] .eat-btn`).addClass('disabled');
                    $(`[data-index=${id}] .freshness`).html('Rotten apple');
                }
            });
        }
    }, 1000);
}

/* Проходимся по всем яблокам и навешиваем таймер, в зависимости от положения*/
function setTimer() {
    let apples = $('.fall-date');
    for (let i = 0; i < apples.length; i++) {
        let apple = $(apples[i]);
        if (apple.html() !== '') {
            let id = apple.parent().parent().data('index');
            let fallDate = apple.children().text();
            let fallDateValidated = fallDate.replace(', ', 'T');

            customTimer(id, fallDateValidated);
        }
    }
}