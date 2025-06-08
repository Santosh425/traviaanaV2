@extends('errors::minimal')

@section('title', __('Forbidd'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
