<?php
/* Smarty version 3.1.33, created on 2019-07-31 07:39:43
  from 'C:\xampp\htdocs\msg\Controller\templates\update.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d41299fdda910_13968637',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04ae53d75e270186fe24892fe86311ac6076916a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\msg\\Controller\\templates\\update.html',
      1 => 1564547463,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d41299fdda910_13968637 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html> 
<html> 
    <head> 
        <meta charset="UTF-8"/>
        <title>編輯</title>
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
    <style>
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
            <h2>編輯文章</h2>
            <hr>
                <div class="form-group">
                    <label>標題 : </label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
">
                    <p id="msgTitle"></p>
                </div>
                <div class="form-group">
                    <label>內容 : </label>
                    <textarea type="textarea" class="form-control" 
                        name="content" id="content"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</textarea>
                    <input type="hidden" name="articleId" value="<?php echo $_smarty_tpl->tpl_vars['articleId']->value;?>
">
                    <p id="msgContent">內容需介於1到15字</p>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary offset-sm-3" id="btnUpdateArt" value="<?php echo $_smarty_tpl->tpl_vars['articleId']->value;?>
">確定</button>
                    <a href="article.php?id=<?php echo $_smarty_tpl->tpl_vars['articleId']->value;?>
" class="btn btn-danger offset-sm-2" role="button">取消</a>
                </div>
        </div>
    </body>
</html<?php }
}
