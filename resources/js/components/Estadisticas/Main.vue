<template>
  <div>
    <div class="row">
      <div class="col-md-4 col-sm-12">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="mb-0 text-muted">Ventas del mes</p>
                <h2 v-if="salesThisMonth">{{ salesThisMonth.length }}</h2>
                <span
                  v-if="!salesThisMonth"
                  class="spinner-border spinner-border-sm text-primary"
                  role="status"
                  aria-hidden="true"
                ></span>
              </div>
              <span
                class="badge badge-pill badge-cyan font-size-12 badge-success py-2"
                v-if="salesThisMonth"
              >
                <i class="fas fa-arrow-up"></i>
                <span class="font-weight-semibold ml-1">6.71%</span>
              </span>
            </div>
            <div class="m-t-40" v-if="salesThisMonth">
              <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                  <span class="badge badge-primary badge-dot mr-2"></span>
                  <span class="text-gray font-weight-semibold font-size-13"
                    >$23,523</span
                  >
                </div>
                <span class="text-dark font-weight-semibold font-size-13 mt-2"
                  >70%
                </span>
              </div>
              <div class="progress progress-sm w-100 m-b-0 mt-2">
                <div class="progress-bar bg-primary" style="width: 70%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex mb-3">
              <div class="flex-grow-1">
                <h5 class="mb-1">Comentarios</h5>
                <div>Estadísticas de comentarios</div>
              </div>
              <a href="#" data-toggle="dropdown" class="text-muted"
                ><i class="fa fa-redo"></i
              ></a>
            </div>

            <div class="row">
              <div class="col-6 text-center">
                <div
                  class="width-50 height-50 bg-primary-transparent-2 rounded-circle d-flex align-items-center justify-content-center mb-2 ml-auto mr-auto"
                >
                  <i class="fa fa-thumbs-up fa-lg text-primary"></i>
                </div>
                <div class="font-weight-600 text-dark">306.5k</div>
                <div class="fs-13px">Positivos</div>
              </div>

              <div class="col-6 text-center">
                <div
                  class="width-50 height-50 bg-primary-transparent-2 rounded-circle d-flex align-items-center justify-content-center mb-2 ml-auto mr-auto"
                >
                  <i class="fa fa-thumbs-down fa-lg text-danger"></i>
                </div>
                <div class="font-weight-600 text-dark">5</div>
                <div class="fs-13px">Negativos</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="card mb-3 h-100">
          <div class="card-body">
            <div class="d-flex mb-3">
              <div class="flex-grow-1">
                <h5 class="mb-1">Usuarios totales</h5>
                <div>Cuentas registradas en la tienda</div>
              </div>
              <a href="#" data-toggle="dropdown" class="text-muted"
                ><i class="fa fa-redo"></i
              ></a>
            </div>
            <div class="d-flex">
              <div class="flex-grow-1">
                <h3 class="mb-1" v-if="allUsers">{{ allUsers }}</h3>
                <span
                  v-if="!allUsers"
                  class="spinner-border spinner-border-sm text-primary"
                  role="status"
                  aria-hidden="true"
                ></span>
                <div class="text-success font-weight-600 fs-13px">
                  <i class="fa fa-caret-up"></i> +3.59%
                </div>
              </div>
              <div
                class="width-50 height-50 bg-primary-transparent-2 rounded-circle d-flex align-items-center justify-content-center"
              >
                <i class="fa fa-user fa-lg text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 d-flex justify-content-between align-center px-0 mt-3">
      <h1>Estadísticas</h1>
      <div class="d-flex align-center">
        <!-- <button v-on:click="refreshData" class="btn btn-sm btn-primary" style="height: 35px;" ><i class="fas fa-retweet"></i></button> -->
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6">
        <div class="row">
          <div class="col-6 mb-3">
            <div class="card h-100 mb-3">
              <div class="card-body">
                <div class="d-flex mb-3">
                  <div class="flex-grow-1">
                    <h5 class="mb-1">Aceptar comentarios</h5>
                    <div>Hacer visible comentarios</div>
                  </div>
                  <a href="#" data-toggle="dropdown" class="text-muted"
                    ><i class="fa fa-redo"></i
                  ></a>
                </div>

                <div class="col-12 p-0">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a
                        class="nav-link active"
                        id="home-tab"
                        data-toggle="tab"
                        href="#home"
                        role="tab"
                        aria-controls="home"
                        aria-selected="true"
                      >
                        Positivos
                      </a>
                    </li>
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        id="profile-tab"
                        data-toggle="tab"
                        href="#profile"
                        role="tab"
                        aria-controls="profile"
                        aria-selected="false"
                      >
                        Negativos
                      </a>
                    </li>
                  </ul>
                  <div
                    class="tab-content border border-top-0 p-2"
                    id="myTabContent"
                    style="background: #f8fafc"
                  >
                    <div
                      class="tab-pane fade show active"
                      id="home"
                      role="tabpanel"
                      aria-labelledby="home-tab"
                    >
                      ...
                    </div>
                    <div
                      class="tab-pane fade"
                      id="profile"
                      role="tabpanel"
                      aria-labelledby="profile-tab"
                    >
                      ...
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-6 mb-3">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex mb-3">
                  <div class="flex-grow-1">
                    <h5 class="mb-1">Tráfico de la tienda</h5>
                    <div class="fs-13px">Puertas de entrada</div>
                  </div>
                  <a href="#" data-toggle="dropdown" class="text-muted"
                    ><i class="fa fa-redo"></i
                  ></a>
                </div>
                <div class="mb-4">
                  <h3 class="mb-1">320,958</h3>
                  <div class="text-success fs-13px font-weight-600">
                    <i class="fa fa-caret-up"></i> +20.9%
                  </div>
                </div>
                <div class="fs-13px">
                  <div class="d-flex align-items-center mb-2">
                    <div class="flex-grow-1 d-flex align-items-center">
                      <i
                        class="fa fa-circle fs-9px fa-fw text-primary mr-2"
                      ></i>
                      Visitas directas
                    </div>
                    <div class="font-weight-600 text-dark">42.66%</div>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <div class="flex-grow-1 d-flex align-items-center">
                      <i class="fa fa-circle fs-9px fa-fw text-teal mr-2"></i>
                      Paginas publicitadas
                    </div>
                    <div class="font-weight-600 text-dark">36.80%</div>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <div class="flex-grow-1 d-flex align-items-center">
                      <i class="fa fa-circle fs-9px fa-fw text-danger mr-2"></i>
                      Redes sociales
                    </div>
                    <div class="font-weight-600 text-dark">9.20%</div>
                  </div>
                  <div class="d-flex align-items-center mb-15px">
                    <div class="flex-grow-1 d-flex align-items-center">
                      <i
                        class="fa fa-circle fs-9px fa-fw text-gray-200 mr-2"
                      ></i>
                      Otras
                    </div>
                    <div class="font-weight-600 text-dark">5.00%</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-6 mb-3">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex mb-3">
              <div class="flex-grow-1">
                <h5 class="mb-1">Estadísticas de ventas</h5>
                <div class="fs-13px">Gráfico de rendimiento de ventas anuales</div>
              </div>
              <a
                href="#"
                data-toggle="dropdown"
                v-on:click="generateYearChart()"
                class="text-muted"
                ><i class="fa fa-redo"></i
              ></a>
            </div>

            <!-- <GChart
              v-if="chartData"
              type="LineChart"
              :data="chartData"
              :options="chartOptions"
            /> -->

            <LineChart
                ref="lineChart"
                @setData="data"
            />
            
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-6">
        <div class="card mb-3">
          <div class="card-body">
            <div class="d-flex align-items-center mb-4">
              <div class="flex-grow-1">
                <h5 class="mb-1">Bestseller</h5>
                <div class="fs-13px">Top 3 productos mas vendidos del mes</div>
              </div>
              <!-- <a href="#">See All</a> -->
            </div>

            <div class="d-flex align-items-center mb-3">
              <div
                class="d-flex align-items-center justify-content-center mr-3 width-50 height-50"
              >
                <img
                    src="https://seantheme.com/asp-studio/assets/img/product/product-1.jpg"
                    alt="" class="mw-100 mh-100"
                />
              </div>
              <div class="flex-grow-1">
                <div>
                  <div class="text-primary fs-10px font-weight-600">
                    TOP SALES
                  </div>
                  <div class="text-dark font-weight-600">
                    iPhone 11 Pro Max (256GB)
                  </div>
                  <div class="fs-13px">$1,099</div>
                </div>
              </div>
              <div class="pl-3 text-center">
                <div class="text-dark font-weight-600">382</div>
                <div class="fs-13px">sales</div>
              </div>
            </div>

            <div class="d-flex align-items-center mb-3">
              <div
                class="d-flex align-items-center justify-content-center mr-3 width-50 height-50"
              >
                <img
                    src="https://seantheme.com/asp-studio/assets/img/product/product-1.jpg"
                    alt="" class="mw-100 mh-100"
                />
              </div>
              <div class="flex-grow-1">
                <div>
                  <div class="text-dark font-weight-600">
                    Macbook Pro 13 inch (2020)
                  </div>
                  <div class="fs-13px">$1,120</div>
                </div>
              </div>
              <div class="pl-3 text-center">
                <div class="text-dark font-weight-600">102</div>
                <div class="fs-13px">sales</div>
              </div>
            </div>

            <div class="d-flex align-items-center mb-3">
              <div
                class="d-flex align-items-center justify-content-center mr-3 width-50 height-50"
              >
                <img
                    src="https://seantheme.com/asp-studio/assets/img/product/product-1.jpg"
                    alt="" class="mw-100 mh-100"
                />
              </div>
              <div class="flex-grow-1">
                <div>
                  <div class="text-dark font-weight-600">
                    Apple Watch Series 4(2020)
                  </div>
                  <div class="fs-13px">$349</div>
                </div>
              </div>
              <div class="pl-3 text-center">
                <div class="text-dark font-weight-600">75</div>
                <div class="fs-13px">sales</div>
              </div>
            </div>

            <div class="d-flex align-items-center mb-3">
              <div
                class="d-flex align-items-center justify-content-center mr-3 width-50 height-50"
              >
                <img
                    src="https://seantheme.com/asp-studio/assets/img/product/product-1.jpg"
                    alt="" class="mw-100 mh-100"
                />
              </div>
              <div class="flex-grow-1">
                <div>
                  <div class="text-dark font-weight-600">
                    12.9-inch iPad Pro (256GB)
                  </div>
                  <div class="fs-13px">$1,099</div>
                </div>
              </div>
              <div class="pl-3 text-center">
                <div class="text-dark font-weight-600">62</div>
                <div class="fs-13px">sales</div>
              </div>
            </div>

            <div class="d-flex align-items-center">
              <div
                class="d-flex align-items-center justify-content-center mr-3 width-50 height-50"
              >
                <img
                    src="https://seantheme.com/asp-studio/assets/img/product/product-1.jpg"
                    alt="" class="mw-100 mh-100"
                />
              </div>
              <div class="flex-grow-1">
                <div>
                  <div class="text-dark font-weight-600">iPhone 11 (128gb)</div>
                  <div class="fs-13px">$799</div>
                </div>
              </div>
              <div class="pl-3 text-center">
                <div class="text-dark font-weight-600">59</div>
                <div class="fs-13px">sales</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2">
              <div class="flex-grow-1">
                <h5 class="mb-1">Transacciones</h5>
                <div class="fs-13px">Historial de últimas transacciones</div>
              </div>
              <a v-bind:href="this.transaccionesRoute">Ver todas</a>
            </div>

            <div class="table-responsive mb-n2">
              <table class="table table-borderless mb-0">
                <thead>
                  <tr class="text-dark">
                    <th class="pl-0">No</th>
                    <th>Detalle de compra</th>
                    <th class="text-center">Estado</th>
                    <th class="text-right pr-0">Precio</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="pl-0">1.</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="ml-3 flex-grow-1">
                          <div class="font-weight-600 text-dark">
                            Macbook Pro 15 inch
                          </div>
                          <div class="fs-13px">5 minutes ago</div>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">
                      <span
                        class="badge bg-success-transparent-2 text-success"
                        style="min-width: 60px"
                        >Success</span
                      >
                    </td>
                    <td class="text-right pr-0">$1,699.00</td>
                  </tr>
                  <tr>
                    <td class="pl-0">2.</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="ml-3 flex-grow-1">
                          <div class="font-weight-600 text-dark">
                            Apple Watch 5 Series
                          </div>
                          <div class="fs-13px">5 minutes ago</div>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">
                      <span
                        class="badge bg-success-transparent-2 text-success"
                        style="min-width: 60px"
                        >Success</span
                      >
                    </td>
                    <td class="text-right pr-0">$699.00</td>
                  </tr>
                  <tr>
                    <td class="pl-0">3.</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="ml-3 flex-grow-1">
                          <div class="font-weight-600 text-dark">
                            iPhone 11 Pro Max
                          </div>
                          <div class="fs-13px">12 minutes ago</div>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">
                      <span
                        class="badge bg-warning-transparent-2 text-warning"
                        style="min-width: 60px"
                        >Pending</span
                      >
                    </td>
                    <td class="text-right pr-0">$1,299.00</td>
                  </tr>
                  <tr>
                    <td class="pl-0">4.</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="ml-3 flex-grow-1">
                          <div class="font-weight-600 text-dark">
                            Apple Magic Keyboard
                          </div>
                          <div class="fs-13px">15 minutes ago</div>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">
                      <span
                        class="badge text-dark-transparent-5"
                        style="min-width: 60px"
                        >Cancelled</span
                      >
                    </td>
                    <td class="text-right pr-0">$199.00</td>
                  </tr>
                  <tr>
                    <td class="pl-0">5.</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="ml-3 flex-grow-1">
                          <div class="font-weight-600 text-dark">
                            iPad Pro 15 inch
                          </div>
                          <div class="fs-13px">15 minutes ago</div>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">
                      <span
                        class="badge bg-success-transparent-2 text-success"
                        style="min-width: 60px"
                        >Cancelled</span
                      >
                    </td>
                    <td class="text-right pr-0">$1,099.00</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { GChart } from "vue-google-charts";
import { BarLoader } from "@saeris/vue-spinners";
import LineChart from '../StatsCharts/LineChart';
import {months} from '../../../constants';
export default {
    props: ['transaccionesRoute'],
  components: {
    GChart,
    LineChart
  },
  data() {
    return {
        months: months,
        data: [],
        salesThisMonth: [],
        usersThisMonth: [],
        allUsers: 0,
        loading: false
    };
  },
  methods: {
    salesInThisMonth: function () {
      this.salesThisMonth = null;
      axios.get("/api/getAllSalesThisMonth").then((response) => {
        this.salesThisMonth = response.data;
      });
    },
    usersInThisMonth: function () {
      this.usersThisMonth = null;
      this.allUsers = null;
      axios.get("/api/getAllUserThisMonth").then((response) => {
        this.usersThisMonth = response.data[0];
        this.allUsers = response.data[1];
      });
    },
    generateYearChart: function () {
      axios.get("/api/generateYearChart").then((response) => {
        this.$refs.lineChart.drawChart(response.data, this.months);
      });
    },
  },
  mounted() {
    this.salesInThisMonth();
    this.usersInThisMonth();
    this.generateYearChart();
  },
};
</script>