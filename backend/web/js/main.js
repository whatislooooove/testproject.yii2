function dropApple(id) {
    $(`[data-index=${id}] .apple-state`).html('Apple on the ground');
    $(`[data-index=${id}] .drop-btn`).addClass('disabled');
    $(`[data-index=${id}] .eat-btn`).removeClass('disabled');

    //let unixDate = +new Date();
    let curDate = new Date();
    let day = (curDate.getDate() < 10) ? ('0' + curDate.getDate()) : curDate.getDate();
    let month = (curDate.getMonth() < 10) ? ('0' + (curDate.getMonth() + 1)) : (curDate.getMonth() + 1);
    let curDateForPrint = day + '-' + month + '-' + curDate.getFullYear() + ' ' +
        curDate.getHours() + ':' + curDate.getMinutes() + ':' + curDate.getSeconds();

    $(`[data-index=${id}] .card-data`).after(`<div class="fall-date">Fall date: ${curDateForPrint}</div>`);
}

function eatApple(id) {
    let percent = Number($(`[data-index=${id}] input`).val());
    let eatenPercent = Number($(`[data-index=${id}] .eaten-percent`).html());
    let sizePercent = Number($(`[data-index=${id}] .size-percent`).html());

    $(`[data-index=${id}] .eaten-percent`).html(eatenPercent += percent);
    $(`[data-index=${id}] .size-percent`).html(sizePercent -= percent);
}