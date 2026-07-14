@extends('admin.layouts.app')

@section('title', 'Edit Country Partner')
@section('page-title', 'Edit Country Partner')
@section('breadcrumb', 'Krousar Thmey Worldwide / Edit')

@section('content')

@include('admin.worldwide_partners.create', ['worldwidePartner' => $worldwidePartner])

@endsection