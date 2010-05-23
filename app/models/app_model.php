<?php
class AppModel extends Model {

    //http://www.pseudocoder.com/free-cakephp-book/
    function find($type, $options = array()) {
        $method = null;
        if(is_string($type)) {
            $method = sprintf('__find%s', Inflector::camelize($type));
        }
        if($method && method_exists($this, $method)) {
            return $this->{$method}($options);
        } else {
            $args = func_get_args();
            return call_user_func_array(array('parent', 'find'), $args);
        }
    }

    //http://code621.com/content/10/easy-pagination-using-matt-curry-s-custom-find-types
    function isQuery($options = array())	{
        if(isset($options['is_query']) && $options['is_query'] == true)	{
            return true;
        }
        return false;
    }
}
?>
