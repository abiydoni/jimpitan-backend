<?= $this->extend('layout/main') ?>

<?= $this->section('styles') ?>
<style>
    .chat-container {
        display: flex;
        height: calc(100vh - 48px - 1.7rem); /* 100vh - topbar height - content padding */
        background-color: white;
        border-radius: 0.625rem;
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    /* Contact List (Left Sidebar) */
    .chat-sidebar {
        width: 250px;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        background-color: #f9fafb;
    }

    .chat-header {
        padding: 0.65rem 0.85rem;
        border-bottom: 1px solid #e5e7eb;
        background-color: white;
    }

    .search-box {
        width: 100%;
        padding: 0.35rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 9999px;
        outline: none;
        background-color: #f3f4f6;
        transition: all 0.2s;
        box-sizing: border-box;
        font-size: 0.8rem;
    }

    .search-box:focus {
        border-color: var(--primary);
        background-color: white;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
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
        padding: 0.5rem 0.75rem;
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
        border-left: 3px solid var(--primary);
    }

    .contact-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #d1d5db;
        margin-right: 0.65rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.85rem;
        color: white;
        flex-shrink: 0;
    }

    .contact-info {
        flex: 1;
        overflow: hidden;
    }

    .contact-name {
        font-weight: 600;
        font-size: 0.825rem;
        color: #111827;
        margin-bottom: 0.1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .contact-last-msg {
        font-size: 0.75rem;
        color: #6b7280;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .contact-badge {
        background-color: var(--danger);
        color: white;
        font-size: 0.68rem;
        padding: 1px 5px;
        border-radius: 9999px;
        font-weight: 700;
        margin-left: 0.35rem;
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
        padding: 0.65rem 1rem;
        border-bottom: 1px solid #e5e7eb;
        background-color: white;
        display: flex;
        align-items: center;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        z-index: 5;
    }

    .chat-area-title {
        font-weight: 600;
        font-size: 0.95rem;
        color: #111827;
    }

    .chat-messages {
        flex: 1;
        padding: 1rem;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
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
        padding: 0.45rem 0.75rem;
        border-radius: 0.65rem;
        font-size: 0.825rem;
        line-height: 1.35;
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
        font-size: 0.7rem;
        color: #9ca3af;
        margin-top: 0.15rem;
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
        gap: 0.5rem;
        margin-top: 0.15rem;
        align-self: flex-end;
    }
    
    .message-wrapper.sent:hover .message-actions {
        display: flex;
    }
    
    .action-btn {
        color: #9ca3af;
        cursor: pointer;
        font-size: 0.75rem;
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
        padding: 0.65rem 1rem;
        background-color: white;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 0.65rem;
        align-items: center;
    }

    .chat-input {
        flex: 1;
        padding: 0.45rem 0.85rem;
        border: 1px solid #d1d5db;
        border-radius: 9999px;
        outline: none;
        transition: all 0.2s;
        font-size: 0.825rem;
    }

    .chat-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
    }

    .btn-send {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background-color: var(--primary);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s;
        font-size: 0.95rem;
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
        <div class="chat-header" style="display:flex; flex-direction:column; gap:0.5rem;">
            <select class="search-box" id="chat-village-filter" onchange="changeVillage()" style="cursor: pointer; padding: 0.6rem 1rem;">
                <option value="ALL">Semua Desa (Pusat)</option>
            </select>
            <input type="text" id="contact-search-input" class="search-box" placeholder="Cari warga atau grup..." oninput="filterContactList()">
            <button type="button" id="btn-test-notif" onclick="triggerTestVillageNotif()" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white; border: none; border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);">
                <i class="fa-solid fa-flask"></i> Uji Coba Notifikasi Desa Baru
            </button>
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
    let VILLAGE_ID = 'ALL';
    let contactSearchQuery = '';
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

    // Helper: Ambil unread count untuk kontak (mendukung key UID maupun format ROOM)
    function getContactUnread(targetId) {
        if (!targetId || !unreadCounts) return 0;
        if (unreadCounts[targetId]) return Number(unreadCounts[targetId]) || 0;
        for (let k in unreadCounts) {
            if (k.includes(targetId) && (Number(unreadCounts[k]) > 0)) {
                return Number(unreadCounts[k]);
            }
        }
        return 0;
    }

    // Helper: Cek URL query parameter untuk otomatis membuka chat
    let _hasAutoOpened = false;
    function checkUrlAutoOpen() {
        if (_hasAutoOpened) return;
        const urlParams = new URLSearchParams(window.location.search);
        const partner = urlParams.get('partner') || urlParams.get('target') || urlParams.get('chat');
        if (partner && contacts && contacts.length > 0) {
            const found = contacts.find(c => c.uid === partner);
            if (found) {
                _hasAutoOpened = true;
                openChat(found.uid, found.name, !!found.isGroup);
            } else if (partner === 'SYSTEM_BOT') {
                _hasAutoOpened = true;
                openChat('SYSTEM_BOT', 'Sistem Registrasi', false);
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // 1. Render kontak dari cache seketika (0 ms delay) jika sudah pernah dibuka
        try {
            const cached = sessionStorage.getItem('chat_contacts_cache_' + VILLAGE_ID);
            if (cached) {
                contacts = JSON.parse(cached);
                renderContacts();
                checkUrlAutoOpen();
            }
        } catch (e) {}

        // 2. Fetch dropdown desa & data kontak segar di background
        fetchChatVillages();
        fetchContacts();
        
        // Polling kontak setiap 30 detik (tidak perlu terlalu sering agar hemat bandwidth & CPU)
        setInterval(fetchContacts, 30000);
        
        // Polling setiap 3 detik khusus untuk chat pesan baru & unread
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

        emojiPicker.addEventListener('emoji-click', event => {
            const cursorPosition = chatInput.selectionStart;
            const textBefore = chatInput.value.substring(0, cursorPosition);
            const textAfter = chatInput.value.substring(cursorPosition, chatInput.value.length);
            
            chatInput.value = textBefore + event.detail.unicode + textAfter;
            chatInput.focus();
            
            const newCursorPosition = cursorPosition + event.detail.unicode.length;
            chatInput.setSelectionRange(newCursorPosition, newCursorPosition);
        });

        document.addEventListener('click', (e) => {
            if (e.target !== emojiContainer && !emojiContainer.contains(e.target) && e.target !== btnEmoji && !btnEmoji.contains(e.target)) {
                emojiContainer.style.display = 'none';
                btnEmoji.style.color = '#6b7280';
            }
        });
    });

    async function fetchChatVillages() {
        try {
            let data = null;
            // Gunakan master/villages yang ringan atau fallback lokal
            try {
                const res = await fetch(`${API_URL}/master/villages`, {
                    headers: { 'Authorization': `Bearer ${FIREBASE_ID_TOKEN}` }
                });
                data = await res.json();
            } catch(e) {}

            if (!data || !data.success) {
                try {
                    const localRes = await fetch(`<?= base_url('/wa_blast/villages') ?>`);
                    data = await localRes.json();
                } catch(e) {}
            }

            if (data && data.success && Array.isArray(data.data)) {
                const select = document.getElementById('chat-village-filter');
                select.innerHTML = '<option value="ALL">Semua Desa (Pusat)</option>';
                data.data.forEach(v => {
                    const opt = document.createElement('option');
                    opt.value = v.id;
                    opt.textContent = v.name;
                    select.appendChild(opt);
                });
                if (VILLAGE_ID) select.value = VILLAGE_ID;
            }
        } catch(e) {
            console.error('Error fetching villages', e);
        }
    }

    function changeVillage() {
        VILLAGE_ID = document.getElementById('chat-village-filter').value;
        
        // Reset state
        activeChatUid = null;
        activeRoomId = null;
        unreadCounts = {};
        contacts = [];
        _hasAutoOpened = false;
        
        document.getElementById('empty-state').style.display = 'flex';
        document.getElementById('chat-area').style.display = 'none';
        
        // Coba render cache desa yang baru dipilih
        try {
            const cached = sessionStorage.getItem('chat_contacts_cache_' + VILLAGE_ID);
            if (cached) {
                contacts = JSON.parse(cached);
                renderContacts();
            } else {
                document.getElementById('contact-list').innerHTML = '<li style="padding: 2rem; text-align: center; color: #9ca3af;">Memuat daftar kontak...</li>';
            }
        } catch(e) {
            document.getElementById('contact-list').innerHTML = '<li style="padding: 2rem; text-align: center; color: #9ca3af;">Memuat daftar kontak...</li>';
        }
        
        fetchContacts();
    }

    function filterContactList() {
        contactSearchQuery = document.getElementById('contact-search-input').value;
        renderContacts();
    }

    async function triggerTestVillageNotif() {
        const btn = document.getElementById('btn-test-notif');
        const origHtml = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim Notif...';
        
        try {
            const token = (typeof FIREBASE_ID_TOKEN !== 'undefined') ? FIREBASE_ID_TOKEN : '';
            const res = await fetch(`${API_URL}/chat/test-village-notification`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    villageName: 'Desa Uji Coba Mandiri ' + Math.floor(Math.random() * 900 + 100),
                    address: 'Jl. Merdeka No. 45, RT 02 / RW 05',
                    registrantName: 'Bapak Hendra (Admin Baru)',
                    registrantPhone: '081234567890',
                    registrantEmail: 'hendra.desa@jimpitan.id'
                })
            });
            const data = await res.json();
            if (data.success) {
                showToast('Sukses', 'Notifikasi pendaftaran desa berhasil dikirim ke Chat Personal Super Admin!');
                document.getElementById('chat-village-filter').value = 'ALL';
                VILLAGE_ID = 'ALL';
                await fetchContacts();
                const partnerUid = (data.data && data.data.partnerUid) ? data.data.partnerUid : 'SYSTEM_BOT';
                await openChat(partnerUid, 'Sistem Registrasi', false);
            } else {
                showAlert('Gagal', data.message || 'Gagal mengirim notifikasi uji coba');
            }
        } catch (err) {
            console.error('Error triggerTestVillageNotif:', err);
            showAlert('Gagal', 'Terjadi kesalahan koneksi saat mengirim notifikasi.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = origHtml;
        }
    }

    async function pollChatData() {
        // Ambil badge unread terbaru
        await fetchUnreadCounts();
        
        // Jika sedang buka chat, update isi pesan
        if (activeChatUid || activeRoomId) {
            await fetchMessages(false);
        }
    }

    async function fetchUnreadCounts() {
        try {
            const res = await fetch(`${API_URL}/chat/${VILLAGE_ID}/unread?uid=${MY_UID}`, { cache: 'no-store' });
            const data = await res.json();
            
            if (data.success && data.data) {
                const newCounts = data.data;
                const oldString = JSON.stringify(unreadCounts);
                const newString = JSON.stringify(newCounts);
                
                // Deteksi jika ada unread baru untuk memunculkan Toast & suara
                for (let key in newCounts) {
                    const count = newCounts[key];
                    const oldCount = unreadCounts[key] || 0;
                    
                    if (count > oldCount) {
                        if (key !== activeChatUid && key !== activeRoomId) {
                            showToast("Pesan Baru", `Anda memiliki ${count - oldCount} pesan baru!`);
                            playNotificationSound();
                        }
                    }
                }
                
                unreadCounts = newCounts;
                
                // Hanya re-render list jika ada perubahan unread agar UI tetap ringan
                if (oldString !== newString) {
                    renderContacts();
                }
            }
        } catch (error) {
            console.error("Gagal mengambil unread counts:", error);
        }
    }

    function playNotificationSound() {
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
            
            if (data.success && Array.isArray(data.data)) {
                contacts = data.data;
                
                // Pastikan GROUP_ADMINS selalu ada di daftar kontak
                const hasGroupAdmins = contacts.some(c => c.uid === 'GROUP_ADMINS');
                if (!hasGroupAdmins) {
                    contacts.unshift({
                        uid: 'GROUP_ADMINS',
                        name: 'Grup Admin Pusat',
                        isGroup: true,
                        isOnline: false,
                    });
                }

                // Pastikan SYSTEM_BOT selalu ada di daftar kontak Super Admin
                const hasSystemBot = contacts.some(c => c.uid === 'SYSTEM_BOT');
                if (!hasSystemBot && VILLAGE_ID === 'ALL') {
                    contacts.unshift({
                        uid: 'SYSTEM_BOT',
                        name: 'Sistem Registrasi',
                        foto: 'https://cdn-icons-png.flaticon.com/512/4712/4712109.png',
                        isOnline: true,
                    });
                }
                
                // Simpan ke cache lokal
                try {
                    sessionStorage.setItem('chat_contacts_cache_' + VILLAGE_ID, JSON.stringify(contacts));
                } catch(e) {}

                renderContacts();
                await fetchUnreadCounts();
                checkUrlAutoOpen();
            }
        } catch (error) {
            if (!contacts || contacts.length === 0) {
                document.getElementById('contact-list').innerHTML = `<li style="padding: 2rem; text-align: center; color: var(--danger);">Gagal memuat kontak. Pastikan Server API Node.js berjalan.</li>`;
            }
        }
    }

    function renderContacts() {
        const list = document.getElementById('contact-list');
        if (!contacts || contacts.length === 0) {
            return;
        }
        
        // Filter berdasarkan pencarian
        let filteredContacts = contacts;
        if (contactSearchQuery.trim() !== '') {
            const query = contactSearchQuery.toLowerCase();
            filteredContacts = contacts.filter(c => (c.name || '').toLowerCase().includes(query));
        }

        // Urutkan kontak secara cerdas:
        // 1. Unread count tertinggi
        // 2. SYSTEM_BOT & GROUP_ADMINS (Pusat) diprioritaskan
        // 3. Online
        // 4. Terakhir aktif
        filteredContacts.sort((a, b) => {
            const unreadA = getContactUnread(a.uid);
            const unreadB = getContactUnread(b.uid);
            if (unreadB !== unreadA) return unreadB - unreadA; // Unread di atas
            
            const isPriorityA = (a.uid === 'SYSTEM_BOT' || a.uid === 'GROUP_ADMINS') ? 1 : 0;
            const isPriorityB = (b.uid === 'SYSTEM_BOT' || b.uid === 'GROUP_ADMINS') ? 1 : 0;
            if (isPriorityB !== isPriorityA) return isPriorityB - isPriorityA;

            const onlineA = (a.isOnline || a.isGroup) ? 1 : 0;
            const onlineB = (b.isOnline || b.isGroup) ? 1 : 0;
            if (onlineB !== onlineA) return onlineB - onlineA; // Online & Grup di atas
            
            const timeA = a.lastSeen ? new Date(a.lastSeen).getTime() : 0;
            const timeB = b.lastSeen ? new Date(b.lastSeen).getTime() : 0;
            return timeB - timeA;
        });

        // Gunakan DocumentFragment agar 1 pass DOM render (sangat cepat, 0 lag!)
        const fragment = document.createDocumentFragment();
        
        filteredContacts.forEach(contact => {
            const isGroup = !!contact.isGroup;
            const targetId = contact.uid;
            
            // Jangan tampilkan diri sendiri
            if (targetId === MY_UID) return;

            const unreadCount = getContactUnread(targetId);
            const badgeHtml = unreadCount > 0 ? `<span class="contact-badge">${unreadCount}</span>` : '';
            
            const isActive = (activeChatUid === targetId) || (activeRoomId === targetId);
            const initial = (contact.name || 'U').charAt(0).toUpperCase();
            
            const li = document.createElement('li');
            li.className = `contact-item ${isActive ? 'active' : ''}`;
            li.onclick = () => openChat(targetId, contact.name, isGroup);
            
            const isSystemBot = (targetId === 'SYSTEM_BOT');
            const avatarColor = isSystemBot ? '#f59e0b' : (isGroup ? '#10b981' : '#6366f1');
            const avatarIcon = isSystemBot ? '<i class="fa-solid fa-robot"></i>' : (isGroup ? '<i class="fa-solid fa-users"></i>' : initial);

            // Indikator online
            const onlineIndicator = (contact.isOnline && !isGroup) 
                ? `<span style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; background-color: var(--success); border-radius: 50%; border: 2px solid white;"></span>`
                : '';

            // Format waktu terakhir online
            let lastMessageText = 'Offline';
            if (isSystemBot) {
                lastMessageText = '<span style="color:#f59e0b; font-weight:600;">Notifikasi Pendaftaran</span>';
            } else if (isGroup) {
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
                <div class="contact-avatar" style="position: relative; background-color: ${avatarColor};">
                    ${avatarIcon}
                    ${onlineIndicator}
                </div>
                <div class="contact-info">
                    <div class="contact-name">${contact.name || targetId}</div>
                    <div class="contact-last-message">${lastMessageText}</div>
                </div>
                ${badgeHtml}
            `;
            
            fragment.appendChild(li);
        });

        list.replaceChildren(fragment);
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
        const initial = (name || 'U').charAt(0).toUpperCase();
        const isSystemBot = (targetId === 'SYSTEM_BOT');
        const avatarColor = isSystemBot ? '#f59e0b' : (isGroup ? '#10b981' : '#6366f1');
        const avatarIcon = isSystemBot ? '<i class="fa-solid fa-robot"></i>' : (isGroup ? '<i class="fa-solid fa-users"></i>' : initial);

        document.getElementById('active-chat-avatar').innerHTML = avatarIcon;
        document.getElementById('active-chat-avatar').style.backgroundColor = avatarColor;
        
        document.getElementById('empty-state').style.display = 'none';
        document.getElementById('chat-area').style.display = 'flex';
        
        renderContacts(); // Update active state
        
        // Tandai sudah dibaca jika memang ada pesan unread
        markAsRead(targetId, isGroup);
        
        // Reset count & Fetch messages
        lastMessageString = '';
        document.getElementById('chat-messages').innerHTML = '<div style="text-align:center; color:#9ca3af; margin-top:2rem;"><i class="fa-solid fa-spinner fa-spin"></i> Memuat percakapan...</div>';
        await fetchMessages(true);
    }

    async function markAsRead(targetId, isGroup) {
        if (!targetId) return;
        const unreadCount = getContactUnread(targetId);
        if (unreadCount <= 0) return;

        try {
            const payload = { uid: MY_UID };
            if (isGroup) payload.roomId = targetId;
            else payload.senderUid = targetId;
            
            // Hapus dari state lokal seketika agar badge langsung hilang tanpa delay
            delete unreadCounts[targetId];
            for (let k in unreadCounts) {
                if (k.includes(targetId)) delete unreadCounts[k];
            }
            renderContacts();

            await fetch(`${API_URL}/chat/${VILLAGE_ID}/mark-read`, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + getFirebaseToken()
                },
                body: JSON.stringify(payload)
            });
            
            fetchGlobalUnread(); // Update global badge
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
                
                // Jika sedang chat, hanya tandai sudah dibaca saat ada pesan baru masuk
                if (isNewMessage) {
                    markAsRead(activeRoomId || activeChatUid, !!activeRoomId);
                }
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
