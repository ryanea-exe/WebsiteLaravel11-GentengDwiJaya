<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Genteng Dwijaya')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.tailwindcss.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.tailwindcss.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        /* Fade In Halaman */
        .page-transition {
            animation: fadeIn 0.45s ease;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ================= DATATABLE ================= */
        /* TOP SECTION */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }
        /* TOP FLEX */
        .dataTables_wrapper .dataTables_length {
            float: left;
        }
        .dataTables_wrapper .dataTables_filter {
            float: right;
        }
        /* CLEAR FLOAT */
        .dataTables_wrapper::after {
            content: "";
            display: block;
            clear: both;
        }
        /* SEARCH */
        .dataTables_filter input {
            border: 1px solid #fdba74 !important;
            border-radius: 12px !important;
            padding: 9px 14px !important;
            outline: none !important;
            background: white !important;
            min-width: 230px;
            max-height: 36px !important;
        }
        .dataTables_filter input:focus {
            border-color: #ea580c !important;
            box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.15);
        }
        /* SELECT */
        .dataTables_length select {
            border: 1px solid #fdba74 !important;
            border-radius: 10px !important;
            padding: 7px 12px !important;
            background: white !important;
        }
        /* TABLE */
        table.dataTable {
            border-collapse: collapse !important;
            width: 100% !important;
        }
        /* HEADER */
        table.dataTable thead th {
            background: #9a3412 !important;
            color: white !important;
            padding: 16px 16px !important;
            border-bottom: none !important;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 12px;
            font-weight: 700;
        }
        /* BODY */
        table.dataTable tbody td {
            padding: 8px 16px !important;
            vertical-align: middle !important;
        }
        table.dataTable tbody tr {
            border-bottom: 1px solid #ffedd5;
        }
        table.dataTable tbody tr:hover {
            background-color: #fff7ed !important;
        }
        /* BOTTOM SECTION */
        .dataTables_info {
            color: #78716c !important;
        }
        /* FLEX BOTTOM */
        .dataTables_wrapper .dataTables_info {
            float: left;
            padding-top: 10px;
        }
        .dataTables_wrapper .dataTables_paginate {
            float: right;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
        }
        /* PAGINATION BUTTON */
        .dataTables_wrapper .paginate_button {
            min-width: 36px !important;
            height: 36px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            border-radius: 8px !important;
            border: 1px solid #fed7aa !important;
            background: white !important;
            color: #9a3412 !important;
            transition: all 0.2s ease;
        }
        /* ACTIVE PAGE */
        .dataTables_wrapper .paginate_button.current {
            background: #c2410c !important;
            color: white !important;
            border: 1px solid #c2410c !important;
        }
        /* HOVER */
        .dataTables_wrapper .paginate_button:hover {
            background: #ea580c !important;
            color: white !important;
            border-color: #ea580c !important;
        }
        /* DISABLED */
        .dataTables_wrapper .paginate_button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        /* Jarak search label */
        .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        /* Jarak pagination dengan tabel */
        .dataTables_paginate {
            margin-top: 16px !important;
        }
        /* Kecilkan info data */
        .dataTables_info {
            font-size: 14px;
            color: #78716c !important;
            margin-top: 16px !important;
        }
        /* Text data kosong */
        .dataTables_empty {
            text-align: center !important;
            font-style: italic;
            color: #78716c;
            padding: 16px 0 !important;
            font-size: 14px;
        }
        /* Hilangkan outline biru default */
        .dataTables_filter input:focus,
        .dataTables_length select:focus {
            outline: none !important;
        }
        /* Responsive search */
        .dataTables_filter {
            margin-left: auto;
        }
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                float: none !important;
                width: 100%;
                justify-content: space-between;
            }
            .dataTables_wrapper .dataTables_filter {
                margin-top: 10px;
            }
            .dataTables_wrapper .dataTables_paginate {
                margin-top: 16px;
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body class="bg-orange-50 text-gray-800 overflow-hidden">
    <!-- HEADER -->
    @include('components.header')

    <!-- WRAPPER -->
    <div class="flex h-screen pt-16">
        <!-- SIDEBAR -->
        @include('components.sidebar')

        <!-- MAIN CONTENT -->
        <main class="flex-1 lg:ml-64 h-[calc(100vh-4rem)] overflow-y-auto page-transition">
            <!-- CONTENT -->
            <div class="p-4 md:p-6 min-h-full flex flex-col">
                <!-- ISI -->
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

            paginate: {
                first: "<<",
                last: ">>",
                next: ">",
                previous: "<"
            }
        }
    });
</script>
</html>