const socket = new WebSocket('ws://localhost:8080');

const connectForm = document.getElementById('connect-form');
const nicknameInput = document.getElementById('nickname');
const joinButton = document.getElementById('join-button');
const disconnectButton = document.getElementById('disconnect-button');
const chatContainer = document.getElementById('chat-container');
const chat = document.getElementById('chat');
const messageForm = document.getElementById('message-form');
const messageInput = document.getElementById('message');
const sendButton = document.getElementById('send-button');

let username;

socket.addEventListener('open', () => {
  console.log('Connected to server');
});

socket.addEventListener('message', (event) => {
  const message = JSON.parse(event.data);
  if (message.type === 'notification') {
    chat.innerHTML += `<p><i>${message.text}</i></p>`;
  } else if (message.type === 'message') {
    const timestamp = new Date(message.timestamp);
    const formattedTimestamp = `[${timestamp.getHours().toString().padStart(2, '0')}:${timestamp.getMinutes().toString().padStart(2, '0')}:${timestamp.getSeconds().toString().padStart(2, '0')}]`;
    const senderClass = message.sender === username ? 'sender' : '';
    chat.innerHTML += `<p class="${senderClass}"><span class="timestamp">${formattedTimestamp}</span> <b>${message.sender}</b>: ${message.text}</p>`;
    chat.scrollTop = chat.scrollHeight;
  }
});

connectForm.addEventListener('submit', (event) => {
  event.preventDefault();
  username = nicknameInput.value;
  if (username.trim()) {
    const connectMessage = {
      type: 'connect',
      nickname: username,
    };
    socket.send(JSON.stringify(connectMessage));
    chatContainer.style.display = 'flex';
    connectForm.style.display = 'none';
    disconnectButton.style.display = 'inline-block';
  }
});

disconnectButton.addEventListener('click', (event) => {
  event.preventDefault();
  socket.close();
  chatContainer.style.display = 'none';
  connectForm.style.display = 'flex';
  nicknameInput.value = '';
  joinButton.disabled = false;
  disconnectButton.style.display = 'none';
  chat.innerHTML = '';
});

messageForm.addEventListener('submit', (event) => {
  event.preventDefault();
  const messageText = messageInput.value;
  if (messageText.trim()) {
    const message = {
      type: 'message',
      sender: username,
      text: messageText,
    };
    socket.send(JSON.stringify(message));
    messageInput.value = '';
  }
});

messageInput.addEventListener('input', () => {
  sendButton.disabled = !messageInput.value.trim();
});

sendButton.disabled = true;
