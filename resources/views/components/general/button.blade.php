<button 
    type="button" 
    {{ $attributes->merge([
        'class' => "transition-colors duration-300 dark:bg-gray-900 text-white bg-gradient-to-br from-blue-500 to-blue-700 
                hover:from-blue-700 hover:to-blue-900 hover:text-white rounded focus:ring focus:ring-offset-2 focus:ring-blue-500"
    ]) }}
>
    {{ $slot }}
</button>