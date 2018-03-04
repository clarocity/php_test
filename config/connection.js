//setting up MySQL connection
var mysql = require("mysql");

if (process.env.JAWSDB_URL){
  connection = mysql.createConnection(process.env.JAWSDB_URL);
}else{
    connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "properties_db"
  });
};

//making the connection
connection.connect(function(err) {
  if (err) {
    console.error("Unfortunately, there was an error connecting: " + err.stack);
    return;
  }
  console.log("connected as id " + connection.threadId);
});

//exporting the connection for ORM to use
module.exports = connection;