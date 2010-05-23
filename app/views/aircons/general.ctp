<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link('View Report', array('controller' => 'aircons', 'action' => 'report')); ?> </li>
        <li><?php echo $html->link('Add Entry', array('controller' => 'aircons', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div id ="general" class="form">
<div class="general-header"> Latest Entries </div>
<?php
foreach ($aircons as $aircon) {
    switch ($aircon['User']['id']) {
    case 1:
        echo '<div class="message-blue">';
        break;
    case 2:
        echo '<div class="message-red">';
        break;
    case 3:
        echo '<div class="message-green">';
        break;
    }
echo $aircon['User']['name'].' used from '. $aircon['Aircon']['start_time'].' to '. $aircon['Aircon']['end_time'];
echo '</div>';
}
?>
</div>
