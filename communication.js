document.addEventListener('DOMContentLoaded', () => {
  loadUsers();
});

let currentReceiverId = null;
const currentUserId = 1; // This should be dynamically set based on the logged-in user

function loadUsers() {
  fetch('getUsers.php')
      .then(response => response.json())
      .then(users => {
          const userList = document.getElementById('userList');
          users.forEach(user => {
              const userElement = document.createElement('div');
              userElement.classList.add('user');
              userElement.textContent = user.username;
              userElement.onclick = () => {
                  currentReceiverId = user.id;
                  loadMessages();
              };
              userList.appendChild(userElement);
          });
      });
}

function loadMessages() {
  if (currentReceiverId) {
      fetch(`getMessages.php?sender_id=${currentUserId}&receiver_id=${currentReceiverId}`)
          .then(response => response.json())
          .then(messages => {
              const messageContainer = document.getElementById('messages');
              messageContainer.innerHTML = ''; // Clear previous messages
              messages.forEach(message => {
                  const messageElement = document.createElement('div');
                  messageElement.classList.add('message', message.sender_id === currentUserId ? 'me' : '');
                  messageElement.textContent = message.message;
                  messageContainer.appendChild(messageElement);
              });
              messageContainer.scrollTop = messageContainer.scrollHeight;
          });
  }
}

function sendMessage() {
  const messageInput = document.getElementById('messageInput');
  const messageContainer = document.getElementById('messages');

  if (messageInput.value.trim() !== '' && currentReceiverId) {
      const message = messageInput.value;
      fetch('sendMessage.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `sender_id=${currentUserId}&receiver_id=${currentReceiverId}&message=${encodeURIComponent(message)}`
      }).then(response => response.text()).then(response => {
          if (response === 'Message sent') {
              const messageElement = document.createElement('div');
              messageElement.classList.add('message', 'me');
              messageElement.textContent = message;
              messageContainer.appendChild(messageElement);
              messageInput.value = '';
              messageContainer.scrollTop = messageContainer.scrollHeight;
          }
      });
  } else {
      alert('Please type a message and select a user to chat with');
  }
}
