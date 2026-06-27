<?= $this->include('template/header'); ?>

<h2><?= $title; ?></h2>

<div class="row mb-3">
    <div class="col-md-6">

        <form id="search-form" class="form-inline">

            <input type="text"
                   name="q"
                   id="search-box"
                   value="<?= $q; ?>"
                   placeholder="Cari judul artikel"
                   class="form-control me-2">

            <select name="kategori_id"
                    id="category-filter"
                    class="form-control me-2">

                <option value="">Semua Kategori</option>

                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori']; ?>">
                        <?= $k['nama_kategori']; ?>
                    </option>
                <?php endforeach; ?>

            </select>

            <input type="submit"
                   value="Cari"
                   class="btn btn-primary">

        </form>

    </div>
</div>

<div id="article-container"></div>

<div id="pagination-container"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    const articleContainer = $('#article-container');
    const paginationContainer = $('#pagination-container');

    function fetchData(url) {

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },

           success: function(data) {

    renderArticles(data.artikel);
    renderPagination(data.pager);

  
}
        });

    }

   function renderPagination(pager) {

    let html = '';

    const totalPages = Math.ceil(pager.total / pager.perPage);

    if (totalPages > 1) {

        html += '<nav><ul class="pagination">';

        for (let i = 1; i <= totalPages; i++) {

            html += `
                <li class="page-item">
                    <a class="page-link" href="#" data-page="${i}">
                        ${i}
                    </a>
                </li>
            `;
        }

        html += '</ul></nav>';
    }

    paginationContainer.html(html);
}
function renderArticles(articles) {
        let html = '<table class="table table-bordered">';

        html += '<thead><tr>';
        html += '<th>No</th>';
        html += '<th>Judul</th>';
        html += '<th>Kategori</th>';
        html += '<th>Status</th>';
        html += '<th>Aksi</th>';
        html += '</tr></thead><tbody>';

        if (articles.length > 0) {

            articles.forEach((article, index) => {

                html += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${article.judul}</td>
                    <td>${article.nama_kategori}</td>
                    <td>${article.status}</td>
                    <td>
                        <a href="/admin/artikel/edit/${article.id}" class="btn btn-warning btn-sm">Ubah</a>
                        <a href="/admin/artikel/delete/${article.id}" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                `;
            });

        } else {

            html += '<tr><td colspan="5">Tidak ada data</td></tr>';

        }

        html += '</tbody></table>';

        articleContainer.html(html);
    }
const searchForm = $('#search-form');
const searchBox = $('#search-box');
const categoryFilter = $('#category-filter');

searchForm.on('submit', function(e) {

    e.preventDefault();

    const q = searchBox.val();
    const kategori_id = categoryFilter.val();

    fetchData(
        `/admin/artikel?q=${q}&kategori_id=${kategori_id}`
    );

});

categoryFilter.on('change', function() {

    searchForm.trigger('submit');

});
    paginationContainer.on('click', '.page-link', function(e) {

    e.preventDefault();

    const page = $(this).data('page');

    const q = searchBox.val();
    const kategori_id = categoryFilter.val();

    fetchData(
        `/admin/artikel?page=${page}&q=${q}&kategori_id=${kategori_id}`
    );

});
fetchData('/admin/artikel');

});
</script>
<?= $this->include('template/footer'); ?>

