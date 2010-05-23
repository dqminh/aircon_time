<?php
class AirconsController extends AppController {
	var $name = 'Aircons';
    var $uses = array('Aircon', 'User');
    var $component = array('CsvHandler');

    function beforeFilter() {
    }

    function select() {
        if ($this->data) {
            $this->Session->write('User.id', $this->data['Aircon']['room']);
            $username = $this->User->find('first', array(
                'conditions' => array('id' => $this->data['Aircon']['room']),
                'recursive' => -1
            ));
            $this->Session->write('User.name', $username['User']['name']);
            // redirect to general
            $this->redirect(array('action' => 'general'));
        }
    }

    function report() {
    }

    function viewReport() {
        // generate overall report, total hours
        if ($this->data) {
            $startDate = $this->data['Aircon']['start_time'];
            $endDate = $this->data['Aircon']['end_time'];
            $startDate = mktime(0,0,0,$startDate['month'], $startDate['day'], $startDate['year']);
            $endDate = mktime(0,0,0,$endDate['month'], $endDate['day'], $endDate['year']);
            $startDate = date('Y-m-d H:i:s', $startDate);
            $endDate = date('Y-m-d H:i:s', $endDate);
            $usage = $this->User->find('usage', array('start' => $startDate, 'end' => $endDate));
            $report = $this->User->generateReport($usage);
            $this->set('startDate', $startDate);
            $this->set('endDate', $endDate);
            $this->set('report', $report);
        }
    }

    function general() {
        $aircons = $this->Aircon->find('all', array('limit' => 10));
        $this->set('aircons', $aircons);
    }

    function import() {
        // TODO: add support for generated data from Google Docs
    }

    function add() {
        if ($this->data) {
            if ($this->Aircon->save($this->data)) {
                $this->Session->setFlash('New Entry is saved successfully');
                $this->redirect(array('action' => 'add'));
            }
        }
    }

    function calculate() {
    }

}
?>
