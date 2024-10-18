<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PayMoney') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="flex justify-center items-center">
                <svg class="w-20 h-20" height="100px" width="100px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 503.467 503.467" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g transform="translate(1 1)"> <path style="fill:#FFD0A1;" d="M55.32,300.227c0-5.973,2.56-11.947,6.827-17.067c10.24-10.24,25.6-8.533,34.987,0.853 l59.733,59.733c0,0,17.067,14.507,17.067,42.667v76.8h-68.267c0-34.133-17.067-42.667-17.067-42.667L20.333,352.28 c0,0-17.067-14.507-17.067-42.667v-128c0-14.507,11.093-25.6,25.6-25.6s25.6,11.093,25.6,25.6L55.32,300.227L55.32,300.227z M447,300.227v-117.76c0-14.507,11.093-25.6,25.6-25.6c14.507,0,25.6,11.093,25.6,25.6v128c0,28.16-17.067,42.667-17.067,42.667 L412.867,421.4c0,0-17.067,8.533-17.067,42.667h-68.267v-76.8c0-28.16,17.067-42.667,17.067-42.667l59.733-59.733 c10.24-10.24,24.747-11.093,34.987-0.853C444.44,288.28,446.147,294.253,447,300.227L447,300.227z"></path> <g> <path style="fill:#FFE079;" d="M250.733,3.267c80.213,0,145.067,64.853,145.067,145.067S330.947,293.4,250.733,293.4 s-145.067-64.853-145.067-145.067S170.52,3.267,250.733,3.267"></path> <path style="fill:#FFE079;" d="M250.733,37.4c61.44,0,110.933,49.493,110.933,110.933s-49.493,110.933-110.933,110.933 S139.8,209.773,139.8,148.333S189.293,37.4,250.733,37.4"></path> </g> <path style="fill:#7EE1E6;" d="M54.467,464.067H191V498.2H54.467V464.067z M310.467,464.067H447V498.2H310.467V464.067z"></path> </g> <path style="fill:#51565F;" d="M448,503.467c-2.56,0-4.267-1.707-4.267-4.267v-29.867h-128V499.2c0,2.56-1.707,4.267-4.267,4.267 s-4.267-1.707-4.267-4.267v-34.133c0-2.56,1.707-4.267,4.267-4.267H448c2.56,0,4.267,1.707,4.267,4.267V499.2 C452.267,501.76,450.56,503.467,448,503.467z M192,503.467c-2.56,0-4.267-1.707-4.267-4.267v-29.867h-128V499.2 c0,2.56-1.707,4.267-4.267,4.267c-2.56,0-4.267-1.707-4.267-4.267v-34.133c0-2.56,1.707-4.267,4.267-4.267H192 c2.56,0,4.267,1.707,4.267,4.267V499.2C196.267,501.76,194.56,503.467,192,503.467z M328.533,435.2c-2.56,0-4.267-1.707-4.267-4.267 v-42.667c0-29.867,17.92-45.227,18.773-46.08l59.733-59.733c5.973-5.973,12.8-8.533,20.48-9.387c7.68,0,15.36,2.56,20.48,8.533 c5.973,5.973,8.533,12.8,8.533,20.48c0,7.68-3.413,14.507-9.387,20.48l-42.667,42.667c-1.707,1.707-4.267,1.707-5.973,0 c-1.707-1.707-1.707-4.267,0-5.973l42.667-42.667c4.267-4.267,6.827-9.387,6.827-14.507s-1.707-10.24-5.973-14.507 s-9.387-5.973-14.507-5.973c-5.12,0-10.24,2.56-14.507,6.827l-59.733,59.733c0,0-16.213,14.507-16.213,39.253v42.667 C332.8,433.493,331.093,435.2,328.533,435.2z M174.933,435.2c-2.56,0-4.267-1.707-4.267-4.267v-42.667 c0-25.6-15.36-39.253-15.36-39.253L95.573,289.28c-4.267-4.267-9.387-6.827-14.507-6.827c-5.12,0-10.24,1.707-14.507,5.973 c-4.267,4.267-5.973,9.387-5.973,14.507c0,5.12,2.56,10.24,6.827,14.507l42.667,42.667c1.707,1.707,1.707,4.267,0,5.973 c-1.707,1.707-4.267,1.707-5.973,0L61.44,323.414c-5.973-5.973-8.533-12.8-9.387-20.48c0-7.68,2.56-15.36,8.533-20.48 c5.973-5.973,12.8-8.533,20.48-8.533s14.507,3.413,20.48,9.387l59.733,59.733c0.853,0.853,17.92,16.213,17.92,46.08v42.667 C179.2,433.493,177.493,435.2,174.933,435.2z M413.867,426.667c-0.853,0-2.56,0-3.413-0.853c-1.707-1.707-1.707-4.267,0-5.973 l68.267-68.267c0.853-0.853,16.213-13.653,16.213-39.253v-128c0-11.947-9.387-21.333-21.333-21.333 c-11.947,0-21.333,9.387-21.333,21.333v67.413c0,2.56-1.707,4.267-4.267,4.267s-4.267-1.707-4.267-4.267v-68.266 c0-16.213,13.653-29.867,29.867-29.867c16.213,0,29.867,13.653,29.867,29.867v128c0,29.867-17.92,45.227-18.773,46.08 l-68.267,68.267C416.427,426.667,414.72,426.667,413.867,426.667z M89.6,426.667c-0.853,0-2.56,0-3.413-0.853L17.92,357.547 c-0.853,0-17.92-15.36-17.92-46.08v-128C0,167.253,13.653,153.6,29.867,153.6s29.867,13.653,29.867,29.867v67.413 c0,2.56-1.707,4.267-4.267,4.267c-2.56,0-4.267-1.707-4.267-4.267v-67.413c0-11.947-9.387-21.333-21.333-21.333 S8.533,171.52,8.533,183.467v128c0,25.6,15.36,39.253,15.36,39.253l68.267,68.267c1.707,1.707,1.707,4.267,0,5.973 C92.16,426.667,90.453,426.667,89.6,426.667z M251.733,298.667c-81.92,0-149.333-67.413-149.333-149.333S169.813,0,251.733,0 s149.333,67.413,149.333,149.333S333.653,298.667,251.733,298.667z M251.733,8.533c-77.653,0-140.8,63.147-140.8,140.8 s63.147,140.8,140.8,140.8s140.8-63.147,140.8-140.8S329.387,8.533,251.733,8.533z M251.733,264.533 c-63.147,0-115.2-52.053-115.2-115.2s52.053-115.2,115.2-115.2s115.2,52.053,115.2,115.2S314.88,264.533,251.733,264.533z M251.733,42.667c-58.88,0-106.667,47.787-106.667,106.667S192.853,256,251.733,256S358.4,208.213,358.4,149.333 S310.613,42.667,251.733,42.667z M251.733,213.333c-2.56,0-4.267-1.707-4.267-4.267V204.8c-14.507-1.707-25.6-14.507-25.6-29.867 c0-2.56,1.707-4.267,4.267-4.267s4.267,1.707,4.267,4.267c0,11.947,9.387,21.333,21.333,21.333c11.947,0,21.333-9.387,21.333-21.333 c0-11.947-9.387-21.333-21.333-21.333c-16.213,0-29.867-13.653-29.867-29.867c0-15.36,11.093-27.307,25.6-29.867V89.6 c0-2.56,1.707-4.267,4.267-4.267c2.56,0,4.267,1.707,4.267,4.267v4.267c14.507,1.707,25.6,14.507,25.6,29.867 c0,2.56-1.707,4.267-4.267,4.267s-4.267-1.707-4.267-4.267c0-11.947-9.387-21.333-21.333-21.333 c-11.947,0-21.333,9.387-21.333,21.333c0,11.947,9.387,21.333,21.333,21.333c16.213,0,29.867,13.653,29.867,29.867 c0,15.36-11.093,27.307-25.6,29.867v4.267C256,211.627,254.293,213.333,251.733,213.333z"></path> </g></svg>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
