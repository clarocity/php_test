<?php

class PropertyListView {
    
    private $model;
    
    public function __construct(PropertyList $model) {
        $this->model = $model;
    }
    
    public function output() {
        $results = $this->model->findAll();
        $idType;
        echo "<br/>";
        echo "<h2>Search Results</h2>";
        include "layout/filters.php";
        $html = "<ul class='list-group'>";
        if (count($results) > 0){
            foreach($results as $value){
                if (isset($value["property_id"])) {
                    $id=$value["property_id"];
                } else {
                    $id=$value["id"];
                }
                $property = "{$value["address"]}, {$value["city"]} {$value["state"]} {$value["zip"]}";
                $html .= "<li class='list-group-item justify-content-between'>{$property}";
                $html .= "<a class='btn btn-info' href='property.php?id={$id}'>Details</a>";
                $html .= "</li>";
            }
        } else {
            $html .= "<li class='list-group-item clearfix'>No results found.</li>";
        }
        $html .= "</ul>";
        return $html;
    }
}

?>