// add listing progress bar
const progress = document.getElementById("custom_progress");
const circles = document.querySelectorAll(".circle");
const labels = document.querySelectorAll(".label");
const prev = document.getElementById("prev");
const next = document.getElementById("next");

let currentStep = 1;
let hasStarted = false; // 👈 NEW

next.addEventListener("click", () => {
    currentStep++;
    if (currentStep > circles.length) currentStep = circles.length;

    hasStarted = true; // start animation after first move
    update();
});

prev.addEventListener("click", () => {
    currentStep--;
    if (currentStep < 1) currentStep = 1;

    update();
});

function update() {
    circles.forEach((circle, index) => {
        // reset everything
        circle.classList.remove("active", "current");
        labels[index].classList.remove("active");

        if (index < currentStep) {
            circle.classList.add("active");
            labels[index].classList.add("active");

            if (index === currentStep - 1) {
                // 👇 ONLY ONE current
                circle.classList.add("current");
                circle.innerText = index + 1;
            } else {
                circle.innerText = "✓";
            }
        } else {
            circle.innerText = index + 1;
        }
    });

    // progress bar
    const activeCount = document.querySelectorAll(".circle.active").length;
    progress.style.width =
        ((activeCount - 1) / (circles.length - 1)) * 100 + "%";

    prev.disabled = currentStep === 1;
    next.disabled = currentStep === circles.length;
}