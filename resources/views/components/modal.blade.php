@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidthPx = [
    'sm' => '384px',
    'md' => '448px',
    'lg' => '512px',
    'xl' => '576px',
    '2xl' => '672px',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)].filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    style="display:none; position:fixed; inset:0; z-index:9999;
           align-items:center; justify-content:center; padding:16px;"
    x-bind:style="show ? 'display:flex !important;' : 'display:none;'"
>
    {{-- Overlay --}}
    <div
        x-show="show"
        x-on:click="show = false"
        x-transition:enter-start="opacity:0"
        x-transition:enter-end="opacity:1"
        x-transition:leave-start="opacity:1"
        x-transition:leave-end="opacity:0"
        style="position:fixed; inset:0; background:rgba(0,0,0,0.5);"
    ></div>

    {{-- Modal Box --}}
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        style="position:relative; z-index:10; background:#fff; border-radius:12px;
               box-shadow:0 20px 60px rgba(0,0,0,0.25); width:100%;
               max-width:{{ $maxWidthPx }}; overflow:hidden;"
    >
        {{ $slot }}
    </div>
</div>