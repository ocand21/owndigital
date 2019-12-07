
<template>
<div class="table-responsive">
    <div class="col-md-12">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tambah Portofolio
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
                            Portofolio Baru
                        </div>
                        <form action="" @submit.prevent="postPortofolio()">
                        <div class="box-body">
                          <div class="form-group">
                              <label for="">Cover</label>
                              <input type="file" @change="uploadFoto" class="form-control" name="foto">
                          </div>
                          <div class="form-group">
                              <label for="">Judul</label>
                              <input type="text" class="form-control" v-model="form.judul" name="judul" :class="{'is-invalid' : form.errors.has('form.judul')}">
                              <has-error :form="form" field="judul"></has-error>
                          </div>

                          <div class="form-group">
                              <label for="">Layanan</label>
                              <select class="form-control" v-model="form.id_layanan" name="id_layanan">
                                <option v-for="lyn in layanan" :key="lyn.id" :value="lyn.id">{{lyn.nama}}</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="">Isi</label>
                              <editor api-key="44nsbdus84r0ju13jm2ng5cpchi6ga081o9mku2kxxze6bgk" :init="{plugins: 'wordcount'}" v-model="form.isi" :class="{'is-invalid' : form.errors.has('form.isi')}"></editor>
                              <has-error :form="form" field="isi"></has-error>
                          </div>

                          <div class="form-group">
                              <label for="">Link</label>
                              <input type="text" class="form-control" v-model="form.link" name="link" :class="{'is-invalid' : form.errors.has('form.link')}">
                              <has-error :form="form" field="link"></has-error>
                          </div>
                        </div>
                        <div class="box-footer text-right">
                          <router-link to="/admin/portolio" class="btn btn-sm btn-danger">Batal</router-link>
                          <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                        </form>
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
          form: new Form({
              id: '',
              judul: '',
              cover: '',
              isi: '',
              link: '',
          }),
          layanan: [],
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
                this.form.cover = reader.result;
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
                        'Gagal!',
                        swal(
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
        postPortofolio() {
            this.form.post('/api/admin/portofolio')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#modalHalaman').modal('hide');
                    swal(
                        'Sukses!',
                        'Portofolio ditambah.',
                        'success'
                    )
                    this.$router.push({name: 'portofolio'})
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
        loadLayanan(){
          axios.get('/api/admin/layanan').then(({
            data
          }) => (this.layanan = data));
        },
    },
    created() {
        this.$Progress.start();
        this.loadLayanan();
        Fire.$on('AfterCreate', () => {
            this.loadLayanan('');
        });
        this.$Progress.finish();
    }
}
</script>
