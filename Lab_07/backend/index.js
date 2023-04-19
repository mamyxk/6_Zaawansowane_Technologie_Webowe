const WebSocket = require('ws');

const server = new WebSocket.Server({ port: 8080 });

server.on('connection', (socket) => {
  let nickname;

  socket.on('message', (message) => {
    console.log(`Received message: ${message}`);
    const parsedMessage = JSON.parse(message);

    if (parsedMessage.type === 'connect') {
      nickname = parsedMessage.nickname;
      console.log(`Client connected: ${nickname}`);

      // Send a notification to all connected clients about the new connection
      broadcastMessage({ type: 'notification', text: `${nickname} has joined the chat.` });
    } else if (parsedMessage.type === 'message') {
      const timestampedMessage = {
        ...parsedMessage,
        timestamp: new Date().toISOString(),
      };

      // Broadcast the message to all connected clients
      broadcastMessage(timestampedMessage);
    }
  });

  socket.on('close', () => {
    console.log('Client disconnected');
    if (nickname) {
      // Send a notification to all connected clients about the disconnection
      broadcastMessage({ type: 'notification', text: `${nickname} has left the chat.` });
    }
  });
});

function broadcastMessage(message) {
  const messageString = JSON.stringify(message);

  server.clients.forEach((client) => {
    if (client.readyState === WebSocket.OPEN) {
      client.send(messageString);
    }
  });
}
