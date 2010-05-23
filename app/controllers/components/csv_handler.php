<?php
/*
 * CSV handler component
 * @author dqminh
 */
class CsvHandlerComponent extends Object {
    var $controller = false;
    var $settings = array();

    function initialize(&$Controller, $settings = array()) {
        $this->controller = $Controller;
        // import customized settings
    }

    /*
     * The CSV files need to be uploaded first into app/tmp
     * The path will be supplied to this function to perform
     * import operation
     * Callback function will be used to perform further modification
     * to CSV data
     * @author dqminh
     * @param $path
     * @param $delimiter
     * @param $callback_function
     */
    function import($path, $delimiter, $callback_function, $context) {
        $row = 1;
        $header = array();
        // open csv file in read only mode
        if (($handler = fopen($path, 'r')) !== false) {
            // get header array, not limit the length of the line
            while (($data = fgetcsv($handler, 0, $delimiter)) !== false) {
                if ($row == 1) {
                    $header = $data;
                } else {
                    $combined = $this->mergeHeaderAndData($header, $data);
                    // only start callback on non-header row
                    call_user_func($callback_function, $combined, $context);
                }
                $row++;
                // merge $header and $data to get sensible data
            }
            fclose($handler);
            return true;
        }
        return false;
    }

    function mergeHeaderAndData($header, $data) {
        $length = count($data);
        $combined = array();
        for ($i = 0; $i < $length; $i++) {
            $combined[$header[$i]] = $data[$i];
        }
        return $combined;
    } 

    function export() {
        throw new Exception("Operation is not supported");
    }

}
?>
