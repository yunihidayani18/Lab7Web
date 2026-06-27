<!DOCTYPE html>
<html>
<head>

    <title>AJAX Artikel</title>

    <script src="<?= base_url('assets/js/jquery-4.0.0.min.js') ?>"></script>
<style>

body{
    font-family: Arial;
    margin: 30px;
}

table{
    border-collapse: collapse;
    width: 100%;
}

table, th, td{
    border: 1px solid #ccc;
}

th{
    background: #0d6efd;
    color: white;
    padding: 10px;
}

td{
    padding: 10px;
}

</style>
</head>

<body></body>

<h1>Data Artikel</h1>

<table class="table-data" id="artikelTable">

    <thead>

        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

    </thead>

    <tbody></tbody>

</table>

<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>

<script>

$(document).ready(function() {

    function loadData() {

        $.ajax({

            url: "<?= base_url('ajax/getData') ?>",

            method: "GET",

            dataType: "json",

            success: function(data) {

                var tableBody = "";

                for (var i = 0; i < data.length; i++) {

                    var row = data[i];

                    tableBody += '<tr>';

                    tableBody += '<td>' + row.id + '</td>';

                    tableBody += '<td>' + row.judul + '</td>';

                    tableBody += '<td>' + row.status + '</td>';

                    tableBody += '<td>Edit | Delete</td>';

                    tableBody += '</tr>';
                }

                $('#artikelTable tbody').html(tableBody);
            }

        });
    }

    loadData();

});

</script>
</body>
</html>

