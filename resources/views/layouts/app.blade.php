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
                        "primary":             "#e11d48",  // rose-600 — boutons, actif
                        "primary-dark":        "#be123c",  // rose-700 — hover
                        "primary-light":       "#fb7185",  // rose-400 — icônes inactives
                        "sidebar":             "#020617",  // slate-950 — fond sidebar
                        "sidebar-active":      "#e11d48",  // rose-600 — item actif sidebar
                        "background":          "#f8fafc",  // slate-50  — fond pages
                        "surface":             "#ffffff",  // blanc — cards
                        "on-surface":          "#020617",  // slate-950 — textes principaux (même couleur que sidebar)
                        "on-surface-variant":  "#64748b",  // slate-500 — textes secondaires
                        "on-surface-muted":    "#94a3b8",  // slate-400 — labels, placeholders
                        "outline-variant":     "#e2e8f0",  // slate-200 — bordures
                        "accent-green":        "#1B6B3A",  // vert — badges positifs uniquement
                        "accent-gold":         "#C9A84C",  // doré — logo FRMF
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

        .zellige-pattern {
            background-color: #f8fafc;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0l15 15-15 15-15-15zM0 30l15 15-15 15-15-15zM60 30l15 15-15 15-15-15zM30 60l15-15-15-15-15 15z' fill='%23e11d48' fill-opacity='0.02' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .dot-pattern {
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 20px 20px;
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