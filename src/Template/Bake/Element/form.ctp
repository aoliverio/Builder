<%
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @since         0.1.0
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/
use Cake\Utility\Inflector;

$fields = collection($fields)->filter(function($field) use ($schema) {
    return $schema->columnType($field) !== 'binary';
});
%>
<?php $this->layout = null ?>
<h3 class="page-header"><?= __('<%= Inflector::humanize($action) %> <%= $singularHumanName %>'); ?></h3>
<div>
    <?= $this->Form->create($<%= $singularVar %>) ?>
    <?php
    <%
    foreach ($fields as $field) {
        if (in_array($field, $primaryKey)) {
            continue;
        }
        if (isset($keyFields[$field])) {
            $fieldData = $schema->column($field);
            if (!empty($fieldData['null'])) {
                %>
            echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'label' => '<%= Inflector::humanize($field) %>', 'class' => 'form-control', 'empty' => true]);
                <%
            } else {
                %>
            echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'label' => '<%= Inflector::humanize($field) %>', 'class' => 'form-control']);
                <%
            }
            continue;
        }
        if (!in_array($field, ['created', 'modified', 'created_user', 'modified_user'])) {
            $fieldData = $schema->column($field);
            if (($fieldData['type'] === 'date') && (!empty($fieldData['null']))) {
                %>
            echo $this->Form->input('<%= $field %>', ['label' => '<%= Inflector::humanize($field) %>', 'empty' => true, 'default' => '']);
                <%
            } else {
                %>
            echo $this->Form->input('<%= $field %>', ['label' => '<%= Inflector::humanize($field) %>', 'class' => 'form-control']);
                <%
            }
        }
    }
    if (!empty($associations['BelongsToMany'])) {
        foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
            %>
            echo $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>, 'class' => 'form-control']);
            <%
        }
    }
    %>
    ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>