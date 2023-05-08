window.addEventListener('DOMContentLoaded', () => {
  
  // plugin atau library sweetalert2
  function alerts(icon, text) {
    swal.fire ({
      icon: icon,
      title: 'Alert',
      text: text
    });
  }
  
  // tombol hapus data
  const btnDelete = document.querySelector('.btn-delete');
  btnDelete.addEventListener('click', function(event) {
    event.preventDefault();
    const id = this.dataset.id.trim();
    deleteData(id);
  });
  
  function deleteData(id) {
    swal.fire ({
      icon: 'info',
      title: 'anda yakin?',
      text: 'apakah anda ingin menghapus data ini?',
      showCancelButton: true
    })
    .then(response => {
      if (response.isConfirmed) {
        document.location.href = `hapus.php?id=${id}`;
      }
    });
  }
  
  // input pencarian data 
  const tableContainer = document.querySelector('.table-container');
  const searchInput = document.querySelector('.search-input');
  searchInput.addEventListener('keyup', async function() {
    try {
      const value = this.value.trim().toLowerCase();
      const result = await fetchData(value);
      tableContainer.innerHTML = result;
    } catch (err) {
      const error = err.message;
      tableContainer.innerHTML = showError(error);1
    }
  });
  
  function fetchData(keyword) {
    return fetch(`data/table.php?keyword=${keyword}`)
      .then(response => {
        if (response.status == 404) throw new Error('file tidak ditemukan');
        return response.text();
      })
      .then(response => response);
  }
  
  function showError(message) {
    return `
      <div class="row">
        <div class="col-md-7 mx-auto">
          <div class="alert alert-danger my-3" role="alert">
            <span class="d-inline-block my-auto fw-normal">${message}</span>
          </div>
        </div>
      </div>
    `;
  }
  
});