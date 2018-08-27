<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Your cart</div>

                <div class="card-body">
                <div class="card card-default" style="min-height: 300px;">

                  <table class="table-repsonsive table-bordered">
                    <thead>
                          <th scope="col">Product</th>
                          <th scope="col">Price</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Action</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(product, index) in products">

                          <td>{{product.name}}</td>
                          <td>{{product.price}} </td>
                          <td><span style="padding: 5px;"> {{product.quant}}</span>
                            <div class="btn-group btn-group-sm "  style="float: right;" role="group" aria-label="Basic example">
                             <button type="button" class="btn-outline-light" v-on:click="addQuant (product)">+</button>
                             <button type="button" class="btn btn-outline-light" v-on:click="minusQuant (product)">-</button>
                            </div>
                          </td>
                          <td>
                          <button v-on:click="deleteProduct (product)"  class="btn btn-dark">
                              Remove
                          </button>
                         </td>

                        </tr>


                      </tbody>


                    </table>

                    <button style="float: right" type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">

                      Checkout ( Total: R{{total}} )
                    </button>
                </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you would like to place this order?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           Once an order is placed they will be no refunds so please ensure that your order is satisfying.
          </div>
          <div class="modal-footer">
            <a  href="/orders" class="btn btn-success" data-dismiss="modal" v-on:click="copyArray">Accept</a>
            <a  class="btn btn-danger" >Decline</a>
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
            return this.$store.state.cartdata;
          },
          total: function(){
            let tot = 0;
            this.$store.state.cartdata.forEach(product => tot += product.price);
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
            this.$store.commit('deleteProduct',product)
          },
          copyArray(){
            this.$store.commit('copyArray')
          },
          addQuant(product){
            if(product.quant < 3){
              var pq = product.quant += 1;
            }

            return pq;
          },
          minusQuant(product){
            if(product.quant >= 2){
              var pq = product.quant -= 1;
            }
            return pq;
          }
        }

    }
</script>
