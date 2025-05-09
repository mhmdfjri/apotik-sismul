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
                <a href="<?= site_url('obat/index') ?>" class="flex items-center px-6 py-3 bg-white/20 text-white">
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
                        Tambah Obat
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
                            Informasi Obat
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Silakan isi detail obat yang ingin ditambahkan ke inventaris
                        </p>
                    </div>
                    <form id="addMedicineForm" class="p-6" action="<?= base_url('index.php/obat/store') ?>"
                        method="post" enctype="multipart/form-data">
                        <!-- Basic Information Section -->
                        <div class="mb-8">
                            <h3 class="text-md font-medium text-gray-700 mb-4">
                                Informasi Dasar
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="medicineName" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Obat <span class="text-red-500">*</span></label>
                                    <input type="text" id="medicineName" name="name"
                                        class="w-full px-4 py-2 border border-gray-200 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                                        placeholder="Masukkan Nama Obat" required />
                                    <div class="hidden error-message text-red-500 text-xs mt-1">
                                        Medicine name is required
                                    </div>
                                </div>
                                <div class="md:row-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Obat</label>
                                    <div id="imageDropzone"
                                        class="image-preview rounded h-[200px] flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition-colors relative overflow-hidden">
                                        <div id="uploadPrompt" class="flex flex-col items-center">
                                            <div
                                                class="w-12 h-12 flex items-center justify-center bg-gray-100 text-gray-400 rounded-full mb-2">
                                                <i class="ri-image-add-line ri-xl"></i>
                                            </div>
                                            <p class="text-sm font-medium text-gray-700">
                                                Seret dan lepas atau klik untuk mengunggah
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                PNG, JPG up to 5MB
                                            </p>
                                        </div>
                                        <div id="imagePreviewContainer"
                                            class="hidden absolute inset-0 flex items-center justify-center">
                                            <img id="imagePreview" src="" alt="Medicine preview"
                                                class="max-h-full max-w-full object-contain" />
                                            <button type="button" id="removeImage"
                                                class="absolute top-2 right-2 w-8 h-8 flex items-center justify-center bg-white/80 text-gray-700 rounded-full hover:bg-white transition-colors">
                                                <i class="ri-close-line"></i>
                                            </button>
                                        </div>
                                        <input type="file" id="medicineImage" name="medicine_image"
                                            class="custom-file-input absolute inset-0 opacity-0 cursor-pointer"
                                            accept="image/png, image/jpeg" />
                                    </div>
                                </div>

                                <div>
                                    <label for="medicineDescription"
                                        class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                    <textarea id="medicineDescription" name="description" rows="4"
                                        class="w-full px-4 py-2 border border-gray-200 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                                        placeholder="Masukkan Deskripsi Obat"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Classification Section -->
                        <div class="mb-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="medicineCategory"
                                        class="block text-sm font-medium text-gray-700 mb-1">Kategori <span
                                            class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <select id="medicineCategory" name="category_id"
                                            class="appearance-none w-full px-4 py-2 pr-8 border border-gray-200 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                                            required>
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category->id_kategori ?>">
                                                <?= $category->nama_kategori ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </div>
                                    <div class="hidden error-message text-red-500 text-xs mt-1">
                                        Please select a category
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Inventory Details Section -->
                        <div class="mb-8">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="medicineStock"
                                        class="block text-sm font-medium text-gray-700 mb-1">Kuantitas <span
                                            class="text-red-500">*</span></label>
                                    <div class="flex">
                                        <button type="button" id="decreaseStock"
                                            class="px-3 py-2 border border-r-0 border-gray-200 rounded-l bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors">
                                            <i class="ri-subtract-line"></i>
                                        </button>
                                        <input type="number" id="medicineStock" name="quantity" min="0"
                                            class="w-full px-4 py-2 border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition text-center"
                                            value="1" required />
                                        <button type="button" id="increaseStock"
                                            class="px-3 py-2 border border-l-0 border-gray-200 rounded-r bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors">
                                            <i class="ri-add-line"></i>
                                        </button>
                                    </div>
                                    <div class="hidden error-message text-red-500 text-xs mt-1">
                                        Stock quantity is required
                                    </div>
                                </div>
                                <div>
                                    <label for="medicinePrice"
                                        class="block text-sm font-medium text-gray-700 mb-1">Harga <span
                                            class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                            <span>Rp</span>
                                        </div>
                                        <input type="number" id="medicinePrice" name="price" min="0.01" step="0.01"
                                            class="w-full pl-8 pr-4 py-2 border border-gray-200 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                                            placeholder="0.00" required />
                                    </div>
                                    <div class="hidden error-message text-red-500 text-xs mt-1">
                                        Unit price is required
                                    </div>
                                </div>

                                <div>
                                    <label for="medicineExpiry"
                                        class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kadaluwarsa
                                        <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                            <i class="ri-calendar-line"></i>
                                        </div>
                                        <input type="date" id="medicineExpiry" name="expiration_date"
                                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                                            required />
                                    </div>
                                    <div class="hidden error-message text-red-500 text-xs mt-1">
                                        Expiration date is required
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-4 border-t border-gray-100">
                            <a href="<?= site_url('obat/index') ?>" data-readdy="true"
                                class="px-6 py-2 border border-gray-300 rounded-button whitespace-nowrap text-gray-700 font-medium hover:bg-gray-50 transition text-center">
                                Batal
                            </a>
                            <button type="submit" id="saveButton"
                                class="px-6 py-2 bg-primary text-white rounded-button whitespace-nowrap font-medium hover:bg-primary/90 transition flex items-center justify-center">
                                <div id="saveIcon" class="w-5 h-5 flex items-center justify-center mr-1">
                                    <i class="ri-save-line"></i>
                                </div>
                                <span>Simpan</span>
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
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Set default date to tomorrow
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const formattedDate = tomorrow.toISOString().split("T")[0];
        document.getElementById("medicineExpiry").value = formattedDate;
        document.getElementById("medicineExpiry").min = formattedDate;

        // Image upload preview
        const imageDropzone = document.getElementById("imageDropzone");
        const medicineImage = document.getElementById("medicineImage");
        const imagePreview = document.getElementById("imagePreview");
        const imagePreviewContainer = document.getElementById(
            "imagePreviewContainer",
        );
        const uploadPrompt = document.getElementById("uploadPrompt");
        const removeImage = document.getElementById("removeImage");

        medicineImage.addEventListener("change", function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    uploadPrompt.classList.add("hidden");
                    imagePreviewContainer.classList.remove("hidden");
                };

                reader.readAsDataURL(this.files[0]);
            }
        });

        removeImage.addEventListener("click", function() {
            medicineImage.value = "";
            imagePreview.src = "";
            uploadPrompt.classList.remove("hidden");
            imagePreviewContainer.classList.add("hidden");
        });

        // Drag and drop functionality
        ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
            imageDropzone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ["dragenter", "dragover"].forEach((eventName) => {
            imageDropzone.addEventListener(eventName, highlight, false);
        });

        ["dragleave", "drop"].forEach((eventName) => {
            imageDropzone.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            imageDropzone.classList.add("dragover");
        }

        function unhighlight() {
            imageDropzone.classList.remove("dragover");
        }

        imageDropzone.addEventListener("drop", handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files && files[0]) {
                medicineImage.files = files;

                const event = new Event("change");
                medicineImage.dispatchEvent(event);
            }
        }

        // Stock quantity increment/decrement
        const decreaseStock = document.getElementById("decreaseStock");
        const increaseStock = document.getElementById("increaseStock");
        const medicineStock = document.getElementById("medicineStock");

        decreaseStock.addEventListener("click", function() {
            const currentValue = parseInt(medicineStock.value) || 0;
            if (currentValue > 0) {
                medicineStock.value = currentValue - 1;
            }
        });

        increaseStock.addEventListener("click", function() {
            const currentValue = parseInt(medicineStock.value) || 0;
            medicineStock.value = currentValue + 1;
        });


    });
    </script>
</body>

</html>