//import MySQL connection object
var connection = require("../config/connection.js");

//helper function for generation MySQL syntax
function printQuestionMarks(num) {
  var arr = [];
  for (var i = 0; i < num; i++) {
    arr.push("?");
  }
  return arr.toString();
}

function objToSql(ob){
  var arr = [];

  for (var key in ob){
    var value = ob[key];

    if (Object.hasOwnProperty.call(ob,key)){

      if(typeof value === "string" && value.indexOf(" ") >= 0){
        value = "'" + value + "'";
      }
      arr.push(key + "=" + value);
    }
  }
  return arr.toString();
}

//creating ORM object to perform SQL queries
var orm = {
  //returns all table entries
  selectAll: function(tableInput, cb){
    var queryString = "SELECT * FROM " + tableInput + ";";
    connection.query(queryString, function(err, result){
      if (err){
        throw err;
      }
      cb(result);
    });
  },
  //inserts a single table entry
  insertOne: function(table, cols, vals, cb){
    var queryString = "INSERT INTO " + table;

    queryString += " (";
    queryString += cols.toString();
    queryString += ") ";
    queryString += "VALUES (";
    queryString += printQuestionMarks(vals.length);
    queryString += ") ";

    console.log(queryString);
    connection.query(queryString, vals, function(err, result) {
      if (err) {
        throw err;
      }
      cb(result);
    });
  },
  //updates a single table entry
  updateOne: function(table, objColVals, condition, cb) {
    var queryString = "UPDATE " + table;

    queryString += " SET ";
    queryString += objToSql(objColVals);
    queryString += " WHERE ";
    queryString += condition;

    console.log(queryString);
    connection.query(queryString, function(err, result) {
      if (err) {
        throw err;
      }
      cb(result);
    });
  }
};

//exports the orm object for use in other modules
module.exports = orm;
