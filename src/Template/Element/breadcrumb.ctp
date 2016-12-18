<?php

use Cake\Utility\Inflector;

/**
 * 
 */
$breadcrumb = [];

/**
 * 
 */
if (trim($this->request->url) != ''):
    array_push($breadcrumb, [
        'class' => '',
        'href' => $this->Url->build('/'),
        'label' => __('Home')
    ]);
endif;

/**
 * 
 */
if (trim($this->request['plugin']) != '') {
    array_push($breadcrumb, [
        'class' => '',
        'href' => $this->Url->build('/' . Inflector::slug(trim($this->request['plugin']))),
        'label' => Inflector::humanize(trim($this->request['plugin']))
    ]);
}

/**
 * 
 */
if (trim($this->request['controller']) != 'Pages') {
    array_push($breadcrumb, [
        'class' => '',
        'href' => $this->Url->build(['controller' => Inflector::slug(trim($this->request['controller'])), 'action' => 'index']),
        'label' => Inflector::humanize(trim($this->request['controller']))
    ]);

    array_push($breadcrumb, [
        'class' => 'active',
        'href' => '',
        'label' => Inflector::humanize(trim($this->request['action']))
    ]);
} else {
    array_push($breadcrumb, [
        'class' => 'active',
        'href' => '',
        'label' => Inflector::humanize(trim($this->request->params['pass'][0]))
    ]);
}
?>
<ol class="breadcrumb">
    <?php
    foreach ($breadcrumb as $row) :
        if ($row['class'] == 'active')
            echo '<li class="active">' . $row['label'] . '</li>';
        else
            echo '<li><a href="' . $row['href'] . '">' . $row['label'] . '</a></li>';
    endforeach;
    ?> 
</ol>