import { defineConfig } from 'vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        viteStaticCopy({
            targets: [
                {
                    src: 'Composants/*/*.{jpg,png,svg,ico,webp}',
                    dest: 'images',
                    rename: { stripBase: 2 }
                }
            ]
        })
    ],
    build: {
        outDir: 'assets',
        emptyOutDir: true,
        rollupOptions: {
            input: {
                app: './main.js'
            },
            output: {
                entryFileNames: 'app.js',
                assetFileNames: 'style.css'
            }
        }
    }
});