@extends('admin.layout')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 col-md-12 order-1">
                <div class="row d-flex justify-content-center">
                    <div class="col-8">
                        <form action="{{route('stockSave')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    แก้ไขสต็อก
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-12">
                                            <label for="name" class="form-label">ชื่อสต็อก : </label>
                                            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $info->name) }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-12">
                                            <label for="amount" class="form-label">จำนวน : </label>
                                            <input type="text" class="form-control" id="amount" name="amount" required value="{{ old('amount', $info->amount) }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-12">
                                            <label for="unit" class="form-label">หน่วย : </label>
                                            <input type="text" class="form-control" id="unit" name="unit" required value="{{ old('unit', $info->unit) }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-12">
                                            <label for="amount_alert" class="form-label">แจ้งเตือนจำนวนสต็อกใกล้หมด (จำนวน) : </label>
                                            <input type="text" class="form-control" id="amount_alert" name="amount_alert" required value="{{ old('amount_alert', $info->amount_alert) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <button type="submit" class="btn btn-outline-primary">บันทึก</button>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ old('id', $info->id) }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection