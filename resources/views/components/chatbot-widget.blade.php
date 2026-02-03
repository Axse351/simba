{{-- Chatbot Widget --}}
<div id="chatbot-widget" class="chatbot-widget">
    {{-- Toggle Button --}}
    <button id="chatbot-toggle" class="chatbot-toggle-btn" type="button">
        <i class="fas fa-comment-medical"></i>
        <span class="badge badge-danger" id="unread-badge" style="display: none;">0</span>
    </button>

    {{-- Chatbot Container --}}
    <div id="chatbot-container" class="chatbot-container" style="display: none;">
        <div class="chatbot-header">
            <div class="d-flex align-items-center">
                <div class="chatbot-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="ml-2">
                    <h6 class="mb-0">Asisten Kesehatan</h6>
                    <small class="text-white-50">Online</small>
                </div>
            </div>
            <button id="chatbot-close" class="btn btn-sm text-white" type="button">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div id="chatbot-messages" class="chatbot-messages">
            <div class="message bot-message">
                <div class="message-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="message-content">
                    <p>Halo! Saya asisten kesehatan virtual. Ada yang bisa saya bantu?</p>
                    <small class="text-muted">{{ now()->format('H:i') }}</small>
                </div>
            </div>
        </div>

        <div class="chatbot-input">
            <form id="chatbot-form" autocomplete="off">
                @csrf
                <div class="input-group">
                    <input type="text"
                           id="chatbot-input"
                           class="form-control"
                           placeholder="Ketik pertanyaan Anda..."
                           autocomplete="off"
                           required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary" id="send-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </form>
            <small class="text-muted d-block mt-1">
                <i class="fas fa-info-circle"></i> Tekan Enter atau klik kirim
            </small>
        </div>
    </div>
</div>

{{-- Chatbot Styles --}}
<style>
    .chatbot-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }

    .chatbot-toggle-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-size: 24px;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .chatbot-toggle-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.6);
    }

    .chatbot-toggle-btn .badge {
        position: absolute;
        top: -5px;
        right: -5px;
        padding: 4px 6px;
        font-size: 10px;
    }

    .chatbot-container {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 380px;
        height: 500px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chatbot-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chatbot-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .chatbot-messages {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
        background: #f8f9fa;
    }

    .chatbot-messages::-webkit-scrollbar {
        width: 6px;
    }

    .chatbot-messages::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 3px;
    }

    .message {
        display: flex;
        margin-bottom: 15px;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    .bot-message .message-avatar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .user-message {
        flex-direction: row-reverse;
    }

    .user-message .message-avatar {
        background: #6c757d;
        color: white;
    }

    .message-content {
        max-width: 75%;
        margin: 0 10px;
    }

    .message-content p {
        background: white;
        padding: 10px 15px;
        border-radius: 12px;
        margin: 0 0 5px 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        word-wrap: break-word;
    }

    .user-message .message-content p {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .typing-indicator {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        background: white;
        border-radius: 12px;
        width: fit-content;
    }

    .typing-indicator span {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #cbd5e0;
        margin: 0 2px;
        animation: typing 1.4s infinite;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typing {
        0%, 60%, 100% {
            transform: translateY(0);
        }
        30% {
            transform: translateY(-10px);
        }
    }

    .chatbot-input {
        padding: 15px;
        background: white;
        border-top: 1px solid #e2e8f0;
    }

    .chatbot-input .form-control {
        border-radius: 20px;
        border: 1px solid #cbd5e0;
        padding: 10px 15px;
    }

    .chatbot-input .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .chatbot-input .btn-primary {
        border-radius: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 10px 20px;
    }

    .chatbot-input .btn-primary:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }

    @media (max-width: 576px) {
        .chatbot-container {
            width: calc(100vw - 40px);
            height: 70vh;
            bottom: 90px;
            right: 20px;
        }
    }
</style>

{{-- Chatbot Scripts --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('chatbot-toggle');
    const closeBtn = document.getElementById('chatbot-close');
    const chatContainer = document.getElementById('chatbot-container');
    const chatForm = document.getElementById('chatbot-form');
    const chatInput = document.getElementById('chatbot-input');
    const messagesContainer = document.getElementById('chatbot-messages');
    const sendBtn = document.getElementById('send-btn');

    // Toggle chatbot
    toggleBtn.addEventListener('click', function() {
        if (chatContainer.style.display === 'none') {
            chatContainer.style.display = 'flex';
            chatInput.focus();
        } else {
            chatContainer.style.display = 'none';
        }
    });

    // Close chatbot
    closeBtn.addEventListener('click', function() {
        chatContainer.style.display = 'none';
    });

    // Handle form submission
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault(); // PENTING: Mencegah reload halaman

        const message = chatInput.value.trim();

        if (message === '') {
            return;
        }

        // Tambahkan pesan user
        addMessage(message, 'user');

        // Kosongkan input
        chatInput.value = '';

        // Disable input sementara
        chatInput.disabled = true;
        sendBtn.disabled = true;

        // Tampilkan typing indicator
        showTypingIndicator();

        // Kirim ke API
        sendMessageToAPI(message);
    });

    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}-message`;

        const time = new Date().toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        });

        messageDiv.innerHTML = `
            <div class="message-avatar">
                <i class="fas fa-${sender === 'bot' ? 'robot' : 'user'}"></i>
            </div>
            <div class="message-content">
                <p>${escapeHtml(text)}</p>
                <small class="text-muted">${time}</small>
            </div>
        `;

        messagesContainer.appendChild(messageDiv);
        scrollToBottom();
    }

    function showTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'message bot-message';
        typingDiv.id = 'typing-indicator';

        typingDiv.innerHTML = `
            <div class="message-avatar">
                <i class="fas fa-robot"></i>
            </div>
            <div class="message-content">
                <div class="typing-indicator">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        `;

        messagesContainer.appendChild(typingDiv);
        scrollToBottom();
    }

    function removeTypingIndicator() {
        const typingIndicator = document.getElementById('typing-indicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

    function sendMessageToAPI(message) {
        // Ganti dengan endpoint API Anda
        fetch('{{ route("user.chatbot.send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            removeTypingIndicator();

            if (data.success) {
                addMessage(data.response, 'bot');
            } else {
                addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'bot');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            removeTypingIndicator();
            addMessage('Maaf, tidak dapat terhubung ke server. Silakan coba lagi.', 'bot');
        })
        .finally(() => {
            // Enable input kembali
            chatInput.disabled = false;
            sendBtn.disabled = false;
            chatInput.focus();
        });
    }

    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Focus input saat chatbot dibuka
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.target.style.display === 'flex') {
                chatInput.focus();
            }
        });
    });

    observer.observe(chatContainer, {
        attributes: true,
        attributeFilter: ['style']
    });
});
</script>
@endpush
