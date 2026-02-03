{{-- Global Notification System (Toast + Confirm Modal) --}}

@if(session('success'))
    <div data-flash-status class="hidden">{{ session('success') }}</div>
@endif

@if(session('status'))
    <div data-flash-status class="hidden">{{ session('status') }}</div>
@endif

@if(session('error'))
    <div data-flash-error class="hidden">{{ session('error') }}</div>
@endif

<div id="public-notification-modal" class="fixed inset-0 z-[9999] hidden pointer-events-none">
    <div id="public-notification-content" class="w-full pointer-events-auto transition-all duration-300 ease-out opacity-0 -translate-y-3"></div>
</div>