<div class="form">
<div class="general-header">
Total Minutes Billable from <?php echo $startDate; ?> to <?php echo $endDate; ?>
</div>
<div class="message-blue">
Frog - Bich 
+ Single: <?php echo $report['1']['single']; ?> 
+ Double: <?php echo $report['1']['double']; ?> 
+ Triple: <?php echo $report['1']['triple']; ?>
</div>
<div class="message-red">
Ga - Moon
+ Single: <?php echo $report['2']['single']; ?> 
+ Double: <?php echo $report['2']['double']; ?> 
+ Triple: <?php echo $report['2']['triple']; ?>
</div>
<div class="message-green">
Duy - Tu
+ Single: <?php echo $report['3']['single']; ?> 
+ Double: <?php echo $report['3']['double']; ?> 
+ Triple: <?php echo $report['3']['triple']; ?>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link('General', array('controller' => 'aircons', 'action' => 'general')); ?> </li>
    </ul>
</div>
