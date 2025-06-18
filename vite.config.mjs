import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
export default defineConfig({
    server: {
    host: '0.0.0.0',  // agar bisa diakses dari luar container
    port: 5173,
    strictPort: true,
    hmr: {
      host: 'localhost', // atau gunakan IP container jika perlu
    },
  },
     plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
