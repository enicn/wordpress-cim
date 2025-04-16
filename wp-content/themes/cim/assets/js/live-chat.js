/**
 * Live Chat Functionality for CIM Theme
 */

document.addEventListener('DOMContentLoaded', function() {
  // Chat elements
  const chatContainer = document.querySelector('.live-chat-container');
  const chatButton = document.querySelector('.chat-button');
  const chatWindow = document.querySelector('.chat-window');
  const chatClose = document.querySelector('.chat-close');
  const chatInput = document.querySelector('.chat-input');
  const chatSend = document.querySelector('.chat-send');
  const chatMessages = document.querySelector('.chat-messages');
  
  // If chat elements don't exist yet, they will be created by PHP
  if (!chatContainer) return;
  
  // Toggle chat window
  chatButton.addEventListener('click', function() {
    chatWindow.classList.toggle('active');
    if (chatWindow.classList.contains('active')) {
      chatInput.focus();
      // If this is the first time opening, show welcome message
      if (chatMessages.children.length === 0) {
        addMessage('Welcome to CIM! How can we help you today?', 'incoming');
      }
    }
  });
  
  // Close chat window
  chatClose.addEventListener('click', function() {
    chatWindow.classList.remove('active');
  });
  
  // Send message on button click
  chatSend.addEventListener('click', sendMessage);
  
  // Send message on Enter key
  chatInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      sendMessage();
    }
  });
  
  // Function to send message
  function sendMessage() {
    const message = chatInput.value.trim();
    if (message === '') return;
    
    // Add user message to chat
    addMessage(message, 'outgoing');
    
    // Clear input
    chatInput.value = '';
    
    // Scroll to bottom
    scrollToBottom();
    
    // Send to server via AJAX
    sendToServer(message);
  }
  
  // Function to add message to chat window
  function addMessage(text, type) {
    const messageEl = document.createElement('div');
    messageEl.classList.add('message', `message-${type}`);
    
    const now = new Date();
    const timeStr = now.getHours().toString().padStart(2, '0') + ':' + 
                   now.getMinutes().toString().padStart(2, '0');
    
    messageEl.innerHTML = `
      ${text}
      <span class="message-time">${timeStr}</span>
    `;
    
    chatMessages.appendChild(messageEl);
    scrollToBottom();
  }
  
  // Function to scroll chat to bottom
  function scrollToBottom() {
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }
  
  // Function to send message to server
  function sendToServer(message) {
    // Show typing indicator
    const typingEl = document.createElement('div');
    typingEl.classList.add('chat-status');
    typingEl.textContent = 'Agent is typing...';
    chatMessages.appendChild(typingEl);
    scrollToBottom();
    
    // AJAX request to WordPress
    const data = new FormData();
    data.append('action', 'cim_send_chat_message');
    data.append('message', message);
    data.append('nonce', cimChat.nonce); // Nonce will be localized from PHP
    
    fetch(cimChat.ajaxurl, {
      method: 'POST',
      credentials: 'same-origin',
      body: data
    })
    .then(response => response.json())
    .then(data => {
      // Remove typing indicator
      chatMessages.removeChild(typingEl);
      
      if (data.success) {
        // Add response from server
        addMessage(data.data.message, 'incoming');
      } else {
        // Show error
        addMessage('Sorry, there was an error processing your request. Please try again later.', 'incoming');
        console.error('Chat error:', data.data);
      }
    })
    .catch(error => {
      // Remove typing indicator
      chatMessages.removeChild(typingEl);
      
      // Show error
      addMessage('Sorry, there was an error connecting to our servers. Please try again later.', 'incoming');
      console.error('Chat error:', error);
    });
  }
});