/*
 *  前端檢查
 */
$(document).ready(function(){
    //暱稱
    $("#nickname").keyup(function(){
        var stringNickname = $("#nickname").val();
        ((stringNickname.length > 5) || (stringNickname.length < 1) || (/[^A-Za-z0-9]/.test(stringNickname)))
         ? errorNickname()
         : $("#msgNickname").html("");
        btnCanClick();
    });
    //帳號
    $("#account").keyup(function(){
        var stringAccount = $("#account").val();
        ((stringAccount.length > 12) || (stringAccount.length < 2) || (/[^A-Za-z0-9]/.test(stringAccount)))
         ? errorAccount()
         : $("#msgAccount").html("");
        btnCanClick();
    });
    //密碼
    $("#password").keyup(function(){
        var stringPassword = $("#password").val();
        ((stringPassword.length > 12) || (stringPassword.length < 2) || (/[^A-Za-z0-9]/.test(stringPassword)))
         ? errorPassword()
         : $("#msgPassword").html("");
        btnCanClick();
    });
    //標題
    $("#title").keyup(function(){
        var stringTitle = $("#title").val();
        ((stringTitle.length > 10) || (stringTitle.length < 1) )
            ? errorTitle()
            : correctTitle();
        btnCanClick();
    });
    //內容
    $("#content").keyup(function(){
        var stringContent = $("#content").val();
        ((stringContent.length > 100) || (stringContent.length < 1) )
            ? errorContent(stringContent.length)
            : correctContent(stringContent.length);
        btnCanClick();
    });
    //留言內容
    $("#msg_content").keyup(function(){
        var stringMsgContent = $("#msg_content").val();
        ((stringMsgContent.length > 15) || (stringMsgContent.length < 1) )
            ? errorMsgContent(stringMsgContent.length)
            : correctMsgContent(stringMsgContent.length);
        btnCanClick();
    });
});

//暱稱驗證
//沒過
function errorNickname(){
    $("#msgNickname").html("暱稱需介於一到五字且不可有空白等特殊字元");
    $("#btnRegister").attr('disabled', true);
}

//帳號驗證
//沒過
function errorAccount(){
    $("#msgAccount").html("帳號需介於2到12字且不可有空白等特殊字元");
    $("#btnRegister").attr('disabled', true);
    $("#btnLogin").attr('disabled', true);
}

//密碼驗證
//沒過
function errorPassword(){
    $("#msgPassword").html("密碼需介於2到12字且不可有空白等特殊字元");
    $("#btnRegister").attr('disabled', true);
    $("#btnLogin").attr('disabled', true);
}

//標題驗證
//沒過
function errorTitle(){
    $("#msgTitle").html("標題需介於1到10字");
    $("#btnAddArt").attr('disabled', true);
    $("#btnUpdateArt").attr('disabled', true);
}

//內容驗證
//沒過
function errorContent(contentLength){
    $("#msgContent").html("內容需介於1到100字，您現在長度為" + contentLength + "字");
    $("#btnAddArt").attr('disabled', true);
    $("#btnUpdateArt").attr('disabled', true);
}
//有過
function correctContent(contentLength){
    $("#msgContent").html("您現在長度為" + contentLength + "字");
}

//留言內容驗證
//沒過
function errorMsgContent(msgContentLength){
    $("#msgContent").html("內容需介於1到15字，您現在長度為" + msgContentLength + "字");
    $("#btnAddMsg").attr('disabled', true);
    $("#btnUpdateMsg").attr('disabled', true);
}
//有過
function correctMsgContent(msgContentLength){
    $("#msgContent").html("您現在長度為" + msgContentLength + "字");
    $("#btnAddMsg").attr('disabled', false);
    $("#btnUpdateMsg").attr('disabled', false);
}

function btnCanClick(){
    var msgNickname = $("#msgNickname").html();
    var msgAccount = $("#msgAccount").html();
    var msgPassword = $("#msgPassword").html();
    var stringTitle = $("#title").val();
    var stringContent = $("#content").val();
    if ((msgNickname === "") && (msgAccount === "") && (msgPassword === "")) {
        $("#btnRegister").attr('disabled', false);
    }
    if ((msgAccount === "") && (msgPassword === "")) {
        $("#btnLogin").attr('disabled', false);
    }
    if ((stringContent.length <= 100) && (stringContent.length > 0) && (stringTitle.length <= 10) && (stringTitle.length > 0) ){
        $("#btnAddArt").attr('disabled', false);
        $("#btnUpdateArt").attr('disabled', false);
    }
}

//驗證結束-------------


/*
 *  註冊頁面
 */
$(document).ready(function() {
    $("#btnRegister").click(function() {
        var nickname = $("#nickname").val();
        var account = $("#account").val();
        var password = $("#password").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/register.php",
            dataType: "json",
            data: {
                'nickname' : nickname,
                'account' : account, 
                'password' : password 
            },
            success: function(data) {
                if (data.isRegister === true){
                    alert(data.msg);
                    self.location = "login.php";
                } else {
                    console.log(data.errorMsg);
                    alert(data.errorMsg);
                }
            },
            error: function() {
                alert("錯誤請求");
            }
        })
    })        
});

/*
 *  登入頁面
 */
$(document).ready(function() {
    $("#btnLogin").click(function() {
        var account = $("#account").val();
        var password = $("#password").val() ;
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/login.php",
            dataType: "json",
            data: {
                'account': account,
                'password': password
            },
            success: function(data) {
                if (data.isLogin === true){
                    alert("登入成功");
                    self.location = "index.php";
                } else {
                    alert("帳號密碼錯誤");
                }
            },
            error: function() {
                alert("錯誤請求");
            }
        })
    })        
});

/*
 *  新增文章
 */
$(document).ready(function() {
    $("#btnAddArt").click(function() {
        var title = $("#title").val();
        var content = $("#content").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/add.php",
            dataType: "json",
            data: {
                'title': title,
                'content': content
            },
            success: function(data) {
                if (data.isAdd === true){
                    alert(data.tips);
                    self.location = "index.php";
                } else {
                    alert(data.tips);
                }
            },
            error: function() {
                alert("錯誤請求");
            }
        })
    })        
});

/*
 *  刪除文章
 */
$(document).ready(function() {
    $("#btnDeleteArt").click(function() {
        var article_id = $("#btnDeleteArt").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/delete.php",
            dataType: "json",
            data: {
                'article_id': article_id
            },
            success: function(data) {
                if (data.isDelete === true){
                    alert(data.tips);
                    self.location = "index.php";
                } else {
                    alert(data.tips);
                }
            },
            error: function() {
                alert("錯誤請求");
            }
        })
    })        
});

/*
 *  編輯文章
 */
$(document).ready(function() {
    $("#btnUpdateArt").click(function() {
        var article_id = $("#btnUpdateArt").val();
        var title = $("#title").val();
        var content = $("#content").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/update.php",
            dataType: "json",
            data: {
                'title': title,
                'content': content,
                'article_id': article_id
            },
            success: function(data) {
                if (data.isUpdate === true){
                    alert(data.tips);
                    self.location = "article.php?id=" + data.article_id;
                } else {
                    alert(data.tips);
                }
            },
            error: function() {
                alert("錯誤請求");
            }
        })
    })        
});

/*
 *  新增留言
 */
$(document).ready(function() {
    $("#btnAddMsg").click(function() {
        var msg_content = $("#msg_content").val();
        var article_id = $("#btnAddMsg").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/msg_add.php",
            dataType: "json",
            data: {
                'article_id' : article_id,
                'msg_content' : msg_content
            },
            success: function(data) {
                if (data.isAddMsg === true){
                    alert(data.tips);
                    self.location = "article.php?id=" + data.article_id;
                } else {
                    alert(data.tips);
                }
            },
            error: function() {
                alert("錯誤請求");
            }
        })
    })        
});

/*
 *  修改留言
 */
$(document).ready(function() {
    $("#btnUpdateMsg").click(function() {
        var msg_content = $("#msg_content").val();
        var msg_id = $("#btnUpdateMsg").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/msg_update.php",
            dataType: "json",
            data: {
                'msg_id' : msg_id,
                'msg_content' : msg_content
            },
            success: function(data) {
                if (data.isUpdateMsg === true){
                    alert(data.tips);
                    self.location = "article.php?id=" + data.article_id;
                } else {
                    alert(data.tips);
                }
            },
            error: function() {
                alert("錯誤請求");
            }
        })
    })        
});

/*
 *  刪除留言
 */
$(document).ready(function() {
    $("#btnDeleteMsg").click(function() {
        var msg_id = $("#btnDeleteMsg").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/msg_delete.php",
            dataType: "json",
            data: {
                'msg_id' : msg_id,
            },
            success: function(data) {
                if (data.isDeleteMsg === true){
                    alert(data.tips);
                    $("#" + data.msg_id).remove();
                } else {
                    alert(data.tips);
                }
            },
            error: function() {
                alert("錯誤請求");
            }
        })
    })        
});
