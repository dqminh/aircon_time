<div class="form">
<h2> Import entries in CSV format. </h2>
<?php echo $this->Form->create('Aircon', array('action' => 'import', 'type' => 'file')); ?>
    <fieldset>
    <?php echo $this->FileUpload->input(array('var' => 'file', 'model' => false)); ?>
    </fieldset>
<?php echo $this->Form->end(__('Import', true)); ?>
</div>
<div class="action">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link('View Report', array('controller' => 'aircons', 'action' => 'report')); ?> </li>
		<li><?php echo $this->Html->link('General', array('controller' => 'aircons', 'action' => 'general')); ?> </li>
	</ul>
</div>
