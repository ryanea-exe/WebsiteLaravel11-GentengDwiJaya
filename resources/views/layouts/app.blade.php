<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', $appSetting->app_name)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Favicon dinamis dari logo setting --}}
    @if($appSetting->app_logo)
    <link rel="icon" type="image/png" href="{{ asset($appSetting->app_logo) }}">
    @else
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23e11d48'><path d='M12 2L2 8v2h20V8L12 2zm-9 9v9h6v-5h6v5h6V11H3z'/></svg>">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.tailwindcss.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.tailwindcss.min.js"></script>

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', 'Segoe UI', sans-serif; }

        /* ---- Scrollbar ---- */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #111; }
        ::-webkit-scrollbar-thumb { background: #e11d48; border-radius: 4px; }

        /* ---- Page transition ---- */
        .page-transition { animation: fadeSlideIn 0.4s ease; }
        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ---- Gradient text ---- */
        .text-gradient {
            background: linear-gradient(135deg, #e11d48 0%, #f97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ============ DATATABLE ============ */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }
        .dataTables_wrapper .dataTables_length { float: left; }
        .dataTables_wrapper .dataTables_filter { float: right; }
        .dataTables_wrapper::after { content: ""; display: block; clear: both; }

        /* Search input */
        .dataTables_filter input {
            background: rgba(255,255,255,0.06) !important;
            border: 1px solid rgba(225,29,72,0.3) !important;
            border-radius: 10px !important;
            padding: 8px 14px !important;
            outline: none !important;
            color: #e5e7eb !important;
            min-width: 220px;
            max-height: 36px !important;
            font-size: 13px;
        }
        .dataTables_filter input::placeholder { color: rgba(156,163,175,0.5); }
        .dataTables_filter input:focus {
            border-color: #e11d48 !important;
            box-shadow: 0 0 0 3px rgba(225,29,72,0.15) !important;
            background: rgba(225,29,72,0.05) !important;
        }

        /* Select */
        .dataTables_length select {
            background: rgba(255,255,255,0.06) !important;
            border: 1px solid rgba(225,29,72,0.3) !important;
            border-radius: 8px !important;
            padding: 6px 12px !important;
            color: #e5e7eb !important;
        }

        /* Table */
        table.dataTable { border-collapse: collapse !important; width: 100% !important; }

        /* Header */
        table.dataTable thead th {
            background: linear-gradient(135deg, #9f1239, #be123c) !important;
            color: white !important;
            padding: 14px 16px !important;
            border-bottom: none !important;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            font-size: 11px;
            font-weight: 700;
        }

        /* Body */
        table.dataTable tbody td {
            padding: 10px 16px !important;
            vertical-align: middle !important;
            color: #d1d5db;
            border-bottom: 1px solid rgba(255,255,255,0.05) !important;
            font-size: 13px;
        }
        table.dataTable tbody tr { border-bottom: 1px solid rgba(255,255,255,0.05); background: transparent; }
        table.dataTable tbody tr:nth-child(even) { background: rgba(255,255,255,0.02) !important; }
        table.dataTable tbody tr:hover { background: rgba(225,29,72,0.07) !important; }

        /* Bottom */
        .dataTables_wrapper .dataTables_info {
            float: left;
            padding-top: 10px;
            font-size: 12px;
            color: #6b7280 !important;
            margin-top: 16px !important;
        }
        .dataTables_wrapper .dataTables_paginate {
            float: right;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            margin-top: 16px !important;
        }

        /* Pagination buttons */
        .dataTables_wrapper .paginate_button {
            min-width: 34px !important;
            height: 34px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            border-radius: 8px !important;
            border: 1px solid rgba(225,29,72,0.25) !important;
            background: rgba(255,255,255,0.04) !important;
            color: #9ca3af !important;
            transition: all 0.2s ease;
        }
        .dataTables_wrapper .paginate_button.current {
            background: linear-gradient(135deg, #e11d48, #9f1239) !important;
            color: white !important;
            border-color: transparent !important;
            box-shadow: 0 0 12px rgba(225,29,72,0.35);
        }
        .dataTables_wrapper .paginate_button:hover {
            background: rgba(225,29,72,0.15) !important;
            color: #e11d48 !important;
            border-color: rgba(225,29,72,0.4) !important;
        }
        .dataTables_wrapper .paginate_button.disabled { opacity: 0.35; cursor: not-allowed; }

        .dataTables_filter label { display: flex; align-items: center; gap: 12px; color: #9ca3af; }
        .dataTables_length label { color: #9ca3af; }
        .dataTables_empty {
            text-align: center !important;
            font-style: italic;
            color: #6b7280;
            padding: 20px 0 !important;
            font-size: 13px;
        }
        .dataTables_filter input:focus,
        .dataTables_length select:focus { outline: none !important; }

        @media (max-width: 768px) {
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                float: none !important;
                width: 100%;
            }
            .dataTables_wrapper .dataTables_filter { margin-top: 10px; }
            .dataTables_wrapper .dataTables_paginate { margin-top: 16px; flex-wrap: wrap; }
        }
    </style>
</head>

<body class="bg-[#0a0a0a] text-gray-200 overflow-hidden">
    <!-- HEADER -->
    @include('components.header')

    <!-- WRAPPER -->
    <div class="flex h-screen pt-16">
        <!-- SIDEBAR -->
        @include('components.sidebar')

        <!-- MAIN CONTENT -->
        <main class="flex-1 lg:ml-64 h-[calc(100vh-4rem)] overflow-y-auto page-transition bg-[#0a0a0a]">
            <div class="p-4 md:p-6 min-h-full flex flex-col">
                <div class="flex-1">
                    @yield('content')
                </div>
                <!-- FOOTER -->
                @include('components.footer')
            </div>
        </main>
    </div>
</body>

<script>
    $('#dataTable').DataTable({
        responsive: true,
        pageLength: 50,
        language: {
            decimal: "",
            emptyTable: "Data tidak ditemukan",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            thousands: ",",
            lengthMenu: "Tampilkan _MENU_ data",
            loadingRecords: "Memuat...",
            processing: "Memproses...",
            search: "Cari :",
            zeroRecords: "Data tidak ditemukan",
            paginate: { first: "<<", last: ">>", next: ">", previous: "<" }
        }
    });
</script>
</html>
