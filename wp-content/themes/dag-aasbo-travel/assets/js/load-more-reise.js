document.addEventListener('DOMContentLoaded', () => {
  const loadBtn = document.getElementById('load-more-reise');
  const postsContainer = document.getElementById('reise-posts');
  let currentPage = 1;

  if (loadBtn) {
    loadBtn.addEventListener('click', () => {
      currentPage++;
      loadBtn.disabled = true;
      loadBtn.innerText = 'Laster...';

      fetch(`${reise_ajax_object.ajax_url}?action=load_more_reise&page=${currentPage}`)
        .then(res => res.text())
        .then(data => {
          if (data.trim() !== '') {
            postsContainer.insertAdjacentHTML('beforeend', data);
            loadBtn.disabled = false;
            loadBtn.innerText = 'Load More';
          } else {
            loadBtn.style.display = 'none';
          }
        });
    });
  }
});
