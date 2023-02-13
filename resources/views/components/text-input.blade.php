@props(['disabled' => false, 'type' => 'text','value'=>null,'name','id'])
@php
    $class = " block px-2.5 pb-2.5 pt-4 w-full text-sm text-dark-900 rounded-lg border appearance-none dark:text-white dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer dark:bg-dark-900 -z-30";
@endphp
    
<input {{ $disabled ? 'disabled' : '' }} type="{{ $type }}" id="{{ $id }}" name='{{ $name }}' value="{{ $value }}" {!! $attributes->merge([
    'class' =>count($errors->get($name))  ? 'dark:border-red border-red-500'.$class : 'dark:border-dark-600 border-dark-300'.$class,
]) !!} placeholder=" " >


    