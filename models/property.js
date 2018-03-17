//imports ORM to implement functions that interact with the database
var orm = require("../config/orm.js");

//creates property object
var property = {
  //selects property table entries
  selectSalesInfo: function(cb){
    var cols = ["properties.property_id", "sale_id", "address", "city", "state", "zip", "sale_date", "sale_price"];
    var joinStatement = orm.join("properties", "properties_sales", "property_id", "property_id");
    orm.select(cols, joinStatement, cb);
  },
  selectProperties: function(cb){
    orm.select("*", "properties", cb);
  },
  insertProperty: function(propertyObject, cb){
    var cols = [];
    var vals = [];

    for(var colName in propertyObject){
      var value = propertyObject[colName];
      cols.push(colName);
      vals.push(value);
    }
    orm.insert("properties", cols, vals, cb);
  },
  insertSale: function(saleObject, cb){
    var cols = [];
    var vals = [];

    for(var colName in saleObject){
      var value = saleObject[colName];
      cols.push(colName);
      vals.push(value);
    }
    orm.insert("properties_sales", cols, vals, cb);
  },
  update: function(objColVals, condition, cb){
    orm.update("properties", objColVals, condition, cb);
  },
  deleteProperty: function(property_id, cb){
    var condition = "property_id = " + property_id;
    orm.delete("properties", condition, cb);
  },
  deleteSale: function(sale_id, cb){
    var condition = "sale_id = " + sale_id; 
    orm.delete("properties_sales", condition, cb);
  }
};

//exports database functions for controller (propertyController.js) use
module.exports = property;