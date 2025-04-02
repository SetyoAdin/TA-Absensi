@extends('layouts.main') {{-- Gunakan template utama --}}

@section('title', 'Dashboard') {{-- Set title --}}

@section('content')
    <style>
        /* Custom Dark Theme CSS */
        :root {
            --dark-bg: #121212;
            --dark-section: #1e1e1e;
            --dark-input: #2d2d2d;
            --accent-color: #6366f1;
            --accent-hover: #4f46e5;
            --text-primary: #f3f4f6;
            --text-secondary: #9ca3af;
            --danger: #ef4444;
            --danger-hover: #dc2626;
            --warning: #f59e0b;
            --warning-hover: #d97706;
            --success: #10b981;
            --secondary: #6b7280;
            --secondary-hover: #4b5563;
            --border-color: #2d2d2d;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
        }

        /* Section headers */
        .section-header {
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--text-primary);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        /* Form section */
        .form-section {
            background-color: var(--dark-section);
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        /* Table section */
        .table-section {
            background-color: var(--dark-section);
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        /* Form layout with columns */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .form-col {
            flex: 0 0 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 768px) {
            .form-col-md-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }

            .form-col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* Form controls */
        .form-control,
        select.form-control,
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        textarea {
            background-color: var(--dark-input);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 6px;
            padding: 10px 14px;
            transition: all 0.2s ease;
            width: 100%;
            height: auto;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .form-control:focus,
        select.form-control:focus,
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            background-color: var(--dark-input) !important;
            /* Force dark background */
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25);
            color: var(--text-primary) !important;
            /* Force light text */
            outline: none;
        }

        /* Override browser default focus styles */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus {
            -webkit-text-fill-color: var(--text-primary);
            -webkit-box-shadow: 0 0 0px 1000px var(--dark-input) inset;
            transition: background-color 5000s ease-in-out 0s;
        }

        .form-label {
            color: var(--text-secondary);
            margin-bottom: 8px;
            font-weight: 500;
            display: block;
        }

        option {
            background-color: var(--dark-input);
            color: var(--text-primary);
        }

        /* Buttons */
        .btn {
            border-radius: 6px;
            padding: 10px 16px;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
            margin-right: 8px;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
            border-color: var(--accent-hover);
        }

        .btn-secondary {
            background-color: var(--secondary);
            border-color: var(--secondary);
            color: white;
        }

        .btn-secondary:hover {
            background-color: var(--secondary-hover);
            border-color: var(--secondary-hover);
        }

        .btn-warning {
            background-color: var(--warning);
            border-color: var(--warning);
            color: white;
        }

        .btn-warning:hover {
            background-color: var(--warning-hover);
            border-color: var(--warning-hover);
        }

        .btn-danger {
            background-color: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: var(--danger-hover);
            border-color: var(--danger-hover);
        }

        .btn-sm {
            padding: 6px 10px;
            font-size: 0.875rem;
        }

        /* Form action buttons */
        .form-actions {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        /* Table styling */
        .table {
            color: var(--text-primary);
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 0;
        }

        .table-bordered {
            border: none;
        }

        .table thead th {
            background-color: rgba(255, 255, 255, 0.05);
            border-bottom: 2px solid var(--border-color);
            color: var(--text-secondary);
            padding: 12px 16px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }

        /* Alert styling */
        .alert {
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: var(--success);
        }

        /* Main container styling */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-title {
            color: var(--text-primary);
            font-weight: 700;
            margin: 30px 0;
            font-size: 1.75rem;
        }

        /* Action buttons spacing */
        td .btn {
            margin-right: 5px;
        }

        /* Adding soft transitions */
        * {
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color);
        }

        /* Form group margin */
        .mb-3 {
            margin-bottom: 20px;
        }

        /* Make table responsive */
        .table-responsive {
            overflow-x: auto;
            border-radius: 8px;
        }

        /* Animation for alerts */
        .alert {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Card styling (for backward compatibility) */
        .card {
            background-color: var(--dark-section);
            border-radius: 10px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .card-header {
            background-color: rgba(255, 255, 255, 0.05);
            padding: 16px 20px;
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
        }

        .card-body {
            padding: 20px;
        }

        /* Bootstrap margin utility override */
        .mt-5 {
            margin-top: 3rem;
        }
    </style>
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="page-title">
                Dashboard
            </h2>
        </div>
    </main>
@endsection
