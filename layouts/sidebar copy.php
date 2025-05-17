<aside class="w-75 min-h-screen bg-white shadow-md p-6">
    <div class="mb-10">
        <div class="text-4xl font-bold text-purple-600">SAM JAYA</div>
        <div class="text-xs text-gray-400 tracking-wide">DASHBOARD</div>
    </div>

    <nav class="space-y-4 overflow-y-auto h-150">
        <a href="#" class="flex items-center space-x-3 text-purple-300 font-semibold text-xl py-3 rounded-lg hover:bg-purple-400 hover:text-purple-100 duration-300 easy-in">
            <svg class="w-5 h-5" fill="currentColor">
                <i class="fa-duotone fa-solid fa-gauge"></i>
            </svg>
            <span>Dashboard</span>
        </a>
        <button onclick="toggleDropdown('dropdown-master')" class="w-full flex items-center justify-between text-purple-300 font-semibold text-xl py-3 px-4 rounded-lg hover:bg-purple-400 hover:text-purple-100 transition duration-300">
            <span class="flex items-center space-x-2 ms-4">
                <i class="fa-solid fa-sitemap text-lg"></i>
                <span>Master Barang</span>
            </span>
            <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul id="dropdown-master" class="hidden ml-8 mt-2 space-y-2 text-base">
            <li>
                <a href="<?= BASE_URL ?>/dashboard/jenis/" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Jenis</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Satuan</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Stok Barang</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Barang Masuk</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Barang Keluar</a>
            </li>
        </ul>
        <a href="#" class="flex items-center space-x-3 text-purple-300 font-semibold text-xl py-3 rounded-lg hover:bg-purple-400 hover:text-purple-100 duration-300 easy-in">
            <svg class="w-5 h-5" fill="currentColor">
                <i class="fa-solid fa-truck-field-un"></i>
            </svg>
            <span>Supplier</span>
        </a>
        <a href="#" class="flex items-center space-x-3 text-purple-300 font-semibold text-xl py-3 rounded-lg hover:bg-purple-400 hover:text-purple-100 duration-300 easy-in">
            <svg class="w-5 h-5" fill="currentColor">
                <i class="fa-solid fa-person-chalkboard"></i>
            </svg>
            <span>Pelanggan</span>
        </a>

        <button onclick="toggleDropdown('dropdown-service')" class="w-full flex items-center justify-between text-purple-300 font-semibold text-xl py-3 px-4 rounded-lg hover:bg-purple-400 hover:text-purple-100 transition duration-300">
            <span class="flex items-center space-x-2 ms-4">
                <i class="fa-solid fa-sitemap text-lg"></i>
                <span>Master Service</span>
            </span>
            <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul id="dropdown-service" class="hidden ml-8 mt-2 space-y-2 text-base">
            <li>
                <a href="#" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Service Status</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Service Order</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Daftar Mekanik</a>
            </li>
        </ul>

        <button onclick="toggleDropdown('dropdown-laporan')" class="w-full flex items-center justify-between text-purple-300 font-semibold text-xl py-3 px-4 rounded-lg hover:bg-purple-400 hover:text-purple-100 transition duration-300">
            <span class="flex items-center space-x-2 ms-4">
                <i class="fa-solid fa-sitemap text-lg"></i>
                <span>Laporan</span>
            </span>
            <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul id="dropdown-laporan" class="hidden ml-8 mt-2 space-y-2 text-base">
            <li>
                <a href="#" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Barang Masuk</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Barang Keluar</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Service</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-purple-300 rounded hover:bg-purple-600 hover:text-white transition">Supplier</a>
            </li>
        </ul>
    </nav>
</aside>