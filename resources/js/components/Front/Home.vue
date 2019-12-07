<template>
<div>


    <!-- Tentang Kami -->
    <section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb" id="about-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 col-lg-5 d-flex">
                    <div class="d-flex align-self-stretch align-items-center">
                        <img :src="tentangKami.foto" class="img" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 pl-lg-5 py-5">
                    <div class="py-md-5">
                        <div class="row justify-content-start pb-3">
                            <div class="col-md-12 heading-section ftco-animate">
                                <span class="subheading">{{tentangKami.judul}}</span>
                                <h2 class="mb-4" style="font-size: 34px; text-transform: capitalize;">{{tentangKami.judul}}</h2>
                                <div v-html="tentangKami.isi"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-6 heading-section text-center ftco-animate">
                    <span class="subheading">{{katatTim.judul}}</span>
                    <h2 class="mb-4">{{katatTim.judul}}</h2>
                    <div v-html="katatTim.isi"></div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6 col-lg-3" v-for="tim in timKami">

                    <div class="staff">
                        <div class="img-wrap d-flex align-items-stretch">
                            <img :src="tim.foto" class="img align-self-stretch" alt="">
                        </div>
                        <div class="text d-flex align-items-center pt-3 text-center">
                            <div>
                                <h3 class="mb-2">{{tim.nama}}</h3>
                                <span class="position mb-4">{{tim.posisi}}</span>
                                <div class="faded">
                                    <ul class="ftco-social text-center">
                                        <li v-show="tim.twitter != null"><a :href="tim.twitter" target="_blank"><span class="icon-twitter"></span></a></li>
                                        <li v-show="tim.facebook != null"><a :href="tim.facebook" target="_blank"><span class="icon-facebook"></span></a></li>
                                        <li v-show="tim.instagram != null"><a :href="tim.instagram" target="_blank"><span class="icon-instagram"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="ftco-section ftco-no-pb ftco-no-pt ftco-services bg-light" id="services-section">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-4 ftco-animate py-5 nav-link-wrap">
                    <div v-for="lyn in layanan" :key="lyn.id" class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link px-4" href="" @click.prevent="detilLayanan(lyn.id)"><span class="mr-3" :class="lyn.icon"></span>{{lyn.nama}}</a>
                    </div>
                </div>
                <div class="col-md-8 ftco-animate p-4 p-md-5 d-flex align-items-center">

                    <div class="tab-content pl-md-5" id="v-pills-tabContent">

                        <div class="tab-pane fade show active py-5" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
                            <span class="icon mb-3 d-block flaticon-ideas"></span>
                            <h2 class="mb-4">{{dtlLayanan.nama}}</h2>
                            <div v-html="dtlLayanan.deskripsi"></div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  -->


    <!--  -->


    <section class="ftco-section ftco-project bg-light" id="projects-section">
        <div class="container px-md-5">
            <div class="row justify-content-center pb-5">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">{{porto.judul}}</span>
                    <h2 class="mb-4">{{porto.judul}}</h2>
                    <div v-html="porto.isi"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="carousel-project owl-carousel">

                        <div class="item" v-for="prj in projek" :key="prj.id">
                            <div class="project">
                                <div class="img">
                                    <img :src="prj.cover" class="img-fixed" width="100%" alt="Colorlib Template">
                                    <div class="text px-4">
                                        <h3><a href="#">{{prj.judul}}</a></h3>
                                        <span>{{prj.nama}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section contact-section ftco-no-pb" id="contact-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">{{kataKontak.judul}}</span>
            <h2 class="mb-4">{{kataKontak.judul}}</h2>
            <div v-html="kataKontak.isi"></div>
          </div>
        </div>
        <div class="row no-gutters block-9">
          <div class="col-md-12 order-md-last d-flex">
            <form action="#" class="bg-light p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>

          </div>

        </div>
        <div class="row d-flex contact-info mb-5">
          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
            <div class="align-self-stretch box p-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="icon-map-signs"></span>
              </div>
              <h3 class="mb-4">Alamat</h3>
              <p>{{konfig.alamat}}</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
            <div class="align-self-stretch box p-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="icon-phone2"></span>
              </div>
              <h3 class="mb-4">Whatsapp</h3>
              <p><a href="">{{konfig.whatsapp}}</a></p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
            <div class="align-self-stretch box p-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="icon-paper-plane"></span>
              </div>
              <h3 class="mb-4">Email</h3>
              <p><a href="mailto:info@yoursite.com">{{konfig.email}}</a></p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
            <div class="align-self-stretch box p-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="icon-globe"></span>
              </div>
              <h3 class="mb-4">Website</h3>
              <p><a href="#">yoursite.com</a></p>
            </div>
          </div>
        </div>

      </div>
    </section>






</div>
</template>

<script>
export default {
    data() {
        return {
            tentangKami: [],
            layanan: [],
            dtlLayanan: [],
            porto: [],
            projek: [],
            timKami: [],
            katatTim: [],
            kataKontak: [],
            konfig: [],
        }
    },
    methods: {
        loadKonfig(){
          axios.get('/api/konfig').then(({
              data
          }) => (this.konfig = data))
        },
        loadkKontak(){
            axios.get('/api/halaman/kalimat-kontak').then(({
                data
            }) => (this.kataKontak = data))

        },
        loadKTim(){
            axios.get('/api/halaman/kalimat-tim').then(({
                data
            }) => (this.katatTim = data))

        },
        loadTim() {
            axios.get('/api/halaman/tim-kami').then(({
                data
            }) => (this.timKami = data))
        },
        loadProjek() {
            axios.get('/api/halaman/projek').then(({
                data
            }) => (this.projek = data))
        },
        loadPorto() {
            axios.get('/api/halaman/porto').then(({
                data
            }) => (this.porto = data))
        },
        detilLayanan(id) {
            axios.get('/api/layanan/' + id).then(({
                data
            }) => (this.dtlLayanan = data))
        },
        loadLayanan() {
            axios.get('/api/layanan').then(({
                data
            }) => (this.layanan = data))
        },
        loadTentang() {
            axios.get('/api/tentang-kami').then(({
                data
            }) => (this.tentangKami = data))
        }
    },
    created() {
        this.loadKonfig();
        this.loadkKontak();
        this.loadKTim();
        this.loadTim();
        this.loadProjek();
        this.loadPorto();
        this.loadLayanan();
        this.loadTentang();
    }
}
</script>
