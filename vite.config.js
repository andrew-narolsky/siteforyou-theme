import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
    build: {
        outDir: 'assets/dist',
        emptyOutDir: false,
        rollupOptions: {
            input: {
                blocks: path.resolve(__dirname, 'assets/src/blocks.css'),
                styles: path.resolve(__dirname, 'assets/src/styles.css'),
                scripts: path.resolve(__dirname, 'assets/src/scripts.js'),
            },
            output: {
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name?.endsWith('.css')) {
                        return '[name].min.css';
                    }
                    return '[name][extname]';
                },
                entryFileNames: '[name].min.js',
            },
        },
    },
});