<aside class="main-sidebar">
    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Разделы', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Блог',
                        'icon' => 'list',
                        'items' => [
                            ['label' => 'Разделы', 'icon' => 'folder', 'url' => ['/article/article-category']],
                            ['label' => 'Статьи', 'icon' => 'list-alt', 'url' => ['/article/article']],
                        ],
                    ],
                    ['label' => 'Страницы', 'icon' => 'file', 'url' => ['/page/page']],
                    ['label' => 'Товары', 'icon' => 'shopping-cart', 'url' => ['/goods/good']],
                    ['label' => 'Настройки', 'icon' => 'cog', 'url' => ['/site/settings']],
                    ['label' => 'Администраторы', 'icon' => 'user', 'url' => ['/administrator']],
                    ['label' => 'Sitemap', 'icon' => 'file-code-o', 'url' => ['/site/sitemap']],
                    ['label' => 'Служебное', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>
</aside>
