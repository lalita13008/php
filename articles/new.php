<?php
require('../common/head.php');
?>
<div id="show_data" class="container">
    <h2>Article</h2>
    <form id="articles" role="form">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="detail">Title</label>
            <textarea id="detail"  class="form-control" rows="5" id="comment" placeholder="Detail"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Post</button>
    </form>
</div>
<script>
    $('form#articles').on('submit', function (e) {
        title = $('#title').val();
        detail = $('#detail').val();
        e.preventDefault();
        $.ajax({
            url: 'articles.php',
            type: 'POST',
            data: {title: title, detail: detail, action: 'add'},
            dataType: "text",
            success: function (e) {
                 location.href = "show.php?id="+e;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus, errorThrown);
            }
        });
    });

</script>
<?php


require('../common/footer.php');
?>