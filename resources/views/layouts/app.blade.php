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
                        // Matching the Sidebar Theme
                        "primary":                  "#e11d48",  // rose-600
                        "primary-dark":             "#be123c",  // rose-700
                        "secondary":                "#fb7185",  // rose-400
                        "dark-sidebar":             "#020617",  // slate-950
                        "background":               "#f8fafc",  // slate-50
                        "surface":                  "#ffffff",
                        "on-surface":               "#0f172a",  // slate-900
                        "on-surface-variant":       "#64748b",  // slate-500
                        "outline-variant":          "#e2e8f0",  // slate-200
                    },
                    fontFamily: {
                        "headline": ["Manrope", "sans-serif"],
                        "body":     ["Inter", "sans-serif"],
                        "label":    ["Inter", "sans-serif"],
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
        
        /* Updated Zellige pattern to match the Rose/Slate theme */
        .zellige-pattern {
            background-color: #f8fafc;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0l15 15-15 15-15-15zM0 30l15 15-15 15-15-15zM60 30l15 15-15 15-15-15zM30 60l15-15-15-15-15 15z' fill='%23e11d48' fill-opacity='0.02' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        /* Dot pattern from your sidebar main area */
        .dot-pattern {
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 20px 20px;
        }

        @yield('extra-styles')
    </style>
    @yield('head')
</head>
<body class="@yield('body-class', 'bg-background font-body text-on-surface min-h-screen relative')">

    @yield('content')

    @yield('scripts')
</body>
</html>