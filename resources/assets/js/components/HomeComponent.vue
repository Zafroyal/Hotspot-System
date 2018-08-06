<template>
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-md-12">
                <div class="card card-default" >
                    <div class="card-header">Menu</div>

                    <div class="card-body"  style="min-height: 300px;">
                    <div class="card card-default"  v-for="(products, index) in filteredProducts" >


                        <div class="card-body">
                          <h2 style="padding:0px;">{{products.name}}   R{{products.price}}  </h2>

                          <p>{{products.description}}</p>
                          <button type="submit" v-on:click="add (products)" class="btn btn-danger">
                              Add to cart
                          </button>
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
      data:function() {
          return {

          };
      },

      created: function(){
        this.$store.dispatch('load');
      },

      computed: {

        filteredProducts: function(){
            return this.$store.state.products;
        },

        filteredCart: function(){
            return this.cartdata;
        }
      },


      methods: {
        add:function(product){
            this.$store.commit({
              type:'addProduct',
              productID: product.id,
              productName: product.name,
              productPrice: product.price,
              productQuantity: 1,
              inCart: false
            });
        }

      },

      mounted(){

      }

}
</script>
