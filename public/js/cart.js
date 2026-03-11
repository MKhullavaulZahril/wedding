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
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
    `).join('');
}

// ── PUBLIC API ────────────────────────────────────────────
window.woCartRemove = function (id, type) {
    removeFromCart(id, type);
    renderCart();
    // Update add-button state if on detail page
    updateAddButtonState(id, type);
};

window.woCartClear = function () {
    if (!confirm('Kosongkan semua item dari keranjang?')) return;
    clearCart();
    renderCart();
    updateAllAddButtons();
};

window.woCartAdd = function (item) {
    const added = addToCart(item);
    renderCart();
    toggleCartPanel(true);
    return added;
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
                    <a href="/checkout" class="cart-btn-checkout">
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
