$(function() {

    createModal();

    $("button.add").on("click", function(e) {
        //console.log(e);
        $("#modalBox").css("display", "block");
    })

    $("button.save").on("click", function(e) {
        var typeId = $("#typeId").val();

        var pageData = {
            "code": $("#code").val(),
            "fromDate": $("#fromDate").val(),
            "toDate": $("#toDate").val(),
            "typeId": typeId,
            "statusId": $("#statusId").val(),
            "title": $("#title").val(),
            "action": $("#action").val(),
            "slogan": $("#slogan").val(),
            "description": $("#description").val(),
        };

        $.ajax({
            type: "POST",
            url: "index.php",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(pageData),
            success: function(data, status) {
                console.log("Got data", data);
            },
            error: function(err) {
                console.log("Didn't get data", err);
            },
            complete: function() {
                // Do this last
                $("#modalBox").css("display", "none");
            }
        });
    })

    // Make a global variable
    var pagesData;

    $.ajax({
        type: "GET",
        url: "index.php",
        dataType: "json",
        success: function(data, status) {
            pagesData = data;
            console.log("Got data", pagesData);

            for (var p in pagesData) {
                var page = pagesData[p];

                $("#pages table tbody").append(
                    $("<tr>")
                    .append($("<td>")
                        .html(page.code))
                    .append($("<td>")
                        .html(page.from_date))
                    .append($("<td>")
                        .html(page.to_date))
                    .append($("<td>")
                        .html(page.type_name))
                    .append(
                        $("<button>")
                        .append($("<img>")
                            .attr("src", "img/salon-actions-archive.png"))
                    ))
            }

        },
        error: function(err) {
            console.log("Didn't get data", err);
        }
    });

})

function createModal() {
    // Get the modal

    // Get the button that opens the modal
    var btn = document.getElementById("openButton");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        $("#modalBox").css("display", "none");
    }

    var modal = document.getElementById('modalBox');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            $("#modalBox").css("display", "none");
        }
    }
}
