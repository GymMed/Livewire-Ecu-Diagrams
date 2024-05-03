<select
    {{ $attributes->merge([
            'class' => "p-2 rounded border focus:ring focus:ring-offset-2 focus:ring-blue-500"
        ]) }}
>
    {{ $slot }}
</select>