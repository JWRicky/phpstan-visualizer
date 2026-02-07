<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>PHPStan Inspector</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛠️</text></svg>">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
        function toggleDarkMode() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
        }
        
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=SF+Mono:wght@400;600&family=Inter:wght@400;600&display=swap');
        body { font-family: 'Inter', sans-serif; overflow: hidden; margin: 0; } 
        .code { font-family: 'SF Mono', monospace; }
        .app-container { min-width: 1200px; width: 1200px; margin: 0 auto; }
    </style>
</head>

<body class="h-screen text-gray-700 dark:text-[#d1d1d1] bg-gray-100 dark:bg-[#121212] transition-colors duration-200">
    <div class="app-container h-screen flex flex-col bg-white dark:bg-[#1e1e1e] shadow-2xl border-x border-gray-300 dark:border-[#121212]">
        
        <header class="h-10 bg-[#f3f3f3] dark:bg-[#2d2d2d] border-b border-gray-300 dark:border-[#121212] flex items-center justify-between px-4 shrink-0">
            <div class="flex items-center gap-4">
                <div class="flex items-center bg-gray-200 dark:bg-[#3d3d3d] p-0.5 rounded-md">
                    <button onclick="toggleDarkMode()" class="p-1.5 hover:bg-white dark:hover:bg-gray-600 rounded text-orange-500 dark:text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.242 16.242l.707.707M7.757 7.757l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
                    </button>
                    <button onclick="toggleDarkMode()" class="p-1.5 hover:bg-white dark:hover:bg-gray-600 rounded text-gray-400 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                    </button>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">PHPStan Visualizer</span>
            </div>
            
            <div class="flex items-center gap-3">
                <span class="text-[11px] font-bold text-red-600 dark:text-[#ff453a] bg-red-100 dark:bg-[#ff453a]/10 px-2 py-0.5 rounded border border-red-200 dark:border-red-900/50">
                    {{ $totals['file_errors'] }} Issues Detected
                </span>
                <button onclick="location.reload()" class="text-[10px] font-bold px-3 py-1 bg-white dark:bg-[#3d3d3d] border border-gray-300 dark:border-[#555] rounded hover:bg-gray-50 dark:hover:bg-[#4d4d4d] transition-all active:scale-95">REFRESH</button>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto scroll-smooth">
            @foreach($files as $file)
            <div class="border-b border-gray-200 dark:border-[#2d2d2d]">
                <div class="bg-gray-50 dark:bg-[#252525] px-6 py-1.5 flex items-center gap-2 sticky top-0 z-10 border-b border-gray-200 dark:border-[#1a1a1a]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" /></svg>
                    <span class="text-[11px] font-bold text-blue-600 dark:text-blue-400 code">{{ $file['rel_path'] }}</span>
                </div>

                <div class="divide-y divide-gray-100 dark:divide-[#2d2d2d]">
                    @foreach($file['errors'] as $error)
                    <div class="group flex items-start hover:bg-gray-200 dark:hover:bg-[#2a2d2e] transition-colors py-2 px-10 relative">
                        <div class="absolute left-4 top-2.5 text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <circle cx="10" cy="10" r="8" />
                                <path fill="currentColor" class="text-white dark:text-[#1e1e1e]" d="M10 6a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 6zm0 9a1 1 0 100-2 1 1 0 000 2z" />
                            </svg>
                        </div>

                        <div class="flex items-baseline gap-4 w-full">
                            <span class="text-[10px] code text-gray-400 dark:text-gray-500 font-bold w-10 shrink-0">L:{{ $error['line'] }}</span>
                            <p class="text-[13px] code text-gray-800 dark:text-[#ececec] leading-snug w-[900px]">
                                {{ $error['message'] }}
                            </p>
                        </div>

                        <div class="absolute right-6 top-[7px]">
                            <a href="{{ $error['url'] }}" 
                               class="opacity-0 group-hover:opacity-100 flex items-center px-3 py-0.5 bg-blue-600 text-white text-[10px] font-bold rounded shadow-sm hover:bg-blue-500 transition-all cursor-pointer">
                                FIX
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </main>
        
    </div>
</body>
</html>