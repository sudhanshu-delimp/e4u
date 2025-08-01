require("dotenv").config({ debug: false });
const express = require("express");
const http = require("http");
const { Server } = require("socket.io");
const bodyParser = require("body-parser");

const host = process.env.SOCKET_HOST || '127.0.0.1';
const port = process.env.SOCKET_PORT || 6001;

const app = express();
const server = http.createServer(app);

const io = new Server(server, {
  cors: {
    origin: "*", 
    methods: ["GET", "POST"]
  }
});

app.use(bodyParser.json());
app.post("/agent-assigned", (req, res) => {
  const data = req.body;
  console.log("Broadcasting update:", data);
  io.emit("agent.assigned", data);
  res.json({ status: "broadcasted" });
});

io.on("connection", (socket) => {
  console.log("Client connected:", socket.id);
});



server.listen(port, () => {
 console.log(`Socket.IO server running at http://${host}:${port}`);
});
