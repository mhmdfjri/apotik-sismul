<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add New Medicine</title>
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

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .custom-file-input::-webkit-file-upload-button {
        visibility: hidden;
        display: none;
    }

    .custom-file-input::before {
        content: '';
        display: none;
    }

    .image-preview {
        border: 2px dashed #e2e8f0;
        transition: all 0.3s ease;
    }

    .image-preview.dragover {
        border-color: #4A90E2;
        background-color: rgba(74, 144, 226, 0.05);
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

                <a href="" data-readdy="true"
                    class="flex items-center px-6 py-3 text-white/80 hover:bg-white/10 transition-colors">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-dashboard-line"></i>
                    </div>
                    <span class="ml-3 text-sm font-medium">Dashboard</span>
                </a>
                <a href="<?= site_url('obat/index') ?>"
                    class="flex items-center px-6 py-3 text-white/80 hover:bg-white/10 transition-colors">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-medicine-bottle-line"></i>
                    </div>
                    <span class="ml-3 text-sm font-medium">Data Obat</span>
                </a>
                <a href="<?= site_url('kategori/index') ?>" class="flex items-center px-6 py-3 bg-white/20 text-white">
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
                    <a href="<?= site_url('kategori/index') ?>" data-readdy="true"
                        class="flex items-center text-gray-600 hover:text-primary transition-colors mr-4">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-arrow-left-line"></i>
                        </div>
                        <span class="ml-1 text-sm font-medium">Kembali ke Data Obat</span>
                    </a>
                    <h1 class="text-xl font-semibold text-gray-800">
                        Ubah Kategori
                    </h1>
                </div>

            </div>
        </header>

        <!-- Form Content -->
        <div class="p-6">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded shadow overflow-hidden mb-6">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-lg font-medium text-gray-800">
                            Kategori
                        </h2>
                    </div>

                    <form id="editCategoryForm" class="p-6"
                        action="<?= base_url('index.php/kategori/update/' . $kategori->id_kategori) ?>" method="post">
                        <!-- Basic Information Section -->
                        <div class="mb-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Kategori <span class="text-red-500">*</span></label>
                                    <input type="text" id="categoryName" name="name"
                                        class="w-full px-4 py-2 border border-gray-200 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                                        placeholder="Masukkan Nama Kategori"
                                        value="<?= htmlspecialchars($kategori->nama_kategori) ?>" required />
                                    <div class="hidden error-message text-red-500 text-xs mt-1">
                                        Category name is required
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-4 border-t border-gray-100">
                            <a href="<?= base_url('kategori') ?>"
                                class="px-6 py-2 border border-gray-300 rounded-button whitespace-nowrap text-gray-700 font-medium hover:bg-gray-50 transition text-center">
                                Batal
                            </a>
                            <button type="submit" id="saveButton"
                                class="px-6 py-2 bg-primary text-white rounded-button whitespace-nowrap font-medium hover:bg-primary/90 transition flex items-center justify-center">
                                <div id="saveIcon" class="w-5 h-5 flex items-center justify-center mr-1">
                                    <i class="ri-save-line"></i>
                                </div>
                                <span>Perbarui</span>
                                <div id="loadingIcon"
                                    class="w-5 h-5 flex items-center justify-center ml-1 animate-spin hidden">
                                    <i class="ri-loader-4-line"></i>
                                </div>
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>




</body>

</html>