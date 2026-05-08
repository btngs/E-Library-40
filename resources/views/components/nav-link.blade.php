@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 rounded-2xl bg-sky-500/10 text-sky-400 font-semibold shadow-sm ring-1 ring-sky-400/20 transition-all duration-200'
            : 'flex items-center px-4 py-3 rounded-2xl text-slate-400 hover:bg-white/5 hover:text-white transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
