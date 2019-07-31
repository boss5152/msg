<?php
/* Smarty version 3.1.33, created on 2019-07-31 04:32:37
  from 'C:\xampp\htdocs\msg\Controller\templates\add.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d40fdc58e1114_64891710',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e20fc9a2d48c7c4204b91f10cd94544b230238c7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\msg\\Controller\\templates\\add.html',
      1 => 1564540356,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d40fdc58e1114_64891710 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>新增</title>
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.4.0/css/bootstrap.min.css">
        <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://cdn.staticfile.org/twitter-bootstrap/3.4.0/js/bootstrap.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="http://localhost/msg/Controller/javascript/tool.js"><?php echo '</script'; ?>
>
    </head>
    <style type="text/css">
        #content{
            height: 300px;
        }
    </style>
    <body>
        <nav class="nav nav-tabs">
            <ul class="nav navbar-nav">
                <?php if (isset($_smarty_tpl->tpl_vars['nickName']->value)) {?>
                    <li class="nav-item">
                        <a class="nav-link" ><?php echo $_smarty_tpl->tpl_vars['nickName']->value;?>
</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add.php?" id="add">發文</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=1" id="index">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php?" id="logout">登出</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php?" id="login"><span>登入<span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php?" id="register"><span>註冊<span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=1" id="index">首頁</a>
                    </li>
                <?php }?>
            </ul>
        </nav>
        <div class="container">
            <h2>新增文章</h2>
            <hr>
                <div class="form-group">
                    <label>標題</label>
                    <textarea
                        type="text" class="form-control" name="title" id="title" 
                        placeholder="中英數上限10字" 
                    ></textarea>
                    <p id="msgTitle">標題需介於1到10字</p>
                </div>
                <div class="form-group">
                    <label>內容</label>
                    <textarea 
                        type="textarea" class="form-control" wrap="hard"
                        name="content" id="content" placeholder="中英數上限100字" 
                    ></textarea>
                        <p id="msgContent">內容需介於1到100字</p>
                </div>
                <div class="form-group">       
                    <button class="btn btn-primary offset-sm-4" type="button" id="btnAddArt" disabled="true">完成</button>
                    <a href="index.php?page=1" class="btn btn-danger offset-sm-3" role="button">取消</a>
                </div>
        </div>
    </body>
</html><?php }
}
