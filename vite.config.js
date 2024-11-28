// vite.config.js
import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";

export default defineConfig({
	plugins: [symfonyPlugin({ refresh: true })],

	build: {
		rollupOptions: {
			input: {
				/* relative to the root option */
				app: "./assets/app.js",

				/* you can also provide [s]css files */
				theme: "./assets/app.css",
			},
		},
	},
});
