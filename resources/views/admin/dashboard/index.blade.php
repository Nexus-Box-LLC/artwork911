@extends('admin.layouts.master')
@section('title', 'Dashboard')

@section('breadcrumb-title')
Dashboard
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="col-12 text-left">
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
</div>
@endsection



