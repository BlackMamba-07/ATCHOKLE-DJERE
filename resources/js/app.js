import "./bootstrap";

// Toggle auth shared view
document.addEventListener("DOMContentLoaded", () => {
    const root = document.getElementById("auth-root");
    if (!root) return;

    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const switchBtn = document.getElementById("switchBtn");
    const switchLabel = document.getElementById("switchLabel");

    function setMode(mode) {
        const isLogin = mode === "login";
        loginForm.classList.toggle("hidden", !isLogin);
        registerForm.classList.toggle("hidden", isLogin);
        const title = document.querySelector("#auth-root h2");
        if (title)
            title.textContent = isLogin ? "Connexion" : "Créer un compte";
        if (switchLabel)
            switchLabel.textContent = isLogin
                ? "Pas de compte ?"
                : "Déjà membre ?";
        if (switchBtn)
            switchBtn.textContent = isLogin ? "Inscription" : "Connexion";
        root.dataset.initialMode = mode;
    }

    setMode(root.dataset.initialMode || "login");
    switchBtn?.addEventListener("click", (e) => {
        e.preventDefault();
        const next =
            root.dataset.initialMode === "login" ? "register" : "login";
        root.classList.add("opacity-0");
        setTimeout(() => {
            setMode(next);
            root.classList.remove("opacity-0");
        }, 150);
    });
});
