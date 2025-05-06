<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pharmacy Inventory Dashboard</title>
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
              <p class="text-xs opacity-70">Pharmacy Manager</p>
            </div>
          </div>
        </div>
        <a
          href="<?= site_url('/') ?>"
          class="flex items-center px-6 py-3 bg-white/20 text-white">
          <div class="w-6 h-6 flex items-center justify-center">
            <i class="ri-dashboard-line"></i>
          </div>
          <span class="ml-3 text-sm font-medium">Dashboard</span>
        </a>
        <a
          href="<?= site_url('obat/index') ?>"
          data-readdy="true"
          class="flex items-center px-6 py-3 text-white/80 hover:bg-white/10 transition-colors">
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
        <span class="ml-3 text-sm font-medium">Settings</span>
      </a>
      <a
        href="#"
        class="flex items-center px-4 py-2 text-white/80 hover:bg-white/10 rounded transition-colors">
        <div class="w-6 h-6 flex items-center justify-center">
          <i class="ri-logout-box-line"></i>
        </div>
        <span class="ml-3 text-sm font-medium">Logout</span>
      </a>
    </div>
  </div>
  <!-- Main Content -->
  <div class="main-content min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm px-6 py-4">
      <div class="flex justify-between items-center">
        <h1 class="text-xl font-semibold text-gray-800">
          Inventory Dashboard
        </h1>
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
            <p class="text-sm font-medium text-gray-700">May 5, 2025</p>
            <p class="text-xs text-gray-500">Monday</p>
          </div>
        </div>
      </div>
    </header>
    <!-- Dashboard Content -->
    <div class="p-6">
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded shadow p-5">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-sm text-gray-500 mb-1">Total Medicines</p>
              <h3 class="text-2xl font-semibold text-gray-800">1,248</h3>
              <p class="text-xs text-green-500 mt-1">+12% from last month</p>
            </div>
            <div
              class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full">
              <i class="ri-medicine-bottle-line ri-lg"></i>
            </div>
          </div>
        </div>
        <div class="bg-white rounded shadow p-5">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-sm text-gray-500 mb-1">Low Stock</p>
              <h3 class="text-2xl font-semibold text-gray-800">42</h3>
              <p class="text-xs text-yellow-500 mt-1">Needs attention</p>
            </div>
            <div
              class="w-10 h-10 flex items-center justify-center bg-yellow-100 text-yellow-500 rounded-full">
              <i class="ri-alert-line ri-lg"></i>
            </div>
          </div>
        </div>
        <div class="bg-white rounded shadow p-5">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-sm text-gray-500 mb-1">Expiring Soon</p>
              <h3 class="text-2xl font-semibold text-gray-800">28</h3>
              <p class="text-xs text-orange-500 mt-1">Within 30 days</p>
            </div>
            <div
              class="w-10 h-10 flex items-center justify-center bg-orange-100 text-orange-500 rounded-full">
              <i class="ri-time-line ri-lg"></i>
            </div>
          </div>
        </div>
        <div class="bg-white rounded shadow p-5">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-sm text-gray-500 mb-1">Out of Stock</p>
              <h3 class="text-2xl font-semibold text-gray-800">15</h3>
              <p class="text-xs text-red-500 mt-1">Critical items</p>
            </div>
            <div
              class="w-10 h-10 flex items-center justify-center bg-red-100 text-red-500 rounded-full">
              <i class="ri-error-warning-line ri-lg"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- Search and Filter Section -->
      <div class="bg-white rounded shadow mb-6">
        <div class="p-5 border-b border-gray-100">
          <div
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1">
              <div class="relative">
                <div
                  class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <div
                    class="w-5 h-5 flex items-center justify-center text-gray-400">
                    <i class="ri-search-line"></i>
                  </div>
                </div>
                <input
                  type="text"
                  class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                  placeholder="Search medicines..." />
              </div>
            </div>
            <div class="flex flex-wrap gap-3">
              <div class="relative">
                <select
                  class="custom-select appearance-none bg-white border border-gray-200 rounded px-4 py-2 pr-8 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition">
                  <option value="">All Categories</option>
                  <option value="antibiotics">Antibiotics</option>
                  <option value="analgesics">Analgesics</option>
                  <option value="antiviral">Antiviral</option>
                  <option value="vitamins">Vitamins</option>
                </select>
              </div>
              <div class="relative">
                <select
                  class="custom-select appearance-none bg-white border border-gray-200 rounded px-4 py-2 pr-8 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition">
                  <option value="">All Suppliers</option>
                  <option value="pharma-a">Pharma A</option>
                  <option value="pharma-b">Pharma B</option>
                  <option value="pharma-c">Pharma C</option>
                </select>
              </div>
              <button
                class="bg-primary text-white px-4 py-2 rounded-button whitespace-nowrap hover:bg-primary/90 transition flex items-center">
                <div class="w-5 h-5 flex items-center justify-center mr-1">
                  <i class="ri-filter-3-line"></i>
                </div>
                Filter
              </button>
            </div>
          </div>
        </div>
        <div
          class="p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <div>
            <h2 class="text-lg font-medium text-gray-800">
              Medicine Inventory
            </h2>
            <p class="text-sm text-gray-500">Showing 1-10 of 1,248 items</p>
          </div>
          <div class="flex gap-3">
            <button
              class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-button whitespace-nowrap hover:bg-gray-50 transition flex items-center">
              <div class="w-5 h-5 flex items-center justify-center mr-1">
                <i class="ri-download-line"></i>
              </div>
              Export
            </button>
            <a
              href=""
              data-readdy="true">
              <button
                class="bg-secondary text-white px-4 py-2 rounded-button whitespace-nowrap hover:bg-secondary/90 transition flex items-center">
                <div class="w-5 h-5 flex items-center justify-center mr-1">
                  <i class="ri-add-line"></i>
                </div>
                Add Medicine
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
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Medicine
                  <span class="sort-icon text-gray-400">
                    <i class="ri-arrow-up-s-line"></i>
                  </span>
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Category
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Stock
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Unit Price
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Expiration
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Supplier
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded">
                      <img
                        class="h-10 w-10 rounded object-cover"
                        src=""
                        alt="Amoxicillin" />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Amoxicillin
                      </div>
                      <div class="text-sm text-gray-500">
                        500mg - 30 Capsules
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                    Antibiotics
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <span class="status-indicator status-good"></span>
                    <span class="text-sm text-gray-900">128 units</span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  $12.99
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="text-sm text-gray-900">Dec 15, 2025</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  MedPharm Inc.
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
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
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded">
                      <img
                        class="h-10 w-10 rounded object-cover"
                        src=""
                        alt="Ibuprofen" />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Ibuprofen
                      </div>
                      <div class="text-sm text-gray-500">
                        200mg - 50 Tablets
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Analgesics
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <span class="status-indicator status-low"></span>
                    <span class="text-sm text-gray-900">18 units</span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  $8.50
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="text-sm expiry-warning">Jun 10, 2025</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  GlobalMed
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
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
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded">
                      <img
                        class="h-10 w-10 rounded object-cover"
                        src=""
                        alt="Paracetamol" />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Paracetamol
                      </div>
                      <div class="text-sm text-gray-500">
                        500mg - 100 Tablets
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Analgesics
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <span class="status-indicator status-good"></span>
                    <span class="text-sm text-gray-900">245 units</span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  $5.99
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="text-sm text-gray-900">Aug 22, 2025</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  PharmaPlus
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
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
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded">
                      <img
                        class="h-10 w-10 rounded object-cover"
                        src=""
                        alt="Azithromycin" />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Azithromycin
                      </div>
                      <div class="text-sm text-gray-500">
                        250mg - 6 Tablets
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                    Antibiotics
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <span class="status-indicator status-out"></span>
                    <span class="text-sm text-gray-900">0 units</span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  $15.75
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="text-sm expiry-expired">Apr 30, 2025</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  MedPharm Inc.
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
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
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded">
                      <img
                        class="h-10 w-10 rounded object-cover"
                        src=""
                        alt="Vitamin D" />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Vitamin D
                      </div>
                      <div class="text-sm text-gray-500">
                        1000 IU - 90 Softgels
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                    Vitamins
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <span class="status-indicator status-good"></span>
                    <span class="text-sm text-gray-900">156 units</span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  $9.25
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="text-sm text-gray-900">Nov 18, 2025</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  NutriHealth
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
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
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded">
                      <img
                        class="h-10 w-10 rounded object-cover"
                        src=""
                        alt="Omeprazole" />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Omeprazole
                      </div>
                      <div class="text-sm text-gray-500">
                        20mg - 28 Capsules
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                    Antacids
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <span class="status-indicator status-low"></span>
                    <span class="text-sm text-gray-900">12 units</span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  $14.50
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="text-sm expiry-warning">May 25, 2025</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  GlobalMed
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
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
              </tr>z
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded">
                      <img
                        class="h-10 w-10 rounded object-cover"
                        src=""
                        alt="Loratadine" />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Loratadine
                      </div>
                      <div class="text-sm text-gray-500">
                        10mg - 30 Tablets
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-100 text-pink-800">
                    Antihistamines
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <span class="status-indicator status-good"></span>
                    <span class="text-sm text-gray-900">87 units</span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  $7.25
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="text-sm text-gray-900">Sep 12, 2025</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  PharmaPlus
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex space-x-2">
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
              Showing
              <span class="font-medium">1</span>
              to
              <span class="font-medium">10</span>
              of
              <span class="font-medium">1,248</span>
              results
            </p>
          </div>
          <div class="flex items-center space-x-2">
            <div class="relative">
              <select
                class="custom-select appearance-none bg-white border border-gray-200 rounded px-3 py-1 pr-8 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition">
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
                <option value="50">50 per page</option>
                <option value="100">100 per page</option>
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
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Table sorting functionality
      const tableHeaders = document.querySelectorAll("table th");
      tableHeaders.forEach((header) => {
        header.addEventListener("click", function() {
          // Toggle sort direction
          const currentIcon = this.querySelector(".sort-icon i");
          if (currentIcon.classList.contains("ri-arrow-up-s-line")) {
            currentIcon.classList.remove("ri-arrow-up-s-line");
            currentIcon.classList.add("ri-arrow-down-s-line");
          } else {
            currentIcon.classList.remove("ri-arrow-down-s-line");
            currentIcon.classList.add("ri-arrow-up-s-line");
          }
          // Here you would add actual sorting logic
          // For demo purposes we're just toggling the icon
        });
      });
    });
  </script>
</body>

</html>