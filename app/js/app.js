////LIKES ////

//// ENVIA LIKE //////
export function adlike(post_id, user_id, action) {
    let data = new URLSearchParams();
    data.append("post_id", post_id);
    data.append("user_id", user_id);
    data.append("action", action);
    //  fetch
    fetch("app/data.php", {
        method: 'POST',
        body: data
    })
        .then(function (response) {
            return response.text();
        })
        .then(function (text) {
            console.log(text)

        })
        .catch(function (error) {
            console.log(error)
        });

    return false;

}



////////////////// FUNCTION NOVIDADE /////////////////////
export function novidade(post_date) {
    var countDownDate = new Date(post_date).getTime()
    var now = new Date().getTime();

    // Find the distance between now an the count down date
    var distance = now - countDownDate
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));

    return days <= 5 ? "<img src='app/images/novo.gif'>" : ""
}

export function imogIcon(icon) {

    if (icon) {
        return '<p><img src="app/images/' + icon + '.gif"></p>';
    } else {
        return ''
    }
}


