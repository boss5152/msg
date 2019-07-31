/*
 *  前端檢查
 */
$(document).ready(function(){
    //暱稱
    $("#nickName").keyup(function(){
        var stringNickName = $("#nickName").val();
        ((stringNickName.length > 5) || (stringNickName.length < 1) || (/[^A-Za-z0-9]/.test(stringNickName)))
         ? errorNickName()
         : $("#msgNickName").html("");
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
    $("#msgContent").keyup(function(){
        var stringMsgContent = $("#msgContent").val();
        ((stringMsgContent.length > 15) || (stringMsgContent.length < 1) )
            ? errorMsgContent(stringMsgContent.length)
            : correctMsgContent(stringMsgContent.length);
    });
});

//暱稱驗證
//沒過
function errorNickName(){
    $("#msgNickName").html("暱稱需介於一到五字且不可有空白等特殊字元");
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
    $("#msgContentTips").html("內容需介於1到15字，您現在長度為" + msgContentLength + "字");
    $("#btnAddMsg").attr('disabled', true);
    $("#btnUpdateMsg").attr('disabled', true);
}
//有過
function correctMsgContent(msgContentLength){
    $("#msgContentTips").html("您現在長度為" + msgContentLength + "字");
    $("#btnAddMsg").attr('disabled', false);
    $("#btnUpdateMsg").attr('disabled', false);
}

function btnCanClick(){
    var msgNickName = $("#msgNickName").html();
    var msgAccount = $("#msgAccount").html();
    var msgPassword = $("#msgPassword").html();
    var stringTitle = $("#title").val();
    var stringContent = $("#content").val();
    if ((msgNickName === "") && (msgAccount === "") && (msgPassword === "")) {
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
        var nickName = $("#nickName").val();
        var account = $("#account").val();
        var password = $("#password").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/register.php",
            dataType: "json",
            data: {
                'nickName' : nickName,
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
        var articleId = $("#btnDeleteArt").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/delete.php",
            dataType: "json",
            data: {
                'articleId': articleId
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
        var articleId = $("#btnUpdateArt").val();
        var title = $("#title").val();
        var content = $("#content").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/update.php",
            dataType: "json",
            data: {
                'title': title,
                'content': content,
                'articleId': articleId
            },
            success: function(data) {
                if (data.isUpdate === true){
                    alert(data.tips);
                    self.location = "article.php?id=" + data.articleId;
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
        var msgContent = $("#msgContent").val();
        var articleId = $("#btnAddMsg").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/msg_add.php",
            dataType: "json",
            data: {
                'articleId' : articleId,
                'msgContent' : msgContent
            },
            success: function(data) {
                if (data.isAddMsg === true){
                    alert(data.tips);
                    self.location = "article.php?id=" + data.articleId;
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
        var msgContent = $("#msgContent").val();
        var msgId = $("#btnUpdateMsg").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/msg_update.php",
            dataType: "json",
            data: {
                'msgId' : msgId,
                'msgContent' : msgContent
            },
            success: function(data) {
                if (data.isUpdateMsg === true){
                    alert(data.tips);
                    self.location = "article.php?id=" + data.articleId;
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
        var msgId = $("#btnDeleteMsg").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/msg/Controller/msg_delete.php",
            dataType: "json",
            data: {
                'msgId' : msgId,
            },
            success: function(data) {
                if (data.isDeleteMsg === true){
                    alert(data.tips);
                    $("#" + data.msgId).remove();
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
