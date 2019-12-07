
<template>
<div class="table-responsive">
    <div class="col-md-12">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pengaturan
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
                            Pengaturan Website
                        </div>

                        <form action="" @submit.prevent="postKonfig()">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="">Nama Website</label>
                                    <input type="text" class="form-control" v-model="form.nama_website" name="nama_website" :class="{'is-invalid' : form.errors.has('form.nama_website')}">
                                    <has-error :form="form" field="nama_website"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea type="text" class="form-control" v-model="form.deskripsi" name="deskripsi" :class="{'is-invalid' : form.errors.has('form.deskripsi')}"></textarea>
                                    <has-error :form="form" field="deskripsi"></has-error>
                                </div>


                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea type="text" class="form-control" v-model="form.alamat" name="alamat" :class="{'is-invalid' : form.errors.has('form.alamat')}"></textarea>
                                    <has-error :form="form" field="alamat"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="">Alamat Website</label>
                                    <input type="text" class="form-control" v-model="form.url_web" name="url_web" :class="{'is-invalid' : form.errors.has('form.url_web')}">
                                    <has-error :form="form" field="url_web"></has-error>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" v-model="form.email" name="email" :class="{'is-invalid' : form.errors.has('form.email')}">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Whatsapp</label>
                                            <input type="text" class="form-control" v-model="form.whatsapp" name="whatsapp" :class="{'is-invalid' : form.errors.has('form.whatsapp')}">
                                            <has-error :form="form" field="whatsapp"></has-error>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Facebook</label>
                                            <input type="text" class="form-control" v-model="form.facebook" name="facebook" :class="{'is-invalid' : form.errors.has('form.facebook')}">
                                            <has-error :form="form" field="facebook"></has-error>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Telegram</label>
                                            <input type="text" class="form-control" v-model="form.telegram" name="telegram" :class="{'is-invalid' : form.errors.has('form.telegram')}">
                                            <has-error :form="form" field="telegram"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Instagram</label>
                                            <input type="text" class="form-control" v-model="form.instagram" name="instagram" :class="{'is-invalid' : form.errors.has('form.instagram')}">
                                            <has-error :form="form" field="instagram"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Twitter</label>
                                            <input type="text" class="form-control" v-model="form.twitter" name="twitter" :class="{'is-invalid' : form.errors.has('form.twitter')}">
                                            <has-error :form="form" field="twitter"></has-error>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-right">
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>

                        </form>
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
export default {
    data() {
        return {
            form: new Form({
                nama_website: '',
                alamat: '',
                deskripsi: '',
                alamat: '',
                whatsapp: '',
                email: '',
                website: '',
                facebook: '',
                instagram: '',
                twitter: '',
                url_web: '',
                telegram: '',
            })
        }
    },
    methods: {
        loadKonfig(){
          axios.get('/api/admin/konfigurasi').then(({
            data
          }) => (this.form.fill(data)))
        },
        postKonfig() {
            this.form.post('/api/admin/konfigurasi')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    swal(
                        'Sukses!',
                        'Konfigurasi diubah.',
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
        }
    },
    created() {
      this.$Progress.start();
      this.loadKonfig();
      Fire.$on('AfterCreate', () => {
        this.loadKonfig();
      });
      this.$Progress.finish();
    }
}
</script>
