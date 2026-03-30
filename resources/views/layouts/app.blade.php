<!DOCTYPE html>
<html lang="fr" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'QuickRef — FRMF')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1B6B3A",
                        "secondary": "#E0283C",
                        "tertiary": "#C9A84C",
                        "background": "#F8F9FA",
                        "surface": "#ffffff",
                        "on-surface": "#1b1b1b",
                        "on-surface-variant": "#495057",
                        "on-primary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "outline-variant": "#E9ECEF",
                        "surface-container-low": "#f6f3f2",
                        "surface-container-lowest": "#ffffff",
                        "outline": "#707a6f",
                        "outline-variant": "#bfc9bd",
                    },
                    fontFamily: {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        "2xl": "1rem",
                        full: "9999px",
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .zellige-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0l15 15-15 15-15-15zM0 30l15 15-15 15-15-15zM60 30l15 15-15 15-15-15zM30 60l15-15-15-15-15 15z' fill='%231B6B3A' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
        @yield('extra-styles')
    </style>
    @yield('head')
</head>
<body class="@yield('body-class', 'bg-background font-body text-on-surface min-h-screen')">

    @yield('content')

    @yield('scripts')
</body>
</html>