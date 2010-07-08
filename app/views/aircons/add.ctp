<div class="aircons form">
<h2> Current User is <?php echo $session->read('User.name'); ?></h2>
<?php echo $this->Form->create('Aircon');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Aircon', true)); ?></legend>
	<?php
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
        echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $session->read('User.id')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link('View Report', array('controller' => 'aircons', 'action' => 'report')); ?> </li>
		<li><?php echo $this->Html->link('General', array('controller' => 'aircons', 'action' => 'general')); ?> </li>
		<li><?php echo $this->Html->link('Import Entries', array('controller' => 'aircons', 'action' => 'import')); ?> </li>
	</ul>
</div>
