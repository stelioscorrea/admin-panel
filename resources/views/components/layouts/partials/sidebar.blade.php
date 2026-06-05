<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <span class="brand-text fw-semibold">{{ config('app.name', 'Admin Panel') }}</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">
                @foreach(config('menu') as $item)
                    @if(is_null($item['role']) || (auth()->check() && auth()->user()->role->value === $item['role']))
                        @if(empty($item['children']))
                            <li class="nav-item">
                                <a href="{{ route($item['route']) }}"
                                   class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                                    <i class="nav-icon {{ $item['icon'] }}"></i>
                                    <p>{{ $item['label'] }}</p>
                                </a>
                            </li>
                        @else
                            @php
                                $isChildActive = collect($item['children'])->contains(fn($c) => request()->routeIs($c['route']));
                            @endphp
                            <li class="nav-item {{ $isChildActive ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ $isChildActive ? 'active' : '' }}">
                                    <i class="nav-icon {{ $item['icon'] }}"></i>
                                    <p>
                                        {{ $item['label'] }}
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach($item['children'] as $child)
                                        <li class="nav-item">
                                            <a href="{{ route($child['route']) }}"
                                               class="nav-link {{ request()->routeIs($child['route']) ? 'active' : '' }}">
                                                <i class="nav-icon {{ $child['icon'] ?? 'bi bi-circle' }}"></i>
                                                <p>{{ $child['label'] }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</aside>