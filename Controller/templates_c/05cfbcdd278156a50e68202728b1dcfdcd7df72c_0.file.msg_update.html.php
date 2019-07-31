<?php
/* Smarty version 3.1.33, created on 2019-07-31 06:31:12
  from 'C:\xampp\htdocs\msg\Controller\templates\msg_update.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d411990123568_73377537',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05cfbcdd278156a50e68202728b1dcfdcd7df72c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\msg\\Controller\\templates\\msg_update.html',
      1 => 1564547471,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d411990123568_73377537 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
    <head>
        <meta charset="utf-8">
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
        <p></p>
        <div class="container">
            <div class="form-group">
                <label for="content">內容 : </label>
                <textarea class="form-control" rows="5" name="msgContent" id="msgContent"><?php echo $_smarty_tpl->tpl_vars['msgContent']->value;?>
</textarea>
                <p id="msgContent">內容需介於1到15字</p>
            </div>
                <button class="btn btn-primary" id="btnUpdateMsg" value="<?php echo $_smarty_tpl->tpl_vars['msgId']->value;?>
">修改留言</button>
                <a href="article.php?id=<?php echo $_smarty_tpl->tpl_vars['articleId']->value;?>
" class="btn btn-danger" role="button">取消</a>
        </div>
    </body>
</html><?php }
}
