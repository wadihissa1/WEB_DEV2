@extends('layout')

@section('content')
<style>
.chat-list {
    overflow-y: auto;
    max-height: calc(100vh - 150px);
}

/* Chat item */
.chat-item {
    cursor: pointer;
}

/* Chatbox */
.chatbox {
    height: calc(100vh - 150px);
    width: 129%;
    overflow-y: auto;
    background-color: #5f5f5f;
    padding: 110px;
    border-left: 1px solid #ddd;
}

/* Messages */
.messages {
    margin-bottom: 20px;
}

/* Message */
.message {
    margin-bottom: 10px;
    padding: 8px 12px;
    border-radius: 5px;
    max-width: 70%;
    word-wrap: break-word;
}

/* Sent message */
.message.sent {
    background-color: #DCF8C6;
    color: #000;
    align-self: flex-end;
}

/* Received message */
.message.received {
    background-color: #f0f0f0;
    color: #000;
    align-self: flex-start;
}

/* Message input */
.message-input {
    margin-top: 10px;
    position: absolute;
    display: flex;
    align-items: center;
    bottom: 2%;
    right: 0;
}

/* Textarea */
textarea.form-control {
    resize: none;
    flex: 1;
}

/* Send button */
#sendMessageBtn {
    margin-left: 10px;
}

/* Chat list item */
.list-group-item {
    border: none;
    border-bottom: 1px solid #ddd;
}

/* Chat list item hover */
.list-group-item:hover {
    background-color: #f5f5f5;
}
</style>
<div class="container">
    <div class="row">
        <!-- Chat list -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    My Chats
                </div>
                <br><br><br><br>
                <div class="card-body chat-list">
                    <ul id="chatList" class="list-group">
                        <li class="list-group-item chat-item" data-chat-id="1">{{ $userId }}</li>
                        <br><br>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Chatbox -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" id="chatHeader">
                    Chat with {{ $userId }}
                </div>
                <div class="card-body chatbox" id="chatbox">
                    <!-- Messages -->
                    <div id="messages" class="messages">
                        <!-- Example message, replace with dynamic data -->
                        <div class="message sent">
                            <div class="message-content">Hello, how can I help you?</div>
                        </div>
                        <div class="message received">
                            <div class="message-content">Hi, I'm interested in your product.</div>
                        </div>
                        <!-- End of example -->
                    </div>
                    <!-- Message input -->
                    <div class="message-input">
                        <textarea id="messageInput" class="form-control" placeholder="Type your message..."></textarea>
                        <button id="sendMessageBtn" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.3/echo.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Echo
        window.Echo.private('messages.' + {{ auth()->id() }})
            .listen('.new-message', function (data) {
                // Check if the received message is for the currently selected chat
                if (data.message.chat_id === selectedChatId) {
                    appendMessage(data.message.sender, data.message.content);
                }
            });

        // Get elements
        var chatList = document.getElementById('chatList');
        var chatHeader = document.getElementById('chatHeader');
        var chatbox = document.getElementById('chatbox');
        var messageInput = document.getElementById('messageInput');
        var sendMessageBtn = document.getElementById('sendMessageBtn');
        var selectedChatId = null;

        // Add event listener to chat list items
        chatList.addEventListener('click', function (event) {
            selectedChatId = event.target.dataset.chatId;
            // Update chat header
            chatHeader.innerText = 'Chat with Buyer ' + selectedChatId;
            // Clear existing messages
            clearMessages();
            // Fetch messages for selected chat
            fetchMessages(selectedChatId);
        });

        // Send message button click event
        sendMessageBtn.addEventListener('click', function () {
            var message = messageInput.value.trim();
            if (message !== "") {
                // Send the message
                sendMessage(message);
                // Clear the message input field
                messageInput.value = "";
            }
        });

        // Fetch messages for the selected chat
        function fetchMessages(chatId) {
            axios.get('/messages/' + chatId)
                .then(function (response) {
                    // Update the messages in the chatbox
                    response.data.messages.forEach(function (message) {
                        appendMessage(message.sender, message.content);
                    });
                })
                .catch(function (error) {
                    console.error('Error fetching messages:', error);
                });
        }

        // Send message function
        function sendMessage(message) {
            axios.post('/messages', {
                    chat_id: selectedChatId,
                    message: message
                })
                .then(function (response) {
                    // Message sent successfully
                    // Append the sent message to the chatbox
                    appendMessage('sent', message);
                })
                .catch(function (error) {
                    console.error('Error sending message:', error);
                });
        }

        // Function to clear existing messages in the chatbox
        function clearMessages() {
            document.getElementById('messages').innerHTML = '';
        }

        // Function to append a message to the chatbox
        function appendMessage(sender, content) {
            var messageDiv = document.createElement('div');
            messageDiv.className = 'message ' + sender;
            messageDiv.innerHTML = '<div class="message-content">' + content + '</div>';
            document.getElementById('messages').appendChild(messageDiv);
            // Scroll to the bottom of the chatbox
            chatbox.scrollTop = chatbox.scrollHeight;
        }
    });
</script>
@endsection
