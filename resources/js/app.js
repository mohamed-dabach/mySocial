window.addEventListener("DOMContentLoaded", (event) => {
    let theme = localStorage.getItem("theme");
    if (theme) {
        document.documentElement.setAttribute("data-mode", theme);
    } else {
        if (
            window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        ) {
            document.documentElement.setAttribute("data-mode", "dark");
        } else {
            document.documentElement.setAttribute("data-mode", "light");
        }
    }
});
