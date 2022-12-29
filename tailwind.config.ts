import { Config } from "tailwindcss";
export default <Config>{
    darkMode: ["class"],
    /* Extend the Tailwind config here */
    content: [
        "./client/content/**/**.md",
        "./client/assets/**/*.css",
        "./client/components/*.{vue,js}",
        "./client/components/**/*.{vue,js}",
        "./client/pages/*.vue",
        "./client/pages/**/*.vue",
        "./client/plugins/**/*.{js,ts}",
        "./client/*.{vue,js,ts}",
    ],
    daisyui: {
        rtl: true,
        themes: [
            {
                dark: {
                    primary: "#7c3aed",
                    secondary: "#ec4899",
                    accent: "#F3CC30",
                    neutral: "#20134E",
                    "base-100": "#28264e",
                    "base-50": "#37346a",
                    info: "#53C0F3",
                    success: "#71EAD2",
                    warning: "#F3CC30",
                    error: "#E24056",
                },
                light: {
                    primary: "#7c3aed",
                    secondary: "#D926A9",
                    accent: "#1FB2A6",
                    neutral: "#191D24",
                    "base-100": "#f3f4f6",
                    "base-50": "#f5f5f6",
                    info: "#3ABFF8",
                    success: "#36D399",
                    warning: "#FBBD23",
                    error: "#F87272",
                },
            },
        ],
    },
    plugins: [
        require("daisyui"),
        require("@tailwindcss/line-clamp"),
        // ...
    ],
};
