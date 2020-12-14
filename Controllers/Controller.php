<?php

    class Controller {
        
        private $requestMethod;
        private $id;
    
        private $classGateway;
    
        public function __construct($requestMethod, $id, $gateway)
        {
            $this->requestMethod = $requestMethod;
            $this->id = $id;
    
            $this->classGateway = new $gateway($db);
        }

        public function processRequest()
        {
            switch ($this->requestMethod) {
                case 'GET':
                    if ($this->id) {
                        require_once('./api/$gateway/get_single.php');
                    } else {
                        require_once('./api/$gateway/get.php');
                    };
                    break;
                case 'POST':
                    require_once('./api/$gateway/post.php');
                    break;
                case 'PUT':
                    require_once('./api/$gateway/put.php');
                    break;
                case 'DELETE':
                    require_once('./api/$gateway/delete.php');
                    break;
                default:
                    $response = $this->notFoundResponse();

                    print_r(json_encode($response));
                    /*
                    header($response['status_code_header']);
                    if ($response['body']) {
                        echo $response['body'];
                    }
                    */
                    break;
            }
        }

        private function notFoundResponse()
        {
            $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
            $response['body'] = null;
            return $response;
        }

        /*
        public static function get()
        {
            require_once('./api/landfills/get.php');
        }
        */
    }
    

?>