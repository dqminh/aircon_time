<div class="aircons form">
<h2> Current User is <?php echo $session->read('User.name'); ?></h2>
<?php echo $this->Form->create('Aircon', array('action' => 'viewReport'));?>
	<fieldset>
	<?php
		echo $this->Form->input('start_time', array('type' => 'date'));
		echo $this->Form->input('end_time', array('type' => 'date'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link('View Report', array('controller' => 'aircons', 'action' => 'report')); ?> </li>
		<li><?php echo $this->Html->link('General', array('controller' => 'aircons', 'action' => 'general')); ?> </li>
	</ul>
</div>
