<?php 

require_once "../app/db/dbconn.php";
require_once "../app/models/Property.php";
require_once "../app/views/PropertyView.php";
require_once "../app/controllers/PropertyController.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"]) && $_GET["id"] !== "") {
        include "layout/head.php"; 
        echo "<div class=\"container container--main\">";

        // Property Details
        $property = new Property($db);
        $propController = new PropertyController($property);
        $propView = new PropertyView($property);
        $propController->setId($_GET["id"]);
        $formConvert = true;

        // edit form
        $formHeading = "Edit Form";
        $btnSubmit = "Update";
        $formSubmit = "editSubmit";
        $formId = "edit-form";
        include "layout/ajaxform.php";


        echo $propView->output();
        
        echo "</div>";
        $pageEdit = true;    
        include "layout/footer.php";
    } else {
        echo "error occurred";
    }

} else if ($_SERVER["REQUEST_METHOD"] === "POST"){ //ajax
    $property = new Property($db);
    $propController = new PropertyController($property);
    $propController->setId($_GET["id"]);
    $propController->addAllValues($_POST);
    echo $property->update();
} else if ($_SERVER["REQUEST_METHOD"] === "DELETE"){ //ajax
    $property = new Property($db);
    echo $property->delete($_GET["id"]);
} else {
    echo "Error occurred.";
}

?>