@props(['value'])

<label {{ $attributes->merge(['class' => 'dark:bg-dark-900 bg-white absolute text-sm text-dark-500 dark:text-dark-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-2 first-letter:uppercase']) }}>
    {{ $value ?? $slot }}
</label>
