<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Orders</div>


                    <div class="card-body" style="min-height: 300px;">
                      <div class="card card-default" v-if='filteredProducts.length > 0'>
                          <div class="card-body" style="min-height: 100px;">
                            <h2 style="padding:0px;">Your current Order</h2>


                              <p ><strong> Products in order:       <br/> </strong> <span style="" v-for="(product, index) in filteredProducts" style="padding-right:10px;">
                                {{product.name}}
                              </span>
                              </p>

                              <h3 style="float:right;"  >
                                 Total: <strong> R {{total}} </strong>
                              </h3>




                          </div>

                      </div>

                      <div class="card card-default" v-if='filteredProducts.length == 0'>
                          <div class="card-body" style="min-height: 200px;">
                            <h2 style="padding:0px;">No orders have been placed</h2>



                              <p>
                                To place an order go to the menu under the menu navigation, select items you would like to purchase and checkout.
                              </p>




                          </div>

                      </div>

                      <div class="alert alert-warning" style="position:relative; bottom: 0; width: 100%;">
                        <strong>Orders will reflect here.</strong> Feel free to place an order at any time.</a>.
                      </div>

                      </div>


                    </div>
                </div>.
            </div>
        </div>

    </div>
</template>

<script>
    export default {
      computed: {
        products(){
          return this.$store.state.userorder;
        },
        orders(){
          return this.$store.state.orders;
        },

        filteredProducts:  function(){
            this.tot = 0;
            return this.$store.state.userorder.filter((product) => {

                this.tot += product.price;

                return this.order.push(product);

            });
          },
          total: function(){

            return this.tot;
          }

      },
      data() {
        return {
            counter: 0,
            order: [],
            tot: 0,
            polling: null
        }
      },

      created: function(){
        this.$store.dispatch('load');
        this.$store.dispatch('loadCid');
        this.$store.dispatch('loadUo');
          this.pollData()
        console.log(this.$store.state.currentuserid);
      },
      methods: {
        deleteProduct(product){
          this.$store.commit('deleteProduct', product.id);
        },

        pollData () {
          this.polling = setInterval(() => {
            this.$store.dispatch('loadPo');
            this.$store.dispatch('loadEo');
            this.$store.dispatch('loadCid');
          }, 5000)
        }
      },

      mounted(){
        console.log(this.$store.state.currentuserid);
        console.log(this.$store.state.userorder);


        Echo.private('emp').listen('EmpEvent', (e) => {
              if(e.number.id == this.$store.state.currentuserid )
                this.$store.state.orders = [];
              console.log(e.number.id);

        });
      }
    }
</script>
