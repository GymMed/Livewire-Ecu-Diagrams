@props([
    'disabled' => false,
    'title' => ''
])

<div class="flex items-center justify-start gap-2 font-medium text-slate-700 has-[:disabled]:opacity-75 dark:text-slate-300">
    <label for="{{ $attributes->get('id') }}" class="text-sm">{{ $title }}</label>
    <x-general.inputs.select 
        {{ $attributes }}
    >
        {{ $slot }}
    </x-general.inputs.select>
</div>