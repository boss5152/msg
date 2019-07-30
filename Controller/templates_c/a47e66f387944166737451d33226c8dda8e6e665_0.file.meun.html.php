<?php
/* Smarty version 3.1.33, created on 2019-07-26 08:01:11
  from 'C:\xampp\htdocs\msg\Controller\templates\meun.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3a97279cc257_72485315',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a47e66f387944166737451d33226c8dda8e6e665' => 
    array (
      0 => 'C:\\xampp\\htdocs\\msg\\Controller\\templates\\meun.html',
      1 => 1564120870,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3a97279cc257_72485315 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.4.0/css/bootstrap.min.css">
        <?php echo '<script'; ?>
 src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://cdn.staticfile.org/twitter-bootstrap/3.4.0/js/bootstrap.min.js"><?php echo '</script'; ?>
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
                        <a class="nav-link" href="index.php?" id="index">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php?" id="index">登出</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php?" id="login"><span>登入<span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php?" id="register"><span>註冊<span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?" id="index">首頁</a>
                    </li>
                <?php }?>
            </ul>
        </nav>
    </body>
</html>
<?php }
}
