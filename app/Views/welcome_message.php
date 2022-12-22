<!DOCTYPE html>
<html>
    <head>
        <link
            href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900"
            rel="stylesheet">
        <link
            href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css"
            rel="stylesheet">
        <link
            href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css"
            rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1,
            maximum-scale=1, user-scalable=no, minimal-ui">
    </head>
    <body>
        <div id="app">
            <v-app>
                <v-main>
                    <v-row>
                        <v-col cols=12>
                            <v-card class="elevation-0" tile>
                                <v-img
                                    height="200px"
                                    src="http://192.168.1.199/rat25/assets/bmt.jpg"
                                    >
                                    <v-app-bar
                                        flat
                                        color="rgba(0, 0, 0, 0)">
                                        <v-app-bar-nav-icon color="white"></v-app-bar-nav-icon>
                                        <v-toolbar-title class="text-h6
                                            white--text pl-0">
                                            RAT XXV TAHUN 2022
                                        </v-toolbar-title>

                                        <v-spacer></v-spacer>

                                        <v-btn
                                            color="primary"
                                            dark
                                            absolute
                                            right
                                            fab
                                            @click="gotoUndian">
                                            <v-icon>mdi-plus</v-icon>
                                        </v-btn>
                                    </v-app-bar>
                                    <v-card>
                                    </v-col>

                                    <v-card min-width="1200" class="mx-auto
                                        elevation-0">
                                        <v-card-text>
                                            <p class="text-h6">
                                                DAFTAR PEMENANG HADIAH RAT XXV
                                                TAHUN 2022
                                            </p>
                                            <template>
                                                <v-simple-table>
                                                    <template v-slot:default>
                                                        <thead>
                                                            <tr>
                                                                <th
                                                                    class="text-left">#</th>
                                                                <th
                                                                    class="text-left">Hadiah</th>
                                                                <th>NIA</th>
                                                                <th>Nama</th>
                                                                <th>Alamat</th>
                                                                <th>Kelompok</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                v-for="(p,
                                                                index) in
                                                                listPemenang"
                                                                :key="index">
                                                                <td>{{ index+1
                                                                    }}</td>
                                                                <td>{{
                                                                    p.namaHadiah
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
                                        </v-card-text>
                                    </v-card>
                                    <v-col cols=12>
                                    </v-col>
                                </v-row>

                            </v-card-text>
                        </v-card>
                    </v-main>
                </v-app>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.min.js"></script>
            <script
                src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.js"></script>
            <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
            <script src="<?=base_url();?>/render/js/home.js"></script>
            <!-- <script src="http://192.168.1.199/rat25/render/js/home.js"></script> -->
        </body>
    </html>