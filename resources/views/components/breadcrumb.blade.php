@props(['menu'])
<div class="section-header">
    <h1>{{ $menu }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('home') }}"></a>Dashboard</div>
        <div class="breadcrumb-item">{{ $menu }}</div>
    </div>
</div>
