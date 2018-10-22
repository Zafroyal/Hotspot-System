<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Your cart</div>

                <div class="card-body">
                <div class="card card-default" style="min-height: 300px;" >


                      <div class="card-body" style="min-height: 200px;" v-if='total == 0'>
                        <h2 style="padding:0px;">No items in cart</h2>



                          <p>
                            To place add items to cart go to the menu and select items you would like to purchase.
                          </p>




                      </div>


                  <table class="table-repsonsive table-bordered " v-if='total > 0'>
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
                             <button type="button" class="btn-outline-dark" v-on:click="addQuant (product)" v-if='total <= 100'>+</button>
                             <button type="button" class="btn-outline-light" v-on:click="addQuant (product)" v-if='total > 100' disabled>+</button>

                             <button type="button" class="btn btn-outline-dark" v-on:click="minusQuant (product)">-</button>
                            </div>
                          </td>
                          <td>
                          <button v-on:click="deleteProduct (product)" style="float: right;" class="btn btn-dark ">
                              Remove
                          </button>
                         </td>

                        </tr>




                      </tbody>


                    </table>

                    <button  style="width: 100%; position:relative; bottom:0" type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" v-if='total < 100 && (currentid == 8 || currentid == 7)'>
                      Checkout ( Total: R{{total}} ) {{fullcart}}
                    </button>
                    <button  style="width: 100%; position:relative; bottom:0" type="submit" class="btn btn-danger"  v-if='currentid != 7 && currentid != 8'>
                      Order privileges inactive 
                    </button>
                    <button  style="width: 100%; position:relative; bottom:0" type="submit" class="btn btn-danger" data-toggle="modal" data-target="#cartfull" v-if='total > 100'>
                       {{fullcart}}
                    </button>
                </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-if='orderArray.length == 0 && total > 0' >
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
            <a  href="/orders" class="btn btn-primary" data-dismiss="modal"  v-on:click="copyArray(), send(), clearCart()">Accept</a>
            <a  class="btn btn-danger"   data-dismiss="modal"  >Decline</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-if='orderArray.length > 0 && total > 0' >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Your order is currently being processed</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           Once the order is complete you will then be able to place other order.
          </div>
          <div class="modal-footer">
            <a  class="btn btn-danger" data-dismiss="modal"  >Dismiss</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cartfull" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Your cart is currently over the price limit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           Your current total in the cart is R{{total}}. Make sure that this total is less than R100
          </div>
          <div class="modal-footer">
            <a  class="btn btn-danger" data-dismiss="modal"  >Dismiss</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-if='total == 0' >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cart is empty</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           There are no items in the cart. Make sure you select items in cart before checking out.
          </div>
          <div class="modal-footer">
            <a  class="btn btn-danger"   data-dismiss="modal"  >Dismiss</a>
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
            counter: 0,
            tot: 0,
            currid: 0,
        }
      },
        computed: {
          products(){
            return this.$store.state.cartdata;
          },

          total: function(){
            this.$store.state.cartdata.forEach(product => this.tot += product.price * product.quant);
            return this.tot;
          },
          fullcart: function(){
            if(this.tot > 100){
              return 'Cart full, Total over R100';
            } else {
              return '';
            }
          },
          orderArray(){
            return this.$store.state.orders;
          },

          currentid(){
            return this.$store.state.currentuserid;
          }

        },

        methods: {
          deleteProduct(product){
            this.tot = 0;
            this.$store.commit('deleteProduct',product)
          },

          copyArray(){
            this.$store.commit('copyArray')
          },
          addQuant(product){
            this.tot = 0;
            if(product.quant < 5){
              var pq = product.quant += 1;
            }

            return pq;
          },
          clearCart(){
              this.$store.state.cartdata = [];
              this.tot = 0;
          },
          minusQuant(product){
            this.tot = 0;
            if(product.quant >= 2){
              var pq = product.quant -= 1;
            }
            return pq;
          },
          send(){
            if(this.tot <= 100){
              axios.post('/send', {
                orders: this.$store.state.cartdata
              }).then(response => {
                console.log(response);

              }).catch(error => {
                console.log(error.response);
              });
            }
          }
        }

    }
</script>
