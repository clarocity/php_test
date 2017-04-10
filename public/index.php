<?php 

require_once "../app/db/dbconn.php";
require_once "../app/models/Property.php";
require_once "../app/controllers/PropertyController.php";
require_once "../app/models/PropertyList.php";
require_once "../app/controllers/PropertyListController.php";
require_once "../app/views/PropertyListView.php";


$propertyList = new PropertyList($db);
$propertyListController = new PropertyListController($propertyList);
$propertyListView = new PropertyListView($propertyList);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newProp = new Property($db);
    $newPropController = new PropertyController($newProp);
    $newPropController->addAllValues($_POST);
    $propertyList->addProperty($newProp);

} else if ($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    include "layout/head.php"; 
    echo "<div class=\"container container--main\">";
    // form
    $formHeading = "Add Form";
    $btnSubmit = "Add";
    $formSubmit = "addSubmit";
    $formId = "add-form";
    $formConvert = false;
    include "layout/ajaxform.php";
    if (isset($_GET["searchInput"]) && $_GET["searchInput"] !== "") { // searched
        if (isset($_GET["year"]) && $_GET["year"] === "2017") { // and filtered
            $propertyListController->filterYear($_GET["year"]);
            echo $propertyList->__get('year');
        }
        if (isset($_GET["priceRange"]) && $_GET["priceRange"] !== "") { // and filtered
            $propertyListController->filterPriceRange($_GET["priceRange"]);
        }
        $propertyListController->search($_GET["searchInput"]);
        echo $propertyListView->output();
    }
    echo "</div>";
    echo "<script src='javascript/ajaxaddform.js'></script>";    
    include "layout/footer.php";
} else {
    echo "Error occurred.";
}
?>