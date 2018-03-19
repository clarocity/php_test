//required dependencies
var express = require("express");
var router = express.Router();
//imports property.js model in order to use its database functions
var property = require("../models/property.js");

//creates routes and logic

router.get("/", function(req,res){
  res.redirect("/properties");
});

router.get("/properties", function(req, res) {
  property.selectSalesInfo(function(err, salesData) {
    if(err){
      console.log(err);
      return res.sendStatus(500);
    }

    property.selectProperties(function(err, propertyData){
      if(err){
        console.log(err);
        return res.sendStatus(500);
      }
      var hbsObject = {
        properties: propertyData,
        sales: salesData
      };
      console.log(hbsObject);
      res.render("index", hbsObject);
    })

  });
});

router.post("/properties", function(req, res) {
  property.insertProperty(req.body, function(data) {
    res.redirect("/properties");
  });
});

router.post("/sales", function(req,res){
  property.insertSale(req.body, function(data){
    res.redirect("/properties");
  })
})

router.post("/properties/update/:id", function(req, res) {
  property.update(req.params.id, function(){
    res.redirect("/properties");
  })
});

router.post("/sales/delete/:id", function(req, res){
  var sale_id = req.params.id; 
  property.deleteSale(sale_id, function(result) {
    res.redirect("/properties");
  });
});
//exports route for use in server.js
module.exports = router;

