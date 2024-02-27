@extends('admin.layouts.master')

@section('title')
    Tambah Kupon
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex align-items-center mb-3">
            <h6 class="mb-0 text-uppercase">Tambah Kupon</h6>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">
                    <form method="POST" class="row g-3" action="{{ route('admin.coupon.store') }}">
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Kupon *</label>
                            <input type="text" class="form-control" id="name"
                                name="name" required maxlength="255" value="{{ old('name') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="code" class="form-label">Kode Kupon *</label>
                            <input type="text" class="form-control" id="code"
                                name="code" required maxlength="50" value="{{ old('code') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Jumlah Kupon *</label>
                            <input type="number" class="form-control" id="quantity"
                                name="quantity" required maxlength="11" value="{{ old('quantity') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="min_purchase_amount" class="form-label">Minimum Pembelian *</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" id="min_purchase_amount"
                                name="min_purchase_amount" required value="{{ old('min_purchase_amount') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="expire_date" class="form-label">Tanggal Kadaluarsa *</label>
                            <input type="date" class="form-control" id="expire_date"
                                name="expire_date" min="{{ date('Y-m-d') }}" required value="{{ old('expire_date') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="discount_type" class="form-label">Tipe Diskon *</label>
                            <select name="discount_type" id="discount_type" class="form-select">
                                <option value="percent">Persen</option>
                                <option value="amount">Jumlah (Rp.)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="discount" class="form-label">Diskon *</label>
                            <input type="number" class="form-control" id="discount"
                                name="discount" required value="{{ old('discount') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <p class="mt-3 text-secondary">* kolom status digunakan untuk mengatur apakah kupon ini ditampilkan atau tidak</p>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
