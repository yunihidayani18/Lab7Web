const Artikel = {

template: `
<div>

<h1>Daftar Artikel</h1>
<button class="btn-tambah" @click="tambah">
➕ Tambah Data
</button>

<div v-if="showForm" class="modal">
    <div class="modal-content">

        <h3>{{ formTitle }}</h3>

        <div>
            <input
                type="text"
                v-model="formData.judul"
                placeholder="Judul">
        </div>

        <div>
            <textarea
                v-model="formData.isi"
                placeholder="Isi artikel">
            </textarea>
        </div>

        <div>
            <select v-model="formData.status">
                <option
                    v-for="option in statusOptions"
                    :value="option.value">
                    {{ option.text }}
                </option>
            </select>
        </div>

        <button type="button" @click="saveData">Simpan</button>
        <button type="button" @click="showForm=false">Batal</button>    

    </div>
</div>

<table>
<thead>
<tr>
<th>ID</th>
<th>Judul</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<tr v-for="(row,index) in artikel">

<td>{{ row.id }}</td>
<td>{{ row.judul }}</td>
<td>
<span
    :class="row.status == 1 ? 'status-publish' : 'status-draft'">
    {{ statusText(row.status) }}
</span>
</td>

<td class="center-text">
   <button
    class="btn-edit"
    @click="edit(row)">
    ✏️ Edit
</button>

<button
    class="btn-hapus"
    @click="hapus(index,row.id)">
    🗑️ Hapus
</button>
</td>

</tr>

</tbody>

</table>

</div>
`,

data() {
    return {
        artikel: [],

        formData: {
            id: null,
            judul: '',
            isi: '',
            status: 0
        },

        showForm: false,
        formTitle: 'Tambah Data',

        statusOptions: [
            {
                text: 'Draft',
                value: 0
            },
            {
                text: 'Publish',
                value: 1
            }
        ]
    }
},

mounted() {
    this.loadData()
},

methods: {

loadData() {


axios.get(apiUrl + '/post')
.then(response => {
this.artikel = response.data.artikel;
})
.catch(error => {
console.log(error);
});

},

edit(data) {
    this.showForm = true;

    this.formTitle = 'Ubah Data';

    this.formData = {
        id: data.id,
        judul: data.judul,
        isi: data.isi,
        status: data.status
    };
},

hapus(index, id) {

    if (confirm('Yakin hapus data?')) {

        axios.delete(apiUrl + '/post/' + id)
            .then(response => {
                this.artikel.splice(index, 1);
            })
            .catch(error => {
                console.log(error);
            });
    }
},

tambah() {
    this.showForm = true;

    this.formTitle = 'Tambah Data';

    this.formData = {
        id: null,
        judul: '',
        isi: '',
        status: 0
    };
},

saveData() {

    if (this.formData.id) {

        axios.put(
            apiUrl + '/post/' + this.formData.id,
            this.formData
        )
        .then(response => {
            this.loadData();
        });
        

    } else {

        axios.post(
            apiUrl + '/post',
            this.formData
        )
        .then(response => {
            this.loadData();
        });
    }

    this.showForm = false;
},
statusText(status) {
return status == 1 ? 'Publish' : 'Draft';
}

}

}