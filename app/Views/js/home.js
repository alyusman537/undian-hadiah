new Vue({
  el: '#app',
  vuetify: new Vuetify(),
  data: {
    url: 'http://192.168.1.199/rat25',
    listPemenang: []
  },
  mounted() {
    this.allPemenang()
  },
  methods: {
    async allPemenang(){
      await axios.get(`${this.url}/pemenang/daftar`)
      .then((res) => {
        this.listPemenang = res.data
        console.log(res.data);
      }).catch((err) => {
        
      });
    },
    gotoUndian(){
      window.open(this.url+'/undian', '_self')
    }
  },
})