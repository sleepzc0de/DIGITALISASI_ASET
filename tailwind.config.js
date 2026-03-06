import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.blade.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    // WAJIB: class yang dipakai via variabel PHP (tidak bisa dideteksi JIT)
    safelist: [
        'bg-blue-50',   'bg-green-50',   'bg-yellow-50', 'bg-red-50',
        'bg-indigo-50', 'bg-purple-50',
        'bg-blue-100',  'bg-green-100',  'bg-indigo-100','bg-pink-100',
        'bg-orange-100','bg-yellow-100',
        'text-blue-600','text-green-600','text-yellow-600','text-red-600',
        'text-indigo-600','text-purple-600','text-pink-600','text-orange-600',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe',
                    300: '#93c5fd', 400: '#60a5fa', 500: '#3b82f6',
                    600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a',
                },
                secondary: {
                    50: '#f8fafc',  100: '#f1f5f9', 200: '#e2e8f0',
                    300: '#cbd5e1', 400: '#94a3b8', 500: '#64748b',
                    600: '#475569', 700: '#334155', 800: '#1e293b', 900: '#0f172a',
                },
            },
            animation: {
                'fade-in':       'fadeIn 0.5s ease-out',
                'fade-in-down':  'fadeInDown 0.5s ease-out',
                'slide-in-right':'slideInRight 0.5s ease-out',
                'pulse-slow':    'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'bounce-slow':   'bounce 2s infinite',
                'spin-slow':     'spin 3s linear infinite',
            },
            backdropBlur: { xs: '2px' },
            boxShadow: {
                'soft' : '0 10px 40px -10px rgba(0, 0, 0, 0.05)',
                'hover': '0 20px 60px -15px rgba(0, 0, 0, 0.08)',
                'glow' : '0 0 20px rgba(59, 130, 246, 0.3)',
            },
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
