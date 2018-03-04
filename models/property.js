//imports ORM to implement functions that interact with the database
var orm = require("../config/orm.js");

//creates property object
var property = {
  //selects property table entries
  select: function(cb){
    orm.select("properties", function (res){
      cb(res);
    });
  },
  insert: function(cols, vals, cb){
    orm.insert("properties", cols, vals, function(res){
      cb(res);
    });
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