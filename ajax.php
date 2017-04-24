<?php
/* AJAX Functions */
require_once 'Property.php';

header('Content-Type: application/json');

if($_POST['action']) {
    switch($_POST['action']) {
        case 'index':
            $property = new Property();
            
            $properties = $property->index();
            if($properties) {
                echo json_encode(['status' => '1','properties' => $properties]);
            } else {
                echo json_encode(['status' => '0','message' => 'There was a problem fetching the properties.']);
            }
            exit();
        
        case 'add':
            $property = new Property();
            $insert_id = $property->create($_POST);
            if($insert_id) {
                echo json_encode([
                    'status'    => '1', 
                    'message'   => 'Property Added Successfully.', 
                    'property'  => $property->read($insert_id)
                ]);
            } else {
                echo json_encode(['status' => '0','message' => 'There was a problem adding the property. Please try again']);
            }           
            
            exit();
            
        case 'read':
            $property = new Property();
            $p = $property->read($_POST['id']);
            
            if($p) {
                echo json_encode(['status' => '1', 'property' => $p]);
            } else {
                echo json_encode(['status' => '0','message' => 'There was a problem reading the property. Please try again']);
            }
            
            exit();
            
        case 'edit':
            $property = new Property();
            if($property->update($_POST)) {
                echo json_encode(['status' => '1','message' => 'Property Edited Successfully']);
            } else {
                echo json_encode(['status' => '0','message' => 'There was a problem fetching the properties.']);
            }
            
            exit();

        case 'delete':
            $property = new Property();
            if($property->delete($_POST['id'])) {
                echo json_encode(['status' => '1','message' => 'Property Deleted Successfully']);
            } else {
                echo json_encode(['status' => '0','message' => 'There was a problem deleting the properties.']);
            }
            

            exit();
    }
}