import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        react({
            fastRefresh: false, // Desactiva el fast refresh
        }),
    ],
    server: {
        host: '127.0.0.1',
        port: 5173,
        proxy: {
            '/api': 'http://localhost:8000', // Proxy para redirigir las solicitudes de API
        },
    },
});








