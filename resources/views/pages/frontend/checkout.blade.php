@extends('layouts.frontend')

@section('title')
Wiji Rak - Checkout
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop.html">Shop</a>
                    <span>Check Out</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <form action="{{ route('checkout.process') }}" class="checkout-form"
            enctype="multipart/form-data" method="POST">
                {{-- @method('POST') --}}
                @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout-content">
                        <a href="#" class="content-btn">Hallo {{ Auth::user()->first_name }}, Mohon isi data agar pengiriman lancar</a>
                    </div>
                    <h4>Biiling Details</h4>
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <label for="first_name">First Name<span>*</span></label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') ? old('first_name') : Auth::user()->first_name ?? '' }}" class="form-control mb-0 @error('first_name') 's-invalid'@enderror"/>
                            @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label for="last_name">Last Name<span>*</span></label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') ? old('last_name') : Auth::user()->last_name ?? '' }}" class="form-control mb-0 @error('last_name') is-invalid @enderror">
                            @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label for="penerima">Nama Penerima<span>*</span></label>
                            <input type="text" id="penerima" name="penerima" value="{{ old('penerima') ? old('penerima') : Auth::user()->penerima ?? '' }}" class="form-control mb-0 @error('penerima') is-invalid @enderror">
                            @error('penerima')'
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label for="email">Email<span>*</span></label>
                            <input readonly type="text" id="email" name="email" value="{{ old('email') ? old('email') : Auth::user()->email ?? '' }}" class="form-control mb-0 @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label for="phone">Nomor HP<span>*</span></label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') ? old('phone') : Auth::user()->phone ?? '' }}" class="form-control mb-0 @error('phone') is-invalid @enderror">
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label for="province">Provinsi<span>*</span></label>
                            <input type="text" id="province" name="province" value="{{ old('province') }}" class="form-control mb-0 @error('province') is-invalid @enderror">
                            @error('province')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label for="city">Kota / Kabupaten<span>*</span></label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}" class="form-control mb-0 @error('city') is-invalid @enderror">
                            @error('city')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label for="address">Alamat Lengkap<span>*</span></label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control mb-0 @error('address') is-invalid @enderror">
                            @error('address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label for="postcode">Kode Pos<span>*</span></label>
                            <input type="text" id="postcode" name="postcode" value="{{ old('postcode') }}" class="form-control mb-0 @error('postcode') is-invalid @enderror">
                            @error('postcode')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label for="shipping_notes">Catatan Tambahan</label>
                            <input type="text" id="shipping_notes" name="shipping_notes" value="{{ old('shipping_notes') }}" class="form-control mb-0 @error('shipping_notes') is-invalid @enderror">
                            @error('shipping_notes')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout-content">
                        <input type="text" style="text-transform: uppercase" placeholder="Enter Your Coupon Code">
                    </div>
                    <div class="place-order">
                        <h4>Your Order</h4>
                        @php
                        $subtotal = 0;
                        $ppn = 0;
                        $total = 0;
                        @endphp
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Product <span>Total</span></li>
                                @foreach ($item as $cart)
                                    <li class="fw-normal">{{ $cart->product->name }} x {{ $cart->quantity }}
                                        <span>{{'Rp ' . number_format($cart->product->price * $cart->quantity, 0, ".", ".")}}</span>
                                    </li>
                                @php
                                    $subtotal += $cart->product->price * $cart->quantity;
                                @endphp

                                @endforeach
                                <li class="fw-normal">Subtotal <span>
                                    {{'Rp ' . number_format($subtotal, 0, ".", ".")}}
                                </span></li>

                                @php
                                    $ppn += (11/100) * $subtotal;
                                @endphp
                                <li class="ppn">PPN 11% <span>
                                    {{'Rp ' . number_format($ppn, 0, ".", ".")}}
                                </span></li>

                                @php
                                    $total += $subtotal + $ppn;
                                @endphp
                                <li class="total-price">Total <h4><strong> <span>
                                    {{'Rp ' . number_format($total, 0, ".", ".")}}
                                </span></strong></h4></li>
                            </ul>
                            <div class="payment-check">
                                <div class="pc-item">
                                    <label for="pc-check">
                                        Cheque Payment
                                        <input type="checkbox" id="pc-check">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="order-btn">
                                <button type="submit" class="site-btn place-btn">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->

@endsection
