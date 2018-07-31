<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Menu</div>
                    Cart
                    <div v-for="(product, index) in cartdata">
                      {{product.name}}
                    </div>
                    <br/>
                     R {{total}}

                    <div class="card-body" v-for="(products, index) in filteredProducts">
                    <div class="card card-default" >


                        <div class="card-body">
                          <h2 style="padding:0px;">{{products.name}}   R{{products.price}}  </h2>

                          <p>{{products.description}}</p>
                          <button type="submit" v-on:click="addProduct (products)" class="btn btn-danger">
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
            products: [],
            cartdata: [

            ]
          };
      },

      created: function(){
        let uri = 'http://localhost:8000/proapi/';
        Axios.get(uri).then((response) => {
          this.products = response.data;
        });



      },
      computed: {
        filteredProducts: function(){
            return this.products;
        },

        total: function(){

          var tot = 0;


          this.cartdata.forEach(product => tot += product.price)

          return tot;
        }

      },


      methods: {

        addProduct: function(product){


              this.cartdata.push({
                id: product.id,
                name: product.name,
                price: product.price,
                description: product.description


              })


        }
      },

      mounted(){

      }

}
</script>
