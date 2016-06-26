<?php namespace pholder\api\session; ?>
<?php require_once('../../api.php'); ?>
<?php require_once('../common/class/session.php'); ?>
<?php class size extends \pholder\api {




    /** global(s) **/
    private $session = null;




    /** __ - construct - start **/
    public function __construct() {
                $this->session = new \pholder\common\c\session();
        return  $this->get();
    }

    /** __ - desconstruct - end **/
    public function __destruct() {
        return  $this->display_json();
    }


    /** get **/
    private function get() {
        $this->set_response_code(200);
        $this->set_response_data(
            $this->session->get_size()
        );
        return true;
    }


} $size = new size(); ?>
