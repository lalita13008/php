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

<form id="comments" role="form">
    <div class="form-group">
        <label for="comment">Comment</label>
        <input type="text" class="form-control" id="comment" placeholder="comment">
    </div>

    <button type="submit" class="btn btn-default">Post</button>
</form>

<script>
    jQuery(window).load(function () {

        var id = getUrlParameter('id');
        $.ajax({
            url: 'articles.php',
            type: 'POST',
            data: {action: 'show_by_id', id: id},
            dataType: 'JSON',
            success: function (data) {
                drawTable(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus, errorThrown);
            }
        });

        $('form#comments').on('submit', function (e) {
            comment = $('#comment').val();
            e.preventDefault();
            $.ajax({
                url: 'articles.php',
                type: 'POST',
                data: {comment: comment,id: id, action: 'add_comment'},
                dataType: "JSON",
                success: function (e) {
                    alert(e);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        });
    });

</script>

<?php

require('../common/footer.php');
?>