//required dependencies
var express = require("express");
var router = express.Router();
//imports property.js model in order to use its database functions
var property = require("../models/property.js");

//creates routes and logic
router.get("/", function(req, res) {
  property.select(function(data) {
    var hbsObject = {
      properties: data
    };
    console.log(hbsObject);
    res.render("index", hbsObject);
  });
});

router.post("/properties", function(req, res) {
  property.insert([
    "address", "city", "state", "zip", "sale_date", "sale_price" 
  ], [
    req.body.address, req.body.city, req.body.state, req.body.zip, req.body.sale_date, req.body.sale_price
  ], function(data) {
    res.redirect("/");
  });
});

router.put("/properties/:id", function(req, res) {
  property.update(req.params.id, function(){
    res.redirect("/");
  })
});

router.delete("/properties/delete/:id", function(req, res){
  var condition = "id = " + req.params.id; 
  
  property.delete(condition, function(result) {
    res.redirect("/");
  });
});
//exports route for use in server.js
module.exports = router;

