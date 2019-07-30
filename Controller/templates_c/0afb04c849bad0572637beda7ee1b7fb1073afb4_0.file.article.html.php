<?php
/* Smarty version 3.1.33, created on 2019-07-30 10:09:14
  from 'C:\xampp\htdocs\msg\Controller\templates\article.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3ffb2a5e4f01_14734691',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0afb04c849bad0572637beda7ee1b7fb1073afb4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\msg\\Controller\\templates\\article.html',
      1 => 1564474153,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3ffb2a5e4f01_14734691 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
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
    <style type="text/css" >
        #art_content{
            height: 300px;
        }
        table{
            word-break: break-all;
        }
    </style>
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
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td class="active">標題</td>
                </tr>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['array_article']->value['title'];?>
</td>
                </tr>
                <tr>
                    <td class="active">內容</td>
                </tr>
                <tr>
                    <td id="art_content"><?php echo $_smarty_tpl->tpl_vars['array_article']->value['content'];?>
</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="container">
        <?php if (isset($_smarty_tpl->tpl_vars['nickname']->value)) {?>
            <a href="msg_add.php?id=<?php echo $_smarty_tpl->tpl_vars['article_id']->value;?>
" class="btn btn-success col-sm-0.5" role="button">回覆</a>
            <?php if ($_smarty_tpl->tpl_vars['array_article']->value['user_id'] == $_smarty_tpl->tpl_vars['user_id']->value) {?>
                <a href="update.php?id=<?php echo $_smarty_tpl->tpl_vars['article_id']->value;?>
" class="btn btn-primary col-sm-0.5" role="button">編輯</a>
                <button class="btn btn-danger offset-sm-4" type="button" id="btnDeleteArt" value="<?php echo $_smarty_tpl->tpl_vars['array_article']->value['article_id'];?>
">刪除</button>
            <?php }?>
        <?php }?>
    </div>
    <hr>
    <div class="container">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrays_msg']->value, 'array_msg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['array_msg']->value) {
?>
            <div id="<?php echo $_smarty_tpl->tpl_vars['array_msg']->value['msg_id'];?>
">
                <tr>
                    <td>
                        留言者 : <?php echo $_smarty_tpl->tpl_vars['array_msg']->value['msg_name'];?>
 <br>
                    </td>
                    <td>
                        內容 : <?php echo $_smarty_tpl->tpl_vars['array_msg']->value['msg_content'];?>
 <br>
                    </td>
                    <td>
                        留言時間 : <?php echo $_smarty_tpl->tpl_vars['array_msg']->value['msg_date'];?>
 <br>
                    </td>
                    <?php if (isset($_smarty_tpl->tpl_vars['nickname']->value) && $_smarty_tpl->tpl_vars['array_msg']->value['user_id'] == $_smarty_tpl->tpl_vars['user_id']->value) {?>
                        <a href="msg_update.php?id=<?php echo $_smarty_tpl->tpl_vars['array_msg']->value['msg_id'];?>
" class="btn btn-success col-sm-0.5" role="button">編輯</a>
                        <button class="btn btn-danger offset-sm-4" type="button" id="btnDeleteMsg" value="<?php echo $_smarty_tpl->tpl_vars['array_msg']->value['msg_id'];?>
">刪除</button>
                    <?php }?>
                </tr>
                <hr>
            </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
</body>
</html><?php }
}
