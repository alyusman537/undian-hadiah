<!DOCTYPE html>
<html>

  <head>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900"
      rel="stylesheet">
    <link
      href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css"
      rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css"
      rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1,
      maximum-scale=1, user-scalable=no, minimal-ui">
  </head>

  <body>
    <div id="app">
      <v-app>
        <v-main>
          <v-toolbar color="info" dark>
            <v-toolbar-title><p class="text-h5"> RAT BMT MASLAHAH XXV</p></v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn text @click="gotoBack"><v-icon>mdi-undo-variant</v-icon></v-btn>
          </v-toolbar>
          <v-container grid-list-xs>
            <v-row>
              <v-col cols="12">
                <v-card class="elevation-0">
                  <v-card-text>
                    <v-row>
                      <v-col cols="6">
                        <v-row>
                          <v-col cols="6">
                            <v-autocomplete
                              v-model="hadiahTerpilih"
                              :items="listHadiah"
                              item-text="nama"
                              item-value="kode"
                              label="Daftar hadiah"></v-autocomplete>
                          </v-col>
                          <v-col cols="3">
                            <v-btn color="info" block class="mt-3"
                              @click="pilihHadiah">Pilih</v-btn>
                          </v-col>
                          <v-col cols="3">
                            <v-btn color="info" block class="mt-3"
                              @click="resetHadiah">Reset</v-btn>
                          </v-col>
                          <v-col cols="12">
                            <v-img max-height="400" width="100%" class="mx-auto"
                              :src="hadiah.foto"></v-img>
                          </v-col>
                        </v-row>
                      </v-col>
                      <v-col cols="6">
                        <v-card class="elevation-0">
                          <div v-if="hadiah.isSelected">

                            <v-row>
                              <v-col cols="12">
                                <p class="text-subtitle text-center text-grey">{{
                                  hadiah.kode }}</p>
                                <p class="text-h5 text-center success--text">{{
                                  hadiah.qty }} {{ hadiah.nama }} </p>
                                <p class="text-center text-h6 text-subtitle">Persembahan
                                  dari</p>
                                <p class="text-h5 text-center primary--text">{{
                                  hadiah.keterangan }}</p>
                              </v-col>
                              <v-col cols="6">
                                <div class="ma-auto" style="max-width: 200px">
                                  <v-otp-input
                                    v-model="otp"
                                    :length="length"></v-otp-input>
                                </div>
                              </v-col>

                              <v-col cols="3" class="my-3">
                                <v-btn block :disabled="!isActive"
                                  @click="pilihPemenang" color="success">Go..!!!</v-btn>
                              </v-col>
                              <v-col cols="3" class="my-3">
                                <v-btn block :disabled="!isCari"
                                  @click="simpanPemenang" color="success">SIMPAN</v-btn>
                              </v-col>
                              <!-- </v-row> -->
                              <!-- </v-col> -->
                              <v-col cols="12">
                                <div v-if="isTerpilih">
                                  <p class="red--text text-h5 text-center">NOMOR
                                    NIA: {{ anggotaTerpilih.nia }}</p>
                                  <p class="text-h4 text-center">{{
                                    anggotaTerpilih.nama }}</p>
                                  <p class="text-h6 grey--text text-center">{{
                                    anggotaTerpilih.alamat }}</p>
                                  <p class="text-h6 grey--text text-center">Kelompok:
                                    {{ anggotaTerpilih.kelompok }}</p>
                                </div>
                              </v-col>
                            </v-row>
                          </div>
                        </v-card>
                      </v-col>
                    </v-row>

                  </v-card-text>
                </v-card>
              </v-col>
              <v-col cols="12">
                <template>
                  <v-simple-table  v-if="hadiah.isSelected">
                    <template v-slot:default>
                      <thead>
                        <tr>
                          <th class="text-left">#</th>
                          <th class="text-left">NIA</th>
                          <th>Nama Pemenang</th>
                          <th>Alamat</th>
                          <th>Kelompok</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(p,
                          index) in
                          listPemenang" :key="index">
                          <td>{{ index+1
                            }}</td>
                          <td>{{ p.anggota }}</td>
                          <td>{{
                            p.namaAnggota
                            }}</td>
                          <td>{{ p.alamat }}</td>
                          <td>{{
                            p.kelompok
                            }}</td>
                        </tr>
                      </tbody>
                    </template>
                  </v-simple-table>
                </template>
              </v-col>
            </v-row>

          </v-container>
        </v-main>
      </v-app>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="http://192.168.1.199/rat25/render/js/undian.js"></script>
  </body>

</html>