# 1°) hairdresser-front installation


# 2°) Doc to templating php Symfony 4.4
https://symfony.com/doc/4.4/templating/PHP.html

## Create link beetween pages
````
<a href="<?= $view['router']->path('hello', ['name' => 'Thomas']) ?>">
    Greet Thomas!
</a>
````

## Create assets
````
<script type="text/javascript" src="<?= $view['assets']->getUrl('js/revolution/jquery.themepunch.tools.min.js')?>"></script>
````

## Create custom block
````
<?php 
$view['slots']->output('custom-name', '') 
?>
````

## Render custom block 
````
<?php $view['slots']->start('custom-name') ?>
    Some html or js content
<?php $view['slots']->stop() ?>
````

# 3°) Doc vuejs
https://fr.vuejs.org/v2/guide/index.html
