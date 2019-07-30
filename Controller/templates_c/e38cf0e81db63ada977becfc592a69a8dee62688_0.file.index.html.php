<?php
/* Smarty version 3.1.33, created on 2019-07-30 15:15:58
  from 'C:\xampp\htdocs\msg\Controller\templates\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d40430e749244_87814295',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e38cf0e81db63ada977becfc592a69a8dee62688' => 
    array (
      0 => 'C:\\xampp\\htdocs\\msg\\Controller\\templates\\index.html',
      1 => 1564492554,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d40430e749244_87814295 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <title>留言板</title>
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
    <style>
        th{
            text-align: center;
        }
        td{
            text-align: center;
        }
        .col-fixed-title {
            width: 120px;
        }
        .col-fixed-content {
            width: 450px;
        }
        .col-fixed-user {
            width: 10%;
        }
        .col-fixed-date {
            width: 20%;
        }
        .col-fixed-view {
            width: 10%;
        }
        #title{
            width: 120px;
            overflow:hidden;
            text-overflow:ellipsis;
            white-space:nowrap;
        }
        #content{
            width: 450px;
            overflow:hidden;
            text-overflow:ellipsis;
            white-space:nowrap;
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
            <h2>留言板</h2>       
            <table class="table table-hover">
                <thead>
                    <tr class="success">
                        <th class="col-fixed-title">標題</th>
                        <th class="col-fixed-content">內容</th>
                        <th>發文者</th>
                        <th>發表時間</th>
                        <th class="col-fixed-view">瀏覽</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['articleObj']->value, 'articleData');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['articleData']->value) {
?>
                    <tr>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['articleData']->value['title'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['articleData']->value['content'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['articleData']->value['nickName'];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['articleData']->value['createDate'];?>

                        </td>
                        <td class="col-fixed-view">
                            <a href="article.php?id=<?php echo $_smarty_tpl->tpl_vars['articleData']->value['articleId'];?>
" class="btn btn-info col-md-10" role="button">瀏覽</a>
                        </td>
                    </tr>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </tbody>
            </table>
        </div>
        <div class="text text-center">
            <ul class="pagination">
                <?php
$_smarty_tpl->tpl_vars['page'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['page']->step = 1;$_smarty_tpl->tpl_vars['page']->total = (int) ceil(($_smarty_tpl->tpl_vars['page']->step > 0 ? $_smarty_tpl->tpl_vars['endPage']->value+1 - ($_smarty_tpl->tpl_vars['firstPage']->value) : $_smarty_tpl->tpl_vars['firstPage']->value-($_smarty_tpl->tpl_vars['endPage']->value)+1)/abs($_smarty_tpl->tpl_vars['page']->step));
if ($_smarty_tpl->tpl_vars['page']->total > 0) {
for ($_smarty_tpl->tpl_vars['page']->value = $_smarty_tpl->tpl_vars['firstPage']->value, $_smarty_tpl->tpl_vars['page']->iteration = 1;$_smarty_tpl->tpl_vars['page']->iteration <= $_smarty_tpl->tpl_vars['page']->total;$_smarty_tpl->tpl_vars['page']->value += $_smarty_tpl->tpl_vars['page']->step, $_smarty_tpl->tpl_vars['page']->iteration++) {
$_smarty_tpl->tpl_vars['page']->first = $_smarty_tpl->tpl_vars['page']->iteration === 1;$_smarty_tpl->tpl_vars['page']->last = $_smarty_tpl->tpl_vars['page']->iteration === $_smarty_tpl->tpl_vars['page']->total;?>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['nowPage']->value) {?>
                        <li class="active"><a href="?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a></li>
                    <?php } else { ?>
                        <li><a href="?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a></li>
                    <?php }?>
                <?php }
}
?>
            </ul>
        </div>
    </body>
</html><?php }
}
