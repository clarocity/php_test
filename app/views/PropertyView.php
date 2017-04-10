<?php

class PropertyView {
    
    private $model;
    
    public function __construct(Property $model) {
        $this->model = $model;
    }

    public function output() {
        $results = $this->model->getSales();
        $html =  "<br/>";
        $html .=  "<h2>Property Details</h2>";
        $html .=  "<p>{$this->model}</p>";
        $html .=  "<div class='btn-group justify-content-between'>";
        $html .=  "<a class='btn btn-warning' id='edit-button'>Edit</a>";
        $html .=  "<a class='btn btn-danger ml-1' id='delete-button'>Delete</a>";
        $html .=  "<span class='message--delete'></span>";
        $html .=  "</div>";
        $html .= "<hr/>";
        $html .= "<h3>Sale History</h3>";
        $html .= "<table class='table table-striped'>";
        if (is_array($results)){
            $html .= "<thead class='table-inverse bg-primary'><tr>";
            $html .= "<td >Sale Date</td><td class='text-right'>Sale Price</td></tr></thead>";
            foreach($results as $value){
                $sale_date = date('F d, Y',strtotime($value['sale_date']));
                setlocale(LC_MONETARY, 'en_US');
                $sale_price = "$" . number_format($value['sale_price']);
                $html .= "<tr><td >{$sale_date}</td><td class='text-right'>{$sale_price}</td></tr>";
            }
        } else {
            $html .= "<p>No sales history found.</p>";
        }
        $html .= "</table>";
        return $html;
    }
}

?>