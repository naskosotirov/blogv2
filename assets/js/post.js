var formValidation = function () {
    var alphaExp = /^[\wа-я _]+$/ig;

    var postTitle = document.getElementById('post_title').value;
    var postText = document.getElementById('post_text').value;

    var el = document.getElementById("post_author");
    var PostAuthor = el.options[el.selectedIndex].value;

    var error = false;
    
    if((!postTitle.match(alphaExp)) || (!postText || postText.length === 0)) {
        error = true;
    }
    
    if(error) {
        alert('Празно/Некоретно попълнено поле от формата!');
        return false;
    }

    return [postTitle, postText, PostAuthor];
}

var postFormData = function() {
    var values;
    values = formValidation();

    if(values){
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var responseObj = JSON.parse(this.responseText);
            if(responseObj.error) {
                alert("Постът не беше успешно добавен!");
            } else {
                createNewPost(responseObj);
                alert("Постът беше успешно добавен!");
                document.getElementById('postForm').reset();
            }
          }
        };

        xhttp.open("POST", "ajax_post.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("post_title="+values[0]+"&post_text="+values[1]+"&post_author="+values[2]);
    }
}

var createNewPost = function(data) {
    var article = document.createElement("article");
    article.className = "post-container pink";
    article.innerHTML = "<div class=\"post-title\"><h3>"+data.postData.post_title+"</h3></div><div class=\"author\">"+data.postData.author_name+"</div><div class=\"post-date\">"+data.postData.post_date+"</div><div class=\"clear\"></div><div class=\"post-text\">"+data.postData.post_text+"</div><div class=\"post-btns\"><button class=\"left-btn\" type=\"button\" onclick=\"javscript:editPost("+data.postData.post_id+");\">Редактиране</button><button class=\"right-btn\" type=\"button\" onclick=\"javscript:daletePost("+data.postData.post_id+");\">Изтриване</button></div>";

    var first = document.getElementsByClassName("post-container");

    if(first[0]) {
        var h2MsgPost = document.getElementById('longestPost');

        h2MsgPost.innerHTML = "Най-дългият пост е с автор: "+data.longestPost.author_name;
        first[0].className = "post-container";
        first[0].parentNode.insertBefore(article, first[0]);
    } else {
        var emptyContainer = document.getElementsByClassName("col-md-8");
        var emptyMsg = document.getElementById('emptyDataMsg');
        var h2Msg = document.createElement("h2");
        
        h2Msg.setAttribute("id", "longestPost");       
        article.innerHTML += "<div class=\"el-container\"><div class=\"el-first\"></div><div class=\"el-second\"><img src=\"assets/images/slon.png\" alt=\"slonche\" /></div></div>";
        h2Msg.innerText = "Най-дългият пост е с автор: "+data.longestPost.author_name;
        emptyContainer[0].removeChild(emptyMsg);
        emptyContainer[0].appendChild(h2Msg);
        emptyContainer[0].appendChild(article);    
    }
}

var editPost = function (id) {
    window.location = "edit.php?id="+id;
}

var daletePost = function (id) {
    if (confirm("Сигурни ли сте, че искате да изтриете този пост?") == true) {
        window.location = "delete.php?id="+id;
    }
}

var submitEditForm = function() {
    document.getElementById("postFormEdit").submit();
}
