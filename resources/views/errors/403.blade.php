@extends('errors::minimal')

@section('title', __('Không được phép'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Không được phép'))
