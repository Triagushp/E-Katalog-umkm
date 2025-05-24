@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="cart-page">
    <!-- Hero Section -->
    <div class="cart-hero">
        <div class="container">
            <h1 class="cart-title">Keranjang Belanja</h1>
        </div>
    </div>
    
    <div class="container py-4">
        <!-- Cart Content -->
        @if($items->count())
            <div class="cart-container">
                <div class="cart-items">
                    <!-- Group items by UMKM -->
                    @php
                        $itemsByUmkm = $items->groupBy('product.umkm_id');
                    @endphp
                    
                    @foreach($itemsByUmkm as $umkmId => $umkmItems)
                        @php
                            $umkmName = $umkmItems->first()->product->umkm->name ?? "UMKM #".$umkmId;
                            $umkmAddress = $umkmItems->first()->product->umkm->alamat ?? "Lokasi tidak tersedia";
                            $umkmTotal = $umkmItems->sum(function($item) { return $item->quantity * $item->product->price; });
                            $shippingCost = 0; // Default shipping cost
                        @endphp
                        <div class="store-group" data-umkm-id="{{ $umkmId }}">
                            <div class="store-header">
                                <div class="store-info">
                                    <div class="store-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    </div>
                                    <h3 class="store-name">{{ $umkmName }}</h3>
                                    <span class="store-location">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                        {{ Str::limit($umkmAddress, 30) }}
                                    </span>
                                </div>
                                <div class="store-selector">
                                    <label class="checkbox">
                                        <input type="checkbox" class="store-checkbox" data-umkm-id="{{ $umkmId }}" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            
                            @foreach($umkmItems as $item)
                            <div class="cart-item" data-item-id="{{ $item->id }}" data-umkm-id="{{ $umkmId }}">
                                <div class="item-selector">
                                    <label class="checkbox">
                                        <input type="checkbox" class="item-checkbox" 
                                            data-price="{{ $item->product->price }}" 
                                            data-quantity="{{ $item->quantity }}" 
                                            checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                {{-- <div class="item-image">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="product-img">
                                    @else
                                        <div class="image-placeholder"></div>
                                    @endif
                                </div> --}}
                                <div class="item-details">
                                    <h3 class="item-name">{{ $item->product->name }}</h3>
                                    <div class="item-meta">
                                        <span class="item-price">Rp{{ number_format($item->product->price, 0, ',', '.') }}</span>
                                        <div class="item-actions">
                                            <span class="total-label">JUMLAH :</span>
                                            {{-- <button class="quantity-btn decrease" data-item-id="{{ $item->id }}">-</button> --}}
                                            <span class="quantity" id="quantity-{{ $item->id }}">{{ $item->quantity }}</span>
                                            {{-- <button class="quantity-btn increase" data-item-id="{{ $item->id }}">+</button> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="item-details">
                                </div>
                                <div class="item-total">
                                    <span class="total-label">Total</span>
                                    <span class="total-amount" id="total-{{ $item->id }}">Rp{{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                            
                            <!-- Per-store summary and checkout -->
                            <div class="store-footer">
                                <div class="shipping-options">
                                    <div class="shipping-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                                        Pembayaran:
                                    </div>
                                    {{-- <div class="shipping-selector">
                                        <select class="shipping-select" data-umkm-id="{{ $umkmId }}">
                                            <option value="15000">Reguler (Rp15.000)</option>
                                            <option value="12000">Ekonomi (Rp12.000)</option>
                                            <option value="25000">Express (Rp25.000)</option>
                                        </select>
                                    </div> --}}
                                </div>
                                {{-- <div class="voucher-section">
                                    <span class="voucher-label">Voucher UMKM</span>
                                    <button class="voucher-btn" data-umkm-id="{{ $umkmId }}">Pilih Voucher</button>
                                </div> --}}
                            </div>
                            
                            <!-- Per-store summary -->
                            <div class="store-summary">
                                <div class="store-summary-items">
                                    <div class="summary-row">
                                        <span>Total Produk (<span class="store-item-count" data-umkm-id="{{ $umkmId }}">{{ $umkmItems->sum('quantity') }}</span> barang)</span>
                                        <span class="store-subtotal" data-umkm-id="{{ $umkmId }}">Rp{{ number_format($umkmTotal, 0, ',', '.') }}</span>
                                    </div>
                                    {{-- <div class="summary-row">
                                        <span>Ongkos Kirim</span>
                                        <span class="store-shipping" data-umkm-id="{{ $umkmId }}">Rp{{ number_format($shippingCost, 0, ',', '.') }}</span>
                                    </div> --}}
                                    {{-- <div class="summary-row">
                                        <span>Diskon Voucher</span>
                                        <span class="store-discount" data-umkm-id="{{ $umkmId }}">Rp0</span>
                                    </div> --}}
                                </div>
                                <div class="store-summary-total">
    <span>Total Pembayaran ke {{ $umkmName }}</span>
    <span class="store-total-price" data-umkm-id="{{ $umkmId }}">Rp{{ number_format($umkmTotal + $shippingCost, 0, ',', '.') }}</span>
                                </div>
                                <form action="#" method="POST" class="store-checkout-form">
                                    @csrf
                                    <input type="hidden" name="umkm_id" value="{{ $umkmId }}">
                                    <input type="hidden" name="store_items" class="store-items-input" data-umkm-id="{{ $umkmId }}" value="">
                                    <button type="submit" class="store-checkout-btn" data-umkm-id="{{ $umkmId }}" disabled>Checkout {{ $umkmName }}</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="cart-summary">
                    <div class="summary-header">
                        <h2>Ringkasan Belanja</h2>
                    </div>
                    <div class="summary-items">
                        <div class="summary-row">
                            <span>Total Item (<span id="total-items">{{ $items->sum('quantity') }}</span> barang)</span>
                            <span id="subtotal-price">Rp{{ number_format($items->sum(function($item) { return $item->quantity * $item->product->price; }), 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Total Toko</span>
                            <span id="total-stores">{{ $itemsByUmkm->count() }} Toko</span>
                        </div>
                        {{-- <div class="summary-row">
                            <span>Total Ongkos Kirim</span>
                            <span id="shipping-cost">Rp{{ number_format($itemsByUmkm->count() * 15000, 0, ',', '.') }}</span>
                        </div> --}}
                    </div>
                    <div class="promo-note">
                        <div class="note-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        </div>
                        <p>Pembayaran dilakukan per toko melalui rekening masing-masing UMKM. Silakan checkout per toko.</p>
                    </div>
                    <a href="{{ url('/productlanding') }}" class="continue-shopping">Lanjutkan Belanja</a>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <div class="empty-cart-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                </div>
                <h2>Keranjang Kamu Kosong</h2>
                <p>Yuk, tambahkan produk favoritmu ke keranjang!</p>
                <a href="{{ url('/productlanding') }}" class="shop-now-btn">Belanja Sekarang</a>
            </div>
        @endif
    </div>
</div>

<style>
:root {
    --primary-blue: #2563EB;
    --light-blue: #93C5FD;
    --dark-blue: #1E40AF;
    --accent-blue: #3B82F6;
    --bg-blue: #EFF6FF;
    --neutral-grey: #F3F4F6;
    --text-dark: #1F2937;
    --text-medium: #4B5563;
    --text-light: #9CA3AF;
    --white: #FFFFFF;
    --shadow-sm: 0 1px 2px 0 rgba(0,0,0,0.05);
    --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
    --radius-sm: 0.25rem;
    --radius-md: 0.5rem;
    --radius-lg: 1rem;
}

.cart-page {
    background-color: var(--bg-blue);
    min-height: 100vh;
}

.cart-hero {
    background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
    padding: 2rem 0;
    position: relative;
    margin-bottom: 1.5rem;
    clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    height: 120px;
    display: flex;
    align-items: center;
}

.cart-hero::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 40%;
    height: 60%;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' width='100' height='100' fill='%23FFFFFF' opacity='0.1'%3E%3Cpath d='M30,30H70V70H30V30Z'/%3E%3Cpath d='M10,10H40V40H10V10Z'/%3E%3Cpath d='M60,60H90V90H60V60Z'/%3E%3C/svg%3E") repeat;
    z-index: 1;
    opacity: 0.1;
}

.cart-title {
    color: var(--white);
    font-size: 2rem;
    font-weight: 600;
    position: relative;
    z-index: 2;
}

.cart-container {
    display: grid;
    grid-template-columns: 3fr 1.5fr;
    gap: 1.5rem;
}

.cart-items {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.store-group {
    background-color: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
}

.cart-item {
    display: flex;
    padding: 1.5rem;
    border-bottom: 1px solid var(--neutral-grey);
    position: relative;
}

.cart-item:last-of-type {
    border-bottom: none;
}

.cart-item:hover {
    background-color: rgba(147, 197, 253, 0.05);
}

.item-selector {
    display: flex;
    align-items: center;
    margin-right: 1rem;
}

.checkbox {
    position: relative;
    display: block;
    width: 20px;
    height: 20px;
    cursor: pointer;
}

.checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: var(--white);
    border: 2px solid var(--light-blue);
    border-radius: 4px;
    transition: all 0.2s ease;
}

.checkbox:hover input ~ .checkmark {
    background-color: var(--bg-blue);
}

.checkbox input:checked ~ .checkmark {
    background-color: var(--primary-blue);
    border-color: var(--primary-blue);
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.checkbox input:checked ~ .checkmark:after {
    display: block;
}

.checkbox .checkmark:after {
    left: 6px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.item-image {
    width: 100px;
    height: 100px;
    margin-right: 1.5rem;
    flex-shrink: 0;
}

.image-placeholder {
    width: 100%;
    height: 100%;
    background-color: var(--neutral-grey);
    border-radius: var(--radius-md);
}

.item-details {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.item-name {
    font-size: 1.1rem;
    font-weight: 500;
    color: var(--text-dark);
    margin-bottom: 0.75rem;
}

.item-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.item-price {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--accent-blue);
}

.item-actions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.quantity-btn {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 1px solid var(--accent-blue);
    background-color: var(--white);
    color: var(--accent-blue);
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.quantity-btn:hover {
    background-color: var(--accent-blue);
    color: var(--white);
}

.quantity {
    font-size: 1rem;
    width: 30px;
    text-align: center;
}

.item-total {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: space-between;
    width: 150px;
}

.total-label {
    font-size: 0.85rem;
    color: var(--text-light);
}

.total-amount {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--dark-blue);
}

.remove-btn {
    background: none;
    border: none;
    color: var(--text-light);
    cursor: pointer;
    transition: color 0.2s ease;
    padding: 0.25rem;
}

.remove-btn:hover {
    color: #EF4444;
}

/* Store Header Styles */
.store-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    background-color: rgba(37, 99, 235, 0.05);
    border-bottom: 1px solid var(--light-blue);
}

.store-info {
    display: flex;
    align-items: center;
}

.store-icon {
    margin-right: 0.75rem;
    color: var(--primary-blue);
}

.store-name {
    font-size: 1rem;
    font-weight: 600;
    margin: 0;
    margin-right: 1rem;
}

.store-location {
    display: flex;
    align-items: center;
    font-size: 0.85rem;
    color: var(--text-medium);
}

.store-location svg {
    margin-right: 0.25rem;
}

/* Store Footer Styles */
.store-footer {
    padding: 1rem 1.5rem;
    background-color: var(--bg-blue);
    border-top: 1px solid var(--neutral-grey);
    border-bottom: 1px solid var(--neutral-grey);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.shipping-options {
    display: flex;
    align-items: center;
}

.shipping-label {
    display: flex;
    align-items: center;
    margin-right: 0.75rem;
    font-size: 0.9rem;
    color: var(--text-medium);
}

.shipping-label svg {
    margin-right: 0.5rem;
}

.shipping-select {
    padding: 0.5rem 1rem;
    border: 1px solid var(--light-blue);
    border-radius: var(--radius-md);
    background-color: var(--white);
    color: var(--text-dark);
    font-size: 0.9rem;
}

.voucher-section {
    display: flex;
    align-items: center;
}

.voucher-label {
    margin-right: 0.75rem;
    font-size: 0.9rem;
    color: var(--text-medium);
}

.voucher-btn {
    padding: 0.5rem 1rem;
    background-color: transparent;
    border: 1px dashed var(--primary-blue);
    color: var(--primary-blue);
    border-radius: var(--radius-md);
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.voucher-btn:hover {
    background-color: rgba(37, 99, 235, 0.05);
}

/* Store Summary Styles */
.store-summary {
    padding: 1.5rem;
    background-color: var(--white);
    border-top: 1px solid var(--neutral-grey);
}

.store-summary-items {
    margin-bottom: 1rem;
}

.store-summary-total {
    display: flex;
    justify-content: space-between;
    padding: 1rem 0;
    border-top: 1px solid var(--neutral-grey);
    margin-bottom: 1rem;
    font-weight: 600;
    color: var(--text-dark);
}

.store-total-price {
    font-size: 1.25rem;
    color: var(--dark-blue);
}

.store-checkout-btn {
    width: 100%;
    padding: 0.75rem 1rem;
    background-color: var(--primary-blue);
    color: var(--white);
    border: none;
    border-radius: var(--radius-md);
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
    margin-bottom: 0.5rem;
}

.store-checkout-btn:hover {
    background-color: var(--dark-blue);
}

/* Main Cart Summary Styles */
.cart-summary {
    background-color: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    position: sticky;
    top: 1.5rem;
    height: fit-content;
}

.summary-header {
    padding: 1.5rem;
    background-color: var(--primary-blue);
    color: var(--white);
}

.summary-header h2 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
}

.summary-items {
    padding: 1.5rem;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    color: var(--text-medium);
}

.promo-note {
    margin: 1.5rem;
    padding: 1rem;
    background-color: var(--bg-blue);
    border-radius: var(--radius-md);
    display: flex;
    align-items: flex-start;
    border-left: 4px solid var(--primary-blue);
}

.note-icon {
    margin-right: 0.75rem;
    color: var(--primary-blue);
    flex-shrink: 0;
}

.promo-note p {
    margin: 0;
    font-size: 0.9rem;
    color: var(--text-medium);
}

.continue-shopping {
    display: block;
    width: 100%;
    padding: 1rem;
    background-color: var(--white);
    color: var(--primary-blue);
    border: none;
    border-top: 1px solid var(--neutral-grey);
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
    text-align: center;
    text-decoration: none;
}

.continue-shopping:hover {
    background-color: var(--bg-blue);
}

.empty-cart {
    background-color: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    padding: 3rem;
    text-align: center;
}

.empty-cart-icon {
    margin-bottom: 1.5rem;
    color: var(--light-blue);
}

.empty-cart h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.empty-cart p {
    color: var(--text-medium);
    margin-bottom: 2rem;
}

.shop-now-btn {
    display: inline-block;
    padding: 0.75rem 2rem;
    background-color: var(--primary-blue);
    color: var(--white);
    text-decoration: none;
    border-radius: var(--radius-md);
    font-weight: 500;
    transition: background-color 0.2s ease;
}

.shop-now-btn:hover {
    background-color: var(--dark-blue);
}

@media (max-width: 992px) {
    .cart-container {
        grid-template-columns: 1fr;
    }
    
    .cart-summary {
        margin-top: 1.5rem;
        position: static;
    }
    
    .store-footer {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .shipping-options {
        margin-bottom: 1rem;
        width: 100%;
    }
    
    .shipping-select {
        width: 100%;
    }
    
    .voucher-section {
        width: 100%;
        justify-content: space-between;
    }
}

@media (max-width: 768px) {
    .cart-item {
        flex-wrap: wrap;
    }
    
    .item-image {
        width: 80px;
        height: 80px;
    }
    
    .item-total {
        width: 100%;
        flex-direction: row;
        align-items: center;
        margin-top: 1rem;
    }
    
    .total-label {
        display: none;
    }
    
    .store-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .store-selector {
        margin-top: 1rem;
    }
    
    .store-info {
        flex-wrap: wrap;
    }
    
    .store-name {
        margin-bottom: 0.5rem;
    }
}

@media (max-width: 576px) {
    .cart-hero {
        height: 100px;
    }
    
    .cart-title {
        font-size: 1.5rem;
    }
    
    .item-meta {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .item-price {
        margin-bottom: 0.5rem;
    }
    
    .item-actions {
        width: 100%;
        justify-content: space-between;
    }
    
    .cart-item {
        padding: 1rem;
    }
    
    .empty-cart {
        padding: 2rem 1rem;
    }
    
    .store-summary-total {
        flex-direction: column;
        gap: 0.5rem;
    }
}

/* Animation for adding items to cart */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(-10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.cart-item {
    animation: fadeIn 0.3s ease-in-out;
}

/* Hover effects */
.store-checkout-btn:active {
    transform: scale(0.98);
}

/* Product image styles */
.product-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: var(--radius-md);
}

/* Responsive adjustments for very small screens */
@media (max-width: 400px) {
    .item-selector {
        margin-right: 0.5rem;
    }
    
    .item-name {
        font-size: 1rem;
    }
    
    .item-price, 
    .total-amount {
        font-size: 1rem;
    }
    
    .shipping-label,
    .voucher-label {
        font-size: 0.8rem;
    }
}

.store-checkout-btn:disabled {
    background-color: var(--text-light);
    cursor: not-allowed;
}

.store-checkout-btn:disabled:hover {
    background-color: var(--text-light);
}
</style>
{{-- <script>
    // Ganti atau tambahkan ke bagian <script> yang sudah ada
$(document).ready(function() {
    // Handle item checkbox changes
    $('.item-checkbox').on('change', function() {
        const $this = $(this);
        const $storeGroup = $this.closest('.store-group');
        const $storeCheckbox = $storeGroup.find('.store-checkbox');
        const $allItemCheckboxes = $storeGroup.find('.item-checkbox');
        const $checkedItemCheckboxes = $storeGroup.find('.item-checkbox:checked');

        // If all items are checked, check the store checkbox
        $storeCheckbox.prop('checked', $checkedItemCheckboxes.length === $allItemCheckboxes.length);
        
        // Update store totals
        updateStoreTotals($storeGroup.data('umkm-id'));
        
        // Update global totals
        updateGlobalTotals();
    });

    // Handle store checkbox changes (check/uncheck all items)
    $('.store-checkbox').on('change', function() {
        const $this = $(this);
        const isChecked = $this.prop('checked');
        const $storeGroup = $this.closest('.store-group');
        const $allItemCheckboxes = $storeGroup.find('.item-checkbox');

        // Check/uncheck all items in the store
        $allItemCheckboxes.prop('checked', isChecked);
        
        // Update store totals
        updateStoreTotals($storeGroup.data('umkm-id'));
        
        // Update global totals
        updateGlobalTotals();
    });

    // Function to update store totals
    function updateStoreTotals(umkmId) {
        let storeSubtotal = 0;
        let storeItemCount = 0;

        // Calculate subtotal for this store based on checked items only
        $('.cart-item[data-umkm-id="' + umkmId + '"] .item-checkbox:checked').each(function() {
            const quantity = parseInt($(this).data('quantity'));
            const price = parseFloat($(this).data('price'));
            storeSubtotal += price * quantity;
            storeItemCount += quantity;
        });

        // Update store summary
        $('.store-subtotal[data-umkm-id="' + umkmId + '"]').text('Rp' + formatNumber(storeSubtotal));
        $('.store-item-count[data-umkm-id="' + umkmId + '"]').text(storeItemCount);
        $('.store-total-price[data-umkm-id="' + umkmId + '"]').text('Rp' + formatNumber(storeSubtotal));
        
        // Update hidden input for checkout
        const selectedItems = [];
        $('.cart-item[data-umkm-id="' + umkmId + '"] .item-checkbox:checked').each(function() {
            const itemId = $(this).closest('.cart-item').data('item-id');
            const quantity = $(this).data('quantity');
            selectedItems.push({ id: itemId, quantity: quantity });
        });
        $('.store-items-input[data-umkm-id="' + umkmId + '"]').val(JSON.stringify(selectedItems));
        
        // Enable/disable checkout button based on selection
        if (selectedItems.length > 0) {
            $('.store-checkout-btn[data-umkm-id="' + umkmId + '"]').prop('disabled', false);
        } else {
            $('.store-checkout-btn[data-umkm-id="' + umkmId + '"]').prop('disabled', true);
        }
    }
    
    // Function to update global cart totals
    function updateGlobalTotals() {
        let totalItems = 0;
        let subtotalPrice = 0;
        
        // Count all checked items across all stores
        $('.item-checkbox:checked').each(function() {
            const quantity = parseInt($(this).data('quantity'));
            const price = parseFloat($(this).data('price'));
            totalItems += quantity;
            subtotalPrice += price * quantity;
        });
        
        // Update global summary
        $('#total-items').text(totalItems);
        $('#subtotal-price').text('Rp' + formatNumber(subtotalPrice));
        
        // Count stores with checked items
        const storesWithCheckedItems = new Set();
        $('.item-checkbox:checked').each(function() {
            const umkmId = $(this).closest('.cart-item').data('umkm-id');
            storesWithCheckedItems.add(umkmId);
        });
        $('#total-stores').text(storesWithCheckedItems.size + ' Toko');
    }

    // Helper function to format numbers with thousands separators
    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
    
    // Initialize totals on page load
    $('.store-group').each(function() {
        updateStoreTotals($(this).data('umkm-id'));
    });
    updateGlobalTotals();
});
</script> --}}
{{-- <script> --}}
    <script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded'); // Debugging
    
    // Handle item checkbox changes
    document.querySelectorAll('.item-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            console.log('Item checkbox changed'); // Debugging
            
            const storeGroup = this.closest('.store-group');
            const umkmId = storeGroup.dataset.umkmId;
            const storeCheckbox = storeGroup.querySelector('.store-checkbox');
            const allItemCheckboxes = storeGroup.querySelectorAll('.item-checkbox');
            const checkedItemCheckboxes = storeGroup.querySelectorAll('.item-checkbox:checked');

            // If all items are checked, check the store checkbox
            storeCheckbox.checked = checkedItemCheckboxes.length === allItemCheckboxes.length;
            
            // Update store totals
            updateStoreTotals(umkmId);
            
            // Update global totals
            updateGlobalTotals();
        });
    });

    // Handle store checkbox changes (check/uncheck all items)
    document.querySelectorAll('.store-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            console.log('Store checkbox changed'); // Debugging
            
            const isChecked = this.checked;
            const storeGroup = this.closest('.store-group');
            const umkmId = storeGroup.dataset.umkmId;
            const allItemCheckboxes = storeGroup.querySelectorAll('.item-checkbox');

            // Check/uncheck all items in the store
            allItemCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            
            // Update store totals
            updateStoreTotals(umkmId);
            
            // Update global totals
            updateGlobalTotals();
        });
    });

    // Function to update store totals
    function updateStoreTotals(umkmId) {
        console.log('Updating store totals for', umkmId); // Debugging
        
        let storeSubtotal = 0;
        let storeItemCount = 0;

        // Calculate subtotal for this store based on checked items only
        document.querySelectorAll(`.cart-item[data-umkm-id="${umkmId}"] .item-checkbox:checked`).forEach(checkbox => {
            const quantity = parseInt(checkbox.dataset.quantity);
            const price = parseFloat(checkbox.dataset.price);
            storeSubtotal += price * quantity;
            storeItemCount += quantity;
        });

        // Update store summary
        document.querySelector(`.store-subtotal[data-umkm-id="${umkmId}"]`).textContent = 'Rp' + formatNumber(storeSubtotal);
        document.querySelector(`.store-item-count[data-umkm-id="${umkmId}"]`).textContent = storeItemCount;
        document.querySelector(`.store-total-price[data-umkm-id="${umkmId}"]`).textContent = 'Rp' + formatNumber(storeSubtotal);
        
        // Update hidden input for checkout
        const selectedItems = [];
        document.querySelectorAll(`.cart-item[data-umkm-id="${umkmId}"] .item-checkbox:checked`).forEach(checkbox => {
            const itemId = checkbox.closest('.cart-item').dataset.itemId;
            const quantity = parseInt(checkbox.dataset.quantity);
            selectedItems.push({ id: itemId, quantity: quantity });
        });
        
        const storeItemsInput = document.querySelector(`.store-items-input[data-umkm-id="${umkmId}"]`);
        storeItemsInput.value = JSON.stringify(selectedItems);
        
        // Enable/disable checkout button based on selection
        const checkoutBtn = document.querySelector(`.store-checkout-btn[data-umkm-id="${umkmId}"]`);
        checkoutBtn.disabled = selectedItems.length === 0;
    }
    
    // Function to update global cart totals
    function updateGlobalTotals() {
        console.log('Updating global totals'); // Debugging
        
        let totalItems = 0;
        let subtotalPrice = 0;
        
        // Count all checked items across all stores
        document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
            const quantity = parseInt(checkbox.dataset.quantity);
            const price = parseFloat(checkbox.dataset.price);
            totalItems += quantity;
            subtotalPrice += price * quantity;
        });
        
        // Update global summary
        document.getElementById('total-items').textContent = totalItems;
        document.getElementById('subtotal-price').textContent = 'Rp' + formatNumber(subtotalPrice);
        
        // Count stores with checked items
        const storesWithCheckedItems = new Set();
        document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
            const umkmId = checkbox.closest('.cart-item').dataset.umkmId;
            storesWithCheckedItems.add(umkmId);
        });
        document.getElementById('total-stores').textContent = storesWithCheckedItems.size + ' Toko';
    }

    // Helper function to format numbers with thousands separators
    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
    
    // Initialize totals on page load
    document.querySelectorAll('.store-group').forEach(storeGroup => {
        updateStoreTotals(storeGroup.dataset.umkmId);
    });
    updateGlobalTotals();
});
</script>
{{-- </script> --}}
@endsection