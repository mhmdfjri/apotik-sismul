<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Obat - Sistem Manajemen Apotek</title>
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
                    <a href="<?= site_url('obat/index') ?>" data-readdy="true"
                        class="flex items-center text-gray-600 hover:text-primary transition-colors mr-4">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-arrow-left-line"></i>
                        </div>
                        <span class="ml-1 text-sm font-medium">Kembali ke Data Obat</span>
                    </a>
                    <h1 class="text-xl font-semibold text-gray-800">
                        Detail Obat
                    </h1>
                </div>
        </header>

        <div class="p-6">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Gambar Obat -->
                        <div class="md:w-1/3">
                            <?php if ($obat->gambar_obat): ?>
                                <img src="<?= base_url('uploads/' . $obat->gambar_obat) ?>" 
                                     alt="<?= $obat->nama_obat ?>" 
                                     class="w-full h-64 object-cover rounded-lg border border-gray-200">
                            <?php else: ?>
                                <div class="w-full h-64 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                    <i class="ri-image-line text-4xl text-gray-400"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Detail Obat -->
                        <div class="md:w-2/3">
                            <div class="mb-6">
                                <h2 class="text-2xl font-bold text-gray-800"><?= $obat->nama_obat ?></h2>
                                <span class="text-sm text-gray-500">Kategori: <?= $obat->nama_kategori ?></span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Stok Tersedia</h3>
                                    <p class="text-lg font-semibold"><?= $obat->kuantitas ?></p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Harga</h3>
                                    <p class="text-lg font-semibold">Rp <?= number_format($obat->harga, 0, ',', '.') ?></p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Tanggal Kadaluarsa</h3>
                                    <p class="text-lg font-semibold <?= strtotime($obat->expiration_date) < time() ? 'text-red-500' : '' ?>">
                                        <?= date('d M Y', strtotime($obat->expiration_date)) ?>
                                        <?php if (strtotime($obat->expiration_date) < time()): ?>
                                            <span class="text-xs text-red-500">(Expired)</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-sm font-medium text-gray-500">Deskripsi</h3>
                                <p class="text-gray-700"><?= $obat->deskripsi ?: 'Tidak ada deskripsi' ?></p>
                            </div>
                            
                            <div class="flex space-x-3">
                                <a href="<?= site_url('obat/edit/' . $obat->id_obat) ?>" 
                                   class="bg-primary text-white px-4 py-2 rounded-button hover:bg-primary/90 transition flex items-center">
                                    <i class="ri-edit-line mr-2"></i> Edit
                                </a>
                                <button type="button" class="btn-delete-obat bg-red-500 text-white px-4 py-2 rounded-button hover:bg-red-600 transition flex items-center"
                                    data-id="<?= $obat->id_obat ?>" data-nama="<?= $obat->nama_obat ?>">
                                    <i class="ri-delete-bin-line mr-2"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
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
                    Apakah Anda yakin ingin menghapus obat <strong id="namaObatTarget"></strong>?
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

    <script>
    const modal = document.getElementById('deleteObatModal');
    const cancelBtn = document.getElementById('cancelObatDelete');
    const namaTarget = document.getElementById('namaObatTarget');
    const form = document.getElementById('formHapusObat');
    
    document.querySelector('.btn-delete-obat').addEventListener('click', () => {
        const id = document.querySelector('.btn-delete-obat').getAttribute('data-id');
        const nama = document.querySelector('.btn-delete-obat').getAttribute('data-nama');

        namaTarget.textContent = nama;
        form.action = '<?= site_url('obat/delete/') ?>' + id;
        modal.classList.remove('hidden');
    });

    cancelBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
    </script>
</body>
</html>