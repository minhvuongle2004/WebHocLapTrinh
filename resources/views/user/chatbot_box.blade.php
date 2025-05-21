<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HTAV2</title>
    <style>
        #chatbot-box {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 350px;
            height: 450px;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            display: none;
            flex-direction: column;
        }

        #chatbot-header {
            background-color: #1c4fc4;
            color: white;
            padding: 10px;
            font-weight: bold;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        #chatbot-body {
            flex: 1 1 auto;
            overflow-y: auto;
            padding: 10px;
        }

        #chatbot-body .user {
            color: #1c4fc4;
            font-weight: bold;
            margin-top: 10px;
        }

        #chatbot-body .bot {
            color: green;
            margin-top: 10px;
        }

        #chatbot-footer {
            padding: 10px;
            border-top: 1px solid #ccc;
            display: flex;
            gap: 10px;
            background: #fff;
        }

        #chatbot-footer input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #chatbot-footer button {
            padding: 8px 12px;
            background-color: #1c4fc4;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #chatbot-footer button:hover {
            background-color: #1558a5;
        }

        #chatbot-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 10000;
            cursor: pointer;
        }

        #chatbot-icon img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <!-- Icon chatbot -->
    <div id="chatbot-icon" onclick="toggleChatbot()">
        <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" alt="Chatbot">
    </div>

    <!-- Chatbox -->
    <div id="chatbot-box">
        <div id="chatbot-header">💬 Trợ Lý Lập Trình</div>
        <div id="chatbot-body">
            <div id="chatbot-messages">
                <div class="bot">Chào bạn! Tôi là trợ lý lập trình. Hỏi về code hoặc hỗ trợ khách hàng nhé!</div>
            </div>
        </div>
        <div id="chatbot-footer">
            <input type="text" id="chatbot-message" placeholder="Nhập câu hỏi..."
                onkeypress="if(event.keyCode == 13) sendChatbot()">
            <button onclick="sendChatbot()">Gửi</button>
        </div>
    </div>

    <script>
        function toggleChatbot() {
            let box = document.getElementById('chatbot-box');
            box.style.display = box.style.display === 'none' || box.style.display === '' ? 'flex' : 'none';
        }

        function sendChatbot() {
            let message = document.getElementById('chatbot-message').value.trim();
            if (!message) return;

            let messagesDiv = document.getElementById('chatbot-messages');
            messagesDiv.innerHTML += `<div class="user">Bạn: ${message}</div>`;

            // Scroll xuống để xem tin nhắn mới
            document.getElementById('chatbot-body').scrollTop = document.getElementById('chatbot-body').scrollHeight;

            // Dùng endpoint thủ công cho debug
            fetch('/botman-manual?message=' + encodeURIComponent(message), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(res => res.json())
                .then(data => {
                    console.log('Nhận được phản hồi:', data); // Debug: xem cấu trúc dữ liệu

                    // Xử lý phản hồi
                    let reply = 'Không có phản hồi';

                    if (data.messages && data.messages.length > 0) {
                        reply = data.messages[0].text;
                    } else if (data.message) {
                        reply = data.message;
                    }

                    messagesDiv.innerHTML += `<div class="bot">Bot: ${reply}</div>`;

                    // Giới hạn số lượng tin nhắn hiển thị
                    let totalMessages = messagesDiv.querySelectorAll('div');
                    if (totalMessages.length > 20) {
                        for (let i = 0; i < totalMessages.length - 20; i++) {
                            totalMessages[i].remove();
                        }
                    }

                    document.getElementById('chatbot-body').scrollTop = document.getElementById('chatbot-body')
                        .scrollHeight;
                    document.getElementById('chatbot-message').value = '';
                })
                .catch(error => {
                    console.error('Lỗi:', error); // Debug: xem lỗi
                    messagesDiv.innerHTML += `<div class="bot">Bot: Lỗi kết nối, thử lại sau.</div>`;
                    document.getElementById('chatbot-body').scrollTop = document.getElementById('chatbot-body')
                        .scrollHeight;
                });
        }
    </script>
</body>

</html>
