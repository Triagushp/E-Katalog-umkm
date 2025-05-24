@extends('layouts.app')

@section('content')
<div class="checkout-page">
    <div class="container">
        <h1>Checkout</h1>
        
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="stores-container">
                @foreach($stores as $umkm)
                    <div class="store-section">
                        <div class="store-header">
                            <h3>{{ $umkm->name }}</h3>
                            <div class="bank-info">
                                <p>Transfer ke: {{ $umkm->bank_name }}</p>
                                <p>No. Rek: {{ $umkm->account_number }}</p>
                                <p>Atas Nama: {{ $umkm->account_holder }}</p>
                            </div>
                        </div>
                        
                        <div class="store-items">
                            @foreach($umkm->items as $item)
                                <div class="checkout-item">
                                    <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                    <span>Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="store-total">
                            <div class="total-row">
                                <span>Total Belanja:</span>
                                <span>Rp{{ number_format($umkm->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="payment-proof">
                                <label>Upload Bukti Pembayaran:</label>
                                <input type="file" name="payment_proofs[{{ $umkm->id }}]" required>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="checkout-actions">
                <button type="submit" class="btn-checkout">Konfirmasi Pembayaran</button>
            </div>
        </form>
    </div>
</div>

<style>
.checkout-page {
    padding: 2rem 0;
}

.store-section {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
    padding: 1.5rem;
}

.store-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding-bottom: 1rem;
    margin-bottom: 1rem;
}

.bank-info {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
}

.checkout-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
}

.store-total {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.total-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    font-weight: bold;
}

.payment-proof {
    margin-top: 1rem;
}

.payment-proof input {
    margin-top: 0.5rem;
}

.btn-checkout {
    background: #2563EB;
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    cursor: pointer;
}
</style>
@endsection