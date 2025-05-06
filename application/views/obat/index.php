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
            primary: "#4A90E2",
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
  <link
    href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
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
      <h1 class="text-2xl font-['Pacifico']">logo</h1>
    </div>
    <div class="flex-1 overflow-y-auto">
      <nav class="mt-6">
        <div class="px-4 mb-6">
          <div class="bg-white/10 rounded p-2 flex items-center">
            <div class="w-8 h-8 flex items-center justify-center">
              <i class="ri-user-line text-white"></i>
            </div>
            <div class="ml-2">
              <p class="text-sm font-medium">James Wilson</p>
              <p class="text-xs opacity-70">Manajer Apotek</p>
            </div>
          </div>
        </div>
        <a
          href="#"
          class="flex items-center px-6 py-3 text-white/80 hover:bg-white/10 transition-colors">
          <div class="w-6 h-6 flex items-center justify-center">
            <i class="ri-dashboard-line"></i>
          </div>
          <span class="ml-3 text-sm font-medium">Dashboard</span>
        </a>
        <a
          href="<?= site_url('obat/index') ?>"
          data-readdy="true"
          class="flex items-center px-6 py-3 bg-white/20 text-white">
          <div class="w-6 h-6 flex items-center justify-center">
            <i class="ri-medicine-bottle-line"></i>
          </div>
          <span class="ml-3 text-sm font-medium">Data Obat</span>
        </a>
        <a
          href="<?= site_url('kategori/index') ?>"
          class="flex items-center px-6 py-3 text-white/80 hover:bg-white/10 transition-colors">
          <div class="w-6 h-6 flex items-center justify-center">
            <i class="ri-folder-line"></i>
          </div>
          <span class="ml-3 text-sm font-medium">Kategori</span>
        </a>
      </nav>
    </div>
    <div class="p-4">
      <a
        href="#"
        class="flex items-center px-4 py-2 text-white/80 hover:bg-white/10 rounded transition-colors">
        <div class="w-6 h-6 flex items-center justify-center">
          <i class="ri-settings-line"></i>
        </div>
        <span class="ml-3 text-sm font-medium">Pengaturan</span>
      </a>
      <a
        href="#"
        class="flex items-center px-4 py-2 text-white/80 hover:bg-white/10 rounded transition-colors">
        <div class="w-6 h-6 flex items-center justify-center">
          <i class="ri-logout-box-line"></i>
        </div>
        <span class="ml-3 text-sm font-medium">Keluar</span>
      </a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm px-6 py-4">
      <div class="flex justify-between items-center">
        <div class="flex items-center">
          <h1 class="text-xl font-semibold text-gray-800">Data Obat</h1>
          <nav class="ml-4">
            <ol class="flex text-sm">
              <li class="flex items-center">
                <a href="#" class="text-gray-500 hover:text-primary">Dashboard</a>
                <div
                  class="w-4 h-4 flex items-center justify-center mx-1 text-gray-400">
                  <i class="ri-arrow-right-s-line"></i>
                </div>
              </li>
              <li class="text-gray-700 font-medium">Data Obat</li>
            </ol>
          </nav>
        </div>
        <div class="flex items-center space-x-4">
          <div class="relative">
            <button
              class="flex items-center space-x-1 text-gray-600 hover:text-gray-800">
              <div class="w-5 h-5 flex items-center justify-center">
                <i class="ri-notification-3-line"></i>
              </div>
              <span
                class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
          </div>
          <div class="relative">
            <button
              class="flex items-center space-x-1 text-gray-600 hover:text-gray-800">
              <div class="w-5 h-5 flex items-center justify-center">
                <i class="ri-mail-line"></i>
              </div>
            </button>
          </div>
          <span class="h-6 border-l border-gray-300"></span>
          <div class="text-right">
            <p class="text-sm font-medium text-gray-700">5 Mei 2025</p>
            <p class="text-xs text-gray-500">Senin</p>
          </div>
        </div>
      </div>
    </header>

    <!-- Dashboard Content -->
    <div class="p-6">
      <!-- Search and Filter Section -->
      <div class="bg-white rounded shadow mb-6">
        <div
          class="p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <div>
            <h2 class="text-lg font-medium text-gray-800">Inventaris Obat</h2>
            <p class="text-sm text-gray-500">
              Menampilkan 1-10 dari 1.248 item
            </p>
          </div>
          <div class="flex gap-3">
            <button
              class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-button whitespace-nowrap hover:bg-gray-50 transition flex items-center text-sm">
              <div class="w-5 h-5 flex items-center justify-center mr-1">
                <i class="ri-download-line"></i>
              </div>
              Ekspor Excel
            </button>
            <button
              class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-button whitespace-nowrap hover:bg-gray-50 transition flex items-center text-sm">
              <div class="w-5 h-5 flex items-center justify-center mr-1">
                <i class="ri-printer-line"></i>
              </div>
              Cetak
            </button>
            <a
              href="<?= site_url('obat/create') ?>"
              data-readdy="true">
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
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="bg-gray-50 text-left">
                <th class="px-4 py-3 w-12">
                  <div class="custom-checkbox" id="selectAll"></div>
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Obat
                  <span class="sort-icon text-gray-400">
                    <i class="ri-arrow-up-s-line"></i>
                  </span>
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Kategori
                  <span class="sort-icon text-gray-400">
                    <i class="ri-arrow-down-s-line"></i>
                  </span>
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Stok
                  <span class="sort-icon text-gray-400">
                    <i class="ri-arrow-down-s-line"></i>
                  </span>
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Harga Satuan
                  <span class="sort-icon text-gray-400">
                    <i class="ri-arrow-down-s-line"></i>
                  </span>
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Kadaluarsa
                  <span class="sort-icon text-gray-400">
                    <i class="ri-arrow-down-s-line"></i>
                  </span>
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Tindakan
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr class="hover:bg-gray-50">
                <td class="px-4 py-4">
                  <div class="custom-checkbox"></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded">
                      <img
                        class="h-10 w-10 rounded object-cover object-top"
                        src="https://readdy.ai/api/search-image?query=Amoxicillin%2520medicine%2520bottle%2520with%2520white%2520pills%252C%2520pharmaceutical%2520product%2520on%2520clean%2520white%2520background%252C%2520professional%2520product%2520photography&width=100&height=100&seq=1&orientation=squarish"
                        alt="Amoxicillin" />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Amoxicillin
                      </div>
                      <div class="text-sm text-gray-500">
                        500mg - 30 Kapsul
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                    Antibiotik
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <span class="status-indicator status-good"></span>
                    <span class="text-sm text-gray-900">128 unit</span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  Rp 125.000
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="text-sm text-gray-900">15 Des 2025</span>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
                    <button class="text-primary hover:text-primary/80">
                      <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-eye-line"></i>
                      </div>
                    </button>
                    <button class="text-primary hover:text-primary/80">
                      <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-edit-line"></i>
                      </div>
                    </button>
                    <button class="text-red-500 hover:text-red-600">
                      <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-delete-bin-line"></i>
                      </div>
                    </button>
                  </div>
                </td>
              </tr>
              <tr class="hover:bg-gray-50">
                <td class="px-4 py-4">
                  <div class="custom-checkbox"></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded">
                      <img
                        class="h-10 w-10 rounded object-cover object-top"
                        src="https://readdy.ai/api/search-image?query=Ibuprofen%2520medicine%2520bottle%2520with%2520white%2520and%2520red%2520pills%252C%2520pharmaceutical%2520product%2520on%2520clean%2520white%2520background%252C%2520professional%2520product%2520photography&width=100&height=100&seq=2&orientation=squarish"
                        alt="Ibuprofen" />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Ibuprofen
                      </div>
                      <div class="text-sm text-gray-500">
                        200mg - 50 Tablet
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Analgesik
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <span class="status-indicator status-low"></span>
                    <span class="text-sm text-gray-900">18 unit</span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  Rp 85.000
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="text-sm expiry-warning">10 Jun 2025</span>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
                    <button class="text-primary hover:text-primary/80">
                      <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-eye-line"></i>
                      </div>
                    </button>
                    <button class="text-primary hover:text-primary/80">
                      <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-edit-line"></i>
                      </div>
                    </button>
                    <button class="text-red-500 hover:text-red-600">
                      <div class="w-5 h-5 flex items-center justify-center">
                        <i class="ri-delete-bin-line"></i>
                      </div>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div
          class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between">
          <div class="flex items-center mb-4 sm:mb-0">
            <p class="text-sm text-gray-700">
              Menampilkan
              <span class="font-medium">1</span>
              sampai
              <span class="font-medium">10</span>
              dari
              <span class="font-medium">1.248</span>
              hasil
            </p>
          </div>
          <div class="flex items-center space-x-2">
            <div class="relative">
              <select
                class="custom-select appearance-none bg-white border border-gray-200 rounded px-3 py-1 pr-8 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition">
                <option value="10">10 per halaman</option>
                <option value="25">25 per halaman</option>
                <option value="50">50 per halaman</option>
                <option value="100">100 per halaman</option>
              </select>
            </div>
            <nav class="flex items-center">
              <button
                class="px-2 py-1 border border-gray-200 rounded-l-md text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                disabled>
                <div class="w-5 h-5 flex items-center justify-center">
                  <i class="ri-arrow-left-s-line"></i>
                </div>
              </button>
              <button
                class="px-3 py-1 border-t border-b border-gray-200 bg-primary text-white hover:bg-primary/90">
                1
              </button>
              <button
                class="px-3 py-1 border-t border-b border-gray-200 text-gray-700 hover:bg-gray-50">
                2
              </button>
              <button
                class="px-3 py-1 border-t border-b border-gray-200 text-gray-700 hover:bg-gray-50">
                3
              </button>
              <button
                class="px-3 py-1 border-t border-b border-gray-200 text-gray-700 hover:bg-gray-50">
                ...
              </button>
              <button
                class="px-3 py-1 border-t border-b border-gray-200 text-gray-700 hover:bg-gray-50">
                125
              </button>
              <button
                class="px-2 py-1 border border-gray-200 rounded-r-md text-gray-700 hover:bg-gray-50">
                <div class="w-5 h-5 flex items-center justify-center">
                  <i class="ri-arrow-right-s-line"></i>
                </div>
              </button>
            </nav>
          </div>
        </div>
      </div>

      <!-- Delete Confirmation Modal (Hidden by default) -->
      <div
        id="deleteModal"
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
              Apakah Anda yakin ingin menghapus obat ini? Tindakan ini tidak
              dapat dibatalkan.
            </p>
            <div class="flex justify-center space-x-3">
              <button
                id="cancelDelete"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-button whitespace-nowrap hover:bg-gray-300 transition">
                Batal
              </button>
              <button
                id="confirmDelete"
                class="px-4 py-2 bg-red-500 text-white rounded-button whitespace-nowrap hover:bg-red-600 transition">
                Ya, Hapus
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Table sorting functionality
      const tableHeaders = document.querySelectorAll("table th");
      tableHeaders.forEach((header) => {
        header.addEventListener("click", function() {
          // Skip the checkbox column
          if (!this.querySelector(".sort-icon")) return;

          // Toggle sort direction
          const currentIcon = this.querySelector(".sort-icon i");
          if (currentIcon.classList.contains("ri-arrow-up-s-line")) {
            currentIcon.classList.remove("ri-arrow-up-s-line");
            currentIcon.classList.add("ri-arrow-down-s-line");
          } else {
            currentIcon.classList.remove("ri-arrow-down-s-line");
            currentIcon.classList.add("ri-arrow-up-s-line");
          }

          // Reset other headers
          tableHeaders.forEach((h) => {
            if (h !== this && h.querySelector(".sort-icon")) {
              const icon = h.querySelector(".sort-icon i");
              icon.classList.remove("ri-arrow-up-s-line", "ri-arrow-down-s-line");
              icon.classList.add("ri-arrow-down-s-line");
            }
          });
        });
      });

      // Custom checkbox functionality
      const checkboxes = document.querySelectorAll(".custom-checkbox");
      const selectAllCheckbox = document.getElementById("selectAll");

      checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("click", function() {
          this.classList.toggle("checked");

          // If this is not the selectAll checkbox and it's unchecked, uncheck selectAll
          if (this !== selectAllCheckbox && !this.classList.contains("checked")) {
            selectAllCheckbox.classList.remove("checked");
          }

          // If this is the selectAll checkbox, update all other checkboxes
          if (this === selectAllCheckbox) {
            const isChecked = this.classList.contains("checked");
            checkboxes.forEach((cb) => {
              if (isChecked) {
                cb.classList.add("checked");
              } else {
                cb.classList.remove("checked");
              }
            });
          }
        });
      });

      // Delete modal functionality
      const deleteButtons = document
        .querySelectorAll("button .ri-delete-bin-line")
        .forEach((button) => {
          button.closest("button").addEventListener("click", function() {
            document.getElementById("deleteModal").classList.remove("hidden");
          });
        });

      document
        .getElementById("cancelDelete")
        .addEventListener("click", function() {
          document.getElementById("deleteModal").classList.add("hidden");
        });

      document
        .getElementById("confirmDelete")
        .addEventListener("click", function() {
          // Here you would add the actual delete logic
          document.getElementById("deleteModal").classList.add("hidden");
          // Show a success message or refresh the table
        });
    });
  </script>

  <?php if ($this->session->flashdata('success')): ?>
    <!-- Success Notification -->
    <div
      id="successNotification"
      class="fixed bottom-4 right-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded shadow-lg flex items-center transform translate-y-20 opacity-0 transition-all duration-300 hidden">
      <div
        class="w-6 h-6 flex items-center justify-center bg-green-100 text-green-600 rounded-full mr-3">
        <i class="ri-check-line"></i>
      </div>
      <div>
        <p class="font-medium text-sm">Success!</p>
        <p class="text-xs text-green-700">
          <?= $this->session->flashdata('success') ?>
        </p>
      </div>
      <button
        type="button"
        class="ml-6 text-green-600 hover:text-green-800"
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
</body>

</html>