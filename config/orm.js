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
  select: function(cols, table, cb){
    //check if cols is array
    if(Array.isArray(cols)){
      if(cols.length < 1){
        return cb(new Error("cols was empty"), null);
      }
      //concatenate values
      var temp = "";
      for(var i = 0; i < cols.length-1; i++){
        temp += cols[i] + ", ";
      }
      temp+= cols[cols.length-1];
    }


    var queryString = "SELECT " + cols + " FROM " + table + ";";
    connection.query(queryString, cb);
  },
  //inserts a single table entry
  insert: function(table, cols, vals, cb){
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
  update: function(table, objColVals, condition, cb) {
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
  },
  //deletes a single table entry
  delete: function(table, condition, cb) {
    var queryString = "DELETE FROM " + table;
    queryString += " WHERE ";
    queryString += condition;

    connection.query(queryString, function(err, result) {
      if (err) {
        throw err;
      }

      cb(result);
    });
  },

  join: function(tableA, tableB, colA, colB){
    return tableA + " JOIN " + tableB + " ON " + tableA + "." + colA + " = " + tableB + "." + colB;
  }

};

//exports the orm object for use in other modules
module.exports = orm;
