
<template>
<div class="table-responsive">
    <div class="col-md-12">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tim Kami
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
                            Tim Kami
                        </div>
                        <div class="box-body">
                            <a href="" class="btn btn-sm btn-primary" @click.prevent="layananModal()">Tambah Tim</a>
                            <hr>
                            <v-client-table :data="timKami" :columns="columns" :options="options">
                              <div slot="aksi" slot-scope="{row}">
                                <a href="" @click.prevent="editTim(row)" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                                <a href="" @click.prevent="deleteTim(row.id)" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                              </div>
                              <img slot="foto" slot-scope="{row}" :src="row.foto" class="img-circle text-center" width="120" height="120" alt="">
                              <div slot="icon" slot-scope="{row}" class="text-center">
                                <span :class="row.icon"></span>
                              </div>
                              <div slot="whatsapp" slot-scope="{row}" class="text-center">
                                <a href="" @click.prevent="whatsapp(row.whatsapp)" class="btn btn-success btn-sm"><i class="fab fa-whatsapp"></i></a>
                              </div>
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

    <div class="modal fade bd-example-modal-lg" id="modalTim" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editMode">Tambah Tim</h5>
                    <h5 class="modal-title" v-show="editMode">Ubah Tim</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" @submit.prevent="editMode ? updateLayanan() : postTim()" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Foto</label>
                            <input type="file" @change="uploadFoto" class="form-control" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" v-model="form.nama" name="nama" :class="{'is-invalid' : form.errors.has('form.nama')}">
                            <has-error :form="form" field="nama"></has-error>
                        </div>

                        <div class="form-group">
                            <label for="">Posisi</label>
                            <input type="text" class="form-control" v-model="form.posisi" name="posisi" :class="{'is-invalid' : form.errors.has('form.posisi')}">
                            <has-error :form="form" field="posisi"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="">Whatsapp</label>
                            <input type="text" class="form-control" v-model="form.whatsapp" name="whatsapp" :class="{'is-invalid' : form.errors.has('form.whatsapp')}">
                            <has-error :form="form" field="whatsapp"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="">Telegram</label>
                            <input type="text" class="form-control" v-model="form.telegram" name="telegram" :class="{'is-invalid' : form.errors.has('form.telegram')}">
                            <has-error :form="form" field="telegram"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="">Facebook</label>
                            <input type="text" class="form-control" v-model="form.facebook" name="facebook" :class="{'is-invalid' : form.errors.has('form.facebook')}">
                            <has-error :form="form" field="facebook"></has-error>
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
export default {
    data() {
        return {
            editMode: false,
            form: new Form({
                id: '',
                nama: '',
                foto: '',
                posisi: '',
                instagram: '',
                facebook: '',
                twitter: '',
                telegram: '',
                whatsapp: '62',
            }),
            columns: [
                'aksi', 'foto', 'nama', 'posisi', 'whatsapp', 'telegram', 'facebook', 'twitter', 'instagram',
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
                sortable: ['foto', 'nama', 'posisi', 'facebook', 'twitter', 'instagram'],
                filterable: ['nama', 'posisi'],
                columnsDisplay: {},
                filterByColumn: true,
                pagination: {
                    dropdown: false
                },
                columnsClasses: {
                    aksi: 'text-center',
                },
             },
            timKami: [],
        }
    },
    methods: {
        whatsapp(whatsapp){
            window.open('https://api.whatsapp.com/send?phone=' + whatsapp, '_blank');
        },
        uploadFoto(e){
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
        deleteTim(id){
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
        updateLayanan(){
          this.form.put('/api/admin/tim/' + this.form.id)
              .then(() => {
                  Fire.$emit('AfterCreate');
                  swal(
                      'Sukses!',
                      'Layanan ditambah.',
                      'success'
                  )
                  this.$Progress.finish();
                  $('#modalTim').modal('hide');
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
        editTim(timKami){
          this.editMode = true,
          this.form.reset();
          $('#modalTim').modal('show');
          this.form.fill(timKami);
        },
        postTim(){
          this.form.post('/api/admin/tim')
              .then(() => {
                  Fire.$emit('AfterCreate');
                  $('#modalTim').modal('hide');
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
        loadTim(){
          axios.get('/api/admin/tim').then(({
            data
          }) => (this.timKami = data));
        },
        layananModal() {
            $('#modalTim').modal('show');
            this.form.reset();
            this.editMode = false;
        }
    },
    created() {
      this.$Progress.start();
      this.loadTim();
      Fire.$on('AfterCreate', () => {
          this.loadTim('');
      });
      this.$Progress.finish();
    }
}
</script>
