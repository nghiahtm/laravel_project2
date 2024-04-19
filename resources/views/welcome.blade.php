<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
    <x-header/>

{{--    dropdown sample--}}
    <div>
        <div x-data="{ isActive: false }" class="relative">
            <div class="inline-flex items-center overflow-hidden rounded-md border bg-white">
                <a
                    href="#"
                    class="border-e px-4 py-2 text-sm/none text-gray-600 hover:bg-gray-50 hover:text-gray-700"
                >
                    Edit
                </a>

                <button
                    x-on:click="isActive = !isActive"
                    class="h-full p-2 text-gray-600 hover:bg-gray-50 hover:text-gray-700"
                >
                    <span class="sr-only">Menu</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
            </div>

            <div
                class="absolute end-0 z-10 mt-2 w-56 rounded-md border border-gray-100 bg-white shadow-lg"
                role="menu"
                x-cloak
                x-transition
                x-show="isActive"
                x-on:click.away="isActive = false"
                x-on:keydown.escape.window="isActive = false"
            >
                <div class="p-2">
                    <a
                        href="#"
                        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                        role="menuitem"
                    >
                        View on Storefront
                    </a>

                    <a
                        href="#"
                        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                        role="menuitem"
                    >
                        View Warehouse Info
                    </a>

                    <a
                        href="#"
                        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                        role="menuitem"
                    >
                        Duplicate Product
                    </a>

                    <a
                        href="#"
                        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                        role="menuitem"
                    >
                        Unpublish Product
                    </a>

                    <form method="POST" action="#">
                        <button
                            type="submit"
                            class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                            role="menuitem"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                />
                            </svg>

                            Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{--img carousel--}}
    <x-img-carousel/>
{{--product cards 1--}}
{{--    <section class="">--}}
{{--        <div class="flex flex-wrap mx-auto md:flex-nowrap p-12">--}}

{{--            <a href="">--}}
{{--                <div class="flex w-full">--}}
{{--                    <div class="relative flex flex-col items-start m-1 transition duration-300 ease-in-out delay-150 transform bg-white shadow-2xl rounded-xl md:w-80 md:-ml-16 md:hover:-translate-x-16 md:hover:-translate-y-8">--}}
{{--                        <img class="object-cover object-center w-full rounded-t-xl lg:h-48 md:h-36" src="/assets/images/placeholders/neon-1.jpg" alt="blog">--}}
{{--                        <div class="px-6 py-8">--}}
{{--                            <h4 class="mt-4 text-2xl font-semibold text-neutral-600">--}}
{{--                                <span class="">Entry</span>--}}
{{--                            </h4>--}}
{{--                            <p class="mt-4 text-base font-normal text-gray-500 leading-relax">Install Tailwind CSS without any Javascript Framewrok locally with purgeCSS, enable the dark mode option, prefferences or class is upt to you.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}

{{--            <a href="">--}}
{{--                <div class="flex w-full">--}}
{{--                    <div class="relative flex flex-col items-start m-1 transition duration-300 ease-in-out delay-150 transform bg-white shadow-2xl rounded-xl md:w-80 md:-ml-16 md:hover:-translate-x-16 md:hover:-translate-y-8">--}}
{{--                        <img class="object-cover object-center w-full rounded-t-xl lg:h-48 md:h-36" src="/assets/images/placeholders/neon-4.jpg" alt="blog">--}}
{{--                        <div class="px-6 py-8">--}}
{{--                            <h4 class="mt-4 text-2xl font-semibold text-neutral-600">--}}
{{--                                <span class="">Entry</span>--}}
{{--                            </h4>--}}
{{--                            <p class="mt-4 text-base font-normal text-gray-500 leading-relax">Install Tailwind CSS without any Javascript Framewrok locally with purgeCSS, enable the dark mode option, prefferences or class is upt to you.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}

{{--            <a href="">--}}
{{--                <div class="flex w-full">--}}
{{--                    <div class="relative flex flex-col items-start m-1 transition duration-300 ease-in-out delay-150 transform bg-white shadow-2xl rounded-xl md:w-80 md:-ml-16 md:hover:-translate-x-16 md:hover:-translate-y-8">--}}
{{--                        <img class="object-cover object-center w-full rounded-t-xl lg:h-48 md:h-36" src="/assets/images/placeholders/neon-2.jpg" alt="blog">--}}
{{--                        <div class="px-6 py-8">--}}
{{--                            <h4 class="mt-4 text-2xl font-semibold text-neutral-600">--}}
{{--                                <span class="">Entry</span>--}}
{{--                            </h4>--}}
{{--                            <p class="mt-4 text-base font-normal text-gray-500 leading-relax">Install Tailwind CSS without any Javascript Framewrok locally with purgeCSS, enable the dark mode option, prefferences or class is upt to you.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}

{{--        </div>--}}
{{--    </section>--}}


{{--    product cards 2--}}
    <section>
        <div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
            <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-3">
                <div class="p-6 hover:scale-105 duration-200">
                    <img class="object-cover object-center w-full mb-8 lg:h-48 md:h-36 rounded-xl" src="https://picsum.photos/500" alt="blog">
                    <div class="inline-flex justify-between w-full">
                        <h1 class="mb-8 text-xl font-semibold leading-none tracking-tighter text-neutral-600">Short headline.</h1>
                        <span>$00.00</span>
                    </div>
                    <p class="mx-auto text-base font-medium leading-relaxed text-gray-500">Free and Premium themes, UI Kit's, templates and landing pages built with Tailwind CSS, HTML &amp; Next.js.</p>
                </div>
                <div class="p-6 hover:scale-105 duration-200">
                    <img class="object-cover object-center w-full mb-8 lg:h-48 md:h-36 rounded-xl" src="https://picsum.photos/500" alt="blog">
                    <div class="inline-flex justify-between w-full">
                        <h1 class="mb-8 text-xl font-semibold leading-none tracking-tighter text-neutral-600">Short headline.</h1>
                        <span>$00.00</span>
                    </div>
                    <p class="mx-auto text-base font-medium leading-relaxed text-gray-500">Free and Premium themes, UI Kit's, templates and landing pages built with Tailwind CSS, HTML &amp; Next.js.</p>
                </div>
                <div class="p-6 hover:scale-105 duration-200">
                    <img class="object-cover object-center w-full mb-8 lg:h-48 md:h-36 rounded-xl" src="https://picsum.photos/500" alt="blog">
                    <div class="inline-flex justify-between w-full">
                        <h1 class="mb-8 text-xl font-semibold leading-none tracking-tighter text-neutral-600">Short headline.</h1>
                        <span>$00.00</span>
                    </div>
                    <p class="mx-auto text-base font-medium leading-relaxed text-gray-500">Free and Premium themes, UI Kit's, templates and landing pages built with Tailwind CSS, HTML &amp; Next.js.</p>
                </div>
            </div>
        </div>
    </section>
    <x-hero/>
    <x-footer/>
    </body>
</html>
