var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var mysql = require('mysql');
var players = [];
var wingames ;
var db = mysql.createConnection({
    host: 'localhost',
    user: 'vaibhav_spinner',
    database: 'spingametest',
    password:'rpAXGBTn'
})
var newGameid = 1;
db.connect(function(err){
    if (err) console.log(err)
})
server.listen(16694, function(){
	console.log("Server is now running...");
});
  var countdown = 70;


///
io.on('connection', function(socket){
	console.log("Player Connected!");
if(players.length==1){
  var countdown = 70;

var countdowner =    setInterval(function() {
    countdown--;
  io.sockets.emit('timer', { countdown: countdown });
  socket.emit('lastwins',wingames);
  console.log(countdown);
if (countdown==0) {
  console.log("starting game");
  countdown = 70;
  newGameid ++;
  console.log(newGameid);


}


}, 1000);

}

	socket.emit('getPlayers', players);
  socket.emit('newgameid',{newgame: newGameid});
	socket.broadcast.emit('newPlayer', { id: socket.id });
	socket.on('disconnect', function(){
		console.log("Player Disconnected");
		socket.broadcast.emit('playerDisconnected', { id: socket.id });
		for(var i = 0; i < players.length; i++){
			if(players[i].id == socket.id){
				players.splice(i, 1);
			}
		}
	});



  socket.on('getcoins',function(data){
    var email = data.uname;
  console.log(" userEamil "+email);

   db.query("SELECT * FROM userinfo WHERE uemail =  ?",[email] ,function (err, result, fields) {
     if(err) throw err;

     console.log(result);
    var ecoin = result[0].uCoins;
   console.log(" userCoins "+ecoin)
   io.emit('ucoins', ecoin);
  }); });




  socket.on('updatecoins',function(data){
    console.log("data= "+data.toString());
    var email = data.uname;
    var ucoins = data.ucoins;
  console.log(" userEmail "+email,"ucoins"+ucoins);

   db.query("UPDATE userinfo set uCoins = ? WHERE uemail = ?",[ucoins,email],function (err, result, fields) {
     if(err) throw err;

     console.log(result.affectedRows + " record(s) updated");
   });

 });

 // socket.on('getwinner',winnerbet(){
 //
 // });
  socket.on('savegame', function(data){
    var gmeid = data.gmeid;
    var uname = data.uname;
    var bet1 = data.bet1;
    var bet2 = data.bet2;
    var bet3 = data.bet3;
    var bet4 = data.bet4;
    var bet5 = data.bet5;
    var bet6 = data.bet6;
    var bet7 = data.bet7;
    var bet8 = data.bet8;
    var bet9 = data.bet9;
    var bet0 = data.bet0;
    db.query("INSERT INTO gamedata (gmeid,urname,bet1,bet2,bet3,bet4,bet5,bet6,bet7,bet8,bet9,bet0) VALUES ('"+newGameid+"','"+uname+"','"+bet1+"','"+bet2+"','"+bet3+"','"+bet4+"','"+bet5+"','"+bet6+"','"+bet7+"','"+bet8+"','"+bet9+"','"+bet0+"' )");
  });



	players.push(new player(socket.id, 0, 0));

});

function player(id, x, y){
	this.id = id;
	this.x = x;
	this.y = y;
}
function gametimer(){
  /// server countdown starts
  var countdown = 70;

  var countdowner =    setInterval(function() {
        countdown--;
    //  io.sockets.emit('timer', { countdown: countdown });
    if (countdown==0) {
      console.console.log("starting game");
      clearInterval(countdowner);

    }


  }, 1000);
}
function lastwin(){
  db.query("SELECT TOP 10 winningno FROM winningtable ",function (err, rows) {
    if(err) throw err;

    console.log(rows);
   res.json(rows);});}

 function winnerbet(){


  db.query("SELECT * FROM gamedata WHERE gmeid = ?",newGameid,function (err, result, fields) {
    if(err) throw err;

    var bet1,bet2, bet3, bet4,bet5, bet6, bet7, bet8, bet9, bet0;
     bet1 += result.bet1;
     bet2 += result[5];
     bet3 += result[6];
     bet4 += result[7];
     bet5 += result[8];
     bet6 += result[9];
     bet7 += result[10];
     bet8 += result[11];
     bet9 += result[12];
     bet0 += result[13];
     console.log(bet1);

    var mini = Math.min(bet1,bet2,bet3,bet4,bet5,bet6,bet7,bet8,bet9,bet0);
      console.log(mini);
    for(var i=0;i<10;i++) {

        if("bet" + i==mini) {
            console.log(i);

        }

    }

  //  socket.emit('showrows', rows);
  });
}
