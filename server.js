//required dependencies
var express = require("express");
var bodyParser = require("body-parser");
var methodOverride = require("method-override");

var PORT = process.env.PORT || 3000;

var app = express();

//static directory
app.use(express.static("public"));

app.use(bodyParser.urlencoded({ extended: false}));
app.use(methodOverride("_method"));

var exphbs = require("express-handlebars");

//handlebars is being set as the view engine
app.engine("handlebars", exphbs({defaultLayout: "main"}));
app.set("view engine", "handlebars");

//imports routes and gives server acces to them
var routes = require("./controllers/properties_controller.js");

app.use("/", routes);
app.listen(PORT, function() {
  console.log("App listening on PORT " + PORT);
});
