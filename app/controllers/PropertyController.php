<?php 

class PropertyController {
    
    private $model;

    public function __construct(Property $model) {
        $this->model = $model;
    }

    public function setId($id) {
        $this->model->findOne($id);
    }

    public function addAllValues (array $values){
        $this->model->__set('address', $values['address']);
        $this->model->__set('city', $values['city']);
        $this->model->__set('state', $values['state']);
        $this->model->__set('zip', $values['zip']);
    }


}

?>