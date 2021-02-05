<div id="categories">
    <?php foreach ($tree as $id => $name): ?>
        <?php echo Html::a(
            $name,
            ['update', 'id'=>$id],
            ['data-pjax'=> '#formsection']) ?>
    <?php endforeach ?>
</div>
<?php Pjax::begin(['id'=>'formsection', 'linkSelector'=>'#categories a']); ?>
<?php Pjax::end(); ?>