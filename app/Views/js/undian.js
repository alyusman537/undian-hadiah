new Vue({
  el: '#app',
  vuetify: new Vuetify(),
  data: {
    url: 'http://192.168.1.199/rat25',
    listHadiah: [],
    hadiahTerpilih: null,
    hadiah: {
      isSelected: false,
      kode: null,
      nama: null,
      qty: null,
      keterangan: null,
      nominal:null,
      level: null,
      foto: null,
      tampil: null,
    },
    listPeserta: [],
    listPemenang: [],
    anggotaTerpilih: {
      nia: null,
      nama: null,
      alamat: null,
      kelompok: null,
    },
    otp: '',
      length: 4,
      dialogPemenang: false,
      isCari: false,
      isTerpilih: false,
  },
  computed: {
    isActive () {
      return this.otp.length === this.length
    },
  },
  mounted() {
    this.allHadiah()
    this.allPeserta()
  },
  methods: {
    async allHadiah(){
      await axios.get(`${this.url}/undian/daftar/hadiah`)
      .then((res) => {
        console.log('ini list hadiah ',res.data);
        /*
        oto: (...)
id: (...)
keterangan: (...)
kode: (...)
level: (...)
nama: (...)
nominal: (...)
qty: (...)
qty_pemenan:(...)
        */
        this.listHadiah = res.data.map((el) => {
          const dorong = {
            foto: el.foto == null? 'no-image.jpg' : el.foto,
            id: el.id,
            keterangan: el.keterangan,
            kode: el.kode,
            level: el.level,
            nama: el.kode +  ' - '+ String(parseInt(el.qty) - parseInt(el.qty_pemenang)) + ' Unit - '+ el.nama,
            nominal: el.nominal
          }
          return dorong
        })
      }).catch((err) => {
        console.log('allhadiah', err.response.data);
      });
    },
    async allPeserta(){
      await axios.get(`${this.url}/undian/daftar/peserta`)
      .then((res) => {
        this.listPeserta = res.data
      }).catch((err) => {
        
      });
    },
    async pilihPemenang(){
      if(this.hadiah.qty == 0) {
        Swal.fire(
          'Gagal!',
          'Hadiah sudah kosong.',
          'error'
        )
      }
      await axios.get(`${this.url}/undian/pilih-pemenang/${this.otp}`)
      .then((res) => {
        this.anggotaTerpilih.nia = res.data.peserta.nia
        this.anggotaTerpilih.nama = String(res.data.peserta.nama).toUpperCase()
        this.anggotaTerpilih.alamat = String(res.data.peserta.alamat).toLocaleUpperCase()
        this.anggotaTerpilih.kelompok = String(res.data.peserta.kelompok).toUpperCase()
        console.log(res.data);
        this.isCari = true
        this.isTerpilih = true
      }).catch((err) => {
        Swal.fire(
          'Gagal!',
          err.response.data.messages.error,
          'error'
        )
        console.log(err.response.data.messages.error);
      });
    },
    async allPemenang(hadiah){
      await axios.get(`${this.url}/undian/daftar/pemenang/${hadiah}`)
      .then((res) => {
        this.listPemenang = res.data
      }).catch((err) => {
        console.log(err.response.data);
      });
    },
    async pilihHadiah(){
      await axios.get(`${this.url}/undian/hadiah-terpilih/${this.hadiahTerpilih}`)
      .then((res) => {
        console.log(res.data)
        this.resetPesertaTerpilih()

        this.hadiah.isSelected = true
        this.hadiah.kode = res.data.kode
        this.hadiah.nama = String(res.data.nama).toUpperCase()
        this.hadiah.qty = parseInt(res.data.qty) - parseInt(res.data.qty_pemenang)
        this.hadiah.keterangan = String(res.data.keterangan).toUpperCase()
        this.hadiah.nominal = res.data.nominal
        this.hadiah.level = res.data.level
        this.hadiah.foto = res.data.foto == null ? `${this.url}/render/image/no-image.jpg` : `${this.url}/render/image/${res.data.foto}`
        this.hadiah.tampil = `${res.data.kode} - ${this.hadiah.qty} Unit - ${this.hadiah.nama}`
        
        this.allPemenang(this.hadiahTerpilih)
      }).catch((err) => {
        
      });
    },
    resetHadiah(){
      this.hadiahTerpilih = null

      this.hadiah.isSelected = false
      this.hadiah.kode = null
      this.hadiah.nama = null
      this.hadiah.qty = null
      this.hadiah.keterangan = null
      this.hadiah.nominal = null
      this.hadiah.level = null
      this.hadiah.foto = null
    },
    resetPesertaTerpilih(){
      this.anggotaTerpilih.nia = null
        this.anggotaTerpilih.nama = null
        this.anggotaTerpilih.alamat = null
        this.anggotaTerpilih.kelompok = null
        this.otp = ''
    },
    async simpanPemenang(){
      const param = {
        hadiah: this.hadiah.kode,
        anggota: this.anggotaTerpilih.nia,
        keterangan: null
      }
      await axios.post(`${this.url}/undian/simpan-pemenang`, param)
      .then((res) => {
        console.log(res.data);
        
        this.resetPesertaTerpilih()
        this.allHadiah()
        this.pilihHadiah()
        this.hadiah.qty = this.hadiah.qty - 1
        this.isCari = false
        this.isTerpilih = false
        // if(this.hadiah.qty == 0) {
        //   this.hadiah.isSelected = false
        // this.hadiah.kode = null
        // this.hadiah.nama = null
        // this.hadiah.qty = null
        // this.hadiah.keterangan = null
        // this.hadiah.nominal = null
        // this.hadiah.level = null
        // this.hadiah.foto = null
        // }
      }).catch((err) => {
        Swal.fire(
          'Gagal!',
          err.response.data.messages.error,
          'error'
        )
        console.log(err.response.data.messages.error);
      });
    },
    gotoBack(){
      window.open(this.url+'/', '_self')
    }
  },
})