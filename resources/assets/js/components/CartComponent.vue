<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Menu</div>

                <div class="card-body">
                <div class="card card-default" >

                  <table class="table table-bordered">
                    <thead>
                          <th scope="col">Product</th>
                          <th scope="col">Price</th>
                          <th scope="col">Quantity</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(product, index) in products">

                          <td>{{product.name}}</td>
                          <td>{{product.price}}</td>
                          <td>2</td>
                          <button v-on:click="addProduct (index)"  class="btn btn-danger col-md-2">
                              Add
                          </button>
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
    export default {
        data() {
          return {

              products: [
                {
                  name: 'Cheese',
                  price: 20,
                  quant: 5
                },
                {
                  name: 'Ham',
                  price: 28,
                  quant: 3
                }
              ],
              counter: 0

          }
        },
        methods: {

        }

    }
</script>
