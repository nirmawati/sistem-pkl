<?php

$this->beginContent('@app/views/layouts/main.php');

\insolita\wgadminlte\LteBox::begin([
    'type' => \insolita\wgadminlte\LteConst::TYPE_INFO,
    'isSolid' => true,
    //'boxTools' => '<button class="btn btn-success btn-xs create_button" ><i class="fa fa-plus-circle"></i> Add</button>',
    'tooltip' => 'this tooltip description',
    //'title' => $this->title,
    //'footer' => 'total 44 active users',
]) ?>
        <?= $content ?>
    <?php \insolita\wgadminlte\LteBox::end() ?>

    <?php $this->endContent(); ?>
