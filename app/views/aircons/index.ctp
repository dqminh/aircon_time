<div class="aircons index">
	<h2><?php __('Aircons');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('start_time');?></th>
			<th><?php echo $this->Paginator->sort('end_time');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($aircons as $aircon):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $aircon['Aircon']['id']; ?>&nbsp;</td>
		<td><?php echo $aircon['Aircon']['start_time']; ?>&nbsp;</td>
		<td><?php echo $aircon['Aircon']['end_time']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($aircon['User']['name'], array('controller' => 'users', 'action' => 'view', $aircon['User']['id'])); ?>
		</td>
		<td><?php echo $aircon['Aircon']['created']; ?>&nbsp;</td>
		<td><?php echo $aircon['Aircon']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $aircon['Aircon']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $aircon['Aircon']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $aircon['Aircon']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $aircon['Aircon']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Aircon', true)), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Users', true)), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('User', true)), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>