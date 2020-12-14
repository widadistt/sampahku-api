<?php

    class Controller {
        
        private $requestMethod;
        private $id;
    
        private $classGateway;
    
        public function __construct($gateway)
        {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = explode( '/', $uri );
        
            $id = null;
            if (isset($uri[3])) {
                $id = $uri[3];
            }

            $requestMethod = $_SERVER["REQUEST_METHOD"];

            $this->requestMethod = $requestMethod;
            $this->id = $id;
            $this->classGateway = $gateway;
        }

        public function processRequest()
        {
            switch ($this->requestMethod) {
                case 'GET':
                    if ($this->id) {
                        require_once('./api/'.$this->classGateway.'/get_single.php');
                    } else {
                        require_once('./api/'.$this->classGateway.'/get.php');
                    };
                    break;
                case 'POST':
                    require_once('./api/'.$this->classGateway.'/post.php');
                    break;
                case 'PUT':
                    require_once('./api/'.$this->classGateway.'/put.php');
                    break;
                case 'DELETE':
                    require_once('./api/'.$this->classGateway.'/delete.php');
                    break;
                default:
                    $response = $this->notFoundResponse();
                    print_r(json_encode($response));
                    break;
            }
        }

        private function notFoundResponse()
        {
            $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
            $response['body'] = null;
            return $response;
        }
    }
    

?>