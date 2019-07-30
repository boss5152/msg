<?php
/* Smarty version 3.1.33, created on 2019-07-23 05:55:01
  from 'C:\xampp\htdocs\msg\Controller\templates\meun_islogin.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d36851570b0a5_90433227',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '56612c2fceee166c9ec2b20835a8a647c62ec0f2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\msg\\Controller\\templates\\meun_islogin.html',
      1 => 1563854100,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d36851570b0a5_90433227 (Smarty_Internal_Template $_smarty_tpl) {
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
        <nav class="navbar navbar-expand-sm bg-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="" id="index"><?php echo $_smarty_tpl->tpl_vars['nickname']->value;?>
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
            </ul>
        </nav>
    </body>
</html>
<?php }
}
