<?php

/**
 * Simple controller functions - looks at request, calls needed methods, loads appropriate views.
 */
require_once APP_PATH . '/Property.php';
require_once APP_PATH . '/SaleHistory.php';

class SimpleController {

    private $routes;
    private $request;
    private $dataMapper;
    private $recsPerPage;

    public function __construct() {
        $this->request = new Request();
        $config = new ConfigIni();
        $this->routes = $config->getConfigSection('routes');
        $this->recsPerPage = $config->getConfigItem('perpage', 'paginator');
        $this->dataMapper = new DataMapper();
    }

    /**
     * Entry point of this class. From here we call all private methods that are responsible for
     * all actions of the app.
     * 
     * @param string $action
     */
    public function run($action) {
        try {
            if (method_exists($this, $action)) {
                $this->$action();
            } else {
                $this->indexPage();
            }
        } catch (Exception $e) {
            $this->errorPage('Something really unexpected happend. Error message: ' . $e->getMessage(), $e);
        }
    }

    private function addProperty() {
        //Destroy session data - we will not need it so far
        session_destroy();
        if ($this->request->isGet()) {
            // Load form for adding new record
            include APP_PATH . '/views/header.php';
            include APP_PATH . '/views/add-property.php';
            include APP_PATH . '/views/footer.php';
        } else {
            // Validate received data. Assume that all fields are required
            $property = new Property($this->request->getParams());
            if ($property->isValid()) {
                $recordId = $this->dataMapper->saveProperty($property);
                $router = new Router();
                $this->run($router->redirect(array('action' => 'property', 'id' => $recordId)));
            } else {
                $errors = 'There are errors on the form';
                include APP_PATH . '/views/header.php';
                include APP_PATH . '/views/add-property.php';
                include APP_PATH . '/views/footer.php';
            }
        }
    }

    /**
     * Pretty loaded function. By default it shows a list of all property records.
     * It also takes care of 1) pagination;
     *                      2) search filtering;
     *                      3) sorting of records
     * @param type $filter
     */
    private function showPropertyList($filter = null) {

        if ('search' == $this->request->getAction() && $this->request->getParam('delete')) {
            unset($_SESSION['filter']['where'][$this->request->getParam('delete')]);
        }

        $filter = (isset($_SESSION['filter'])) ? $_SESSION['filter'] : array();

        $search = '';
        // Do we have search request?
        if ($this->request->getParam('search')) {
            $search = $this->request->getParam('search');
            if (is_numeric($search) && 5 == strlen($search)) {
                // ZIP
                $filter['where']['zip'] = $search;
            }

            if (preg_match('/^([a-zA-Z\s]+)$/', $search) && 2 < strlen($search)) {
                // City
                $filter['where']['city'] = $search;
            }

            if (preg_match('/[A-Z]+/', $search) && 2 == strlen($search)) {
                // State
                $filter['where']['state'] = $search;
            }

            if (preg_match('/(\d+)\s([A-Z][a-z]+)/', $search)) {
                // Address
                $filter['where']['address'] = $search;
            }
        }
        
        // Store filter data for complex search
        $_SESSION['filter'] = $filter;

        // Prepare for pagination
        $numberOfRecords = $this->dataMapper->getNumberOfRecords('property', $filter);
        $activePage = 1;
        $pages = 1;
        if ($numberOfRecords > $this->recsPerPage) {

            // There is more than one page
            $page = ($this->request->getParam('page')) ? $this->request->getParam('page') : 1;
            $filter['limit'] = array(
                'position' => ($page - 1) * $this->recsPerPage,
                'count' => $this->recsPerPage
            );
            $activePage = $page;
            $pages = ceil($numberOfRecords / $this->recsPerPage);
        }

        // Generate output
        include APP_PATH . '/views/header.php';

        // $propertyList - array of properties
        // $activePage   - current page
        // $pages        - number of pages
        //   
        //  will be available in the /views/index.php
        $propertyList = $this->dataMapper->getProperties($filter);
        include APP_PATH . '/views/index.php';
        include APP_PATH . '/views/footer.php';
    }

    /**
     * Shows particular record
     */
    private function showProperty() {
        $property = $this->dataMapper->getProperty($this->request->getParam('id'));
        include APP_PATH . '/views/header.php';
        include APP_PATH . '/views/show-property.php';
        include APP_PATH . '/views/footer.php';
    }

    // Edit record. Allow it only if there are no history records for it??
    private function editProperty() {
        if ($this->request->isGet()) {
            $property = $this->dataMapper->getProperty($this->request->getParam('propertyId'));
            include APP_PATH . '/views/header.php';
            include APP_PATH . '/views/add-property.php';
            include APP_PATH . '/views/footer.php';
        } else {

            // Validate received data. Assume that all fields are required
            $property = new Property($this->request->getParams());
            if ($property->isValid()) {
                $recordId = $this->dataMapper->saveProperty($property);
                include APP_PATH . '/views/header.php';
                include APP_PATH . '/views/add-property.php';
                include APP_PATH . '/views/footer.php';
            }
        }
    }

    /**
     * Delete record. Allow it only if there are no history records for it.
     */
    private function deleteProperty() {
        try {
            $this->dataMapper->deleteProperty($this->request->getParam('propertyId'));
        } catch (Exception $e) {
            $this->errorPage('You cannot delete this record. Reason: ' . $e->getPrevious()->getMessage(), $e);
        }
        $router = new Router();
        $router->redirect(array('action' => 'index'));
    }

    /**
     * Add sale price and date to property record.
     * Here we handle AJAX call from the web
     */
    private function addSale() {
        if ($this->request->isPost()) {
            $historyArray = $this->request->getParams();
//            $historyArray['saleDate'] = date('Y-m-d');
            $history = new SaleHistory($historyArray);
            if ($history->isValid()) {
                try {
                    $recordId = $this->dataMapper->addSale($history);
                } catch (Exception $e) {
                    header('Content-type: application/json');
                    header("HTTP/1.0 500 Server error");
                    echo json_encode(array('error' => '1', 'errorMessage' => $e->getMessage(), 'message' => 'Couldnt save data to DB'));
                }
                if (isset($recordId)) {
                    include APP_PATH . '/views/add-sale.php';
                }
            } else {
                $invalidProps = $history->getInvalidProps();
                $errorMessage = '';
                foreach ($invalidProps as $prop) {
                    $errorMessage .= 'Field ' . $prop . ' is not set or invalid; ';
                }
                header('Content-type: application/json');
                header("HTTP/1.0 500 Invalid input");
                echo json_encode(array('error' => '1', 'errorMessage' => $errorMessage, 'message' => $errorMessage));
            }
        }
    }

    private function aboutPage() {
        session_destroy();
        include APP_PATH . '/views/header.php';
        include APP_PATH . '/views/about.php';
        include APP_PATH . '/views/footer.php';
    }

    /**
     * This is default method. It is called if no valid route is found for requested action.
     */
    private function indexPage() {
        $this->showPropertyList();
    }

    /**
     * Exceptions and errors representer.
     */
    private function errorPage($message, $exception) {
        include APP_PATH . '/views/header.php';
        include APP_PATH . '/views/error.php';
        include APP_PATH . '/views/footer.php';
    }

}

?>
