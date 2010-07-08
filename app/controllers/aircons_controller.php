<?php
class AirconsController extends AppController {
	var $name = 'Aircons';
    var $uses = array('Aircon', 'User');
    var $helpers = array('Html', 'Form', 'FileUpload.FileUpload');
    var $components = array('CsvHandler', 'FileUpload.FileUpload');

    function beforeFilter() {
        parent::beforeFilter();
        // only allow to upload Csv file
        $this->FileUpload->allowedTypes(array('text/csv'));
        $this->FileUpload->uploadDir('files');
        $this->FileUpload->fileModel(null);
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

    // display the view to select start and end date.
    // These dates will be transfered to viewReport
    function report() {
    }

    function viewReport() {
        // generate overall report, total hours
        if ($this->data) {
            $startDate = $this->data['Aircon']['start_time'];
            $endDate = $this->data['Aircon']['end_time'];
            $startDate = mktime(0,0,0,$startDate['month'], $startDate['day'], $startDate['year']);
            $endDate = mktime(0,0,0,$endDate['month'], $endDate['day'], $endDate['year']);
            if ($startDate > $endDate) {
                $this->Session->setFlash("Start Date must be before End Date");
                $this->redirect("/aircons/report");
            } else {
                $startDate = date('Y-m-d H:i:s', $startDate);
                $endDate = date('Y-m-d H:i:s', $endDate);

                $usage = $this->User->find('usage', array('start' => $startDate, 'end' => $endDate));
                $report = $this->User->generateReport($usage);
                $this->set('startDate', $startDate);
                $this->set('endDate', $endDate);
                $this->set('report', $report);
            }
        }
    }

    function general() {
        $aircons = $this->Aircon->find('all', array('limit' => 10));
        $this->set('aircons', $aircons);
    }

    function import() {
        if ($this->data) {
            if ($this->FileUpload->success) {
                try {
                    $uploaded = WWW_ROOT.'files'.DS.$this->FileUpload->finalFile;
                    if ($this->CsvHandler->import($uploaded, ",",
                        array('AirconsController', 'processImportedData'),
                        array('context' => $this)
                    )) {
                        // finish processing data
                        $this->Session->setFlash(__("Import Successful"));
                        $this->redirect("/aircons/general");
                    }
                } catch (Exception $e) {
                    $this->Session->setFlash($e->getMessage());
                }
            } else {
                $this->Session->setFlash($this->FileUpload->showErrors());
            }
        }
    }

    function processImportedData($aircon, $args) {
        $context = $args['context'];
        $date = $aircon['Date'];
        $startTime = $aircon['Start Time'];
        $endTime = $aircon['End Time'];
        $userId = $aircon['User'];

        $start = $context->__combineDateAndTime($date, $startTime);
        $end = $context->__combineDateAndTime($date, $endTime);

        if (strtotime($start) > strtotime($end)) {
            throw new Exception(" Start Time is larger than End time. 
                Please check the CSV at ". $date. " from: ". $startTime ." to: ".$endTime);
        }
        $saveData = array(
            'Aircon' => array(
                'start_time' => $start,
                'end_time' => $end,
                'user_id' => $userId
            )
        );

        $context->Aircon->create();
        $context->Aircon->save($saveData, false);
    }

    function __combineDateAndTime($date, $time) {
        $dateTime = strtotime($date.' '.$time);
        return strftime('%F %T', $dateTime);
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
