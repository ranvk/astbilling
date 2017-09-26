<?php

$items = Yii::$app->user->identity->id == 1 ?
    [
        ['label' => '菜单列表', 'options' => ['class' => 'header']],
        ['label' => '首页', 'icon' => 'file-code-o', 'url' => ['/site']],
        ['label' => '通话记录', 'icon' => 'file-code-o', 'url' => ['/cdr']],
        ['label' => '用户管理', 'icon' => 'file-code-o', 'url' => ['/user']],
        ['label' => '中继号码', 'icon' => 'file-code-o', 'url' => ['/phone']],
        ['label' => '服务器集群', 'icon' => 'file-code-o', 'url' => ['/service']],
        ['label' => '呼入白名单', 'icon' => 'file-code-o', 'url' => ['/whitelist']],
    ] :
    [
        ['label' => '菜单列表', 'options' => ['class' => 'header']],
        ['label' => '首页', 'icon' => 'file-code-o', 'url' => ['/site']],
        ['label' => '通话记录', 'icon' => 'file-code-o', 'url' => ['/cdr']],
    ];

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <?= dmstr\widgets\Menu::widget(
        ['options' => ['class' => 'sidebar-menu'],
        'items' => $items,]
        ) ?>

    </section>

</aside>
