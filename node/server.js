

//load the webserver module from our library
//make sure to npm install the module
const express = require('express');

//load the mysql module from our library
const mysql = require('mysql');
//load the mysql credentials from our local file system on the server
const credentials = require('./mysqlcredentials.js');
//use those credentials to configure a connection to the database
const db = mysql.createConnection(credentials);
let counter = 0;
//instantiate our web server
const server = express();

server.use( express.static(__dirname + '/html') );

//indicate a URL you want to listen to
server.get('/items', (req, res)=>{
	counter++;
	//connect to the database and call the callback function when connection established
	db.connect( ()=>{
		//send my query and call the callback function to handle the data
		db.query( 'SELECT * FROM todoItems', (err, data, fields)=>{
			//if there was no error
			if(!err){
				//send to the client the JSON converted data from the query
				const output = {
					success: true,
					data: data,
					counter: counter
				}
				res.send( JSON.stringify(output));
			}
		})
	})
})
server.get('/item', (req, res)=>{
	counter++;
	//connect to the database and call the callback function when connection established
	db.connect( ()=>{
		//send my query and call the callback function to handle the data
		//get the query string variable itemID
		db.query( 'SELECT * FROM todoItems WHERE ID = '+req.query.itemID, (err, data, fields)=>{
			//if there was no error
			if(!err){
				//send to the client the JSON converted data from the query
				const output = {
					success: true,
					data: data,
					counter: counter
				}
				res.send( JSON.stringify(output));
			}
		})
	})
})
//tell the web server to listen to a port
server.listen(3000, ()=>{
	console.log('server is listening to port 3000');
})



















