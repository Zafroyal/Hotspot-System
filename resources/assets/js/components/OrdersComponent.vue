<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Orders</div>

                    <div class="card-body" style="min-height: 300px;">
                      <div class="card card-default" v-if="total > 0">


                          <div class="card-body">
                            <h3 style="padding:0px;">Order R{{total}}</h3>
                            <p  v-for="(product, index) in products">
                              {{product.name}}
                            </p>
                            <div class="alert alert-warning">
                              <strong>Order under way!</strong> You will be notified on collection</a>.
                            </div>
                          </div>
                      </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
      computed: {
        products(){
          return this.$store.state.orders;
        },
        total: function(){
          let tot = 0;
          this.$store.state.orders.forEach(product => tot += product.price);
          return tot;
        }
      },
      data() {
        return {
            counter: 0
        }
      },
      methods: {
        deleteProduct(product){
          this.$store.commit('deleteProduct', product.id)
        }
      }
    }
</script>
