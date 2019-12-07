
<template>
<div class="table-responsive">
    <div class="col-md-12">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Halaman
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-md-12" style="margin-top: 10px">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            Halaman
                        </div>
                        <div class="box-body">
                            <router-link to="/admin/portolio/tambah" class="btn btn-sm btn-primary">Tambah Portofolio</router-link >
                            <hr>
                            <v-client-table :data="portofolio" :columns="columns" :options="options">
                                <div slot="aksi" slot-scope="{row}">
                                    <a href="" @click.prevent="editHalaman(row)" style="margin: 5px" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                                    <a href="" @click.prevent="uploadGaleri(row.id)" style="margin: 5px" class="btn btn-warning btn-sm"><span class="fa fa-file-image"></span></a>
                                    <a href="" @click.prevent="deletePorto(row.id)" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                </div>
                                <img slot="cover" slot-scope="{row}" :src="row.cover" class="img-circle text-center" width="120" height="120" alt="">
                                <p slot="isi" slot-scope="{row}" v-html="row.isi"></p>

                            </v-client-table>
                        </div>
                        <div class="box-footer">

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>


            </div>
        </section>
        <!-- /.content -->
    </div>

</div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue';
export default {
    components: {
        'editor': Editor
    },
    data() {
        return {
            editMode: false,
            form: new Form({
                id: '',
                judul: '',
                foto: '',
                isi: '',
            }),
            columns: [
                'aksi', 'judul', 'isi', 'cover',
            ],
            options: {
                texts: {
                    filterPlaceholder: "Cari data",
                    filter: "Pencarian : ",
                    filterBy: "Cari {column}",
                    count: "Menampilkan {from} ke {to} dari {count} data|{count} data|Satu data",
                },
                headings: {
                    nama: 'Nama Lengkap',
                },
                sortable: ['cover', 'judul', 'isi'],
                filterable: ['cover', 'judul', 'isi'],
                columnsDisplay: {},
                filterByColumn: true,
                pagination: {
                    dropdown: false
                },
                columnsClasses: {
                    aksi: 'text-center',
                },
            },
            portofolio: [],
        }
    },
    methods: {
        uploadGaleri(){

        },
        deletePorto(id) {
            swal({
                title: 'Anda yakin?',
                text: "Operasi ini tidak dapat dibatalkan!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus tim!',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (result.value) {
                    axios.delete('/api/admin/portofolio/' + id).then(() => {
                        swal(
                            'Dihapus!',
                            'Data berhasil dihapus.',
                            'success'
                        )
                        Fire.$emit('AfterCreate')
                    }).catch(() => {
                        swal("Gagal!", "Terjadi kesalahan.",
                            "warning");
                    });
                }

            })
        },
        updateHalaman() {
            this.form.put('/api/admin/portofolio/' + this.form.id)
                .then(() => {
                    Fire.$emit('AfterCreate');
                    swal(
                        'Sukses!',
                        'Layanan ditambah.',
                        'success'
                    )
                    this.$Progress.finish();
                    $('#modalHalaman').modal('hide');
                    this.form.reset();
                })
                .catch(() => {
                    swal(
                        'Gagal!',
                        'Terjadi kesalahan',
                        'warning'
                    )
                })
        },
        editHalaman(portofolio) {
            this.editMode = true,
            this.form.reset();
            $('#modalHalaman').modal('show');
            this.form.fill(portofolio);
        },
        postHalaman() {
            this.form.post('/api/admin/halaman')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#modalHalaman').modal('hide');
                    swal(
                        'Sukses!',
                        'Layanan ditambah.',
                        'success'
                    )
                    this.$Progress.finish();
                    this.form.reset();
                })
                .catch(() => {
                    swal(
                        'Gagal!',
                        'Terjadi kesalahan',
                        'warning'
                    )
                })
        },
        loadPortofolio() {
            axios.get('/api/admin/portofolio').then(({
                data
            }) => (this.portofolio = data));
        },
        tambahPortofolio() {
            $('#modalHalaman').modal('show');
            this.form.reset();
            this.editMode = false;
        }
    },
    created() {
        this.$Progress.start();
        this.loadPortofolio();
        Fire.$on('AfterCreate', () => {
            this.loadPortofolio('');
        });
        this.$Progress.finish();
    }
}
</script>
