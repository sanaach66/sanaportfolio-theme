// assets/js/sidebar.js
document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.querySelector(".sidebar");
  const toggleBtn = document.querySelector(".sidebar-toggle");

  if (!sidebar || !toggleBtn) return;

  // Toggle sidebar visibility
  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("active");
  });

  // Optional: Close sidebar when clicking outside on mobile
  document.addEventListener("click", (e) => {
    if (
      window.innerWidth <= 991 &&
      sidebar.classList.contains("active") &&
      !sidebar.contains(e.target) &&
      !toggleBtn.contains(e.target)
    ) {
      sidebar.classList.remove("active");
    }
  });
});
