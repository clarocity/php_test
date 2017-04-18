<?php 

class PropertyListController {
    
    private $model;

    public function __construct(PropertyList $model) {
        $this->model = $model;
    }

    public function filterYear($year){
        $this->model->setYear($year);
    }

    public function filterPriceRange($priceRange){
        switch ($priceRange) {
            case "inexpensive":
                $this->model->setPriceRange("<= 500000");
                break;
            case "moderate":
                $this->model->setPriceRange("> 500000 AND sale_price <= 1000000");
                break;
            case "pricey":
                $this->model->setPriceRange("> 1000000");
                break;
        }   
    }

    public function search($searchwords){
        $this->model->setAgainst($searchwords);
    }

}

?>