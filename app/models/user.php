<?php
class User extends AppModel {
	var $name = 'User';
    var $actsAs = array('Containable');
	var $displayField = 'name';
    var $timeFormat = 'Y-m-d H:i:s';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Aircon' => array(
			'className' => 'Aircon',
			'foreignKey' => 'user_id',
			'dependent' => false,
		)
	);

    function __findUsage($options) {
        $start = $options['start'];
        $end = $options['end'];
        // find all air con entries between these two dates
        $conditions = array(
            'AND' => array(
                'Aircon.start_time BETWEEN ? AND ?' => array($start, $end),
                'Aircon.end_time BETWEEN ? AND ?' => array($start, $end)
            )
        );
        $query = am(array('contain' => array('Aircon' => 
            array('conditions' => $conditions))), $options);
        if ($this->isQuery($query)) {
            return $query;
        }
        return parent::find('all', $query);
    }

    /**
     * Generate report from find('usage')
     *
     * @author dqminh
     */
    function generateReport($result) {
        // remove all user that has no Aircon entries
        $result = $this->__removeNoAirconUser($result);
        
        // extract only Aircon entries
        $airCons = Set::extract('/Aircon', $result);
        
        // sort all Aircon entries asc
        $sorted = Set::sort($airCons, '{n}.Aircon.start_time', 'asc');

        // get one-day entries first
        $currentIndex = 0;
        $oneDayArray = array();
        $totalSummary = array(
            '1' => array('single' => 0, 'double' => 0, 'triple' => 0),
            '2' => array('single' => 0, 'double' => 0, 'triple' => 0),
            '3' => array('single' => 0, 'double' => 0, 'triple' => 0),
        );
        while (count($sorted) >= ($currentIndex + 1) ) {
            $oneDayArray = $this->__getOneDayOfEntries($currentIndex, $sorted);         // correct
            $summary = $this->__processOneDayEntries($oneDayArray);
            $this->__mergeSummary($totalSummary, $summary);
        }
        $this->beautifyResult($totalSummary);
        return $totalSummary;
    }

    function __mergeSummary(&$totalSummary, $summary) {
        foreach ($totalSummary as $i => &$room) {
            foreach ($room as $j => $value) {
                $room[$j] += $summary[$i][$j];
            }
        }
    }

    /*
     * find total usage include matched and non-matched
     */
    function __processOneDayEntries($entries) {
        $totalBillable = $this->__getTotalBillable($entries);
        // because we only have 3 rooms
        $summary = array(
            '1' => array('single' => 0, 'double' => 0, 'triple' => 0),
            '2' => array('single' => 0, 'double' => 0, 'triple' => 0),
            '3' => array('single' => 0, 'double' => 0, 'triple' => 0),
        );
        // add everything to single first
        foreach ($entries as $entry) {
            $summary[$entry['Aircon']['user_id']]['single'] += $entry['Aircon']['duration'];
        }

        // start searching sequentially ( performance is bad here )
        // need comment to explain
        $i = 0;
        while ($i < count($entries)) {
            $current =& $entries[$i];
            $startFirst = strtotime($current['Aircon']['start_time']);
            $endFirst = strtotime($current['Aircon']['end_time']);
            for ($j = $i+1 ; $j < count($entries) ; $j++ ) {
                $evaluate =& $entries[$j];
                if ( $evaluate['Aircon']['user_id'] == $current['Aircon']['user_id']) {
                    continue;
                }
                $startSecond = strtotime($evaluate['Aircon']['start_time']);
                $endSecond = strtotime($evaluate['Aircon']['end_time']);
                $common = 0;
                $common = $this->getCommonTime($startFirst, $endFirst, $startSecond, $endSecond);
                $summary[$current['Aircon']['user_id']]['double'] += $common;
                $summary[$current['Aircon']['user_id']]['single'] -= $common;
                $summary[$evaluate['Aircon']['user_id']]['double'] += $common;
                $summary[$evaluate['Aircon']['user_id']]['single'] -= $common;
            }
            $i++;
        }

        // process the summary to get the final summary
        $tripleTime = min($summary[1]['single'], $summary[2]['single'], $summary[3]['single']);
        foreach ($summary as &$s) {
            $s['single'] = $s['single'] - $tripleTime;
            $s['triple'] = abs($tripleTime);
            $s['double'] = $s['double'] - 2*abs($tripleTime);
        }
        return $summary;
    }

    function beautifyResult(&$totalSummary) {
        foreach ($totalSummary as $i => &$room) {
            foreach ($room as $j => $value) {
                $room[$j] = ceil($value/3600);
            }
        }
    }

    function getCommonTime($startFirst, $endFirst, $startSecond, $endSecond) {
        $differentStart = $startSecond - $startFirst;
        $differentEnd = $endSecond - $endFirst;
        $common =  (($endFirst - $startFirst) + ($endSecond - $startSecond) - abs($differentStart) - abs($differentEnd)) / 2;
        if ($common < 0) $common = 0;
        return $common;
    }

    // correct
    function __getTotalBillable(&$entries) {
        $totalBillable = 0;
        foreach ($entries as &$entry) {
            $start = strtotime($entry['Aircon']['start_time']);
            $end = strtotime($entry['Aircon']['end_time']);
            $duration = $end - $start;
            $entry['Aircon']['duration'] = $duration;
            $totalBillable += $duration;
        }
        return $totalBillable;
    }

    // correct
    function __getOneDayOfEntries(&$currentIndex, $sorted) {
        $oneDayArray = array();
        $currentTime = strtotime($sorted[$currentIndex]['Aircon']['start_time']);
        $currentDay = date('d', $currentTime);
        $tmp = $currentIndex;
        for ($i = $tmp; $i < count($sorted); $i++) {
            $checkDay = date('d', strtotime($sorted[$i]['Aircon']['start_time']));
            if (!($checkDay > $currentDay)) { 
                // because the array is sorted, we only check for day matched
                $oneDayArray[] = $sorted[$i];
                $currentIndex++;
            } else {
                $currentIndex = $i;
                break;
            }
        }
        return $oneDayArray;
    }

    // correct
    function __removeNoAirconUser($result) {
        foreach ($result as $key => $r) {
            if (empty($r['Aircon'])) {
                unset($result[$key]);
            }
        }
        return $result;
    }
}
?>
