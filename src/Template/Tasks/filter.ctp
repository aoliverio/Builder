<?php $this->layout = null ?>
<h4><?= __('Filter Task'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($task); ?>
    <?= $this->Form->input('roles._ids', ['options' => $roles, 'class' => 'form-control']); ?>
    <hr/>
    <div class="text-center">
        <button class="btn btn-success" type="submit"><?= __('Filter'); ?></button>  
    </div>
    <?= $this->Form->end(); ?>
</div>