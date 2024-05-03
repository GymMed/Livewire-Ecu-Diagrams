@props([
    'disabled' => false,
    'checked' => false,
    'title' => ''
])

<div class="flex items-center justify-start gap-2 font-medium text-slate-700 has-[:disabled]:opacity-75 dark:text-slate-300">
    <x-general.inputs.radio-input 
        {{ $attributes }}
        :checked="$checked"
        :disabled="$disabled"
    />
    <label for="{{ $attributes->get('id') }}" class="text-sm">{{ $title }}</label>
</div>