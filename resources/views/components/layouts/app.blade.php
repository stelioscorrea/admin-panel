<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Admin Panel'))</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <x-layouts.partials.navbar />
        <x-layouts.partials.sidebar />

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">@yield('page_title')</h3>
                        @yield('content_header')
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

    {{-- Toast Notifications --}}
    <div
        x-data="toastNotifications()"
        x-on:notify.window="add($event.detail)"
        class="toast-container position-fixed top-0 end-0 p-3"
        style="z-index: 9999"
    >
        <template x-for="toast in toasts" :key="toast.id">
            <div
                x-show="toast.visible"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-8"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-end="opacity-0"
                :class="`toast show align-items-center text-bg-${toast.type} border-0 mb-2`"
                role="alert"
            >
                <div class="d-flex">
                    <div class="toast-body" x-text="toast.message"></div>
                    <button
                        type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        x-on:click="remove(toast.id)"
                    ></button>
                </div>
            </div>
        </template>
    </div>

    @livewireScripts
    <script>
        function toastNotifications() {
            return {
                toasts: [],
                add(detail) {
                    const id = Date.now();
                    const type = detail.type ?? 'success';
                    this.toasts.push({ id, message: detail.message, type, visible: true });
                    setTimeout(() => this.remove(id), 4000);
                },
                remove(id) {
                    this.toasts = this.toasts.filter(t => t.id !== id);
                }
            }
        }
    </script>
</body>

</html>