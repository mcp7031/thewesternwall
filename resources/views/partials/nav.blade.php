<body class="px-2 py-4" hstyle="font-family:Open sans, sans-serif">
    <nav class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <div x-data="{ open: false }" class="bg-white shadow-md p-4">

            <div>
                <a href="/">
                    <img src="{{ asset('/images/RTVFree.png') }}" alt="FreedomRTV Logo" width="165" height="16">
                </a>
            </div>
            <button @click="open = !open" class="text-gray-500 px-2">
                <svg x-show="!open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div x-show="open">
                <ul class="bg-white p-4">
                    <li><a class="text-blue-500" href="/">Home</a></li>
                    <li><a target="_blank" class="text-blue-500" href="/about">About The Western Wall</a></li>
                    <li><a class="text-blue-500" href="/aboutRTV">About RTV</a></li>
                    <li><a class="text-blue-500" href="#">Our People</a></li>
                    <li><a target="_blank" class="text-blue-500" href="/whatwebelieve">What We Believe</a></li>
                    <li><a target="_blank" class="text-blue-500" href="/onfreedom">On Freedom and Democracy </a></li>
                    <li><a target="_blank" class="text-blue-500" href="/onfamily">On Family</a></li>
                    <li><a target="_blank" class="text-blue-500" href="/onproperty">On Property Rights</a></li>
                    <li><a target="_blank" class="text-blue-500" href="/onprivatemoney">On Private Money</a></li>
                    <li><a class="text-blue-500" href="/store">Merchandise</a></li>
                    <li><a class="text-blue-500" href="/community">Community Links</a></li>
                    <li><a class="text-blue-500" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <div> Website under construction </div>
        <div class="flex items-center">
            <div x-data="{ dropdownMenu: false }" class="bg-white mt-4">
                <!-- Dropdown toggle button -->
                <button @click="dropdownMenu = !dropdownMenu" class="text-gray-500 px-2">
                    <i x-show="!dropdownMenu" class="font-['Font Awesome'] fa fa-user fa-2x fa-fw"> </i>
                    <svg x-show="dropdownMenu" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <!-- Dropdown list -->
                <div x-show="dropdownMenu" class="py-2 bg-gray-100 rounded-md shadow-xl w-22">
                    <a class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-400" href="/login">
                        Login
                    </a>
                    <a class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-400" href="/register">
                        Register
                    </a>
                </div>
            </div>
            <div x-data="{ dropdownMenu: false }" class="bg-white mt-4">
                <!-- Dropdown toggle button -->
                <livewire:shopping-cart-badge />

            </div>
            <div>
                <a href="/subscribe" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-4">Subscribe for Updates</a>
            </div>
        </div>
    </nav>
</body>

