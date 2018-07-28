<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Menu</div>

                    <div class="card-body" v-for="(products, index) in filteredProducts">
                    <div class="card card-default" >


                        <div class="card-body">
                          <h2 style="padding:0px;">{{products.name}}   R{{products.price}} </h2>

                          <p>{{products.description}}</p>
                          <button type="submit" class="btn btn-danger">
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
          return {products: ''};
      },
      created: function(){
        let uri = 'http://127.0.0.1:8000/proapi/';
        Axios.get(uri).then((response) => {
          this.products = response.data;
        });
      },
      computed: {
        filteredProducts: function(){
            return this.products;
        }

      }

}
</script>
