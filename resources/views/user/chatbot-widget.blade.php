{{-- Chatbot Widget - Floating Button & Chat Window --}}
<div id="chatbot-widget">
    {{-- Floating Button --}}
    <button id="chatbot-toggle" class="chatbot-toggle">
        <i class="fas fa-comments"></i>
        <span class="badge badge-danger chatbot-badge" id="new-message-badge" style="display: none;">1</span>
    </button>

    {{-- Chat Window --}}
    <div id="chatbot-window" class="chatbot-window" style="display: none;">
        {{-- Header --}}
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
            <button id="chatbot-close" class="btn btn-sm text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{-- Chat Messages --}}
        <div class="chatbot-messages" id="chatbot-messages">
            <div class="message bot-message">
                <div class="message-content">
                    <p>👋 Halo! Saya asisten kesehatan virtual Posyandu.</p>
                    <p>Silakan tanyakan seputar kesehatan ibu dan anak. Bagaimana saya bisa membantu Anda hari ini?</p>
                </div>
                <small class="message-time">{{ now()->format('H:i') }}</small>
            </div>
        </div>

        {{-- Input Area --}}
        <div class="chatbot-input">
            <form id="chatbot-form">
                @csrf
                <div class="input-group">
                    <input type="text"
                           id="chatbot-message-input"
                           class="form-control"
                           placeholder="Ketik pertanyaan Anda..."
                           maxlength="500"
                           required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary" id="chatbot-send-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </form>
            <small class="text-muted d-block mt-1">
                <i class="fas fa-info-circle"></i> Untuk informasi umum. Konsultasi langsung dengan bidan untuk kondisi serius.
            </small>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Chatbot Toggle Button */
    .chatbot-toggle {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .chatbot-toggle:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    }

    .chatbot-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Chat Window */
    .chatbot-window {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 380px;
        height: 500px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        display: flex;
        flex-direction: column;
        z-index: 1000;
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

    /* Header */
    .chatbot-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px;
        border-radius: 15px 15px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chatbot-avatar {
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    /* Messages Area */
    .chatbot-messages {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
        background: #f8f9fa;
    }

    .message {
        margin-bottom: 15px;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .message-content {
        display: inline-block;
        max-width: 80%;
        padding: 10px 15px;
        border-radius: 15px;
        word-wrap: break-word;
    }

    .bot-message .message-content {
        background: white;
        border: 1px solid #e9ecef;
    }

    .user-message {
        text-align: right;
    }

    .user-message .message-content {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .message-time {
        display: block;
        font-size: 11px;
        color: #6c757d;
        margin-top: 5px;
    }

    .typing-indicator {
        display: inline-block;
        padding: 10px 15px;
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 15px;
    }

    .typing-indicator span {
        display: inline-block;
        width: 8px;
        height: 8px;
        background: #6c757d;
        border-radius: 50%;
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
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-10px); }
    }

    /* Input Area */
    .chatbot-input {
        padding: 15px;
        background: white;
        border-top: 1px solid #e9ecef;
        border-radius: 0 0 15px 15px;
    }

    .chatbot-input .form-control {
        border-radius: 20px;
        border: 1px solid #e9ecef;
    }

    .chatbot-input .btn {
        border-radius: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .chatbot-window {
            width: calc(100% - 40px);
            right: 20px;
            left: 20px;
            height: 450px;
        }
    }

    /* Scrollbar */
    .chatbot-messages::-webkit-scrollbar {
        width: 6px;
    }

    .chatbot-messages::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .chatbot-messages::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }

    .chatbot-messages::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    const toggleBtn = $('#chatbot-toggle');
    const chatWindow = $('#chatbot-window');
    const closeBtn = $('#chatbot-close');
    const messagesContainer = $('#chatbot-messages');
    const form = $('#chatbot-form');
    const input = $('#chatbot-message-input');
    const sendBtn = $('#chatbot-send-btn');

    // Toggle chat window
    toggleBtn.on('click', function() {
        chatWindow.toggle();
        $('#new-message-badge').hide();
    });

    closeBtn.on('click', function() {
        chatWindow.hide();
    });

    // Send message
    form.on('submit', function(e) {
        e.preventDefault();

        const message = input.val().trim();
        if (!message) return;

        // Add user message
        addMessage(message, 'user');
        input.val('');

        // Show typing indicator
        showTypingIndicator();

        // Send to server
        $.ajax({
            url: '{{ route("user.chatbot.send") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                message: message
            },
            success: function(response) {
                hideTypingIndicator();
                if (response.success) {
                    addMessage(response.response, 'bot');
                } else {
                    addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'bot');
                }
            },
            error: function() {
                hideTypingIndicator();
                addMessage('Maaf, layanan chatbot sedang tidak tersedia.', 'bot');
            }
        });
    });

    // Add message to chat
    function addMessage(text, type) {
        const time = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        const messageClass = type === 'user' ? 'user-message' : 'bot-message';

        const messageHtml = `
            <div class="message ${messageClass}">
                <div class="message-content">
                    <p>${escapeHtml(text)}</p>
                </div>
                <small class="message-time">${time}</small>
            </div>
        `;

        messagesContainer.append(messageHtml);
        scrollToBottom();
    }

    // Show typing indicator
    function showTypingIndicator() {
        const typingHtml = `
            <div class="message bot-message typing-message">
                <div class="typing-indicator">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        `;
        messagesContainer.append(typingHtml);
        scrollToBottom();
    }

    // Hide typing indicator
    function hideTypingIndicator() {
        $('.typing-message').remove();
    }

    // Scroll to bottom
    function scrollToBottom() {
        messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
    }

    // Escape HTML
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
});
</script>
@endpush
