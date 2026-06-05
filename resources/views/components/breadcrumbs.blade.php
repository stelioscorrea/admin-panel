@props(['items' => []])

@if(count($items))
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($items as $index => $item)
                @if($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">{{ $item['label'] }}</li>
                @else
                    <li class="breadcrumb-item">
                        @if(isset($item['route']))
                            <a href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
                        @else
                            {{ $item['label'] }}
                        @endif
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
