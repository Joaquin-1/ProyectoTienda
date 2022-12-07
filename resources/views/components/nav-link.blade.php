@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#4C3F2B] text-m font-medium leading-5 text-[#4C3F2B] focus:outline-none focus:border-[#4C3F2B] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-m font-medium leading-5 text-[#9F8152] hover:text-[#9F8152] hover:border-[#9F8152] focus:outline-none focus:text-[#9F8152] focus:border-[#9F8152] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
