<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SiSPP - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('image/SiSPP-nobg.jpg') }}" type="image/x-icon">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>


    <style>
        /* Single Selection Styles */
        .select2-container--default .select2-selection--single {
            background-color: rgb(239 246 255) !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.375rem !important;
            height: 42px !important;
            padding: 0.5rem 0.75rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px !important;
            color: #374151 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 10px !important;
        }

        /* Multiple Selection Styles */
        .select2-container--default .select2-selection--multiple {
            background-color: rgb(239 246 255) !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.375rem !important;
            min-height: 42px !important;
            padding: 0.25rem 0.5rem !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            margin: 0.25rem !important;
            padding: 0.25rem 0.5rem !important;
            background-color: #fff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.25rem !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #374151 !important;
            margin-right: 0.25rem !important;
        }

        /* Dropdown Styles */
        .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.375rem !important;
        }

        .select2-search--dropdown .select2-search__field {
            padding: 0.5rem !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.375rem !important;
        }
    </style>

    <script>
        function openEditModal(id) {
            document.getElementById('editModal' + id).classList.remove('hidden');
        }

        function closeEditModal(id) {
            document.getElementById('editModal' + id).classList.add('hidden');
        }
    </script>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('text-blue-500');
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#workOrderTable').DataTable({
                "order": [[0, "desc"]],
                "language": {
                    "search": "Search: (*By number or Product)",
                    "searchPlaceholder": "Search...",
                    "lengthMenu": "Show _MENU_ entries per page",
                    "zeroRecords": "No matching records found",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                },
                "columns": [
                    { "searchable": false }, // WO Number
                    { "searchable": true }, // Product Name  
                    { "searchable": false },
                    { "searchable": false },
                    { "searchable": false },
                    { "searchable": false },
                    { "searchable": false }
                ]
            });
        });
    </script>

    <script>
        function openEditOperatorModal(id) {
            document.getElementById('editOperatorModal').classList.remove('hidden');

            // Fetch form content using the named route
            fetch(`{{ route('operator.edit', '') }}/${id}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('editOperatorContent').innerHTML = html;
                });
        }

        function closeEditOperatorModal() {
            document.getElementById('editOperatorModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.addEventListener('click', function (event) {
            const operatorModal = document.getElementById('editOperatorModal');
            if (event.target === operatorModal) {
                closeEditOperatorModal();
            }
        });

        function openMilestoneModal(id) {
            document.getElementById('milestoneModal').classList.remove('hidden');

            // Fetch milestone content using the named route
            fetch(`{{ route('workorder.milestone', '') }}/${id}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('milestoneModalContent').innerHTML = html;
                });
        }

        function closeMilestoneModal() {
            document.getElementById('milestoneModal').classList.add('hidden');
        }

        // Add to your existing click event listener
        document.addEventListener('click', function (event) {
            const editModal = document.getElementById('editModal');
            const milestoneModal = document.getElementById('milestoneModal');

            if (event.target === editModal) {
                closeEditModal();
            }
            if (event.target === milestoneModal) {
                closeMilestoneModal();
            }
        });

        function openEditModal(id) {
            document.getElementById('editModal').classList.remove('hidden');

            // Fetch form content using the named route
            fetch(`{{ route('workorder.edit', '') }}/${id}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('editModalContent').innerHTML = html;
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                closeEditModal();
            }
        });

        function handleStatusChange() {
            document.getElementById('filterForm').submit();
        }

        function exportFilteredPdf() {
            const status = document.getElementById('status-filter')?.value;
            const assigned = document.getElementById('assigned-filter')?.value || 'All';
            window.location.href = `{{ route('workorder.exportPdf') }}?status=${status}&assigned=${assigned}`;
        }
    </script>
</head>

<body class="bg-gray-100">
    <div class="flex">
        @include('layouts.sidebar')

        <div class="flex-1">
            @include('layouts.topbar')
            <main class="p-6">


                @yield('content')
            </main>
        </div>
</body>

</html>