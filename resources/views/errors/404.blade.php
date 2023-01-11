@extends('errors::minimal')

@section('title', __('Không tồn tại'))
@section('code', '404')
@section('message', __($exception->getMessage() ? : 'Not Found'))
