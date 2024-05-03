import "./bootstrap";
import Alpine from "alpinejs";

// window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("mainState", () => {
        const getTheme = () => {
            if (window.localStorage.getItem("dark")) {
                return JSON.parse(window.localStorage.getItem("dark"));
            }
            return (
                !!window.matchMedia &&
                window.matchMedia("(prefers-color-scheme: dark)").matches
            );
        };
        const setTheme = (value) => {
            window.localStorage.setItem("dark", value);
        };
        return {
            isDarkMode: getTheme(),
            toggleTheme() {
                this.isDarkMode = !this.isDarkMode;
                setTheme(this.isDarkMode);
            },
        };
    });
});

// Alpine.start();
