<?php namespace pholder; ?>
<?php class api {




    /** global(s) **/
    private $response_code = null;
    private $response_data = array();




    /** display - json **/
    public function display_json() {
        http_response_code($this->response_code);
        header('Content-Type: application/json');
        echo json_encode($this->response_data);
    }

    /** display - error **/
    public function display_json_error($msg = null) {
        if( $msg ){
            $this->set_response_data(array('message' => $msg));
        }
        return $this->display_json();
    }


    /** download **/
    public function download($file) {
        if( $this->response_code == 200 ){
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
        }
        http_response_code($this->response_code);
    }


    /** get - files - details **/
    public function get_files_details($base, $files) {
                $files_with_details = array();
                foreach($files as $file) {
                    $files_with_details[] = $this->get_file_details($base, $file);
                }
        return  $files_with_details;
    }

    /** get - file - details **/
    public function get_file_details($base, $file) {
                $details = array();
                $details['name'] = basename($file);
                $details['path'] = realpath($file);
                $details['hash'] = md5($details['path']);
                $details['dir']  = is_dir($details['path']);
                $details['icon'] = $this->get_file_icon($details['path']);
        return  $details;
    }

    /** get - file - icon **/
    public function get_file_icon($path) {
        switch($path) {
            case is_dir($path):
                return 'folder_open';
            default:
                return 'insert_drive_file';
        }
    }


    /** set - response - code **/
    public function set_response_code($code) {
        $this->response_code = $code;
    }

    /** set - response - data **/
    public function set_response_data($data) {
        $this->response_data = $data;
    }


}?>