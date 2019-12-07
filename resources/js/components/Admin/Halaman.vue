
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
                            <a href="" class="btn btn-sm btn-primary" @click.prevent="layananModal()">Tambah Halaman</a>
                            <hr>
                            <v-client-table :data="halaman" :columns="columns" :options="options">
                                <div slot="aksi" slot-scope="{row}">
                                    <a href="" @click.prevent="editHalaman(row)" style="margin: 5px" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                                    <a href="" @click.prevent="deleteTim(row.id)" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                </div>
                                <img slot="foto" slot-scope="{row}" :src="row.foto" class="img-circle text-center" width="120" height="120" alt="">
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

    <div class="modal fade bd-example-modal-lg" id="modalHalaman" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editMode">Tambah Halaman</h5>
                    <h5 class="modal-title" v-show="editMode">Ubah Halaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" @submit.prevent="editMode ? updateHalaman() : postHalaman()" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Foto</label>
                            <input type="file" @change="uploadFoto" class="form-control" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" class="form-control" v-model="form.judul" name="judul" :class="{'is-invalid' : form.errors.has('form.judul')}">
                            <has-error :form="form" field="judul"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="">Isi</label>
                            <editor api-key="44nsbdus84r0ju13jm2ng5cpchi6ga081o9mku2kxxze6bgk" :init="{plugins: 'wordcount'}" v-model="form.isi" :class="{'is-invalid' : form.errors.has('form.isi')}"></editor>
                            <has-error :form="form" field="isi"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" v-show="!editMode" class="btn btn-sm btn-primary">Simpan</button>
                        <button type="submit" v-show="editMode" class="btn btn-sm btn-primary">Ubah</button>
                        <button type="button" name="button" data-dismiss="modal" class="btn btn-sm btn-warning">Tutup</button>
                    </div>

                </form>
            </div>
        </div>
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
                'aksi', 'judul', 'isi', 'foto',
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
                sortable: ['foto', 'judul', 'isi'],
                filterable: ['foto', 'judul', 'isi'],
                columnsDisplay: {},
                filterByColumn: true,
                pagination: {
                    dropdown: false
                },
                columnsClasses: {
                    aksi: 'text-center',
                },
            },
            halaman: [],
        }
    },
    methods: {
        whatsapp(whatsapp) {
            window.open('https://api.whatsapp.com/send?phone=' + whatsapp, '_blank');
        },
        uploadFoto(e) {
            // console.log('uploading');
            let file = e.target.files[0];
            console.log(file);
            let reader = new FileReader();
            reader.onloadend = (file) => {
                // console.log("RESULT", reader.result)
                this.form.foto = reader.result;
            }
            reader.readAsDataURL(file);
        },
        deleteTim(id) {
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
                    axios.delete('/api/admin/tim/' + id).then(() => {
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
            this.form.put('/api/admin/halaman/' + this.form.id)
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
        editHalaman(halaman) {
            this.editMode = true,
            this.form.reset();
            $('#modalHalaman').modal('show');
            this.form.fill(halaman);
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
        loadHalaman() {
            axios.get('/api/admin/halaman').then(({
                data
            }) => (this.halaman = data));
        },
        layananModal() {
            $('#modalHalaman').modal('show');
            this.form.reset();
            this.editMode = false;
        }
    },
    created() {
        this.$Progress.start();
        this.loadHalaman();
        Fire.$on('AfterCreate', () => {
            this.loadHalaman('');
        });
        this.$Progress.finish();
    }
}
</script>
