<!DOCTYPE html>
<html lang="bg">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>BLOG TEMPLATE EDIT POST</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/reset.css" rel='stylesheet' type='text/css' />
    <link href="assets/css/style.css" rel='stylesheet' type='text/css' />
</head>
<body>
    <div class="container clearfix">
        <div class="form-container edit-post">
            <?php if(isset($error_update)) {?><h2><?=$error_update;?></h2><?php }?>
            <h3>Форма за редактиране на Постове</h3>
            <form id="postFormEdit" action="edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="post_id" value="<?=$single_post[0]['post_id'];?>" />
                <div class="clearfix">
                    <label>Име на поста:</label>
                    <input type="text" id="post_title" name="post_title" value="<?=$single_post[0]['post_title'];?>" />
                </div>
                <div class="clearfix">
                    <label>Автор на поста:</label>
                    <select name="post_author" id="post_author">
                    <?php foreach($author_data as$author_key => $author) :?>
                        <option value="<?=$author['author_id']?>"><?=$author['author_name']?></option>
                    <?php endforeach;?>
                    </select>
                </div>
                <div class="clearfix">
                    <label>Тект на поста:</label>
                    <textarea rows="20" name="post_text" id="post_text"><?=$single_post[0]['post_text'];?></textarea>
                </div>
                <div class="clearfix">
                    <button class="left-btn" type="button" onclick="javscript:submitEditForm();">Записване</button>
                    <button class="right-btn" type="button" onclick="javascript:document.getElementById('postFormEdit').reset();">Изчистване</button>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/post.js" type="text/javascript"></script>
</body>
</html>
