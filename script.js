function openSlideMenu() {
  document.getElementById('side-menu').style.width = '250px';
  const main = document.getElementById('main');
  if (window.innerWidth > 720 && main) {
    main.style.marginLeft = '250px';
  }
  let overlay = document.getElementById('side-overlay');
  if (!overlay) {
    overlay = document.createElement('div');
    overlay.id = 'side-overlay';
    overlay.className = 'side-overlay show';
    overlay.onclick = closeSlideMenu;
    document.body.appendChild(overlay);
  } else {
    overlay.classList.add('show');
  }
}

function closeSlideMenu() {
  document.getElementById('side-menu').style.width = '0';
  const main = document.getElementById('main');
  if (main) main.style.marginLeft = '0';
  const overlay = document.getElementById('side-overlay');
  if (overlay) overlay.classList.remove('show');
}

// Preview foto sebelum upload (dipakai di form tambah/edit siswa)
function previewFoto(input) {
  const preview = document.getElementById('fotoPreview');
  if (!preview || !input.files || !input.files[0]) return;
  const reader = new FileReader();
  reader.onload = function (e) {
    preview.src = e.target.result;
  };
  reader.readAsDataURL(input.files[0]);
}

// Highlight menu navbar/sidebar sesuai halaman aktif
document.addEventListener('DOMContentLoaded', function () {
  const path = window.location.pathname.split('/').pop();
  document.querySelectorAll('.navbar-nav a, .side-nav a').forEach(function (a) {
    const href = a.getAttribute('href');
    if (href && href === path) {
      a.classList.add('active');
    }
  });
});
