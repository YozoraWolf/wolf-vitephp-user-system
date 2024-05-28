import { defineConfig } from 'vite';
import usePHP from 'vite-plugin-php';


export default defineConfig({
    base: '/pages/',
    server: {
        port: 3005
    },
    plugins: [usePHP({
        entry: ['pages/**/*.php'],
    })]
});