<div class="col-lg-3 col-6">
    <div class="small-box text-bg-{{ $color }}">
        <div class="inner">
            <h3>{{ $value }}</h3>
            <p>{{ $title }}</p>
        </div>
        <svg class="small-box-icon" fill="currentColor">
            <use xlink:href="{{ asset('vendor/adminlte/icons.svg') }}#{{ $icon }}"/>
        </svg>
    </div>
</div>
