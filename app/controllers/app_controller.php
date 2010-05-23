<?php
class AppController extends Controller {
    var $component = array('Auth', 'Session');

    function beforeFilter() {
        // before we can add ( or want to ) Auth, just allow all 
        $this->Auth->allow('*');
    }

}
?>
