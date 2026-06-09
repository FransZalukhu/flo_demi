// inbox.js
import * as bootstrap from 'bootstrap';

/* =========================
   INBOX NOTIFICATION DATA
========================= */
const inboxData = [
  {
    id: 1,
    name: 'Noerzahra Ramadhani Gusty',
    initials: 'ZR',
    color: 'primary',
    title: 'Pembelian Course UI/UX Design',
    description:
      'Hi, Superadmin! Noerzahra Ramadhani Gusty melakukan checkout course UI/UX Design seharga Rp299.000,-',
    time: '21.30 WIB'
  },
  {
    id: 2,
    name: 'Putri Insani Kamelia',
    initials: 'PI',
    color: 'danger',
    title: 'Pembelian Course UI/UX Design',
    description:
      'Hi, Superadmin! Putri Insani Kamelia melakukan checkout course UI/UX Design seharga Rp0',
    time: '17.30 WIB'
  },
  {
    id: 3,
    name: 'Rahmatia',
    initials: 'RT',
    color: 'warning',
    title: 'Pembelian Course UI/UX Design',
    description:
      'Hi, Superadmin! Rahmatia melakukan checkout course UI/UX Design seharga Rp299.000,-',
    time: '14.30 WIB'
  },
  {
    id: 4,
    name: 'Dynda Ayu Sastika',
    initials: 'DA',
    color: 'secondary',
    title: 'Pembelian Course UI/UX Design',
    description:
      'Hi, Superadmin! Dynda Ayu Sastika melakukan checkout course UI/UX Design seharga Rp299.000,-',
    time: 'Kemarin'
  },
  {
    id: 5,
    name: 'Firnalia Amanda',
    initials: 'FA',
    color: 'purple',
    title: 'Pembelian Course UI/UX Design',
    description:
      'Hi, Superadmin! Firnalia Amanda melakukan checkout course UI/UX Design seharga Rp299.000,-',
    time: 'Kemarin'
  }
];

/* =========================
   INITIALIZE INBOX
========================= */
function initializeInbox() {
  renderInbox();

  // Button Izinkan
  document.addEventListener('click', (e) => {
    if (e.target.classList.contains('btn-approve')) {
      const id = e.target.dataset.id;

      e.target.textContent = 'Diizinkan';
      e.target.classList.remove('btn-success');
      e.target.classList.add('btn-secondary');
      e.target.disabled = true;

      console.log('Approved ID:', id);
    }
  });
}

/* =========================
   RENDER INBOX UI
========================= */
function renderInbox() {
  const container = document.getElementById('emailItems');
  if (!container) return;

  container.innerHTML = inboxData
    .map(
      (item) => `
      <div class="inbox-item">
        <div class="d-flex align-items-start">

          <div class="avatar bg-${item.color} me-3">
            ${item.initials}
          </div>

          <div class="flex-grow-1">
            <div class="d-flex justify-content-between align-items-start">
              <h6 class="mb-1 fw-bold">${item.name}</h6>
              <small class="text-muted">${item.time}</small>
            </div>

            <div class="fw-semibold mb-1">${item.title}</div>

            <p class="text-muted small mb-2">
              ${item.description}
            </p>

            <button
              class="btn btn-success btn-sm btn-approve"
              data-id="${item.id}">
              Izinkan
            </button>
          </div>

        </div>
      </div>
    `
    )
    .join('');
}

/* =========================
   CUSTOM STYLES
========================= */
const style = document.createElement('style');
style.textContent = `
  .inbox-item {
    padding: 14px 16px;
    margin-bottom: 10px;
    border-left: 4px solid #9F66AF; /* GARIS UNGU */
    background-color: #ffffff;
    border-radius: 6px;
  }

  .avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    color: #fff;
    font-weight: 600;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .bg-purple {
    background-color: #9F66AF;
  }

  .btn-sm {
    padding: 4px 14px;
    font-size: 0.75rem;
  }

  /* Mobile lebih padat */
  @media (max-width: 576px) {
    .inbox-item {
      padding: 10px 12px;
      border-left-width: 3px;
    }

    .avatar {
      width: 36px;
      height: 36px;
      font-size: 0.7rem;
    }
  }
`;
document.head.appendChild(style);

/* =========================
   DOM READY
========================= */
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeInbox);
} else {
  initializeInbox();
}
