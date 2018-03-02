//imports ORM to implement functions that interact with the database
var orm = require("../config/orm.js");

//creates property object
var property = {
  //selects all property table entries
  selectAll: function(cb){
    orm.selectAll("properties", function (res){
      cb(res);
    });
  },
  insertOne: function(cols, vals, cb){
    orm.insertOne("properties", cols, vals, function(res){
      cb(res);
    });
  },
  updateOne: function(objColVals, condition, cb){
    orm.updateOne("properties", objColVals, condition, function(res){
      cb(res);
    });
  },

    //may need to edit this
    deleteOne: function(condition, cb){
      orm.deleteOne("properties", objColVals, condition, function(res){
        cb(res);
      });
    }
};

//exports database functions for controller (propertyController.js) use
module.exports = property;