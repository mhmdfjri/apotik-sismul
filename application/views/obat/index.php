<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Obat - Sistem Manajemen Apotek</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: "#A0C878",
                    secondary: "#34C759"
                },
                borderRadius: {
                    none: "0px",
                    sm: "4px",
                    DEFAULT: "8px",
                    md: "12px",
                    lg: "16px",
                    xl: "20px",
                    "2xl": "24px",
                    "3xl": "32px",
                    full: "9999px",
                    button: "8px",
                },
            },
        },
    };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
    <style>
    :where([class^="ri-"])::before {
        content: "\f3c2";
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: #f9fafb;
    }

    .sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
    }

    .main-content {
        margin-left: 250px;
    }

    .status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 6px;
    }

    .status-good {
        background-color: #34C759;
    }

    .status-low {
        background-color: #FFCC00;
    }

    .status-out {
        background-color: #FF3B30;
    }

    .expiry-warning {
        color: #FF9500;
    }

    .expiry-expired {
        color: #FF3B30;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .custom-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%234A5568'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        background-size: 1em;
    }

    table th {
        position: relative;
        cursor: pointer;
    }

    .sort-icon {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
    }

    .custom-checkbox {
        position: relative;
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .custom-checkbox.checked {
        background-color: #4A90E2;
        border-color: #4A90E2;
    }

    .custom-checkbox.checked::after {
        content: '';
        position: absolute;
        left: 5px;
        top: 2px;
        width: 6px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar bg-primary text-white flex flex-col">
        <div class="p-6 flex items-center justify-center">
            <h1 class="text-2xl font-['Pacifico']">Inventaris Apotek</h1>
        </div>
        <div class="flex-1 overflow-y-auto">
            <nav class="mt-6">
                <a href="<?= site_url('obat/index') ?>" data-readdy="true"
                    class="flex items-center px-6 py-3 bg-white/20 text-white">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-medicine-bottle-line"></i>
                    </div>
                    <span class="ml-3 text-sm font-medium">Data Obat</span>
                </a>
                <a href="<?= site_url('kategori/index') ?>"
                    class="flex items-center px-6 py-3 text-white/80 hover:bg-white/10 transition-colors">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-folder-line"></i>
                    </div>
                    <span class="ml-3 text-sm font-medium">Kategori</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-800">Data Obat</h1>
                </div>

            </div>
        </header>


        <div class="p-6">
            <div class="bg-white rounded shadow mb-6">
                <div class="p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-medium text-gray-800">Inventaris Obat</h2>
                    </div>
                    <div class="flex gap-3">
                        <!-- Tombol Hapus Semua -->
                        <form action="<?= site_url('obat/delete_all') ?>" method="post">
                            <button type="button" id="openDeleteModal"
                                class="bg-red-500 text-white px-4 py-2 rounded-button whitespace-nowrap hover:bg-red-600 transition flex items-center text-sm">
                                <div class="w-5 h-5 flex items-center justify-center mr-1">
                                    <i class="ri-delete-bin-line"></i>
                                </div>
                                Hapus Semua
                            </button>

                        </form>

                        <!-- Tombol Tambah Kategori -->
                        <a href="<?= site_url('obat/create') ?>" data-readdy="true">
                            <button
                                class="bg-secondary text-white px-4 py-2 rounded-button whitespace-nowrap hover:bg-secondary/90 transition flex items-center text-sm">
                                <div class="w-5 h-5 flex items-center justify-center mr-1">
                                    <i class="ri-add-line"></i>
                                </div>
                                Tambah Obat
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Medicine Table -->
            <div class="bg-white rounded shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <form method="get" action="<?= site_url('obat') ?>" class="flex items-center">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="ri-search-line text-gray-400"></i>
                            </div>
                            <input type="text" name="search" value="<?= html_escape($search) ?>"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full pl-10 p-2.5"
                                placeholder="Cari nama obat...">
                            <input type="hidden" name="limit" value="<?= $limit ?>">
                        </div>
                        <button type="submit"
                            class="ml-2 px-4 py-2.5 bg-primary text-white rounded-button hover:bg-primary/90 transition">
                            Cari
                        </button>
                        <?php if ($search): ?>
                        <a href="<?= site_url('obat') ?>"
                            class="ml-2 px-4 py-2.5 bg-gray-200 text-gray-700 rounded-button hover:bg-gray-300 transition">
                            Reset
                        </a>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- Di bagian atas tabel, setelah form pencarian -->
                <?php if ($search): ?>
                <div class="px-6 py-3 bg-blue-50 text-blue-800 text-sm">
                    Menampilkan hasil pencarian untuk: <strong>"<?= html_escape($search) ?>"</strong>.
                    Ditemukan <?= $totalObat ?> obat.
                </div>
                <?php endif; ?>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 text-left">
                                <th class="px-4 py-3 w-12">
                                    <div class="custom-checkbox" id="selectAll"></div>
                                </th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Obat
                                </th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tindakan
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($obat as $item): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4">
                                    <div class="custom-checkbox"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-sm leading-5 font-semibold text-gray-800">
                                        <?= $item->nama_obat ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?= $item->nama_kategori ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="<?= base_url('index.php/obat/read/' . $item->id_obat) ?>"
                                            class="text-blue-500 hover:text-blue-700">
                                            <div class="w-5 h-5 flex items-center justify-center">
                                                <i class="ri-eye-line"></i>
                                            </div>
                                        </a>
                                        <a href="<?= base_url('index.php/obat/edit/' . $item->id_obat) ?>"
                                            class="text-primary hover:text-primary/80">
                                            <div class="w-5 h-5 flex items-center justify-center">
                                                <i class="ri-edit-line"></i>
                                            </div>
                                        </a>
                                        <button type="button" class="text-red-500 hover:text-red-600 btn-delete-obat"
                                            data-id="<?= $item->id_obat ?>" data-nama="<?= $item->nama_obat ?>">
                                            <div class="w-5 h-5 flex items-center justify-center">
                                                <i class="ri-delete-bin-line"></i>
                                            </div>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <p class="text-sm text-gray-700">
                            Menampilkan
                            <span class="font-medium"><?= (($page - 1) * $limit) + 1 ?></span>
                            sampai
                            <span class="font-medium"><?= min($page * $limit, $totalObat) ?></span>
                            dari
                            <span class="font-medium"><?= $totalObat ?></span>
                        </p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <!-- Di bagian pagination, update link seperti ini: -->
                        <nav class="flex items-center">
                            <!-- Tombol Prev -->
                            <a href="?page=<?= max(1, $page - 1) ?>&limit=<?= $limit ?><?= $search ? '&search='.urlencode($search) : '' ?>"
                                class="px-2 py-1 border border-gray-200 rounded-l-md text-gray-500 hover:bg-gray-50">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-arrow-left-s-line"></i>
                                </div>
                            </a>
                            <!-- Tombol Halaman -->
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?page=<?= $i ?>&limit=<?= $limit ?><?= $search ? '&search='.urlencode($search) : '' ?>"
                                class="px-3 py-1 border-t border-b border-gray-200 <?= $i == $page ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' ?>">
                                <?= $i ?>
                            </a>
                            <?php endfor; ?>
                            <!-- Tombol Next -->
                            <a href="?page=<?= min($totalPages, $page + 1) ?>&limit=<?= $limit ?><?= $search ? '&search='.urlencode($search) : '' ?>"
                                class="px-2 py-1 border border-gray-200 rounded-r-md text-gray-500 hover:bg-gray-50">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-arrow-right-s-line"></i>
                                </div>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>


            <!-- Delete by id -->
            <div id="deleteObatModal"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                    <div class="text-center">
                        <div
                            class="w-16 h-16 mx-auto flex items-center justify-center bg-red-100 text-red-500 rounded-full mb-4">
                            <i class="ri-error-warning-line ri-2x"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            Konfirmasi Hapus
                        </h3>
                        <p class="text-sm text-gray-500 mb-6">
                            Apakah Anda yakin ingin menghapus kategori <strong id="namaObatTarget"></strong>?
                        </p>
                        <div class="flex justify-center space-x-3">
                            <button id="cancelObatDelete"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-button hover:bg-gray-300 transition">
                                Batal
                            </button>

                            <form id="formHapusObat" method="post">
                                <button type="submit"
                                    class="px-4 py-2 bg-red-500 text-white rounded-button hover:bg-red-600 transition">
                                    Ya, Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- hapus semua obat -->
            <div id="deleteModal"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                    <div class="text-center">
                        <div
                            class="w-16 h-16 mx-auto flex items-center justify-center bg-red-100 text-red-500 rounded-full mb-4">
                            <i class="ri-error-warning-line ri-2x"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            Konfirmasi Hapus Semua
                        </h3>
                        <p class="text-sm text-gray-500 mb-6">
                            Apakah Anda yakin ingin menghapus <strong>semua data obat</strong>? Tindakan ini tidak dapat
                            dibatalkan.
                        </p>
                        <div class="flex justify-center space-x-3">
                            <button id="cancelDelete"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-button whitespace-nowrap hover:bg-gray-300 transition">
                                Batal
                            </button>

                            <form id="deleteAllForm" method="post" action="<?= site_url('obat/delete_all') ?>">
                                <button type="submit"
                                    class="px-4 py-2 bg-red-500 text-white rounded-button whitespace-nowrap hover:bg-red-600 transition">
                                    Ya, Hapus Semua
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php if ($this->session->flashdata('success')): ?>
    <!-- Success Notification -->
    <div id="successNotification"
        class="fixed bottom-4 right-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded shadow-lg flex items-center transform translate-y-20 opacity-0 transition-all duration-300 hidden">
        <div class="w-6 h-6 flex items-center justify-center bg-green-100 text-green-600 rounded-full mr-3">
            <i class="ri-check-line"></i>
        </div>
        <div>
            <p class="font-medium text-sm">Success!</p>
            <p class="text-xs text-green-700">
                <?= $this->session->flashdata('success') ?>
            </p>
        </div>
        <button type="button" class="ml-6 text-green-600 hover:text-green-800"
            onclick="document.getElementById('successNotification').classList.add('hidden')">
            <i class="ri-close-line"></i>
        </button>
    </div>

    <script>
    window.addEventListener('DOMContentLoaded', () => {
        const notif = document.getElementById('successNotification');
        notif.classList.remove('hidden');
        notif.classList.remove('translate-y-20', 'opacity-0');
        notif.classList.add('translate-y-0', 'opacity-100');

        setTimeout(() => {
            notif.classList.add('hidden');
        }, 3000);
    });
    </script>
    <?php endif; ?>

    <script>
    const modal = document.getElementById('deleteObatModal');
    const cancelBtn = document.getElementById('cancelObatDelete');
    const namaTarget = document.getElementById('namaObatTarget');
    const form = document.getElementById('formHapusObat');
    const deleteModal = document.getElementById('deleteModal');
    const openDeleteModal = document.getElementById('openDeleteModal');
    const cancelDelete = document.getElementById('cancelDelete');

    openDeleteModal.addEventListener('click', () => {
        deleteModal.classList.remove('hidden');
    });

    cancelDelete.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });
    document.querySelectorAll('.btn-delete-obat').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-id');
            const nama = btn.getAttribute('data-nama');

            namaTarget.textContent = nama;
            form.action = `<?= base_url('index.php/obat/delete/') ?>${id}`;
            modal.classList.remove('hidden');
        });
    });

    cancelBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
    </script>
</body>

</html>