<?= $this->extend('layout/main') ?>

<?= $this->section('styles') ?>
<style>
    .chat-container {
        display: flex;
        height: calc(100vh - 70px); /* 100vh - topbar height */
        background-color: white;
    }

    /* Contact List (Left Sidebar) */
    .chat-sidebar {
        width: 320px;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        background-color: #f9fafb;
    }

    .chat-header {
        padding: 1.25rem;
        border-bottom: 1px solid #e5e7eb;
        background-color: white;
    }

    .search-box {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 9999px;
        outline: none;
        background-color: #f3f4f6;
        transition: all 0.2s;
        box-sizing: border-box;
    }

    .search-box:focus {
        border-color: var(--primary);
        background-color: white;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .contact-list {
        flex: 1;
        overflow-y: auto;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .contact-item {
        display: flex;
        align-items: center;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        cursor: pointer;
        transition: background-color 0.2s;
        position: relative;
    }

    .contact-item:hover {
        background-color: #f3f4f6;
    }

    .contact-item.active {
        background-color: #eef2ff;
        border-left: 4px solid var(--primary);
    }

    .contact-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: #d1d5db;
        margin-right: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: white;
        flex-shrink: 0;
    }

    .contact-info {
        flex: 1;
        overflow: hidden;
    }

    .contact-name {
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .contact-last-msg {
        font-size: 0.875rem;
        color: #6b7280;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .contact-badge {
        background-color: var(--danger);
        color: white;
        font-size: 0.75rem;
        padding: 0.1rem 0.5rem;
        border-radius: 9999px;
        font-weight: 700;
        margin-left: 0.5rem;
    }

    /* Chat Area (Right Side) */
    .chat-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        background-color: #ffffff;
        background-image: url('data:image/svg+xml,%3Csvg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23f3f4f6" fill-opacity="0.4" fill-rule="evenodd"%3E%3Ccircle cx="3" cy="3" r="3"/%3E%3Ccircle cx="13" cy="13" r="3"/%3E%3C/g%3E%3C/svg%3E');
    }

    .chat-area-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        background-color: white;
        display: flex;
        align-items: center;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        z-index: 5;
    }

    .chat-area-title {
        font-weight: 600;
        font-size: 1.125rem;
        color: #111827;
    }

    .chat-messages {
        flex: 1;
        padding: 1.5rem;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .message-wrapper {
        display: flex;
        flex-direction: column;
        max-width: 70%;
    }

    .message-wrapper.sent {
        align-self: flex-end;
    }

    .message-wrapper.received {
        align-self: flex-start;
    }

    .message-bubble {
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        font-size: 0.95rem;
        line-height: 1.5;
        position: relative;
    }

    .message-wrapper.sent .message-bubble {
        background-color: var(--primary);
        color: white;
        border-bottom-right-radius: 0.25rem;
    }

    .message-wrapper.received .message-bubble {
        background-color: white;
        color: #1f2937;
        border-bottom-left-radius: 0.25rem;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    .message-time-wrapper {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.75rem;
        color: #9ca3af;
        margin-top: 0.25rem;
    }
    
    .message-wrapper.sent .message-time-wrapper {
        align-self: flex-end;
    }
    
    .message-wrapper.received .message-time-wrapper {
        align-self: flex-start;
    }
    
    .message-actions {
        display: none;
        align-items: center;
        gap: 0.75rem;
        margin-top: 0.25rem;
        align-self: flex-end;
    }
    
    .message-wrapper.sent:hover .message-actions {
        display: flex;
    }
    
    .action-btn {
        color: #9ca3af;
        cursor: pointer;
        font-size: 0.8rem;
        transition: color 0.2s;
    }
    
    .action-btn:hover {
        color: var(--primary);
    }
    
    .action-btn.delete-btn:hover {
        color: var(--danger);
    }
    
    .message-deleted {
        font-style: italic;
        color: #9ca3af;
    }

    .message-edited {
        font-size: 0.65rem;
        color: #d1d5db;
        margin-left: 0.25rem;
        font-style: italic;
    }

    .chat-input-area {
        padding: 1rem 1.5rem;
        background-color: white;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .chat-input {
        flex: 1;
        padding: 0.875rem 1.25rem;
        border: 1px solid #d1d5db;
        border-radius: 9999px;
        outline: none;
        transition: all 0.2s;
        font-size: 0.95rem;
    }

    .chat-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .btn-send {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s;
        font-size: 1.25rem;
    }

    .btn-send:hover {
        background-color: var(--primary-hover);
    }
    
    .btn-send:disabled {
        background-color: #9ca3af;
        cursor: not-allowed;
    }

    .empty-state {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #6b7280;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="chat-container">
    <!-- Sidebar -->
    <div class="chat-sidebar">
        <div class="chat-header">
            <input type="text" class="search-box" placeholder="Cari warga atau grup...">
        </div>
        <ul class="contact-list" id="contact-list">
            <!-- Diisi oleh JavaScript -->
            <li style="padding: 2rem; text-align: center; color: #9ca3af;">Memuat daftar kontak...</li>
        </ul>
    </div>

    <!-- Main Chat Area -->
    <div class="chat-area" id="chat-area" style="display: none;">
        <div class="chat-area-header">
            <div class="contact-avatar" id="active-chat-avatar" style="width: 40px; height: 40px; margin-right: 1rem; font-size: 1rem;">U</div>
            <div class="chat-area-title" id="active-chat-title">Nama Kontak</div>
        </div>
        <div class="chat-messages" id="chat-messages">
            <!-- Diisi oleh JavaScript -->
        </div>
        <div class="chat-input-area" style="position: relative;">
            <button class="btn-emoji" id="btn-emoji" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #6b7280; padding: 0.5rem; transition: color 0.2s;"><i class="fa-regular fa-face-smile"></i></button>
            <input type="text" id="chat-input" class="chat-input" placeholder="Ketik pesan..." autocomplete="off">
            <button class="btn-send" id="btn-send" onclick="sendMessage()"><i class="fa-solid fa-paper-plane"></i></button>
            <!-- Wadah Emoji Picker (sembunyi secara default) -->
            <div id="emoji-picker-container" style="display: none; position: absolute; bottom: 80px; left: 10px; z-index: 1000; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-radius: 8px;">
                <emoji-picker></emoji-picker>
            </div>
        </div>
    </div>
    
    <div class="empty-state" id="empty-state">
        <i class="fa-regular fa-comments"></i>
        <h3>Pilih obrolan untuk mulai mengirim pesan</h3>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Script untuk Emoji Picker Element -->
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@1/index.js"></script>
<script>
    // State Aplikasi
    let contacts = [];
    let activeChatUid = null;
    let activeRoomId = null;
    let unreadCounts = {};
    let lastMessageString = ''; // Untuk mendeteksi pesan baru

    // MY_UID & getFirebaseToken() sudah didefinisikan secara global di layout/main.php
    const MY_NAME = (typeof CURRENT_USER_NAME !== 'undefined') ? CURRENT_USER_NAME : 'Appsbee Support';
    const VILLAGE_ID = 'ALL';
    // Map untuk menyimpan data pesan (untuk keperluan edit)
    const messageMap = {};

    // Helper: Parse format WhatsApp (*tebal*, _miring_, ~coret~, ```kode```, dan URL)
    function formatWhatsAppText(text) {
        if (!text) return '';
        // Hindari XSS
        let safeText = text.replace(/</g, "&lt;").replace(/>/g, "&gt;");
        
        // URL ke clickable link
        safeText = safeText.replace(/(https?:\/\/[^\s]+|www\.[^\s]+)/g, function(url) {
            let href = url.startsWith('www.') ? 'https://' + url : url;
            return `<a href="${href}" target="_blank" style="color:#3b82f6; text-decoration:underline;">${url}</a>`;
        });
        
        // Bold
        safeText = safeText.replace(/\*([^\*]+)\*/g, "<strong>$1</strong>");
        // Italic
        safeText = safeText.replace(/_([^_]+)_/g, "<em>$1</em>");
        // Strikethrough
        safeText = safeText.replace(/~([^~]+)~/g, "<del>$1</del>");
        // Code monospace
        safeText = safeText.replace(/```([^`]+)```/g, "<code style='font-family:monospace; background:rgba(0,0,0,0.1); padding:2px 4px; border-radius:4px;'>$1</code>");
        
        // Ganti newline dengan <br>
        safeText = safeText.replace(/\n/g, "<br>");
        
        return safeText;
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Init fetch
        fetchContacts();
        // Polling contacts
        setInterval(fetchContacts, 10000);
        
        // Polling setiap 3 detik untuk chat
        setInterval(pollChatData, 3000);
        
        // Setup tombol Enter untuk kirim
        document.getElementById('chat-input').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Event delegation untuk tombol edit & delete di bubble pesan
        document.getElementById('chat-messages').addEventListener('click', (e) => {
            const btn = e.target.closest('[data-action]');
            if (!btn) return;
            const action = btn.dataset.action;
            const id = btn.dataset.id;
            if (action === 'edit') {
                const oldMsg = messageMap[id] || '';
                editMessagePrompt(id, oldMsg);
            } else if (action === 'delete') {
                deleteMessage(id);
            }
        });

        // --- Logika Emoji Picker ---
        const btnEmoji = document.getElementById('btn-emoji');
        const emojiContainer = document.getElementById('emoji-picker-container');
        const chatInput = document.getElementById('chat-input');
        const emojiPicker = document.querySelector('emoji-picker');

        // Toggle tampilan picker
        btnEmoji.addEventListener('click', (e) => {
            e.stopPropagation();
            if (emojiContainer.style.display === 'none') {
                emojiContainer.style.display = 'block';
                btnEmoji.style.color = 'var(--primary)';
            } else {
                emojiContainer.style.display = 'none';
                btnEmoji.style.color = '#6b7280';
            }
        });

        // Menangkap event saat emoji dipilih
        emojiPicker.addEventListener('emoji-click', event => {
            const cursorPosition = chatInput.selectionStart;
            const textBefore = chatInput.value.substring(0, cursorPosition);
            const textAfter = chatInput.value.substring(cursorPosition, chatInput.value.length);
            
            chatInput.value = textBefore + event.detail.unicode + textAfter;
            chatInput.focus();
            
            // Pindahkan kursor setelah emoji yang baru dimasukkan
            const newCursorPosition = cursorPosition + event.detail.unicode.length;
            chatInput.setSelectionRange(newCursorPosition, newCursorPosition);
        });

        // Sembunyikan picker jika klik di luar area
        document.addEventListener('click', (e) => {
            if (e.target !== emojiContainer && !emojiContainer.contains(e.target) && e.target !== btnEmoji && !btnEmoji.contains(e.target)) {
                emojiContainer.style.display = 'none';
                btnEmoji.style.color = '#6b7280';
            }
        });
    });

    async function pollChatData() {
        // Ambil badge unread terbaru
        await fetchUnreadCounts();
        
        // Jika sedang buka chat, update isi pesan
        if (activeChatUid || activeRoomId) {
            await fetchMessages(false); // false = jangan scroll ke bawah jika tidak ada pesan baru
        }
    }

    async function fetchUnreadCounts() {
        try {
            const res = await fetch(`${API_URL}/chat/${VILLAGE_ID}/unread?uid=${MY_UID}`, { cache: 'no-store' });
            const data = await res.json();
            
            if (data.success) {
                // Deteksi jika ada unread baru untuk memunculkan Toast
                for (let key in data.data) {
                    const count = data.data[key];
                    const oldCount = unreadCounts[key] || 0;
                    
                    if (count > oldCount) {
                        // Ada pesan baru masuk yang belum dibaca!
                        // Pastikan ini BUKAN dari chat yang sedang kita buka
                        if (key !== activeChatUid && key !== activeRoomId) {
                            showToast("Pesan Baru", `Anda memiliki ${count - oldCount} pesan baru!`);
                            
                            // 🔔 MAIN KAN SUARA NOTIFIKASI
                            playNotificationSound();
                        }
                    }
                }
                
                unreadCounts = data.data;
                renderContacts(); // Update badge di list
            }
        } catch (error) {
            console.error("Gagal mengambil unread counts:", error);
        }
    }

    function playNotificationSound() {
        // Karena browser modern melarang autoplay sound tanpa interaksi,
        // Ini mungkin diblokir sampai user mengklik sesuatu di halaman.
        try {
            const audio = new Audio('https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3');
            audio.play().catch(e => console.log("Audio autoplay blocked by browser"));
        } catch(e) {}
    }

    async function fetchContacts() {
        try {
            const res = await fetch(`${API_URL}/chat/${VILLAGE_ID}/users`, {
                headers: { 'Authorization': `Bearer ${getFirebaseToken()}` }
            });
            const data = await res.json();
            
            if (data.success) {
                contacts = data.data;
                
                // Pastikan GROUP_ADMINS selalu ada di daftar kontak (sinkron dengan Flutter)
                const hasGroupAdmins = contacts.some(c => c.uid === 'GROUP_ADMINS');
                if (!hasGroupAdmins) {
                    contacts.unshift({
                        uid: 'GROUP_ADMINS',
                        name: 'Grup Admin Pusat',
                        isGroup: true,
                        isOnline: false,
                    });
                }
                
                renderContacts();
                await fetchUnreadCounts();
            }
        } catch (error) {
            document.getElementById('contact-list').innerHTML = `<li style="padding: 2rem; text-align: center; color: var(--danger);">Gagal memuat kontak. Pastikan Server API Node.js berjalan.</li>`;
        }
    }

    function renderContacts() {
        const list = document.getElementById('contact-list');
        list.innerHTML = '';
        
        // Urutkan kontak: Unread > Online/Grup > LastSeen
        contacts.sort((a, b) => {
            const unreadA = unreadCounts[a.uid] || 0;
            const unreadB = unreadCounts[b.uid] || 0;
            if (unreadB !== unreadA) return unreadB - unreadA; // Unread di atas
            
            const onlineA = (a.isOnline || a.isGroup) ? 1 : 0;
            const onlineB = (b.isOnline || b.isGroup) ? 1 : 0;
            if (onlineB !== onlineA) return onlineB - onlineA; // Online & Grup di atas
            
            const timeA = a.lastSeen ? new Date(a.lastSeen).getTime() : 0;
            const timeB = b.lastSeen ? new Date(b.lastSeen).getTime() : 0;
            return timeB - timeA; // Terakhir online terbaru di atas
        });
        
        contacts.forEach(contact => {
            const isGroup = contact.isGroup;
            const targetId = isGroup ? contact.uid : contact.uid;
            
            // Jangan tampilkan diri sendiri
            if (targetId === MY_UID) return;

            const unreadCount = unreadCounts[targetId] || 0;
            const badgeHtml = unreadCount > 0 ? `<span class="contact-badge">${unreadCount}</span>` : '';
            
            const isActive = (activeChatUid === targetId) || (activeRoomId === targetId);
            const initial = contact.name.charAt(0).toUpperCase();
            
            const li = document.createElement('li');
            li.className = `contact-item ${isActive ? 'active' : ''}`;
            li.onclick = () => openChat(targetId, contact.name, isGroup);
            
            // Indikator online
            const onlineIndicator = (contact.isOnline && !isGroup) 
                ? `<span style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; background-color: var(--success); border-radius: 50%; border: 2px solid white;"></span>`
                : '';

            // Format waktu terakhir online
            let lastMessageText = 'Offline';
            if (isGroup) {
                lastMessageText = 'Grup Obrolan';
            } else if (contact.isOnline) {
                lastMessageText = '<span style="color:var(--success);">Online</span>';
            } else if (contact.lastSeen) {
                const date = new Date(contact.lastSeen);
                const isToday = date.toDateString() === new Date().toDateString();
                const timeStr = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                const dateStr = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
                lastMessageText = `Terakhir online: ${isToday ? 'Hari ini ' + timeStr : dateStr}`;
            }

            li.innerHTML = `
                <div class="contact-avatar" style="position: relative; background-color: ${isGroup ? '#10b981' : '#6366f1'};">
                    ${isGroup ? '<i class="fa-solid fa-users"></i>' : initial}
                    ${onlineIndicator}
                </div>
                <div class="contact-info">
                    <div class="contact-name">${contact.name}</div>
                    <div class="contact-last-message">${lastMessageText}</div>
                </div>
                ${badgeHtml}
            `;
            
            list.appendChild(li);
        });
    }

    async function openChat(targetId, name, isGroup = false) {
        if (isGroup) {
            activeRoomId = targetId;
            activeChatUid = null;
        } else {
            activeChatUid = targetId;
            activeRoomId = null;
        }
        
        document.getElementById('active-chat-title').innerText = name;
        const initial = name.charAt(0).toUpperCase();
        document.getElementById('active-chat-avatar').innerHTML = isGroup ? '<i class="fa-solid fa-users"></i>' : initial;
        document.getElementById('active-chat-avatar').style.backgroundColor = isGroup ? '#10b981' : '#6366f1';
        
        document.getElementById('empty-state').style.display = 'none';
        document.getElementById('chat-area').style.display = 'flex';
        
        renderContacts(); // Update active state
        
        // Tandai sudah dibaca
        markAsRead(targetId, isGroup);
        
        // Reset count & Fetch messages
        lastMessageString = '';
        document.getElementById('chat-messages').innerHTML = '<div style="text-align:center; color:#9ca3af; margin-top:2rem;">Memuat pesan...</div>';
        await fetchMessages(true);
    }

    async function markAsRead(targetId, isGroup) {
        try {
            const payload = { uid: MY_UID };
            if (isGroup) payload.roomId = targetId;
            else payload.senderUid = targetId;
            
            await fetch(`${API_URL}/chat/${VILLAGE_ID}/mark-read`, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + getFirebaseToken()
                },
                body: JSON.stringify(payload)
            });
            
            // Hapus dari state lokal
            delete unreadCounts[targetId];
            fetchGlobalUnread(); // Update global badge
            renderContacts();
        } catch (e) {
            console.error("Gagal menandai dibaca:", e);
        }
    }

    async function fetchMessages(forceScroll = false) {
        if (!activeChatUid && !activeRoomId) return;
        
        try {
            // TargetUid khusus untuk membedakan endpoint
            const target = activeRoomId ? 'GROUP' : activeChatUid;
            const res = await fetch(`${API_URL}/chat/${VILLAGE_ID}/messages/${target}?uid=${MY_UID}&roomId=${activeRoomId || ''}`, { cache: 'no-store' });
            const data = await res.json();
            
            if (data.success) {
                const messages = data.data;
                
                // Gunakan JSON.stringify untuk mendeteksi pesan yang berubah isinya (edit/delete)
                const currentMessageString = JSON.stringify(messages);
                if (currentMessageString === lastMessageString && !forceScroll) return;
                
                const isNewMessage = messages.length > (JSON.parse(lastMessageString || '[]').length);
                lastMessageString = currentMessageString;
                
                const container = document.getElementById('chat-messages');
                container.innerHTML = '';
                
                if (messages.length === 0) {
                    container.innerHTML = '<div style="text-align:center; color:#9ca3af; margin-top:2rem;">Belum ada pesan. Mulai sapa sekarang!</div>';
                    return;
                }
                
                // Fungsi untuk menentukan ukuran emoji
                const getEmojiStyle = (text) => {
                    const withoutSpace = text.replace(/\s+/g, '');
                    if (!withoutSpace) return '';
                    let hasNormalText = false;
                    for (let i = 0; i < withoutSpace.length; i++) {
                        if (withoutSpace.charCodeAt(i) < 8000) {
                            hasNormalText = true;
                            break;
                        }
                    }
                    if (hasNormalText) return '';
                    const count = [...withoutSpace].length;
                    if (count === 1) return 'font-size: 3rem; line-height: 1.2; background: transparent; padding: 0; box-shadow: none;';
                    if (count === 2) return 'font-size: 2.25rem; line-height: 1.2; background: transparent; padding: 0; box-shadow: none;';
                    if (count === 3) return 'font-size: 1.75rem; line-height: 1.2; background: transparent; padding: 0; box-shadow: none;';
                    return 'font-size: 1.5rem; background: transparent; padding: 0; box-shadow: none;'; // Jika cuma emoji > 3
                };
                
                messages.forEach(msg => {
                    // Simpan teks pesan ke map untuk keperluan edit
                    messageMap[msg.id] = msg.message;
                    const isMine = msg.senderUid === MY_UID;
                    const time = new Date(msg.createdAt).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                    
                    const div = document.createElement('div');
                    div.className = `message-wrapper ${isMine ? 'sent' : 'received'}`;
                    
                    // Untuk grup, tampilkan nama pengirim jika itu bukan punya kita
                    let senderNameHtml = '';
                    if (activeRoomId && !isMine) {
                        senderNameHtml = `<div style="font-size:0.75rem; color:#6366f1; font-weight:600; margin-bottom:0.25rem;">${msg.senderName}</div>`;
                    }
                    
                    let contentHtml = '';
                    let actionHtml = '';
                    let tickHtml = '';
                    let editedHtml = msg.isEdited ? '<span class="message-edited">(diedit)</span>' : '';
                    
                    if (msg.isDeleted) {
                        contentHtml = `<div class="message-bubble"><span class="message-deleted"><i class="fa-solid fa-ban"></i> Pesan ini telah dihapus</span></div>`;
                    } else {
                        // Formatting ala WhatsApp dan escape HTML
                        const safeMsg = formatWhatsAppText(msg.message);
                        const emojiStyle = getEmojiStyle(msg.message);
                        contentHtml = `
                            <div class="message-bubble" style="${emojiStyle}">
                                ${senderNameHtml}
                                ${safeMsg}
                            </div>
                        `;
                        
                        if (isMine) {
                            const msgId = msg.id;
                            actionHtml = `
                                <div class="message-actions">
                                    <span class="action-btn" title="Edit Pesan" data-action="edit" data-id="${msgId}" style="cursor:pointer;"><i class="fa-solid fa-pen"></i></span>
                                    <span class="action-btn delete-btn" title="Hapus Pesan" data-action="delete" data-id="${msgId}" style="cursor:pointer;"><i class="fa-solid fa-trash"></i></span>
                                </div>
                            `;
                            tickHtml = msg.isRead 
                                ? `<i class="fa-solid fa-check-double" style="color: #3b82f6; font-size: 0.7rem; margin-left: 0.25rem;" title="Dibaca"></i>` 
                                : `<i class="fa-solid fa-check" style="font-size: 0.7rem; margin-left: 0.25rem;" title="Terkirim"></i>`;
                        }
                    }
                    
                    div.innerHTML = `
                        ${contentHtml}
                        ${actionHtml}
                        <div class="message-time-wrapper">
                            ${time} ${editedHtml} ${tickHtml}
                        </div>
                    `;
                    container.appendChild(div);
                });
                
                // Scroll to bottom
                if (isNewMessage || forceScroll) {
                    container.scrollTop = container.scrollHeight;
                }
                
                // Jika sedang chat, selalu tandai sudah dibaca saat pesan baru masuk
                markAsRead(activeRoomId || activeChatUid, !!activeRoomId);
            }
        } catch (error) {
            console.error("Gagal mengambil pesan:", error);
        }
    }

    async function editMessagePrompt(messageId, oldMessage) {
        const newMessage = prompt("Edit pesan Anda:", oldMessage);
        if (newMessage !== null && newMessage.trim() !== "" && newMessage !== oldMessage) {
            try {
                const res = await fetch(`${API_URL}/chat/${VILLAGE_ID}/messages/${messageId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + getFirebaseToken()
                    },
                    body: JSON.stringify({ message: newMessage.trim(), isEdited: true })
                });
                const data = await res.json();
                if (data.success) {
                    lastMessageString = ''; // Reset agar fetchMessages paksa re-render
                    await fetchMessages(true);
                } else {
                    Swal.fire('Gagal', "Gagal mengedit pesan: " + data.message, 'error');
                }
            } catch (error) {
                console.error("Gagal mengedit:", error);
                Swal.fire('Kesalahan', "Terjadi kesalahan jaringan.", 'error');
            }
        }
    }

    async function deleteMessage(messageId) {
        const result = await Swal.fire({
            title: 'Hapus Pesan?',
            text: 'Apakah Anda yakin ingin menghapus pesan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            confirmButtonColor: '#ef4444'
        });

        if (result.isConfirmed) {
            try {
                const res = await fetch(`${API_URL}/chat/${VILLAGE_ID}/messages/${messageId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + getFirebaseToken()
                    },
                    body: JSON.stringify({ isDeleted: true })
                });
                const data = await res.json();
                if (data.success) {
                    lastMessageString = ''; // Reset agar fetchMessages paksa re-render
                    await fetchMessages(true);
                } else {
                    Swal.fire('Gagal', "Gagal menghapus pesan: " + data.message, 'error');
                }
            } catch (error) {
                console.error("Gagal menghapus:", error);
                Swal.fire('Kesalahan', "Terjadi kesalahan jaringan.", 'error');
            }
        }
    }

    async function sendMessage() {
        const input = document.getElementById('chat-input');
        const text = input.value.trim();
        
        if (!text || (!activeChatUid && !activeRoomId)) return;
        
        const btn = document.getElementById('btn-send');
        btn.disabled = true;
        input.value = ''; // Kosongkan input agar terasa responsif
        
        try {
            const payload = {
                senderUid: MY_UID,
                senderName: MY_NAME,
                message: text,
                roomId: activeRoomId
            };
            
            if (!activeRoomId) {
                payload.receiverUid = activeChatUid;
                // Buat ID unik untuk personal chat
                payload.roomId = `PERSONAL_${[MY_UID, activeChatUid].sort().join('_')}`;
            }

            const res = await fetch(`${API_URL}/chat/${VILLAGE_ID}/messages`, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${getFirebaseToken()}` // Kirim Firebase token
                },
                body: JSON.stringify(payload)
            });
            
            const data = await res.json();
            if (data.success) {
                // Segera tarik pesan baru setelah berhasil kirim
                fetchMessages(true);
            } else {
                showToast("Error", data.message || data.error || "Gagal mengirim pesan.");
            }
        } catch (error) {
            console.error("Error send message:", error);
            showToast("Error", "Koneksi terputus saat mengirim pesan.");
        } finally {
            btn.disabled = false;
            input.focus();
        }
    }

    // Ping status online Super Admin ke Backend
    async function pingOnlineStatus(isOnline = true) {
        try {
            await fetch(`${API_URL}/master/users/${MY_UID}/online-status`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ isOnline })
            });
        } catch (error) {
            // Abaikan error ping
        }
    }

    // Ping pertama kali saat load, lalu tiap 30 detik
    pingOnlineStatus(true);
    setInterval(() => pingOnlineStatus(true), 30000);

    // Saat menutup browser, kirim status offline
    window.addEventListener('beforeunload', () => {
        fetch(`${API_URL}/master/users/${MY_UID}/online-status`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ isOnline: false }),
            keepalive: true
        });
    });
</script>
<?= $this->endSection() ?>
