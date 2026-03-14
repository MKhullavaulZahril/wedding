/**
 * cart.js — Wedding Organizations Shopping Cart
 * Uses localStorage for persistent cart storage.
 */

const CART_KEY = 'wo_cart';

// ── STORAGE HELPERS ──────────────────────────────────────
function getCart() {
    try {
        return JSON.parse(localStorage.getItem(CART_KEY)) || [];
    } catch { return []; }
}

function saveCart(cart) {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
}

function addToCart(item) {
    const cart = getCart();
    // Prevent duplicate (same id & type)
    const exists = cart.find(c => c.id === item.id && c.type === item.type);
    if (exists) return false;
    cart.push(item);
    saveCart(cart);
    return true;
}

function removeFromCart(id, type) {
    let cart = getCart();
    cart = cart.filter(c => !(c.id === id && c.type === type));
    saveCart(cart);
}

function clearCart() {
    localStorage.removeItem(CART_KEY);
}

// ── RENDER ───────────────────────────────────────────────
function renderCart() {
    const cart = getCart();
    const badge = document.querySelector('.cart-badge');
    const itemsArea = document.querySelector('.cart-items-area');
    const footer = document.querySelector('.cart-footer');

    if (!itemsArea) return;

    // Update badge
    if (badge) {
        if (cart.length > 0) {
            badge.textContent = cart.length;
            badge.classList.add('visible');
        } else {
            badge.classList.remove('visible');
        }
    }

    // Render items
    if (cart.length === 0) {
        itemsArea.innerHTML = `
            <div class="cart-empty">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                <p class="empty-label">Keranjang Kosong</p>
                <p>Jelajahi venue dan vendor impian Anda,<br>lalu simpan ke keranjang.</p>
            </div>`;
        if (footer) footer.style.display = 'none';
        return;
    }

    if (footer) footer.style.display = 'flex';

    itemsArea.innerHTML = cart.map(item => `
        <div class="cart-item" data-id="${item.id}" data-type="${item.type}">
            <img class="cart-item-img"
                 src="${item.image || 'https://via.placeholder.com/70'}"
                 alt="${item.name}"
                 onerror="this.style.background='rgba(200,170,110,0.15)'">
            <div class="cart-item-info">
                <div class="cart-item-type">${item.type === 'venue' ? '🏛 Venue' : '🌸 Vendor'}</div>
                <div class="cart-item-name">${item.name}</div>
                <div class="cart-item-price">${item.price || ''}</div>
                <div class="cart-item-location">${item.location || ''}</div>
            </div>
            <button class="cart-item-remove" onclick="woCartRemove('${item.id}','${item.type}')" title="Hapus">
                <svg style="pointer-events: none;" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
    `).join('');
}

// ── PUBLIC API ────────────────────────────────────────────
window.woCartRemove = function (id, type) {
    const cart = getCart();
    const item = cart.find(c => c.id === id && c.type === type);
    const itemName = item ? item.name : 'Item';

    woConfirm('Hapus Item?', `Apakah Anda yakin ingin menghapus <strong>${itemName}</strong> dari keranjang impian Anda?`, function() {
        removeFromCart(id, type);
        renderCart();
        // Update add-button state if on detail page
        updateAddButtonState(id, type);
        woShowNotification('info', 'Dihapus', `${itemName} telah dihapus dari keranjang.`);
    });
};

window.woCartClear = function () {
    woConfirm('Kosongkan Keranjang?', 'Apakah Anda yakin ingin menghapus <strong>semua item</strong> dari keranjang impian Anda?', function() {
        clearCart();
        renderCart();
        updateAllAddButtons();
        woShowNotification('info', 'Keranjang Kosong', 'Semua item telah dibersihkan.');
    });
};

window.woCartAdd = function (item) {
    const added = addToCart(item);
    renderCart();
    toggleCartPanel(true);
    
    if (added) {
        woShowNotification('success', 'Tersimpan', `${item.name} telah ditambahkan ke keranjang impian Anda.`);
    }
    return added;
};

// ── NOTIFICATIONS ─────────────────────────────────────────
window.woShowNotification = function(type, title, message) {
    if (!document.getElementById('woPremiumStyles')) {
        const style = document.createElement('style');
        style.id = 'woPremiumStyles';
        style.innerHTML = `
            .wo-notification-container { position: fixed; top: 24px; left: 50%; transform: translateX(-50%); z-index: 99999; display: flex; flex-direction: column; gap: 12px; pointer-events: none; }
            .wo-notification { min-width: 320px; padding: 16px 20px; background: rgba(255, 253, 250, 0.98); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-left: 3px solid #C9A96E; border-radius: 12px; box-shadow: 0 12px 40px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 14px; pointer-events: auto; animation: woToastIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards, woToastOut 0.5s cubic-bezier(0.7, 0, 0.84, 0) forwards 3.5s; }
            .wo-notification.success { border-left-color: #6EA87A; }
            .wo-notification.error { border-left-color: #B8455A; }
            .wo-notification-icon { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
            .wo-notification.success .wo-notification-icon { background: rgba(110, 168, 122, 0.1); color: #6EA87A; }
            .wo-notification.error .wo-notification-icon { background: rgba(184, 69, 90, 0.1); color: #B8455A; }
            .wo-notification.info .wo-notification-icon { background: rgba(201, 169, 110, 0.1); color: #C9A96E; }
            .wo-notification-title { font-family: 'Cormorant Garamond', serif; font-size: 1.1rem; font-weight: 600; color: #1A1208; margin-bottom: 2px; }
            .wo-notification-msg { font-family: 'Jost', sans-serif; font-size: 0.82rem; color: #8A7898; line-height: 1.4; }
            @keyframes woToastIn { from { opacity: 0; transform: translateY(-20px) scale(0.95); } to { opacity: 1; transform: translateY(0) scale(1); } }
            @keyframes woToastOut { from { opacity: 1; transform: translateY(0) scale(1); } to { opacity: 0; transform: translateY(-10px) scale(0.95); } }
            
            .wo-modal-overlay { position: fixed; inset: 0; background: rgba(26, 18, 8, 0.4); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); z-index: 100000; display: none; align-items: center; justify-content: center; padding: 24px; opacity: 0; transition: opacity 0.4s ease; }
            .wo-modal-overlay.active { display: flex; opacity: 1; }
            .wo-modal { background: #FFFDFB; width: 100%; max-width: 400px; border-radius: 20px; padding: 32px; text-align: center; box-shadow: 0 24px 80px rgba(26, 18, 8, 0.25); transform: translateY(20px) scale(0.95); transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
            .wo-modal-overlay.active .wo-modal { transform: translateY(0) scale(1); }
            .wo-modal-icon { width: 60px; height: 60px; background: rgba(184, 69, 90, 0.08); color: #B8455A; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
            .wo-modal-title { font-family: 'Cormorant Garamond', serif; font-size: 1.6rem; font-weight: 600; color: #2A1040; margin-bottom: 12px; }
            .wo-modal-msg { font-family: 'Jost', sans-serif; font-size: 0.95rem; color: #8A7898; line-height: 1.6; margin-bottom: 32px; }
            .wo-modal-actions { display: grid; grid-template-columns: 1fr 1.2fr; gap: 12px; }
            .btn-modal { padding: 14px; border-radius: 12px; font-family: 'Jost', sans-serif; font-size: 0.82rem; font-weight: 500; letter-spacing: 0.05em; border: none; cursor: pointer; transition: all 0.3s ease; }
            .btn-modal-cancel { background: transparent; border: 1.5px solid rgba(138, 120, 152, 0.2) !important; color: #8A7898; }
            .btn-modal-confirm { background: #B8455A; color: #fff; box-shadow: 0 8px 20px rgba(184, 69, 90, 0.25); }
        `;
        document.head.appendChild(style);
    }

    let container = document.querySelector('.wo-notification-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'wo-notification-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `wo-notification ${type}`;
    
    let icon = '';
    if (type === 'success') icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>';
    else if (type === 'error') icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';
    else icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>';

    toast.innerHTML = `
        <div class="wo-notification-icon">${icon}</div>
        <div class="wo-notification-content">
            <div class="wo-notification-title">${title}</div>
            <div class="wo-notification-msg">${message}</div>
        </div>
    `;

    container.appendChild(toast);
    setTimeout(() => { toast.remove(); }, 4200);
};

window.woConfirm = function(title, message, onConfirm) {
    let overlay = document.querySelector('.wo-modal-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'wo-modal-overlay';
        overlay.innerHTML = `
            <div class="wo-modal">
                <div class="wo-modal-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18m-2 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                </div>
                <div class="wo-modal-title"></div>
                <div class="wo-modal-msg"></div>
                <div class="wo-modal-actions">
                    <button class="btn-modal btn-modal-cancel">Batal</button>
                    <button class="btn-modal btn-modal-confirm">Ya, Hapus</button>
                </div>
            </div>
        `;
        document.body.appendChild(overlay);
    }

    const modal = overlay.querySelector('.wo-modal');
    overlay.querySelector('.wo-modal-title').textContent = title;
    overlay.querySelector('.wo-modal-msg').innerHTML = message;

    const btnCancel = overlay.querySelector('.btn-modal-cancel');
    const btnConfirm = overlay.querySelector('.btn-modal-confirm');

    const close = () => { overlay.classList.remove('active'); };

    btnCancel.onclick = close;
    btnConfirm.onclick = () => { close(); onConfirm(); };

    // Close on overlay click
    overlay.onclick = (e) => { if(e.target === overlay) close(); };

    // Show
    overlay.classList.add('active');
};

// ── PANEL OPEN / CLOSE ────────────────────────────────────
function toggleCartPanel(forceOpen) {
    const panel = document.getElementById('cartPanel');
    const overlay = document.getElementById('cartOverlay');
    if (!panel) return;

    const isOpen = panel.classList.contains('active');
    const shouldOpen = forceOpen !== undefined ? forceOpen : !isOpen;

    if (shouldOpen) {
        panel.classList.add('active');
        if (overlay) overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    } else {
        panel.classList.remove('active');
        if (overlay) overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// ── ADD BUTTON STATE HELPERS ──────────────────────────────
function updateAddButtonState(id, type) {
    const btn = document.querySelector(`.btn-add-to-cart[data-id="${id}"][data-type="${type}"]`);
    if (!btn) return;
    const inCart = getCart().some(c => c.id === id && c.type === type);
    btn.classList.toggle('added', inCart);
    btn.innerHTML = inCart
        ? `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Tersimpan di Keranjang`
        : `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg> Simpan ke Keranjang`;
}

function updateAllAddButtons() {
    const cart = getCart();
    const checkIcon = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>`;
    const cartIcon  = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>`;

    // Update detail-page buttons (.btn-add-to-cart)
    document.querySelectorAll('.btn-add-to-cart').forEach(btn => {
        const id = btn.dataset.id, type = btn.dataset.type;
        const inCart = cart.some(c => c.id === id && c.type === type);
        btn.classList.toggle('added', inCart);
        btn.innerHTML = inCart
            ? `${checkIcon} Tersimpan di Keranjang`
            : `${cartIcon} Simpan ke Keranjang`;
    });

    // Update card-cart-btn (ikon di kartu listing grid)
    document.querySelectorAll('.card-cart-btn').forEach(btn => {
        const id = btn.dataset.id, type = btn.dataset.type;
        if (!id) return; // Skip if no data attributes
        const inCart = cart.some(c => c.id === id && c.type === type);
        btn.classList.toggle('added', inCart);
        btn.innerHTML = inCart ? checkIcon : cartIcon;
    });
}


// ── INIT ──────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    // Inject cart HTML if not present
    if (!document.getElementById('cartPanel')) {
        document.body.insertAdjacentHTML('beforeend', `
            <!-- Cart Float Button -->
            <button class="cart-float-btn" id="cartFloatBtn" title="Keranjang Saya" onclick="toggleCartPanel()">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                <span class="cart-badge" id="cartBadge"></span>
            </button>

            <!-- Cart Overlay -->
            <div class="cart-overlay" id="cartOverlay" onclick="toggleCartPanel(false)"></div>

            <!-- Cart Panel -->
            <div class="cart-panel" id="cartPanel">
                <div class="cart-header">
                    <div class="cart-title">Keranjang <span>Impian</span></div>
                    <button class="cart-close-btn" onclick="toggleCartPanel(false)" title="Tutup">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>
                <div class="cart-items-area"></div>
                <div class="cart-footer" style="display:none;">
                    <p class="cart-footer-note">Lanjutkan ke halaman pemesanan untuk konfirmasi</p>
                    <a href="/checkout-cart" class="cart-btn-checkout">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        Lanjut ke Pemesanan
                    </a>
                    <button class="cart-btn-clear" onclick="woCartClear()">Kosongkan Keranjang</button>
                </div>
            </div>
        `);
    }

    // Initial render
    renderCart();
    updateAllAddButtons();

    // Expose toggleCartPanel globally
    window.toggleCartPanel = toggleCartPanel;
});
