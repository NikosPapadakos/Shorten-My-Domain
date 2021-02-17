// Show inactive function
var showInactive = function () {

    $.getJSON('http://localhost/smd/api/read_inactive.php', function extract(data) {
        let inactiveLinks = data.payload
        $('.countB').html(inactiveLinks)
    })
}

// Show active function
var showActive = function () {

    $.getJSON('http://localhost/smd/api/read_active.php', function extract(data) {
        let activeLinks = data.payload
        $('.countA').html(activeLinks)
    })
}

// Show renewable function
var showRenewable = function () {

    $.getJSON('http://localhost/smd/api/read_renew.php', function extract(data) {
        let renewableLinks = data.payload
        $('.countC').html(renewableLinks)
    })
}

$(document).ready(function () {

    // Render all database data
    function renderUrls() {
        $.getJSON('http://localhost/smd/api/read.php', function buildTable(data) {

            $('#table td').remove();

            let url = data.payload.data;

            for (let i = 0; i < url.length; i++) {
                let row = `<tr class="" id= "${url[i].id}">
                            <td class="align-middle id" >${url[i].id}</td>
                            <td class="align-middle original" " >${url[i].original}</td>
                            <td class="align-middle shortened" id="">${url[i].shortened}</td>
                            <td class="align-middle creation">${url[i].creation_date}</td>
                            <td class="align-middle expiry">${url[i].expiry_date}</td>
                            <td class="align-middle renewable">${url[i].renewable == 1 ? 'Yes' : 'No'}</td>
                            <td class="align-middle enabled-${url[i].id}">${url[i].is_enabled == 1 ? 'On' : 'Off'}</td>
                            <td class="align-middle"> <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-success activate">Enable</button>
                            <button type="button" class="btn btn-warning disable">Disable</button>
                            <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#deleteModal">Delete</button>
                            </div></td>
                            </tr>`
                $('#table').append(row);
            }
        });
    };
    renderUrls();


    // Styling dynamically created trs
    $(document).on("mouseenter mouseleave", `tr`, function () {
        $(this).toggleClass('tr-hover');
    });



    // Show active button 
    function renderActiveUrls() {
        $.getJSON('http://localhost/smd/api/render_active.php', function buildActiveTable(data) {

            $('#table td').remove();

            let url = data.payload.data;

            for (let i = 0; i < url.length; i++) {
                let row = `<tr class="" id= "${url[i].id}">
                        <td class="align-middle id" >${url[i].id}</td>
                        <td class="align-middle original" " >${url[i].original}</td>
                        <td class="align-middle shortened" id="">${url[i].shortened}</td>
                        <td class="align-middle creation">${url[i].creation_date}</td>
                        <td class="align-middle expiry">${url[i].expiry_date}</td>
                        <td class="align-middle renewable">${url[i].renewable == 1 ? 'Yes' : 'No'}</td>
                        <td class="align-middle enabled-${url[i].id}">${url[i].is_enabled == 1 ? 'On' : 'Off'}</td>
                        <td class="align-middle"> <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-success activate">Enable</button>
                        <button type="button" class="btn btn-warning disable">Disable</button>
                        <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        </div></td>
                        </tr>`
                $('#table').append(row);
            }
        });
    };

    $("#show-active").on('click', function () {
        $('#table').empty()
        renderActiveUrls();
    })



    // Show all button
    $("#show-all").on('click', function () {
        $('#table').empty()
        renderUrls();
    })



    // Show expired or disabled button
    function renderNonActiveUrls() {
        $.getJSON('http://localhost/smd/api/render_nonactive.php', function buildNonActiveTable(data) {

            $('#table td').remove();

            let url = data.payload.data;

            for (let i = 0; i < url.length; i++) {
                let row = `<tr class="" id= "${url[i].id}">
                        <td class="align-middle id" >${url[i].id}</td>
                        <td class="align-middle original" " >${url[i].original}</td>
                        <td class="align-middle shortened" id="">${url[i].shortened}</td>
                        <td class="align-middle creation">${url[i].creation_date}</td>
                        <td class="align-middle expiry">${url[i].expiry_date}</td>
                        <td class="align-middle renewable">${url[i].renewable == 1 ? 'Yes' : 'No'}</td>
                        <td class="align-middle enabled-${url[i].id}">${url[i].is_enabled == 1 ? 'On' : 'Off'}</td>
                        <td class="align-middle"> <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-success activate">Enable</button>
                        <button type="button" class="btn btn-warning disable">Disable</button>
                        <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        </div></td>
                        </tr>`
                $('#table').append(row);
            }
        });
    };
    $("#show-disabled").on('click', function () {
        $('#table').empty()
        renderNonActiveUrls();
    })



    //show active
    showActive();

    //show inactive
    showInactive();

    //show renewable
    showRenewable();




    // Search bar
    $('#search').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        $("#table tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

});





// Delete button
$(document).on("click", '#table .delete', function () {
    let deId = $(this).closest('tr').attr('id');

    $('#modalDeleteBtn').data('row_id', deId)
    $('#deleteModal').modal('toggle')
});

$('#modalDeleteBtn').on("click", function () {
    let del = {
        "id": $('#modalDeleteBtn').data('row_id')
    }

    $.ajax({
        type: "DELETE",
        url: "http://localhost/smd/api/delete.php",
        data: JSON.stringify(del),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function () {

            $('#deleteModal').modal('toggle');
            $('#delModal').modal('toggle');
            $(`#${del.id}`).remove();
            showInactive();
            showActive();
            showRenewable();
        },
        error: function (errMsg) {
            alert(errMsg);
        }
    });
});





//Disable button
$(document).on("click", '#table .disable', function () {
    let disId = $(this).closest('tr').attr('id');
    if ($(`.enabled-${disId}`).text() == 'On') {
        $('#modalDisBtn').data('row_id', disId)
        $('#disableModal').modal('toggle')
    }

});

$('#modalDisBtn').on("click", function () {
    let dis = {
        "id": $('#modalDisBtn').data('row_id')
    }

    $.ajax({
        type: "POST",
        url: "http://localhost/smd/api/disableUrl.php",
        data: JSON.stringify(dis),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function () {
            $('#disableModal').modal('toggle');
            $('#disModal').modal('toggle');
            $(`.enabled-${dis.id}`).text('Off')
            showInactive();
            showActive();
            showRenewable();
        },
        error: function (errMsg) {
            alert(errMsg);
        }
    });

});

//Enable button
$(document).on("click", '#table .activate', function () {
    let enId = $(this).closest('tr').attr('id');
    if ($(`.enabled-${enId}`).text() == 'Off') {
        $('#modalEnBtn').data('row_id', enId)
        $('#enableModal').modal('toggle')
    }

});

$('#modalEnBtn').on("click", function () {
    let en = {
        "id": $('#modalEnBtn').data('row_id')
    }

    $.ajax({
        type: "POST",
        url: "http://localhost/smd/api/enableUrl.php",
        data: JSON.stringify(en),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function () {
            $('#enableModal').modal('toggle');
            $('#enModal').modal('toggle');
            $(`.enabled-${en.id}`).text('On')
            showInactive();
            showActive();
            showRenewable();
        },
        error: function (errMsg) {
            alert(errMsg);
        }
    });

});

