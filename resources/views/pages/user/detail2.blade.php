@extends('layouts.user.main')

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Halaman Detail Flash Sale</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('user.dashboard') }}"> Home
                            <span class="lnr lnr-arrow-right"> </span></a>
                        <a href="#">Detail Flash Sale</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <section class="section_gap">
        <!--================Single Product Area =================-->
        <div class="product_image_area">
            <div class="container">
                <div class="row s_product_inner">
                    <div class="col-lg-6">
                        <div class="single-prd-item">
                            <img class="img-fluid" src="{{ asset('images/' . $flashsale->image) }}" alt="{{ $flashsale->product_name }}">
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <div class="s_product_text">
                            <h3>{{ $flashsale->product_name }}</h3>
                            <h2>Rp{{ number_format($flashsale->discount_price, 2) }} <small class="text-muted">({{ $flashsale->original_price }})</small></h2>
                            <ul class="list">
                                <li>
                                    <a class="active" href="#">
                                        <span> Kategori</span> : {{ $flashsale->category ?? 'N/A' }} </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>Terjual</span> : {{ $flashsale->sold_count }} </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>Sisa Stok</span> : {{ $flashsale->stock }} </a>
                                </li>
                            </ul>
                            <p>{{ $flashsale->description ?? 'Deskripsi tidak tersedia.' }}</p>
                            <div class="card_area d-flex align-items-center">
                                @if ($flashsale->stock > 0)
                                    <a class="primary-btn" href="javascript:void(0);"
                                       onclick="confirmPurchase('{{ $flashsale->id }}', '{{ Auth::user()->id }}')"> Beli
                                        Produk</a>
                                @else
                                    <a class="primary-btn disabled" href="#">Produk Habis</a>
                                @endif
                                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================End Single Product Area =================-->
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmPurchase(flashsaleId, userId) {
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
                    window.location.href = '/flashsale/pur/' + flashsaleId + '/' + userId;
                }
            });
        }
    </script>
@endsection
