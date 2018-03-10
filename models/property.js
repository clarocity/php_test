//imports ORM to implement functions that interact with the database
var orm = require("../config/orm.js");

//creates property object
var property = {
  //selects property table entries
  selectSalesInfo: function(cb){
    var cols = ["properties.property_id", "address", "city", "state", "zip", "sale_date", "sale_price"];
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
    orm.insert("properties", cols, vals, function(res){
      cb(res);
    });
  },
  insertSale: function(){
    
  },
  update: function(objColVals, condition, cb){
    orm.update("properties", objColVals, condition, function(res){
      cb(res);
    });
  },
  delete: function(condition, cb){
      orm.delete("properties", condition, function(res){
        cb(res);
      });
    }
};

//exports database functions for controller (propertyController.js) use
module.exports = property;