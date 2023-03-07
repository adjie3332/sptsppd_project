{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}
@stack('prepend-style')
@include('includes.style')
@stack('addon-style')
<title>Not Found</title>

<div class="empty-2-3 container mx-auto d-flex align-items-center justify-content-center flex-column">
    <img class="main-img img-fluid"
        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Empty%20State/EmptyState2/Empty-2-3.png"
        alt="">
    <div class="text-center w-100">
        <h1 class="title-text text-white">Opss! Something Missing</h1>
        <p class="title-caption">
            The page you’re looking for isn’t found. We<br class="d-sm-block d-none"> suggest you Back to
            Dashboard.
        </p>
        <div class="d-flex justify-content-center">
            <a href="{{ route('dashboard') }}" class="btn btn-back d-inline-flex text-white border-0">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>
@stack('prepend-script')
@include('includes.script')
@stack('addon-script')
