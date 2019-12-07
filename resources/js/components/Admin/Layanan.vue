
<template>
<div class="table-responsive">
    <div class="col-md-12">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Home
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
                            Layanan
                        </div>
                        <div class="box-body">
                            <a href="" class="btn btn-sm btn-primary" @click.prevent="layananModal()">Tambah Layanan</a>
                            <hr>
                            <v-client-table :data="layanan" :columns="columns" :options="options">
                              <div slot="aksi" slot-scope="{row}">
                                <a href="" @click.prevent="editLayanan(row)" style="margin-bottom: 5px" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                                <a href="" @click.prevent="deleteLayanan(row.id)" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                              </div>
                              <div slot="icon" slot-scope="{row}" class="text-center">
                                <span :class="row.icon"></span>
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

    <div class="modal fade bd-example-modal-lg" id="modalLayanan" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editMode">Tambah Layanan</h5>
                    <h5 class="modal-title" v-show="editMode">Ubah Layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" @submit.prevent="editMode ? updateLayanan() : postLayanan()" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" v-model="form.nama" name="nama" :class="{'is-invalid' : form.errors.has('form.nama')}">
                            <has-error :form="form" field="nama"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="">Icon</label>
                            <input type="text" class="form-control" v-model="form.icon" name="icon" :class="{'is-invalid' : form.errors.has('form.icon')}">
                            <has-error :form="form" field="icon"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea type="text" rows="5" class="form-control" v-model="form.deskripsi" name="deskripsi" :class="{'is-invalid' : form.errors.has('form.deskripsi')}"></textarea>
                            <has-error :form="form" field="deskripsi"></has-error>
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
                icon: '',
                deskripsi: '',
            }),
            columns: [
                'aksi', 'icon', 'nama', 'deskripsi',
            ],
            options: {
                texts: {
                    filterPlaceholder: "Cari data",
                    filter: "Pencarian : ",
                    filterBy: "Cari {column}",
                    count: "Menampilkan {from} ke {to} dari {count} data|{count} data|Satu data",
                },
                headings: {
                    nama: 'Nama Layanan',
                    icon: 'Icon',
                    deskripsi: 'Deskripsi',
                },
                sortable: ['icon', 'nama', 'deskripsi'],
                filterable: ['icon', 'nama', 'deskripsi'],
                columnsDisplay: {},
                filterByColumn: true,
                pagination: {
                    dropdown: false
                },
                columnsClasses: {
                    aksi: 'text-center',
                },
             },
            layanan: [],
        }
    },
    methods: {
        deleteLayanan(id){
          swal({
                title: 'Anda yakin?',
                text: "Operasi ini tidak dapat dibatalkan!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus fasilitas!',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (result.value) {
                    axios.delete('/api/admin/layanan/' + id).then(() => {
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
          this.form.post('/api/admin/layanan/' + this.form.id)
              .then(() => {
                  Fire.$emit('AfterCreate');
                  swal(
                      'Sukses!',
                      'Layanan ditambah.',
                      'success'
                  )
                  this.$Progress.finish();
                  $('#modalLayanan').modal('hide');
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
        editLayanan(layanan){
          this.editMode = true,
          this.form.reset();
          $('#modalLayanan').modal('show');
          this.form.fill(layanan);
        },
        postLayanan(){
          this.form.post('/api/admin/layanan')
              .then(() => {
                  Fire.$emit('AfterCreate');
                  $('#modalLayanan').modal('hide');
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
        loadLayanan(){
          axios.get('/api/admin/layanan').then(({
            data
          }) => (this.layanan = data));
        },
        layananModal() {
            $('#modalLayanan').modal('show');
            this.form.reset();
            this.editMode = false;
        }
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
