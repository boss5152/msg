<?php
/* Smarty version 3.1.33, created on 2019-07-30 08:37:18
  from 'C:\xampp\htdocs\msg\Controller\templates\register.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3fe59e1a10a9_96644490',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a1eaaa2f80671e593537b20d22b4e80698a27b48' => 
    array (
      0 => 'C:\\xampp\\htdocs\\msg\\Controller\\templates\\register.html',
      1 => 1564468637,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3fe59e1a10a9_96644490 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
    <head>
        <meta charset="UTF-8"/>
        <title>註冊</title>
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
    <body>
        <nav class="nav nav-tabs">
            <ul class="nav navbar-nav">
                <?php if (isset($_smarty_tpl->tpl_vars['nickname']->value)) {?>
                    <li class="nav-item">
                        <a class="nav-link" ><?php echo $_smarty_tpl->tpl_vars['nickname']->value;?>
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
        <p></p>
        <div class="container col-md-4 col-md-offset-4">
                <div class="form-group">
                    <label>您的暱稱 : </label>
                    <input type="text" class="form-control" name="nickname" id="nickname" placeholder="中英數上限5字">
                    <p id="msgNickname">暱稱需介於一到五字且不可有空白等特殊字元</p>
                </div>
                <div class="form-group">
                    <label for="account">帳號 : </label>
                    <input type="text" class="form-control" name="account" id="account" placeholder="英數2碼以上12碼以下">
                    <p id="msgAccount">帳號需介於2到12字且不可有空白等特殊字元</p>
                </div>
                <div class="form-group">
                    <label for="password">密碼 : </label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="英數2碼以上12碼以下">
                    <p id="msgPassword">密碼需介於2到12字且不可有空白等特殊字元</p>
                </div>
                <div class="form-group">
                    <button id="btnRegister" type="button" class="btn btn-primary offset-sm-3" disabled="true">註冊</button>
                    <a href="index.php?page=1" class="btn btn-danger offset-sm-3" role="button">取消</a>
                </div>
        </div>
    </body>
</html><?php }
}
