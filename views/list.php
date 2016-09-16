<!DOCTYPE html>
<html lang="bg">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>BLOG TEMPLATE</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/reset.css" rel='stylesheet' type='text/css' />
    <link href="assets/css/style.css" rel='stylesheet' type='text/css' />
</head>
<body>
    <div class="container clearfix">
        <section class="col-md-8">
        <?php if(!empty($author_top)) : ?><h2 id="longestPost">Най-дългият пост е с автор: <?=$author_top[0]['author_name']?></h2><?php endif;?>
        <?php if(empty($blog_data)) : ?><h2 id="emptyDataMsg">Няма налични постове!</h2><?php endif;?>
        <?php $elephant = rand(0, (count($blog_data) - 1));?>
        <?php foreach($blog_data as $key => $post) :?>
            <article class="post-container <?= ($key==0)? 'pink' : '';?>">
                <div class="post-title"><h3><?=$post['post_title']?></h3></div>
                <div class="author"><?=$post['author_name']?></div>
                <div class="post-date"><?=$post['post_date']?></div>
                <div class="clear"></div>
                <div class="post-text"><?=$post['post_text']?></div>
                <div class="post-btns">
                    <button class="left-btn" type="button" onclick="javscript:editPost(<?=$post['post_id'];?>);">Редактиране</button>
                    <button class="right-btn" type="button" onclick="javscript:daletePost(<?=$post['post_id'];?>);">Изтриване</button>
                </div>
            <?php if($key==$elephant) {?>
                <div class="el-container">
                    <div class="el-first"></div>
                    <div class="el-second">
                        <img src="assets/images/slon.png" alt="slonche" />
                    </div>
                </div>
            <?php }?>
            </article>
        <?php endforeach;?>
        </section>
        <aside class="col-md-4">
            <div class="form-container">
                <h3>Форма за добавяне на Постове</h3>
                <form id="postForm">
                    <div class="clearfix">
                        <label>Име на поста:</label>
                        <input type="text" id="post_title" name="post_title" />
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
                        <textarea rows="20" name="post_text" id="post_text"></textarea>
                    </div>
                    <div class="clearfix">
                        <button class="left-btn" type="button" onclick="javscript:postFormData();">Записване</button>
                        <button class="right-btn" type="button" onclick="javascript:document.getElementById('postForm').reset();">Изчистване</button>
                    </div>
                </form>
            </div>
        </aside>
        <div class="clear"></div>
    </div>
    <script src="assets/js/post.js" type="text/javascript"></script>
</body>
</html>
