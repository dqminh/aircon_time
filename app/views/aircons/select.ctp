<?php
// Select the room you belong to
echo $form->create('Aircon', array('action' => 'select'));
echo $form->input('room', 
    array('options' => array(
        '1' => 'Frog - Bich',
        '2' => 'Moon - Ga',
        '3' => 'Duy - Tu'
    ))
);
echo $form->end('Start');
?>
