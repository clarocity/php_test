<?php

/**
 * Simple controller functions - looks at request, calls needed methods, loads appropriate views.
 */
require_once APP_PATH . '/Property.php';
require_once APP_PATH . '/SaleHistory.php';
require_once APP_PATH . '/View.php';

class SimpleController {

    private $routes;
    private $request;
    private $dataMapper;
    private $recsPerPage;
    private $view;
    private $messages;
    private $exception;

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
     * Here also all uncaught exceptions are finally caught.
     * 
     * @param string $action
     */
    public function run($action) {
        try {
            if (!method_exists($this, $action)) {
                $action = 'errorPage';
                $this->messages = '404 - Page not found';
            }
            $this->view = new View($action);
            $this->view->setLayout('layout.php');
            $this->$action();
            $this->view->render();
        } catch (Exception $e) {
            $this->exception = $e;
            $this->messages = 'Something terrible happened. ' . $e->getMessage();
            $this->run('errorPage');
        }
    }

    private function addProperty() {
        //Destroy session data - we will not need it so far
        session_destroy();
        if ($this->request->isPost()) {
            // Validate received data. Assume that all fields are required
            $property = new Property($this->request->getParams());
            if ($property->isValid()) {
                $recordId = $this->dataMapper->saveProperty($property);
                $router = new Router();
                $this->run($router->redirect(array('action' => 'property', 'id' => $recordId)));
            } else {
                $this->view->errors = 'There are errors on the form';
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
        $this->view->setView('index.php');
        if ('search' == $this->request->getAction() && null != $this->request->getParam('delete')) {
            unset($_SESSION['filter']['search'][(int)$this->request->getParam('delete')]);
            $this->view->json($_SESSION);
        }

        $filter = (isset($_SESSION['filter'])) ? $_SESSION['filter'] : array();
        if (isset($_SESSION['filter']['search'])) {
            $filter['search'] = $_SESSION['filter']['search'];
        }

        if ($this->request->getParam('search')) {
            $filter['search'][] = htmlentities($this->request->getParam('search'));
            $this->view->search = htmlentities($this->request->getParam('search'));
        }

        // Store filter data for complex search
        $_SESSION['filter'] = $filter;

        // Prepare for pagination
        $this->view->numberOfRecords = $this->dataMapper->getNumberOfRecords('property', $filter);
        $this->view->activePage = 1;
        $this->view->pages = 1;
        if ($this->view->numberOfRecords > $this->recsPerPage) {

            // There is more than one page
            $page = ($this->request->getParam('page')) ? $this->request->getParam('page') : 1;
            $filter['limit'] = array(
                'position' => ($page - 1) * $this->recsPerPage,
                'count' => $this->recsPerPage
            );
            $this->view->activePage = $page;
            $this->view->pages = ceil($this->view->numberOfRecords / $this->recsPerPage);
        }
        $this->view->propertyList = $this->dataMapper->getProperties($filter);
    }

    /**
     * Shows particular record
     */
    private function showProperty() {
        $this->view->property = $this->dataMapper->getProperty($this->request->getParam('id'));
    }

    // Edit record. Allow it only if there are no history records for it??
    // We will use add-property form
    private function editProperty() {
        $this->view->setView('add-property.php');
        if ($this->request->isGet()) {
            $this->view->property = $this->dataMapper->getProperty($this->request->getParam('propertyId'));
        } else {
            // Validate received data. Assume that all fields are required
            $this->view->property = new Property($this->request->getParams());
            if ($this->view->property->isValid()) {
                $this->view->recordId = $this->dataMapper->saveProperty($this->view->property);
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

        $this->view->enableLayout(FALSE);
        $this->view->request = $this->request;
        if ($this->request->isPost()) {
            $historyArray = $this->request->getParams();
//            $historyArray['saleDate'] = date('Y-m-d');
            $history = new SaleHistory($historyArray);
            if ($history->isValid()) {
                try {
                    $this->view->recordId = $this->dataMapper->addSale($history);
                } catch (Exception $e) {
                    header("HTTP/1.0 500 Server error");
                    $this->view->json(array('error' => '1', 'errorMessage' => $e->getMessage(), 'message' => 'Couldnt save data to DB'));
                }
                if (!isset($this->view->recordId)) {
                    $this->view->doRender(FALSE);
                }
            } else {
                $invalidProps = $history->getInvalidProps();
                $errorMessage = '';
                foreach ($invalidProps as $prop) {
                    $errorMessage .= 'Field ' . $prop . ' is not set or invalid; ';
                }
                header("HTTP/1.0 500 Invalid input");
                $this->view->json(array('error' => '1', 'errorMessage' => $errorMessage, 'message' => $errorMessage));
            }
        }
    }

    private function aboutPage() {
        session_destroy();
    }

    /**
     * This is default method. It is called if no valid route is found for requested action.
     */
    private function index() {
        $this->showPropertyList();
    }

    /**
     * Exceptions and errors representer.
     */
    private function errorPage() {
        $this->view->message = $this->messages;
        $this->view->exception = $this->exception;
    }

}

?>
