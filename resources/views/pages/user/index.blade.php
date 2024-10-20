@extends('layouts.user.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h1>Nike New <br>Collection!</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                    ad minim veniam, quis nostrud exercitation.</p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" src="{{ asset('assets/templates/user/img/banner/banner-img.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Product Area -->
    <section class="section_gap">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Latest Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>


            <h1 class="text-center my-4">Flash Sale</h1>
            <div class="container-fluid">
                <div class="flash-sale-header d-flex justify-content-between align-items-center mb-3">
          
                </div>
                <div class="row"> <!-- Tambahkan div row di sini -->
                    @forelse($flashsales as $flashSaleItem)
                        <div class="col-6 col-md-3 mb-4"> <!-- Mengubah col-md-2 menjadi col-md-3 -->
                            <div class="card product text-center shadow-sm position-relative" style="height: 100%;">
            
                                <!-- Diskon Tag -->
                                <div class="discount-tag position-absolute bg-warning text-white font-weight-bold px-2 py-1">
                                    {{ round($flashSaleItem->discount_percentage) }}% OFF
                                </div>
            
                                <!-- Gambar Produk -->
                                <img src="{{ asset('images/' . $flashSaleItem->image) }}" class="card-img-top"
                                    alt="{{ $flashSaleItem->product_name }}">
            
                                <!-- Info Produk -->
                                <div class="card-body p-3"> <!-- Tambahkan padding untuk lebih besar -->
                                    <h6 class="card-title text-truncate">{{ $flashSaleItem->product_name }}</h6>
                                    <p class="text-danger font-weight-bold">
                                        Rp{{ number_format($flashSaleItem->discount_price, 2) }}</p>
                                    <p class="small text-muted">{{ $flashSaleItem->sold_count }} Terjual</p>
                                    <!-- Timer di dalam kotak produk -->
                                    <div class="flash-sale-timer bg-dark text-white py-1 rounded"
                                        id="countdown-{{ $flashSaleItem->id }}">
                                        Sisa waktu: <span id="time-{{ $flashSaleItem->id }}"></span>
                                    </div>
                                    <div class="prd-bottom">
                                        <a class="social-info" href="javascript:void(0);"
                                            onclick="confirmPurchase('{{ $flashSaleItem->id }}', '{{ Auth::user()->id }}')">
                                           
                                        </a>
                                        <a href="{{ route('user.detail2.flashsale', $flashSaleItem->id) }}" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">Detail</p>
                                        </a>
                                    </div>
                                    <!-- Label jika produk habis -->
                                    @if ($flashSaleItem->stock <= 0)
                                        <p class="badge badge-danger mt-2">HABIS</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <h3 class="text-center">Tidak ada produk flash sale saat ini.</h3>
                        </div>
                    @endforelse
                </div> <!-- Tutup div row di sini -->
            
                <!-- Script untuk countdown (seperti yang sebelumnya) -->
                <script>
                    @foreach($flashsales as $flashSaleItem)
                        var endTime{{ $flashSaleItem->id }} = new Date("{{ $flashSaleItem->end_time }}").getTime();
                        var countdownInterval{{ $flashSaleItem->id }} = setInterval(function() {
                            var now = new Date().getTime();
                            var distance = endTime{{ $flashSaleItem->id }} - now;
            
                            if (distance >= 0) {
                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds = Math.floor((distance % (1000)) / 1000);
            
                                document.getElementById("time-{{ $flashSaleItem->id }}").innerHTML = hours + " jam " + minutes +
                                    " menit " + seconds + " detik";
                            } else {
                                clearInterval(countdownInterval{{ $flashSaleItem->id }});
                                document.getElementById("time-{{ $flashSaleItem->id }}").innerHTML = "Flash Sale Berakhir";
                            }
                        }, 1000);
                    @endforeach
                </script>
            </div>
            






                <h1 class="text-center my-4">Produk</h1>
                <div class="container-fluid">
                    <div class="flash-sale-header d-flex justify-content-between align-items-center mb-3">
                    </div>
                    <div class="row mt-5">
                        @forelse ($products as $item)
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="single-product card text-center">
                                    <img class="img-fluid card-img-top" src="{{ asset('images/' . $item->image) }}"
                                        alt="">
                                    <div class="product-details card-body">
                                        <h6>{{ $item->name }}</h6>
                                        <div class="price">
                                            <h6>Harga: {{ $item->price }} Points</h6>
                                        </div>
                                        <div class="prd-bottom">
                                            <a class="social-info" href="javascript:void(0);"
                                                onclick="confirmPurchase('{{ $item->id }}', '{{ Auth::user()->id }}')">
                                                <span class="ti-bag"></span>
                                                <p class="hover-text">Beli</p>
                                            </a>
                                            <a href="{{ route('user.detail.product', $item->id) }}" class="social-info">
                                                <span class="lnr lnr-move"></span>
                                                <p class="hover-text">Detail</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-lg-12">
                                <h3 class="text-center">Tidak ada produk</h3>
                            </div>
                        @endforelse
                    </div>
                </div>
    </section>
    <!-- End Product Area -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmPurchase(productId, userId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan membeli produk ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Beli!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/product/purchase/' + productId + '/' + userId;
                }
            });
        }
    </script>
@endsection
