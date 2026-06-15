import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",

                // Superadmin
                "resources/js/superadmin/app.js",
                "resources/js/superadmin/pages/dashboard.js",

                "resources/js/superadmin/components/charts.js",
                "resources/js/superadmin/components/datatables.js",
                "resources/js/push-notification.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
