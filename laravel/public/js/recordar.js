function deleteMessageResponse(submissionid, url) {

}

function addMessageResponse(demandid, userid, url) {
    var txtMensaje = document.getElementById('txtMensaje').value;
    if (txtMensaje) {
        //console.log(demandid+' '+userid+' '+txtMensaje);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",
            data: {
                comentario: txtMensaje,
                demand_id: demandid,
                title_id: document.getElementById('title_id').value,
                user_id: userid
            },
            dataType: 'json',
            success: function (result) {
                //console.log(result);
                //alert('2');
                var mensajes = document.getElementById("mensajes");
                var p = document.getElementById("respuestas");
                var p_prime = p.cloneNode(true);
                p_prime.getElementsByTagName("p")[0].innerHTML = result['submission']['comentario'];
                if (result['title']['titulo'] != null) {
                    p_prime.getElementsByTagName("p")[1].innerHTML = result['title']['titulo'];
                }
                mensajes.appendChild(p_prime);
            }
        });
    } else {
        console.log('no message');
    }
}

function setFolder(titleid, url) {
    var idFolder = document.getElementById('id1').value;
    //alert(idFolder);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: "POST",
        data: {
            title_id: titleid,
            folder_id: idFolder
        },
        dataType: 'json',
        success: function (result) {
            //console.log(result);
        }
    });
};

function rateTitle(wish_id, title_id, rate, route) {
    //RATE TITLE FROM WISHSLIST
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route,
        type: "post",
        //async: true,
        data: {
            wish_id: wish_id,
            title_id: title_id,
            rate: rate
        },
        dataType: 'json',
        success: function (result) {
            //console.log(result);
            wish = result['wish'];
            for (let i = 1; i < 6; i++) {
                if (wish.valoracion >= i) {
                    document.getElementById('redstar' + wish.id + i).setAttribute("class",
                        "fa-solid fa-star");
                    document.getElementById('redstar' + wish.id + i).setAttribute("style", "color:red");
                } else {
                    document.getElementById('redstar' + wish.id + i).setAttribute("class",
                        "fa-regular fa-star");
                    document.getElementById('redstar' + wish.id + i).setAttribute("style",
                        "color:black");
                }
            }
        }
    });
}

function rateUserSubmission(submission_id, rate, route) {
    //Rate USER form Submissions
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: route,
        type: "post",
        data: {
            submission_id: submission_id,
            rate: rate,
        },
        dataType: 'json',
        success: function (result) {
            console.log(result);
            submission = result['submission'];
            for (let i = 1; i < 6; i++) {
                if (submission.rating >= i) {
                    document.getElementById('redstar' + submission.id + i).setAttribute("class",
                        "fa-solid fa-star");
                    document.getElementById('redstar' + submission.id + i).setAttribute("style", "color:dodgerblue");
                } else {
                    document.getElementById('redstar' + submission.id + i).setAttribute("class",
                        "fa-regular fa-star");
                    document.getElementById('redstar' + submission.id + i).setAttribute("style",
                        "color:black");
                }
            }
        }
    });
}




