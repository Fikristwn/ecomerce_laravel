@extends('layouts.admin.main')

@section('title', 'Detail Produk')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.product') }}">Produk</a></div>
                <div class="breadcrumb-item">Detail</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Detail Produk: {{ $product->name }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                    </div>
                    <div class="col-md-6">
                        <h4>{{ $product->name }}</h4>
                        <p><strong>Harga: </strong>Rp{{ number_format($product->price, 2) }}</p>
                        <p><strong>Kategori: </strong>{{ $product->category }}</p>
                        <p><strong>Deskripsi: </strong>{{ $product->description }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                <a href="{{ route('admin.product') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </section>
</div>
@endsection
