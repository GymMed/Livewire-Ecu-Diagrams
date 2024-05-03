<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="{{ asset('images/hacker.png') }}" class="h-8" alt="Hacker Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ config('app.name') }}</span>
    </a>
    
    <x-general.header.hamburger-btn 
    />

    <div x-data="{ open: true }" x-on:mobile-nav-show.window="open = !open;" :class="(open ? 'hidden ' : '') + 'w-full md:block md:w-auto'" id="navbar-default" >
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <x-general.header.navigation.link name="Home" href="{{ route('home') }}" :active=true />
        <x-general.header.navigation.link name="About" href="#" :active=false />
        <x-general.header.navigation.link name="Services" href="#" :active=false />
        <x-general.header.navigation.link name="Pricing" href="#" :active=false />
        <x-general.header.navigation.link name="Contact" href="#" :active=false />
      </ul>
    </div>
  </div>
</nav>
