<?php

require('../common/head.php');
?>
<table id="personDataTable">
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Password</th>
        <th>created_at</th>
    </tr>

</table>
<script>
    jQuery(window).load(function () {
        $.ajax({
            url: 'articles.php',
            type: 'POST',
            data: {action: 'show'},
            dataType: "JSON",
            success: function (data) {
                drawTable(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus, errorThrown);
            }
        });
    });

    function drawTable(data) {
        for (var i = 0; i < data.length; i++) {
            drawRow(data[i]);
        }
    }

    function drawRow(rowData) {
        var row = $("<tr />")
        $("#personDataTable").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
        row.append($("<td>" + rowData.article_id + "</td>"));
        row.append($("<td>" + rowData.title + "</td>"));
        row.append($("<td>" + rowData.detail + "</td>"));
        row.append($("<td>" + rowData.created_at + "</td>"));
    }
</script>

<?php

require('../common/footer.php');
?>