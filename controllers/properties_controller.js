//required dependencies
var express = require("express");
var router = express.Router();
//imports property.js model in order to use its database functions
var property = require("../models/property.js");

//creates routes and logic
router.get("/", function(req, res) {
  property.selectAll(function(data) {
    var hbsObject = {
      properties: data
    };
    console.log(hbsObject);
    res.render("index", hbsObject);
  });
});

router.post("/properties", function(req, res) {
  property.insertOne([
    "address", "city", "state", "zip", "sale_date", "sale_price" 
  ], [
    req.body.address, req.body.city, req.body.state, req.body.zip, req.body.sale_date, req.body.sale_price
  ], function(data) {
    res.redirect("/");
  });
});

router.put("/properties/:id", function(req, res) {
  var condition = "id = " + req.params.id;

  console.log("condition", condition);

  property.updateOne({
    deleted: true
  }, condition, function(data) {
    res.redirect("/");
  });
});

//need to edit
// router.put("/properties/:id", function(req,res){
//   var condition = "id " + req.params.id;
//   console.log("condition", condition);

//   property.updateOne({

//   })
// })


//exports route for use in server.js
module.exports = router;

